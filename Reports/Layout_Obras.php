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
    <h1>School Library - Relatório de Obras</h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Isbn</th>
                    <th>Titulo Livro</th>
                    <th>Autor</th>
                    <th>Edição</th>
                    <th>Ano</th>
                    <th>Quantidade</th>
                    <th>Acervo</th>
                    <th>Gênero</th>
                    <th>Editora</th>
                    <th>Situação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    // Verifica se a conexão foi estabelecida
                    if (!isset($pdo)) {
                    throw new Exception('A conexão com o banco de dados não foi estabelecida.');
                    }

                    $sql = "SELECT * FROM obra WHERE Situacao IN ('Disponível', 'Emprestado', 'Reservado', 'Manutenção', 'Descontinuado') ORDER BY data_registro DESC";
                    $result = $pdo->query($sql);

                    if ($result->rowCount() > 0) {
                        while ($user_data = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td class='col-lg-2'>" . htmlspecialchars($user_data['Isbn']) . "</td>";
                            echo "<td class='col-lg-2'>" . htmlspecialchars($user_data['Titulo']) . "</td>";
                            echo "<td class='col-lg-2'>" . htmlspecialchars($user_data['Autor']) . "</td>";
                            echo "<td class='col-lg-2'>" . htmlspecialchars($user_data['Edicao']) . "</td>";
                            echo "<td class='col-lg-1'>" . htmlspecialchars($user_data['Ano']) . "</td>";
                            echo "<td class='col-lg-1'>" . htmlspecialchars($user_data['Copia']) . "</td>";
                            echo "<td class='col-lg-2'>" . htmlspecialchars($user_data['Acervo']) . "</td>";
                            echo "<td class='col-lg-2'>" . htmlspecialchars($user_data['Genero']) . "</td>";
                            echo "<td class='col-lg-2'>" . htmlspecialchars($user_data['Editora']) . "</td>";
                            echo "<td class='col-lg-0'>" . htmlspecialchars($user_data['Situacao']) . "</td>";
                          
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
