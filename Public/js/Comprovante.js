document.addEventListener("DOMContentLoaded", function () {
    const comprovanteButtons = document.querySelectorAll('.comprovante');
    comprovanteButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            const emprestimoRow = this.closest('tr');
            const matricula = emprestimoRow.querySelector('td:nth-child(2)').innerText;
            const turma = emprestimoRow.querySelector('td:nth-child(3)').innerText;
            const aluno = emprestimoRow.querySelector('td:nth-child(4)').innerText;
            const tituloLivro = emprestimoRow.querySelector('td:nth-child(5)').innerText;
            const dataEmprestimo = emprestimoRow.querySelector('td:nth-child(6)').innerText;
            const dataDevolucao = emprestimoRow.querySelector('td:nth-child(7)').innerText;
            const situacao = emprestimoRow.querySelector('td:nth-child(8)').innerText;

            // Obtenha a data e hora atual
            const dataAtual = new Date();
            const dataHoraFormatada = `${dataAtual.toLocaleDateString()} ${dataAtual.toLocaleTimeString()}`;

            // Crie um elemento div com o ID 'comprovante-content'
            const comprovanteDiv = document.createElement('div');
            comprovanteDiv.id = 'comprovante-content';

            // Configure o conteúdo dinâmico no elemento div
            comprovanteDiv.innerHTML = `
                <img src="../Public/img/logo-colegio.png" alt="Logo da Escola" class="logo" style="width: 100px;">
                
                <h1>Cupom de Empréstimo</h1>
                <p><strong>Matrícula:</strong> ${matricula}</p>
                <p><strong>Turma:</strong> ${turma}</p>
                <p><strong>Aluno:</strong> ${aluno}</p>
                <p><strong>Título do Livro:</strong> ${tituloLivro}</p>
                <p><strong>Data de Empréstimo:</strong> ${dataEmprestimo}</p>
                <p><strong>Data de Devolução:</strong> ${dataDevolucao}</p>
                <p><strong>Status:</strong> ${situacao}</p>
                <p><strong>Data de Emissão:</strong> ${dataHoraFormatada}</p>
            `;

            // Adicione o elemento div ao corpo do documento
            document.body.appendChild(comprovanteDiv);

            // Chame a função printJS com o ID 'comprovante-content'
            printJS({
                printable: 'comprovante-content', // ID do elemento HTML a ser impresso
                type: 'html',
            });

            // Remova o elemento div após a impressão (opcional)
            document.body.removeChild(comprovanteDiv);
        });
    });
});
