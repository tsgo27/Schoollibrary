$(document).ready(function() {
    $(".xp-menubar").on('click', function() {
      $("#sidebar").toggleClass('active');
      $("#content").toggleClass('active');
    });
  
    $('.xp-menubar, .body-overlay').on('click', function() {
      $("#sidebar, .body-overlay").toggleClass('show-nav');
    });
  
    // Adicione um manipulador de eventos para os elementos do submenu
    $('.submenu-trigger').on('click', function(event) {
      event.preventDefault(); // Impede que o link seja seguido
      var submenuId = $(this).data('submenu'); // Obtém o ID do submenu associado
  
      // Fecha todos os submenus, exceto o submenu associado ao link clicado
      $('.collapse').not('#' + submenuId).removeClass('show-submenu');
      
      // Abre ou fecha o submenu associado ao link clicado
      $('#' + submenuId).toggleClass('show-submenu');
    });
  });
  