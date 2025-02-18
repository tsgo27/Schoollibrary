$(document).ready(function() {
    $('.verEmprestimos').click(function() {
        let idAluno = $(this).data('id'); // Captura o ID do aluno
        console.log("ID do aluno:", idAluno); // Depuração no console

        $.ajax({
            url: "../Models/get_buscar_emprestimos.php", // Certifique-se que o caminho está correto
            type: 'POST',
            data: {
                id_aluno: idAluno
            },
            dataType: 'json',
            success: function(response) {
                console.log("Dados recebidos:", response); // Depuração

                let modalBody = $('#emprestimosModal .modal-body');
                modalBody.empty(); // Limpa os dados anteriores

                if (response.length > 0) {
                    response.forEach(emprestimo => {
                        modalBody.append(`
                        <p><strong>Livro:</strong> ${emprestimo.TituloLivro}</p>
                        <p><strong>Data Empréstimo:</strong> ${emprestimo.DataEmprestimo}</p>
                        <p><strong>Data Devolução:</strong> ${emprestimo.DataDevolucao}</p>
                        <hr>
                    `);
                    });
                } else {
                    modalBody.append('<p>O aluno não possui empréstimos ativos.</p>');
                }

                $('#emprestimosModal').modal('show'); // Exibe o modal
            },
            error: function(xhr, status, error) {
                console.error("Erro na requisição:", status, error);
            }
        });
    });
});