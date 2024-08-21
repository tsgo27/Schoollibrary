<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="../Includes/css/Graficos.css">
</head>

<body>
    <div id="grafico-alunos"></div>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Status', 'Quantidade'],
                ['Ativo', <?= $ativos ?>],
                ['Inativo', <?= $inativos ?>]
            ]);

            var options = {
                title: 'Alunos: Ativos/Inativos'
            };
            var chart = new google.visualization.PieChart(document.getElementById('grafico-alunos'));
            chart.draw(data, options);
        }
    </script>
</body>
</html>