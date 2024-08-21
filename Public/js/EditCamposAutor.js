
$(document).ready(function() {
    $('.editarAutor').on('click', function() {
        const codAutor = $(this).closest('tr').find('td:eq(0)').text();
        const autor = $(this).closest('tr').find('td:eq(1)').text();
        const status = $(this).closest('tr').find('td:eq(2)').text();
        
        $('#codAutor').val(codAutor);
        $('#editaAutor').val(autor);
        $('#Situacao').val(status);
      
        // Abre o modal de edição (caso não esteja aberto)
        $('#editEmployeeModal').modal('show');
        });
    });
    