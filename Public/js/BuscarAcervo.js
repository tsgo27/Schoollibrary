$(document).ready(function() {
  function buscarAcervo(inputSelector, suggestionsSelector) {
    $(inputSelector).on("input", function() {
      let input = $(this).val().trim();
      if (input.length >= 2) {
        $.ajax({
          url: "../Models/get_acervos.php",
          type: "POST",
          data: { input: input },
          dataType: "html",
          success: function(data) {
            $(suggestionsSelector).html(data);
          },
          error: function() {
            console.log("Erro ao buscar sugestões.");
          }
        });
      } else {
        $(suggestionsSelector).html("");
      }
    });
  }

  // Função para preencher o campo ao clicar na sugestão
  $(document).on("click", ".acervo-suggestion", function() {
    let NameAcervo = $(this).text();
    let inputField = $(this).closest("div").prev("input");
    inputField.val(NameAcervo);
    $(".acervo-suggestions").html(""); // Limpa todas as sugestões
  });

  // Aplicando a função aos dois inputs
  buscarAcervo("#AddAcervo", "#acervoSuggestions");
  buscarAcervo("#editaAcervo", "#acervoSuggestionsEdit");
});
