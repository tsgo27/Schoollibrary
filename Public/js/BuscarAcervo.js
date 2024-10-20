$(document).ready(function() {
  $("#AddAcervo").on("input", function() {
    let input = $(this).val();
    if (input.length >= 2) {
      $.ajax({
        url: "../Models/Read_Acervos.php",
        type: "POST",
        data: { input: input },
        success: function(data) {
          $("#acervoSuggestions").html(data);
        }
      });
    } else {
      $("#acervoSuggestions").html("");
    }
  });

  // Handle the click event on suggested authors
  $(document).on("click", ".acervo-suggestion", function() {
    let NameAcervo = $(this).text();
    $("#AddAcervo").val(NameAcervo);
    $("#acervoSuggestions").html(""); // Clear the suggestions
  });
});

