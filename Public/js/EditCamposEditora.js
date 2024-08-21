$(document).ready(function() {
    // Captura o evento de clique no botão "Editar"
    $('.editarEditora').on('click', function() {
        // Obtém os dados do atributo "data" da linha da tabela
        const codEditora = $(this).closest('tr').find('td:eq(0)').text();
        const editora = $(this).closest('tr').find('td:eq(1)').text(); 
        const cidade = $(this).closest('tr').find('td:eq(2)').text();
        const estado = $(this).closest('tr').find('td:eq(3)').text(); 
        const status = $(this).closest('tr').find('td:eq(4)').text(); 

        // Preenche os campos do formulário de edição
        $('#codEditora').val(codEditora);
        $('#editaEditora').val(editora); 
        $('#editaCidade').val(cidade);
        $('#editaEstado').val(estado);
        $('#editaStatus').val(status);

        // Abre o modal de edição (caso não esteja aberto)
        $('#editEmployeeModal').modal('show');
    });
});
