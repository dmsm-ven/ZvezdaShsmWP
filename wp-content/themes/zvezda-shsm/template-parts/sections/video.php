<?php
$video_title = zvezda_front_page_field('video_title', 'Смотрите матчи клуба');
$video_subtitle = zvezda_front_page_field('video_subtitle', 'Записи матчей и трансляции — на YouTube-канале ' . zvezda_setting('club_name') . ' ТВ.');
$video_url = zvezda_front_page_field('video_url', '');
$video_preview = zvezda_front_page_field('video_preview_image', []);
$video_preview_url = is_array($video_preview) && !empty($video_preview['url'])
    ? $video_preview['url']
    : get_theme_file_uri('/assets/images/maxresdefault.jpg');
?>
<section class="section video-sec">
  <div class="wrap reveal">
    <div class="kicker">Видео</div>
    <h2><?php echo esc_html($video_title); ?></h2>
    <p class="sub" style="margin-bottom:28px"><?php echo esc_html($video_subtitle); ?></p>
    <div
      class="video-card<?php echo $video_url ? ' is-playable' : ''; ?>"
      id="videoCard"
      <?php if ($video_url) : ?>role="button" tabindex="0" data-video-url="<?php echo esc_url($video_url); ?>" aria-label="Смотреть видео матча"<?php endif; ?>
    >
      <img src="<?php echo esc_url($video_preview_url); ?>" alt="<?php echo esc_attr($video_title); ?>" loading="lazy">
      <?php if ($video_url) : ?>
        <div class="play"><svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5.5v13l11-6.5z"></path></svg></div>
        <div class="vtitle">Смотреть видео</div>
      <?php endif; ?>
    </div>
    <div style="text-align:center;margin-top:26px">
      <a class="btn btn-ghost" href="<?php echo esc_url(zvezda_setting('youtube_url')); ?>" target="_blank" rel="noopener">Все видео на YouTube</a>
    </div>
  </div>
</section>