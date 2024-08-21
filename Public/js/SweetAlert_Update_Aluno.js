$(document).ready(function () {
    // Variável para controlar se houve alterações no formulário
    var hasChanges = false;
    
    // Função para marcar que houve alterações no formulário
    function markChanges() {
        hasChanges = true;
    }

    // Evento para detectar alterações nos campos do formulário
    document.getElementById('matricula').addEventListener('input', markChanges);
    document.getElementById('editarNome').addEventListener('input', markChanges);
    document.getElementById('editarTelefone').addEventListener('input', markChanges);
    document.getElementById('editarEmail').addEventListener('input', markChanges);
    document.getElementById('editarStatus').addEventListener('input', markChanges);

    // Evento submit do formulário
    document.getElementById('update').addEventListener('click', function (event) {
        // Se não houver alterações no formulário, não exibe o alerta e deixa o formulário ser submetido normalmente
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

        // Cancela o evento de submissão do formulário para que não seja enviado sem a exibição do alerta
        event.preventDefault();
    });
});

