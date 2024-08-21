$(document).ready(function () {
    // Evento de submissão do formulário
    $('#cadastroFormu').submit(function (event) {
        event.preventDefault(); // Evita a submissão normal do formulário
        
        // Realiza a submissão do formulário usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function () {
                // Exibe o SweetAlert após o cadastro bem-sucedido
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: 'Reserva atualizado com sucesso.',
                    confirmButtonText: 'Fechar'
                }).then(function () {
                    location.reload(); // Recarrega a página após clicar no botão "Fechar"
                });
            },
            error: function () {
                // Trate os erros de submissão, se necessário
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: 'Ocorreu um erro ao atualizar a Emprestimo.',
                    confirmButtonText: 'Fechar'
                });
            }
        });
    });
});