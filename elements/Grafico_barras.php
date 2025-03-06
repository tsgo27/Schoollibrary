<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="../elements/css/Graficos.css">
</head>

<body>
    <div id="grafico-emprestimos"></div>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawBarChart);
        
        function drawBarChart() {
            var dataEmprestimos = [
                ['Mês', 'Quantidade']
            ];
            <?php foreach ($resultEmprestimos as $emprestimo) : ?>
                dataEmprestimos.push(['<?= $emprestimo['NomeMes'] ?>', <?= $emprestimo['Quantidade'] ?>]);
            <?php endforeach; ?>

            var data = google.visualization.arrayToDataTable(dataEmprestimos);

            var options = {
                title: 'Quantidade de Empréstimos por Mês',
                legend: {
                    position: 'none'
                },
                bar: {
                    groupWidth: '50%'
                }, // Ajuste a largura das barras conforme necessário
                annotations: {
                    textStyle: {
                        fontSize: 12,
                        color: 'black'
                    }
                },
                tooltip: {
                    isHtml: true,
                    textStyle: {
                        fontSize: 12
                    }
                },
                chartArea: {
                    width: '70%',
                    height: '70%'
                } // Ajuste a largura e altura da área do gráfico
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('grafico-emprestimos'));
            chart.draw(data, options);
        }
    </script>
</body>
</html>