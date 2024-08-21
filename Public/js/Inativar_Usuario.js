$(document).ready(function () {
    // Evento de clique no botão "Inativar" ou "Ativar"
    $(document).on('click', '.btn-status', function (event) {
        event.preventDefault();

        // Obtém a matrícula do usuário a ser inativado/ativado
        const matricula = $(this).closest('tr').data('matricula');
        // Obtém o status atual do usuário
        const statusAtual = $(this).closest('tr').data('user-status');
        // Obtém o botão clicado
        const botao = $(this);

        console.log('Matrícula:', matricula);
        console.log('Status Atual:', statusAtual);

        // Define o novo status com base no status atual
        const novoStatus = statusAtual === 'Ativo' ? 'Inativo' : 'Ativo';
        // Define a ação com base no novo status
        const acao = novoStatus === 'Ativo' ? 'ativarUsuario' : 'inativarUsuario';


        console.log('Novo Status:', novoStatus);
        console.log('Ação:', acao);

        // Envia os dados via AJAX para atualizar o status no banco de dados
        $.ajax({
            type: 'POST',
            url: `../Models/Update_Status_Usuario.php?acao=${acao}`,
            data: {
                matricula: matricula,
                novo_status: novoStatus
            }
        }).done(function (response) {
            console.log('Resposta da Requisição:', response);
            // Se a atualização for bem-sucedida, atualiza o status na tabela e no botão
            if (response === 'success') {
                // Atualiza o status na tabela
                $(botao).closest('tr').data('user-status', novoStatus);
                $(botao).closest('tr').find('td:nth-child(6)').text(novoStatus);
                // Atualiza o texto e classe do botão
                $(botao).val(novoStatus === 'Ativo' ? 'Inativar' : 'Ativar');
                $(botao).toggleClass('btn-danger btn-success');
            } else {
                // Exibe uma mensagem de erro em caso de falha
                alert('Erro ao atualizar o status do usuário.');
            }
        }).fail(function () {
            // Exibe uma mensagem de erro em caso de falha
            alert('Erro ao atualizar o status do usuário.');
        });

        return false; // Evita que o formulário seja submetido normalmente
    });
});
