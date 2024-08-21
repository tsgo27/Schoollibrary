
$(document).ready(function() {
    $('.editarAcervo').on('click', function() {
        const codAcervo = $(this).closest('tr').find('td:eq(0)').text();
        const acervo = $(this).closest('tr').find('td:eq(1)').text();
        const status = $(this).closest('tr').find('td:eq(2)').text(); 

        $('#codAcervo').val(codAcervo);
        $('#editaAcervo').val(acervo);
        $('#editaStatus').val(status);

        $('#editEmployeeModal').modal('show');
    });
});
