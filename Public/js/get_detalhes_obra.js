$(document).ready(function() {
    $(".visualizarObra").click(function () {
        var obraId = $(this).data("id");
        var status = $(this).data("status");

        $.ajax({
            url: "../Models/get_buscar_detalhes_obra.php",
            type: "POST",
            data: { obra_id: obraId, status: status },
            success: function (response) {
                var data = JSON.parse(response);

                if (data.error) {
                    // Exibir mensagem no modal para "Obra Disponível"
                    $("#detalhesObraBody").html(
                        "<p class='text-center font-weight-bold'>" + data.error + "</p>"
                    );
                } else {
                    // Preencher modal com os dados recebidos
                    var conteudo = "";
                    if (status === 'Reservado') {
                        conteudo = "<b>Aluno:</b> " + data[0].nome_aluno + "<br>" +
                                   "<b>Reserva:</b> " + data[0].data_reserva + "<br>" +
                                   "<b>Data de Expiração:</b> " + data[0].data_expiracao;
                                   
                    } else if (status === 'Emprestado') {
                        conteudo = "<b>Aluno:</b> " + data[0].nome_aluno + "<br>" +
                                   "<b>Empréstimo:</b> " + data[0].data_emprestimo + "<br>" +
                                   "<b>Data de Devolução:</b> " + data[0].data_devolucao;
                    }
                    $("#detalhesObraBody").html(conteudo);
                }

                // Exibir o modal
                $("#detalhesObraModal").modal("show");
            }
        });
    });
});
