<?php
require_once __DIR__ . '/../Config/web_extends.php';
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
    <h1>School Library - Relatório de Usuários</h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Tipo Usuario</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    // Verifica se a conexão foi estabelecida
                    if (!isset($pdo)) {
                    throw new Exception('A conexão com o banco de dados não foi estabelecida.');
                    }

                    $sql = "SELECT * FROM usuarios ORDER BY data_registro DESC";
                    $result = $pdo->query($sql);

                    if ($result->rowCount() > 0) {
                        while ($user_data = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td class='col-lg-2'>" . htmlspecialchars($user_data['matricula']) . "</td>";
                            echo "<td class='col-lg-2'>" . htmlspecialchars($user_data['nome']) . "</td>";
                            echo "<td class='col-lg-2'>" . htmlspecialchars($user_data['telefone']) . "</td>";
                            echo "<td class='col-lg-2'>" . htmlspecialchars($user_data['email']) . "</td>";
                            echo "<td class='col-lg-1'>" . htmlspecialchars($user_data['user_status']) . "</td>";
                            echo "<td class='col-lg-1'>" . htmlspecialchars($user_data['user_tipo']) . "</td>";

                          
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

</html>