$(document).ready(function () {
    var hasChanges = false;

    function markChanges() {
        hasChanges = true;
    }

    // Evento para detectar alterações nos campos do formulário
    document.getElementById('matricula').addEventListener('input', markChanges);
    document.getElementById('editaTurma').addEventListener('input', markChanges);
    document.getElementById('editarNome').addEventListener('input', markChanges);
    document.getElementById('editarTelefone').addEventListener('input', markChanges);
    document.getElementById('editarEmail').addEventListener('input', markChanges);
    document.getElementById('editarStatus').addEventListener('change', markChanges);

    // Evento submit do formulário
    document.getElementById('update').addEventListener('click', function (event) {
        // Se não houver alterações no formulário, permite o envio normal sem alerta
        if (!hasChanges) {
            return;
        }

        // Exibe o alerta SweetAlert2
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: 'Aluno atualizado com sucesso.',
            confirmButtonText: 'Fechar'
        }).then(function () {
            // Submete o formulário após o alerta ser confirmado
            document.getElementById('updateForm').submit();
        });

        // Cancela a submissão para aguardar o alerta
        event.preventDefault();
    });
});
