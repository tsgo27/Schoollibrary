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
    <h1>School Library - Relatório de Alunos Inativos</h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Turma</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    // Verifica se a conexão foi estabelecida
                    if (!isset($pdo)) {
                    throw new Exception('A conexão com o banco de dados não foi estabelecida.');
                    }

                    $sql = "SELECT * FROM alunos WHERE user_status = 'Inativo' ORDER BY data_registro DESC";
                    $result = $pdo->query($sql);

                    if ($result->rowCount() > 0) {
                        while ($user_data = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td class='col-lg-2'>" . htmlspecialchars($user_data['matricula']) . "</td>";
                            echo "<td class='col-lg-2'>" . htmlspecialchars($user_data['turma']) . "</td>";
                            echo "<td class='col-lg-2'>" . htmlspecialchars($user_data['nome']) . "</td>";
                            echo "<td class='col-lg-2'>" . htmlspecialchars($user_data['telefone']) . "</td>";
                            echo "<td class='col-lg-2'>" . htmlspecialchars($user_data['email']) . "</td>";
                            echo "<td class='col-lg-1'>" . htmlspecialchars($user_data['user_status']) . "</td>";                            
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
        $pdf->page_text(720, 570, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 12, array(0,0,0));
    }
</script>
</html>