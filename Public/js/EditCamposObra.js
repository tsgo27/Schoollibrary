$(document).ready(function() {
    $('.editarObra').on('click', function() {
        const codObra = $(this).closest('tr').find('td:eq(0)').text();
        const isbn = $(this).closest('tr').find('td:eq(1)').text();
        const titulo = $(this).closest('tr').find('td:eq(2)').text();
        const autor = $(this).closest('tr').find('td:eq(3)').text();
        const edicao = $(this).closest('tr').find('td:eq(4)').text();
        const ano = $(this).closest('tr').find('td:eq(5)').text();
        const copia = $(this).closest('tr').find('td:eq(6)').text();
        const acervo = $(this).closest('tr').find('td:eq(7)').text();
        const genero = $(this).closest('tr').find('td:eq(8)').text();
        const editora = $(this).closest('tr').find('td:eq(9)').text();
        const situacao = $(this).closest('tr').find('td:eq(10)').text(); 

        $('#codObra').val(codObra);
        $('#editaIsbn').val(isbn);
        $('#editaTitulo').val(titulo);
        $('#editaAutor').val(autor);
        $('#editaEdicao').val(edicao);
        $('#editaAno').val(ano);
        $('#editaCopia').val(copia);
        $('#editaAcervo').val(acervo);
        $('#editaGenero').val(genero);
        $('#editaEditora').val(editora);

        // Adicionando um pequeno atraso para garantir o preenchimento correto
        setTimeout(() => { $('#editaSituacao').val(situacao); }, 100);

        $('#editEmployeeModal').modal('show');
    });
});
