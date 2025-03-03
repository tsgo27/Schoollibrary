$(document).ready(function() {
    function buscarDadosAluno(matricula, campoAluno, campoTurma) {
        if (matricula !== "") {
            $.ajax({
                type: "POST",
                url: "../Models/get_nome_aluno.php",
                data: { matricula: matricula },
                dataType: "json",
                success: function(response) {
                    if (response.erro) {
                        alert(response.erro);
                    } else {
                        $(campoAluno).val(response.nome);
                        $(campoTurma).val(response.turma);
                    }
                },
                error: function() {
                    alert("Erro ao buscar os dados do aluno.");
                }
            });
        }
    }

    // Quando o campo Matricula perde o foco
    $("#add_matricula_aluno").on("blur", function() {
        buscarDadosAluno($(this).val(), "#add_nome_aluno", "#add_turma_aluno");
    });

    $("#editaMatricula").on("blur", function() {
        buscarDadosAluno($(this).val(), "#editaAluno", "#editaTurma");
    });
});
