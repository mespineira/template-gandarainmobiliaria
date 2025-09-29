(function(){
  // Menú móvil con superposición (overlay)
  var toggleBtn = document.querySelector('.ge-nav-mobile-toggle');
  var closeBtn = document.querySelector('.ge-mobile-menu__close');
  var overlay = document.getElementById('ge-mobile-menu-overlay');
  
  if(toggleBtn && overlay && closeBtn){
    // Abrir el menú
    toggleBtn.addEventListener('click', function(){
      document.body.classList.add('mobile-menu-open');
      overlay.classList.add('is-active');
      overlay.setAttribute('aria-hidden', 'false');
    });

    // Cerrar el menú
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

    // Ajustar el padding-top del body una sola vez
    document.body.style.setProperty('--ge-header-height', totalHeaderHeight + 'px');

    window.addEventListener('scroll', function() {
      if (window.pageYOffset > 150) { // Activar después de 150px de scroll
        document.body.classList.add('header-sticky');
      } else {
        document.body.classList.remove('header-sticky');
      }
    });
  }

})();
