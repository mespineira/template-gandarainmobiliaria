(function(){
  // Menú móvil con superposición (overlay)
  var toggleBtn = document.querySelector('.ge-nav-mobile-toggle');
  var closeBtn = document.querySelector('.ge-mobile-menu__close');
  var overlay = document.getElementById('ge-mobile-menu-overlay');
  
  if(toggleBtn && overlay && closeBtn){
    toggleBtn.addEventListener('click', function(){
      document.body.classList.add('mobile-menu-open');
      overlay.classList.add('is-active');
      overlay.setAttribute('aria-hidden', 'false');
    });

    closeBtn.addEventListener('click', function(){
      document.body.classList.remove('mobile-menu-open');
      overlay.classList.remove('is-active');
      overlay.setAttribute('aria-hidden', 'true');
    });
  }

  // Header sticky al hacer scroll
  var header = document.querySelector('.ge-header');
  if (header) {
    var topbarHeight = document.querySelector('.ge-topbar') ? document.querySelector('.ge-topbar').offsetHeight : 0;
    var mainHeaderHeight = document.querySelector('.ge-main-header') ? document.querySelector('.ge-main-header').offsetHeight : 0;
    var totalHeaderHeight = topbarHeight + mainHeaderHeight;

    document.body.style.setProperty('--ge-header-height', totalHeaderHeight + 'px');

    window.addEventListener('scroll', function() {
      if (window.pageYOffset > 150) {
        document.body.classList.add('header-sticky');
      } else {
        document.body.classList.remove('header-sticky');
      }
    });
  }

  // Inicialización del Slider Hero
  var heroSlider = document.querySelector('.ge-hero-slider');
  if (heroSlider && typeof Swiper !== 'undefined') {
    const swiper = new Swiper('.ge-hero-slider', {
      loop: true,
      effect: 'fade',
      fadeEffect: {
        crossFade: true
      },
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  }

})();

