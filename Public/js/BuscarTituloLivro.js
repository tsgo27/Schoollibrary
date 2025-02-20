$(document).ready(function () {
  function buscarSugestoes(inputField) {
    let input = $(inputField).val();
    if (input.length >= 2) {
      $.ajax({
        url: "../Models/get_titulo_livro.php",
        type: "POST",
        data: { input: input },
        success: function (data) {
          $(inputField).siblings("#tituloSuggestions").html(data);
        }
      });
    } else {
      $(inputField).siblings("#tituloSuggestions").html("");
    }
  }

  // Monitorar tanto o campo de cadastro quanto o de edição
  $(document).on("input", "#AddTitulo, #editaTitulo", function () {
    buscarSugestoes(this);
  });

  // Selecionar sugestão e preencher o campo correto
  $(document).on("click", ".titulo-suggestion", function () {
    let titulo = $(this).data("titulo");

    if ($("#AddTitulo").is(":focus")) {
      $("#AddTitulo").val(titulo);
    } else if ($("#editaTitulo").is(":focus")) {
      $("#editaTitulo").val(titulo);
    }

    $("#tituloSuggestions").html(""); // Limpar sugestões
  });

  // Reativar eventos ao abrir o modal de edição
  $('#editEmployeeModal').on('shown.bs.modal', function () {
    $("#editaTitulo").trigger("input"); // Dispara o evento para ativar a busca
  });
});
