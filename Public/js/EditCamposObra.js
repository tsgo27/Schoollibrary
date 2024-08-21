$(document).ready(function() {
    // Captura o evento de clique no botão "Editar"
    $('.editarObra').on('click', function() {
        // Obtém os dados do atributo "data" da linha da tabela
        const codObra = $(this).closest('tr').find('td:eq(0)').text();
        const isbn = $(this).closest('tr').find('td:eq(1)').text();
        const titulo = $(this).closest('tr').find('td:eq(2)').text();
        const subtitulo = $(this).closest('tr').find('td:eq(3)').text();
        const autor = $(this).closest('tr').find('td:eq(4)').text();
        const edicao = $(this).closest('tr').find('td:eq(5)').text();
        const ano = $(this).closest('tr').find('td:eq(6)').text();
        const copia = $(this).closest('tr').find('td:eq(7)').text();
        const acervo = $(this).closest('tr').find('td:eq(8)').text();
        const genero = $(this).closest('tr').find('td:eq(9)').text();
        const editora = $(this).closest('tr').find('td:eq(10)').text();
        const situacao = $(this).closest('tr').find('td:eq(11)').text(); 

        // Preenche os campos do formulário de edição
        $('#codObra').val(codObra);
        $('#editaIsbn').val(isbn);
        $('#editaTitulo').val(titulo);
        $('#editaSubtitulo').val(subtitulo);
        $('#editaAutor').val(autor);
        $('#editaEdicao').val(edicao);
        $('#editaAno').val(ano);
        $('#editaCopia').val(copia);
        $('#editaAcervo').val(acervo);
        $('#editaGenero').val(genero);
        $('#editaEditora').val(editora);
        $('#editaSituacao').val(situacao); 

        // Abre o modal de edição (caso não esteja aberto)
        $('#editEmployeeModal').modal('show');
    });
});
