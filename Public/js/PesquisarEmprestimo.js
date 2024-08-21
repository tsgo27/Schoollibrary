let timeoutId;

function searchData() {
    // Limpar timeout anterior se houver
    clearTimeout(timeoutId);

    // Aguardar 300ms após a última tecla para iniciar a pesquisa
    timeoutId = setTimeout(function() {
        const input = document.getElementById('pesquisar');
        const filter = input.value.toUpperCase();
        const table = document.querySelector('.table');
        const rows = table.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const tdNome = rows[i].getElementsByTagName('td')[3]; // Use o índice 2 para a coluna do título da obra
            const tdSubtitulo = rows[i].getElementsByTagName('td')[2]; // Use o índice 3 para a coluna do subtítulo
            if (tdNome && tdSubtitulo) {
                const nome = tdNome.textContent || tdNome.innerText;
                const subtitulo = tdSubtitulo.textContent || tdSubtitulo.innerText;
                if (nome.toUpperCase().indexOf(filter) > -1 || subtitulo.toUpperCase().indexOf(filter) > -1) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    }, 300);
}

// Evento para acionar a pesquisa toda vez que o usuário digitar algo
document.getElementById('pesquisar').addEventListener('input', searchData);
