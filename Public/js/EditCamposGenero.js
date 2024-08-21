
$(document).ready(function() {
    $('.editarGenero').on('click', function() {
        const codGenero = $(this).closest('tr').find('td:eq(0)').text();
        const genero = $(this).closest('tr').find('td:eq(1)').text();
        

        $('#codGenero').val(codGenero);
        $('#editaGenero').val(genero);
      

         // Abre o modal de edição (caso não esteja aberto)
         $('#editEmployeeModal').modal('show');
        });
    });
    