$(document).ready(function () {
    // Função para exibir o SweetAlert de sucesso
    function showSuccessAlert(message) {
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: message,
            confirmButtonText: 'Fechar'
        }).then(function () {
            location.reload(); // Recarrega a página após clicar no botão "Fechar"
        });
    }

    // Evento de submissão do formulário de cadastro
    $('#cadastroForm').submit(function (event) {
        event.preventDefault(); // Evita a submissão normal do formulário

        // Realiza a submissão do formulário usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function () {
                showSuccessAlert('Gênero cadastrado com sucesso.');
            },
            error: function () {
                // Trate os erros de submissão, se necessário
            }
        });
    });
});
