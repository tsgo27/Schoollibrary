$(document).ready(function(){
    // Quando o botão "Detalhes" for clicado
    $('a[data-toggle="modal"]').click(function(){
      // Captura os dados dos atributos 'data-*' do botão
      var nome = $(this).data('nome');
      var matricula = $(this).data('matricula');
      var telefone = $(this).data('telefone');
      var email = $(this).data('email');
      var status = $(this).data('status');
      
      // Passa os dados para o modal
      $('#modal-nome').text(nome);
      $('#modal-matricula').text(matricula);
      $('#modal-telefone').text(telefone);
      $('#modal-email').text(email);
      $('#modal-status').text(status);
    });
  });