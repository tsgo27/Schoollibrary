$(document).ready(function () {
  $("#AddAutor").on("input", function () {
    let input = $(this).val().trim();
    
    if (input.length >= 2) {
      $.ajax({
        url: "../Models/get_nome_autor.php",
        type: "POST",
        data: { input: input },
        dataType: "html", // Garante que a resposta seja tratada como HTML
        success: function (data) {
          $("#authorSuggestions").html(data);
        },
        error: function () {
          console.log("Erro ao buscar sugestões.");
        }
      });
    } else {
      $("#authorSuggestions").html("");
    }
  });

  // Ao clicar na sugestão, preencher o campo e ocultar sugestões
  $(document).on("click", ".author-suggestion", function () {
    let authorName = $(this).text();
    $("#AddAutor").val(authorName);
    $("#authorSuggestions").html("");
  });
});
