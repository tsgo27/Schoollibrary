$(document).ready(function() {
    $('.editarReserva').on('click', function() {
        const codReserva = $(this).closest('tr').find('td:eq(0)').text();
        const matricula = $(this).closest('tr').find('td:eq(1)').text();
        const turma = $(this).closest('tr').find('td:eq(2)').text();
        const nome_aluno = $(this).closest('tr').find('td:eq(3)').text();
        const titulo = $(this).closest('tr').find('td:eq(4)').text();
        const reserva = $(this).closest('tr').find('td:eq(5)').text();
        const expiracao = $(this).closest('tr').find('td:eq(6)').text();
        const situacao = $(this).closest('tr').find('td:eq(7)').text(); 

        // Preencher os campos do formulário de edição
        $('#codReserva').val(codReserva);
        $('#editaMatricula').val(matricula);
        $('#editaTurma').val(turma);
        $('#editaAluno').val(nome_aluno);
        $('#editaTitulo').val(titulo);
        $('#editaReserva').val(reserva);
        $('#editaExpiracao').val(expiracao);
        $('#situacao').val(situacao);

        // Abrir o modal de edição
        $('#editEmployeeModal').modal('show');
    });
});
