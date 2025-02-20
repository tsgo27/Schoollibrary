$(document).ready(function () {
  $("#AddTitulo").on("input", function () {
    let input = $(this).val();
    if (input.length >= 2) {
      $.ajax({
        url: "../Models/get_titulo_livro.php",
        type: "POST",
        data: { input: input },
        success: function (data) {
          $("#tituloSuggestions").html(data);
        }
      });
    } else {
      $("#tituloSuggestions").html("");
    }
  });

  // Handle the click event on suggested titles
  $(document).on("click", ".titulo-suggestion", function () {
    let titulo = $(this).data('titulo');


    // Preencher automaticamente os campos Título
    $("#AddTitulo").val(titulo);
 
    

    $("#tituloSuggestions").html(""); // Clear the suggestions
  });
});