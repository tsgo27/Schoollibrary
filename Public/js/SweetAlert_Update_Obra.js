$(document).ready(function () {
    $('#cadastroFormu').submit(function (event) {
        event.preventDefault(); 
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: 'Obra atualizada com sucesso.',
                    confirmButtonText: 'Fechar',
                    timer: 5000, // Alerta permanecerá por 5 segundos antes de fechar automaticamente
                    showConfirmButton: true 
                }).then(function (result) {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            },
            error: function () {
                // Trate os erros de submissão, se necessário
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: 'Ocorreu um erro ao atualizar a Obra.',
                    confirmButtonText: 'Fechar'
                });
            }
        });
    });
});
