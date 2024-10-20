$(document).ready(function () {
  $("#AddAutor").on("input", function () {
    let input = $(this).val();
    if (input.length >= 2) {
      $.ajax({
        url: "../Models/Read_Autor.php",
        type: "POST",
        data: { input: input },
        success: function (data) {
          $("#authorSuggestions").html(data);
        }
      });
    } else {
      $("#authorSuggestions").html("");
    }
  });

  // Handle the click event on suggested authors
  $(document).on("click", ".author-suggestion", function () {
    let authorName = $(this).text();
    $("#AddAutor").val(authorName);
    $("#authorSuggestions").html(""); // Clear the suggestions
  });
});

