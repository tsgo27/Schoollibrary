$(document).ready(function () {
    // Função para exibir o SweetAlert2
    function showAlert(type, title, message) {
        Swal.fire({
            icon: type,
            title: title,
            text: message,
            confirmButtonText: 'Fechar'
        }).then(function () {
            location.reload(); // Recarrega a página após clicar no botão "Fechar"
        });
    }

    // Evento de submissão do formulário dentro do modal
    $('#addEmployeeModal form').on('submit', function (event) {
        event.preventDefault(); // Evita a submissão normal do formulário

        // Realiza a submissão do formulário usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function () {
                showAlert('success', 'Sucesso!', 'Acervo salvo com sucesso!');
            },
            error: function () {
                showAlert('error', 'Erro!', 'Ocorreu um erro ao salvar os dados. Tente novamente.');
            }
        });
    });
});
