$(document).ready(function() {
    function buscarNomeAluno(matricula, campoAluno) {
        if (matricula !== "") {
            $.ajax({
                type: "POST",
                url: "../Models/get_nome_aluno.php",
                data: { matricula: matricula },
                success: function(response) {
                    $(campoAluno).val(response);
                },
                error: function() {
                    alert("Erro ao buscar o nome do aluno.");
                }
            });
        }
    }

    // Adicionar - Quando o campo Matricula perde o foco
    $("#AddMatricula").on("blur", function() {
        buscarNomeAluno($(this).val(), "#AddAluno");
    });

    // Editar - Quando o campo editaMatricula perde o foco
    $("#editaMatricula").on("blur", function() {
        buscarNomeAluno($(this).val(), "#editaAluno");
    });
});
