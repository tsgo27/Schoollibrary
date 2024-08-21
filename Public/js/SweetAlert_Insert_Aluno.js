$(document).ready(function() {
    // Variável para controlar se houve alterações no formulário
    var hasChanges = false;

    // Função para marcar que houve alterações no formulário
    function markChanges() {
        hasChanges = true;
    }

    // Evento para detectar alterações nos campos do formulário
    document.querySelector('input[name="matricula"]').addEventListener('input', markChanges);
    document.querySelector('input[name="nome"]').addEventListener('input', markChanges);
    document.querySelector('input[name="telefone"]').addEventListener('input', markChanges);
    document.querySelector('input[name="email"]').addEventListener('input', markChanges);
    document.querySelector('select[name="user_status"]').addEventListener('change', markChanges);

    // Evento submit do formulário
    document.getElementById('submitAdicionar').addEventListener('click', function (event) {
        event.preventDefault();

        // Se não houver alterações no formulário, não envia os dados
        if (!hasChanges) {
            return;
        }

        // Obtém os dados do formulário
        const idAluno = document.querySelector('input[name="idAluno"]').value;
        const matricula = document.querySelector('input[name="matricula"]').value;
        const nome = document.querySelector('input[name="nome"]').value;
        const telefone = document.querySelector('input[name="telefone"]').value;
        const email = document.querySelector('input[name="email"]').value;
        const status = document.querySelector('select[name="user_status"]').value;

        // Envia os dados do formulário via AJAX
        $.ajax({
            type: "POST",
            url: "../Models/Insert_Aluno.php",
            data: {
                idAluno: idAluno,
                matricula: matricula,
                nome: nome,
                telefone: telefone,
                email: email,
                user_status: status
            },
            success: function(response) {
                // Exibe o SweetAlert de acordo com a resposta do servidor
                if (response === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: 'Cadastro realizado com sucesso.',
                        confirmButtonText: 'Fechar'
                    }).then(function() {
                        // Recarrega a página para atualizar a tabela de Alunos
                        window.location.reload();
                    });
                } else if (response === "error_matricula") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Matricula já cadastrado. Tente outro.',
                        confirmButtonText: 'Fechar'
                    });
                } else if (response === "error_email") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'E-mail já cadastrado. Tente outro.',
                        confirmButtonText: 'Fechar'
                    });
                } else if (response === "error_required") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Preencha todos os campos obrigatórios.',
                        confirmButtonText: 'Fechar'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Erro ao realizar o cadastro. Contate o administrador.',
                        confirmButtonText: 'Fechar'
                    });
                }
            },
            error: function() {
                // Exibe o SweetAlert em caso de erro no AJAX
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Erro ao realizar o cadastro! Contate o administrador.',
                    confirmButtonText: 'Fechar'
                });
            }
        });
    });
});
