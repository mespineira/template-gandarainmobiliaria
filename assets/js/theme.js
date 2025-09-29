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
  // MODIFICACIÓN: Simplificado para solo añadir/quitar la clase.
  // La lógica de alturas y padding se maneja ahora puramente con CSS.
  var header = document.querySelector('.ge-header');
  if (header) {
    // Escuchador de scroll para activar/desactivar el estado sticky
    window.addEventListener('scroll', function() {
      if (window.pageYOffset > 150) { // Se activa después de 150px de scroll
        document.body.classList.add('header-sticky');
      } else {
        document.body.classList.remove('header-sticky');
      }
    }, { passive: true }); // Mejora de rendimiento
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
