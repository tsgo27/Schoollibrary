<?php
require_once __DIR__ . '/../Config/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório</title>
    <link rel="stylesheet" href="../Reports/css/Styles-reports.css">
</head>

<body>
    <h1>School Library - Relatório de Reservas</h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Turma</th>
                    <th>Aluno</th>
                    <th>Titulo Livro</th>
                    <th>Data Reserva</th>
                    <th>Data Expiração</th>
                    <th>Situação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    if (!isset($pdo)) {
                        throw new Exception('A conexão com o banco de dados não foi estabelecida.');
                    }
                    $sql = "SELECT * FROM reservas WHERE situacao_reserva IN ('Disponível', 'Reservado') ORDER BY data_registro DESC";
                    $result = $pdo->query($sql);

                    if ($result->rowCount() > 0) {
                        while ($user_data = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td class='col-lg-2'>" . htmlspecialchars($user_data['matricula_aluno']) . "</td>";
                            echo "<td class='col-lg-2'>" . htmlspecialchars($user_data['turma_aluno']) . "</td>";
                            echo "<td class='col-lg-2'>" . htmlspecialchars($user_data['nome_aluno']) . "</td>";
                            echo "<td class='col-lg-2'>" . htmlspecialchars($user_data['titulo_livro']) . "</td>";
                            echo "<td class='col-lg-2'>" . htmlspecialchars($user_data['data_reserva']) . "</td>";
                            echo "<td class='col-lg-1'>" . htmlspecialchars($user_data['data_expiracao']) . "</td>";
                            echo "<td class='col-lg-1'>" . htmlspecialchars($user_data['situacao_reserva']) . "</td>";

                        }
                    }
                } catch (PDOException $e) {
                    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<script type='text/php'>
    if (isset($pdf)) {
        $pdf->page_text(720, 550, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 12, array(0,0,0));
    }
</script>
</html>