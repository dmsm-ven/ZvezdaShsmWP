(function () {
  // Верхняя полоса: показать, если ещё не закрывали
  var promo = document.getElementById('promo');
  if (promo) {
    var closed = false;
    try { closed = localStorage.getItem('promoClosed') === '1'; } catch (e) {}
    if (!closed) promo.hidden = false;
    var btn = promo.querySelector('.promo__close');
    if (btn) btn.addEventListener('click', function () {
      promo.hidden = true;
      try { localStorage.setItem('promoClosed', '1'); } catch (e) {}
    });
  }
  // Мобильное меню
  var toggle = document.querySelector('.nav-toggle');
  var nav = document.getElementById('site-nav');
  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      var open = nav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  }
})();
