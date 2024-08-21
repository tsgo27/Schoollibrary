function searchData() {
    const input = document.getElementById('pesquisar');
    const filter = input.value.toUpperCase();
    const table = document.querySelector('.table');
    const rows = table.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const tdTitulo = rows[i].getElementsByTagName('td')[2]; // Índice 2 para o Título
        const tdAutor = rows[i].getElementsByTagName('td')[4]; // Índice 5 para o Autor

        if (tdTitulo && tdAutor) {
            const titulo = tdTitulo.textContent || tdTitulo.innerText;
            const autor = tdAutor.textContent || tdAutor.innerText;

            if (titulo.toUpperCase().indexOf(filter) > -1 || autor.toUpperCase().indexOf(filter) > -1) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }
}

// Evento para acionar a pesquisa toda vez que o usuário digitar algo
document.getElementById('pesquisar').addEventListener('input', searchData);
