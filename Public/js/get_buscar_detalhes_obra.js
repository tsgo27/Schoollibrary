$(document).ready(function() {
    $(".visualizarObra").click(function () {
        var obraId = $(this).data("id");
        var status = $(this).data("status");

        // Enviando dados via AJAX
        $.ajax({
            url: "../Models/get_buscar_detalhes_obra.php",
            type: "POST",
            data: { obra_id: obraId, status: status },
            success: function (response) {
                var data = JSON.parse(response);

                if (data.error) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Aviso',
                        text: data.error,
                        confirmButtonText: 'OK'
                    });
                } else {
                    // Exibir dados no modal conforme o status
                    if (status === 'Reservado') {
                        $("#detalhesObraBody").html(
                            "Nome do Aluno: " + data[0].NomeAluno + "<br>" +
                            "Data de Reserva: " + data[0].DataReserva + "<br>" +
                            "Data de Expiração: " + data[0].DataExpiracao
                        );
                    } else if (status === 'Emprestado') {
                        $("#detalhesObraBody").html(
                            "Nome do Aluno: " + data[0].NomeAluno + "<br>" +
                            "Data do Empréstimo: " + data[0].DataEmprestimo + "<br>" +
                            "Data de Devolução: " + data[0].DataDevolucao
                        );
                    }
                    $("#detalhesObraModal").modal("show");
                }
            }
        });
    });
});
