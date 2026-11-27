#requires -Version 5.1
<#
.SYNOPSIS
    Builds a client-ready PDF from website_instruction.md.
.DESCRIPTION
    Prompts for the public website URL, WordPress admin login and password.
    Replaces the local development URL and adds a credentials cover page.

    Requirements:
      - Pandoc (https://pandoc.org/installing.html)
      - Microsoft Edge or Google Chrome
#>

$ErrorActionPreference = 'Stop'

function Get-BrowserPath {
    $candidates = @(
        "${env:ProgramFiles(x86)}\Microsoft\Edge\Application\msedge.exe",
        "$env:ProgramFiles\Microsoft\Edge\Application\msedge.exe",
        "$env:LOCALAPPDATA\Microsoft\Edge\Application\msedge.exe",
        "$env:ProgramFiles\Google\Chrome\Application\chrome.exe",
        "${env:ProgramFiles(x86)}\Google\Chrome\Application\chrome.exe",
        "$env:LOCALAPPDATA\Google\Chrome\Application\chrome.exe"
    )
    foreach ($candidate in $candidates) {
        if (Test-Path -LiteralPath $candidate) { return $candidate }
    }
    return $null
}

function ConvertTo-HtmlText([string]$Value) {
    return [System.Net.WebUtility]::HtmlEncode($Value)
}

$markdownPath = Join-Path $PSScriptRoot 'website_instruction.md'
if (-not (Test-Path -LiteralPath $markdownPath)) {
    throw "Не найден файл инструкции: $markdownPath"
}

$pandocCommand = Get-Command 'pandoc' -ErrorAction SilentlyContinue
if (-not $pandocCommand) {
    throw "Не найден Pandoc. Установите его с https://pandoc.org/installing.html и повторите запуск."
}

$browserPath = Get-BrowserPath
if (-not $browserPath) {
    throw 'Не найден Microsoft Edge или Google Chrome. Установите один из этих браузеров.'
}

Write-Host ''
Write-Host 'Подготовка PDF-инструкции для клиента' -ForegroundColor Cyan
Write-Host '--------------------------------------'

$domainInput = Read-Host '1. Введите домен сайта (например, https://example.ru)'
if ([string]::IsNullOrWhiteSpace($domainInput)) { throw 'Домен не может быть пустым.' }

$domainInput = $domainInput.Trim()
if ($domainInput -notmatch '^https?://') { $domainInput = "https://$domainInput" }

$siteUri = $null
if (-not [Uri]::TryCreate($domainInput, [UriKind]::Absolute, [ref]$siteUri) -or
    $siteUri.Scheme -notin @('http', 'https') -or
    [string]::IsNullOrWhiteSpace($siteUri.Host) -or
    $siteUri.AbsolutePath -ne '/' -or $siteUri.Query -or $siteUri.Fragment) {
    throw 'Укажите только домен сайта, например https://example.ru, без пути и параметров.'
}
$siteUrl = $siteUri.GetLeftPart([UriPartial]::Authority).TrimEnd('/')

$adminLogin = Read-Host '2. Введите логин администратора'
if ([string]::IsNullOrWhiteSpace($adminLogin)) { throw 'Логин не может быть пустым.' }

$securePassword = Read-Host '3. Введите пароль администратора' -AsSecureString
if ($securePassword.Length -eq 0) { throw 'Пароль не может быть пустым.' }

$passwordPointer = [IntPtr]::Zero
$tempDirectory = Join-Path ([System.IO.Path]::GetTempPath()) ("WebsiteManual_" + [Guid]::NewGuid().ToString('N'))
$profileDirectory = Join-Path $tempDirectory 'browser-profile'

try {
    $passwordPointer = [Runtime.InteropServices.Marshal]::SecureStringToBSTR($securePassword)
    $adminPassword = [Runtime.InteropServices.Marshal]::PtrToStringBSTR($passwordPointer)

    $markdown = [System.IO.File]::ReadAllText($markdownPath, [System.Text.Encoding]::UTF8)
    $markdown = $markdown.Replace('http://localhost:8080', $siteUrl)
    $markdown = $markdown.Replace(' (после переноса сайта используйте его постоянный адрес).', '.')

    # Turn important navigation labels into direct links.
    $adminBase = "$siteUrl/wp-admin/"
    $linkMap = [ordered]@{
        'Настройки клуба' = "$adminBase" + 'admin.php?page=zvezda-club-settings'
        'Контактные формы' = "$adminBase" + 'admin.php?page=wpcf7'
        'Вопросы и ответы' = "$adminBase" + 'edit.php?post_type=faq'
        'Тренеры' = "$adminBase" + 'edit.php?post_type=coach'
        'Отзывы' = "$adminBase" + 'edit.php?post_type=review'
        'Записи' = "$adminBase" + 'edit.php'
        'Страницы' = "$adminBase" + 'edit.php?post_type=page'
        'О клубе' = "$siteUrl/about/"
        'Философия' = "$siteUrl/philosophy/"
        'Расписание' = "$siteUrl/schedule/"
        'Медиа' = "$siteUrl/media/"
        'Полезное' = "$siteUrl/useful/"
        'Оплата' = "$siteUrl/payment/"
        'Контакты' = "$siteUrl/contacts/"
        'Главная страница' = "$siteUrl/"
    }

    foreach ($label in $linkMap.Keys) {
        $url = [System.Net.WebUtility]::HtmlEncode($linkMap[$label])
        $markdownLink = "[$label]($url)"
        $pattern = '(?<![\p{L}\p{N}_\[])' + [regex]::Escape($label) + '(?![\p{L}\p{N}_\]])'
        $markdown = [regex]::Replace($markdown, $pattern, [System.Text.RegularExpressions.MatchEvaluator]{ param($match) $markdownLink })
    }

    $loginHtml = ConvertTo-HtmlText $adminLogin
    $passwordHtml = ConvertTo-HtmlText $adminPassword
    $adminUrl = ConvertTo-HtmlText "$siteUrl/wp-admin/"

    [System.IO.Directory]::CreateDirectory($tempDirectory) | Out-Null
    $tempMarkdown = Join-Path $tempDirectory 'website_instruction.md'
    $htmlPath = Join-Path $tempDirectory 'website_instruction.html'
    [System.IO.File]::WriteAllText($tempMarkdown, $markdown, (New-Object System.Text.UTF8Encoding($false)))

    & $pandocCommand.Source $tempMarkdown '--from=gfm' '--to=html5' '--standalone' '--metadata=lang:ru' '--metadata=title:Инструкция по управлению сайтом' '--output' $htmlPath
    if ($LASTEXITCODE -ne 0 -or -not (Test-Path -LiteralPath $htmlPath)) {
        throw 'Pandoc не смог преобразовать Markdown в HTML.'
    }

    $coverHtml = @"
<section class="credentials-page">
  <div class="credentials-card">
    <p class="eyebrow">ИНСТРУКЦИЯ ДЛЯ АДМИНИСТРАТОРА</p>
    <h1>Доступ к сайту</h1>
    <p class="site-address"><a href="$adminUrl">$adminUrl</a></p>
    <div class="credential-row"><span>Логин</span><strong>$loginHtml</strong></div>
    <div class="credential-row"><span>Пароль</span><strong>$passwordHtml</strong></div>
    <p class="security-note">Сохраните эти данные в безопасном месте. Не передавайте PDF посторонним.</p>
  </div>
</section>
"@

    $html = [System.IO.File]::ReadAllText($htmlPath, [System.Text.Encoding]::UTF8)
    $bodyTag = [regex]::Match($html, '(?i)<body[^>]*>')
    if (-not $bodyTag.Success) { throw 'Не удалось подготовить HTML-документ для печати.' }
    $html = $html.Insert($bodyTag.Index + $bodyTag.Length, $coverHtml)

    $styles = @'
<style>
@page { size: A4; margin: 9mm 10mm; }
body { margin: 0; font-family: "Segoe UI", Arial, sans-serif; color: #242424; font-size: 10pt; line-height: 1.38; }
h1, h2, h3 { color: #172b46; line-height: 1.2; page-break-after: avoid; margin-bottom: 0.45em; }
h1 { font-size: 23pt; } h2 { font-size: 16pt; margin-top: 1em; } h3 { font-size: 12pt; margin-top: 0.8em; }
a { color: #075db5; text-decoration-line: underline; text-decoration-style: dotted; text-decoration-color: #075db5; text-underline-offset: 2px; overflow-wrap: anywhere; }
table { width: 100%; border-collapse: collapse; font-size: 9.5pt; }
th, td { border: 1px solid #d5dbe3; padding: 4px 6px; text-align: left; vertical-align: top; }
th { background: #eef2f7; }
blockquote { border-left: 3px solid #9aa9ba; margin: 0.6em 0; padding-left: 9px; color: #555; }
pre, code { overflow-wrap: anywhere; white-space: pre-wrap; }
p { margin: 0.45em 0; }
ul, ol { margin: 0.35em 0; padding-left: 1.5em; }
li { margin: 0.12em 0; }
.credentials-page { height: 275mm; box-sizing: border-box; display: flex; align-items: center; justify-content: center; page-break-after: always; }
.credentials-card { width: 100%; max-width: 155mm; margin: auto; }
.eyebrow { color: #64748b; font-size: 9pt; font-weight: 700; letter-spacing: 1.5px; }
.credentials-card h1 { margin: 10mm 0 3mm; font-size: 30pt; }
.site-address { font-size: 13pt; margin-bottom: 15mm; overflow-wrap: anywhere; }
.credential-row { border-top: 1px solid #d5dbe3; padding: 7mm 0; }
.credential-row span { display: block; color: #64748b; font-size: 9pt; margin-bottom: 2mm; }
.credential-row strong { display: block; font-size: 15pt; overflow-wrap: anywhere; }
.security-note { margin-top: 12mm; color: #64748b; font-size: 9pt; }
</style>
'@
    $html = $html -replace '(?i)</head>', ($styles + '</head>')
    [System.IO.File]::WriteAllText($htmlPath, $html, (New-Object System.Text.UTF8Encoding($false)))

    $desktopPath = [Environment]::GetFolderPath('Desktop')
    if ([string]::IsNullOrWhiteSpace($desktopPath) -or -not (Test-Path -LiteralPath $desktopPath)) {
        $desktopPath = [Environment]::GetFolderPath('MyDocuments')
    }

    $safeHost = $siteUri.Host -replace '[^a-zA-Z0-9.-]', '_'
    $pdfPath = Join-Path $desktopPath "Website_Instruction_$safeHost.pdf"
    if (Test-Path -LiteralPath $pdfPath) { Remove-Item -LiteralPath $pdfPath -Force }
    $htmlUri = ([Uri]$htmlPath).AbsoluteUri
    $quote = [char]34
    $arguments = '--headless --disable-gpu --no-first-run --no-pdf-header-footer ' +
                 "--user-data-dir=$quote$profileDirectory$quote " +
                 "--print-to-pdf=$quote$pdfPath$quote $quote$htmlUri$quote"

    $process = Start-Process -FilePath $browserPath -ArgumentList $arguments -Wait -PassThru
    if ($process.ExitCode -ne 0 -or -not (Test-Path -LiteralPath $pdfPath)) {
        throw 'Браузер не смог создать PDF. Попробуйте закрыть браузер и запустить скрипт ещё раз.'
    }

    $pdfInfo = Get-Item -LiteralPath $pdfPath
    if ($pdfInfo.Length -lt 1000) { throw 'PDF создан, но его размер выглядит некорректно.' }

    Write-Host ''
    Write-Host 'PDF успешно создан:' -ForegroundColor Green
    Write-Host $pdfPath -ForegroundColor Green
    Write-Host ("Размер: {0:N0} КБ" -f ($pdfInfo.Length / 1KB))
    Write-Host ''
    Write-Warning 'PDF содержит логин и пароль в открытом виде. Не добавляйте его в Git и передавайте только доверенному получателю.'
}
finally {
    if ($passwordPointer -ne [IntPtr]::Zero) {
        [Runtime.InteropServices.Marshal]::ZeroFreeBSTR($passwordPointer)
    }
    if (Test-Path -LiteralPath $tempDirectory) {
        Remove-Item -LiteralPath $tempDirectory -Recurse -Force -ErrorAction SilentlyContinue
    }
    $adminPassword = $null
    $securePassword = $null
}
