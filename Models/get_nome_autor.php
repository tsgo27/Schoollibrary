<?php
require_once __DIR__ . '/../Config/bootstrap.php';

/*
* Buscar Nome do autor
*
*/

$input = $_POST['input'];
$query = $pdo->prepare("SELECT NomeAutor FROM autor WHERE NomeAutor LIKE :input AND StatusAutor = 'Ativo' LIMIT 10");
$query->bindValue(':input', '%' . $input . '%', PDO::PARAM_STR);
$query->execute();

$suggestions = $query->fetchAll(PDO::FETCH_ASSOC);

if ($suggestions) {
    foreach ($suggestions as $suggestion) {
        $nomeAutor = htmlspecialchars($suggestion['NomeAutor']);
        echo '<div class="author-suggestion clickable" style="color: green;">' . $nomeAutor . '</div>';
    }
} else {
    echo 'Nenhuma sugestão encontrada.'; 
}
?>
