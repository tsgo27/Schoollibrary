$(document).ready(function() {
    $('.editarAutor').on('click', function() {
        const id = $(this).closest('tr').find('td:eq(0)').text();
        const nome = $(this).closest('tr').find('td:eq(1)').text();
        const entidades = $(this).closest('tr').find('td:eq(2)').text();
        const status = $(this).closest('tr').find('td:eq(3)').text(); 


        $('#id').val(id);
        $('#entidade').val(entidades);
        $('#nome').val(nome);
        $('#editStatus').val(status); 

        $('#editEmployeeModal').modal('show');
    });
});
