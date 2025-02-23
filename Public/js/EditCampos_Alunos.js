$(document).ready(function() {
    // Captura o evento de clique no botão "Editar"
    $('.editarUsuario').on('click', function() {
        
        // Obtém os dados do atributo "data" da linha da tabela
        const codAluno = $(this).closest('tr').find('td:eq(0)').text();
        const turma = $(this).closest('tr').find('td:eq(2)').text();
        const matricula = $(this).closest('tr').find('td:eq(1)').text();
        const nome = $(this).closest('tr').find('td:eq(3)').text();
        const telefone = $(this).closest('tr').find('td:eq(4)').text();
        const email = $(this).closest('tr').find('td:eq(5)').text();
      
        $('.editarUsuario').on('click', function() {
            console.log($(this).closest('tr').find('td:eq(2)').text()); // Verifique se retorna o valor correto
        });
        

        // Preenche os campos do formulário de edição aluno
        $('#idAluno').val(codAluno);
        $('#matricula').val(matricula);
        $('#editaTurma').val(turma);
        $('#editarNome').val(nome);
        $('#editarTelefone').val(telefone);
        $('#editarEmail').val(email);
         
            
    });
});
