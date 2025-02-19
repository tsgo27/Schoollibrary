$(document).ready(function() {
    $('.editarEmprestimo').on('click', function() {
        const codEmprestimo = $(this).closest('tr').find('td:eq(0)').text();
        const matricula = $(this).closest('tr').find('td:eq(1)').text();
        const aluno = $(this).closest('tr').find('td:eq(2)').text();
        const titulo = $(this).closest('tr').find('td:eq(3)').text();
        const emprestimo = $(this).closest('tr').find('td:eq(4)').text();
        const devolucao = $(this).closest('tr').find('td:eq(5)').text();
        const status = $(this).closest('tr').find('td:eq(6)').text(); 

        // Preencher os campos do formulário de edição
        $('#codEmprestimo').val(codEmprestimo);
        $('#editaMatricula').val(matricula);
        $('#editaAluno').val(aluno);
        $('#editaTitulo').val(titulo);
        $('#editaEmprestimo').val(emprestimo);
        $('#editaDevolucao').val(devolucao);
        $('#Status_Livro').val(status);

        // Abrir o modal de edição
        $('#editEmployeeModal').modal('show');
    });
});