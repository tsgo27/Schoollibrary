<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../page/css/erro_conexao.css">
        <title>Erro de Conexão</title>
    </head>
    
    <body>
        <div class="error-container">
            <p class="error-message">Erro ao estabelecer uma conexão com banco de dados</p>
            <hr>
            <?php if (isset($_GET['error'])): ?>
            <div class="error-details">
                <strong>Detalhes:</strong>
                <pre><?php echo htmlspecialchars(urldecode($_GET['error'])); ?></pre>
            </div>
            <?php endif; ?>
        </div>
    </body>
</html>