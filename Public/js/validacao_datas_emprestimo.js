document.addEventListener("DOMContentLoaded", function () {
    function configurarValidacao(formId, emprestimoId, devolucaoId, submitId, isEditForm = false) {
        const dataEmprestimo = document.getElementById(emprestimoId);
        const dataDevolucao = document.getElementById(devolucaoId);
        const submitButton = document.getElementById(submitId);
        const form = document.getElementById(formId);

        // Validação automática ao mudar as datas
        dataEmprestimo.addEventListener("change", validarDatas);
        dataDevolucao.addEventListener("change", validarDatas);

        function validarDatas() {
            // Remove mensagens de erro anteriores
            document.querySelectorAll(".invalid-feedback").forEach(el => el.remove());
            dataEmprestimo.classList.remove("is-invalid");
            dataDevolucao.classList.remove("is-invalid");

            // Se os campos estiverem vazios, não desativa o botão
            if (!dataEmprestimo.value || !dataDevolucao.value) {
                submitButton.disabled = false;
                return;
            }

            let emprestimoValue = new Date(dataEmprestimo.value);
            let devolucaoValue = new Date(dataDevolucao.value);

            // Validação: Data de devolução deve ser posterior à data de empréstimo
            if (devolucaoValue <= emprestimoValue) {
                dataDevolucao.classList.add("is-invalid");
                showErrorMessage(dataDevolucao, "A data de devolução deve ser posterior à data de empréstimo.");
                submitButton.disabled = true;
            } else {
                submitButton.disabled = false;
            }
        }

        // Exibe mensagem de erro abaixo do input
        function showErrorMessage(input, message) {
            let errorDiv = document.createElement("div");
            errorDiv.className = "invalid-feedback";
            errorDiv.style.display = "block";
            errorDiv.innerText = message;
            input.parentNode.appendChild(errorDiv);
        }

        // Impede envio do formulário caso haja erro
        form.addEventListener("submit", function (event) {
            validarDatas();
            if (document.querySelector(".is-invalid")) {
                event.preventDefault();
            }
        });
    }

    // Aplica a validação no formulário de cadastro (agora inicia com botão ativo)
    configurarValidacao("cadastroForm", "add_data_emprestimo", "add_data_devolucao", "submitAdicionar", false);

    // Aplica a validação no formulário de edição
    configurarValidacao("cadastroFormu", "editaEmprestimo", "editaDevolucao", "update", true);
});