<?php
require_once __DIR__ . '/../Config/web_extends.php';

/*
* Buscar acervo do livro
*
*/

$input = $_POST['input'];
$query = $pdo->prepare("SELECT Acervo FROM acervo WHERE Acervo LIKE :input AND StatusAcervo = 'Ativo' LIMIT 10");
$query->bindValue(':input', '%' . $input . '%', PDO::PARAM_STR);
$query->execute();

$suggestions = $query->fetchAll(PDO::FETCH_ASSOC);

if ($suggestions) {
    foreach ($suggestions as $suggestion) {
        $endereco = htmlspecialchars($suggestion['Acervo']);
        // Exibindo o endereço com a fonte verde
        echo '<div class="acervo-suggestion clickable" style="color: green;">' . $endereco . '</div>';
    }
} else {
    echo 'Nenhuma sugestão encontrada.'; // Mensagem para quando não há sugestões
}
?>
