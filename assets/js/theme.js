(function(){
  var btn = document.querySelector('.ge-nav__toggle');
  var menu = document.getElementById('ge-menu');
  if(btn && menu){
    btn.addEventListener('click', function(){
      var expanded = btn.getAttribute('aria-expanded') === 'true';
      btn.setAttribute('aria-expanded', String(!expanded));
      menu.classList.toggle('is-open');
    });
  }
})();