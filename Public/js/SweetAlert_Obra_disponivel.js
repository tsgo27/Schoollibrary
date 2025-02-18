$.ajax({
    url: "../Models/get_buscar_detalhes_obra.php",
    type: "POST",
    data: { obraId: obraId, status: status },
    success: function (response) {
        var data = JSON.parse(response);
        if (data.error) {
            Swal.fire({
                icon: 'info',
                title: 'Aviso',
                text: data.error,
                confirmButtonText: 'OK'
            });
        } else {
            $("#detalhesObraBody").html(response);
            $("#detalhesObraModal").modal("show");
        }
    }
});
