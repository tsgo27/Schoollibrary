$(document).ready(function() {
    $('.verEmprestimos').click(function() {
        let idAluno = $(this).data('id'); // Captura o ID do aluno
        
        $.ajax({
            url: "../Models/get_buscar_emprestimos.php", 
            type: 'POST',
            data: {
                id_aluno: idAluno
            },
            dataType: 'json',
            success: function(response) {
                console.log("Dados recebidos:", response); 

                let modalBody = $('#emprestimosModal .modal-body');
                modalBody.empty(); // Limpa os dados anteriores

                if (response.length > 0) {
                    response.forEach(emprestimo => {
                        modalBody.append(`
                        <p><strong>Livro:</strong> ${emprestimo.titulo_livro}</p>
                        <p><strong>Data Empréstimo:</strong> ${emprestimo.data_emprestimo}</p>
                        <p><strong>Data Devolução:</strong> ${emprestimo.data_devolucao}</p>
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