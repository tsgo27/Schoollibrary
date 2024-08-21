<?php
require_once __DIR__ . '/../Config/web-extends.php';

/** @var PDO $pdo */

$input = $_POST['input'];
$query = $pdo->prepare("SELECT NomeAutor FROM autor WHERE NomeAutor LIKE :input AND StatusAutor = 'Ativo' LIMIT 10");
$query->bindValue(':input', '%' . $input . '%', PDO::PARAM_STR);
$query->execute();

$suggestions = $query->fetchAll(PDO::FETCH_ASSOC);

if ($suggestions) {
    foreach ($suggestions as $suggestion) {
        $nomeAutor = htmlspecialchars($suggestion['NomeAutor']);
        // Exibindo o nome do autor com a fonte verde
        echo '<div class="author-suggestion clickable" style="color: green;">' . $nomeAutor . '</div>';
    }
} else {
    echo 'Nenhuma sugestão encontrada.'; // Mensagem para quando não há sugestões
}
?>
