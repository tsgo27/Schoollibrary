$(document).ready(function () {
  function setupAuthorAutocomplete(inputSelector, suggestionsSelector) {
    $(document).on("input", inputSelector, function () {
      let input = $(this).val().trim();

      if (input.length >= 2) {
        $.ajax({
          url: "../Models/get_nome_autor.php",
          type: "POST",
          data: { input: input },
          dataType: "html",
          success: function (data) {
            $(suggestionsSelector).html(data);
          },
          error: function () {
            console.log("Erro ao buscar sugestões.");
          }
        });
      } else {
        $(suggestionsSelector).html("");
      }
    });

    // Ao clicar na sugestão, preencher o campo e ocultar sugestões
    $(document).on("click", ".author-suggestion", function () {
      let authorName = $(this).text();
      $(inputSelector).val(authorName);
      $(suggestionsSelector).html("");
    });
  }

  // Aplica a função nos campos de adição e edição
  setupAuthorAutocomplete("#AddAutor", "#authorSuggestionsEdit");
  setupAuthorAutocomplete("#editaAutor", "#authorSuggestionsEdita");
});
