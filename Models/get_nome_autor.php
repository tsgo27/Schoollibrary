<?php
require_once __DIR__ . '/../Config/bootstrap.php';

/*
* Buscar Nome do autor
*
*/

$input = $_POST['input'];
$query = $pdo->prepare("SELECT nome_autor FROM autor WHERE nome_autor LIKE :input AND status_autor = 'Ativo' LIMIT 10");
$query->bindValue(':input', '%' . $input . '%', PDO::PARAM_STR);
$query->execute();

$suggestions = $query->fetchAll(PDO::FETCH_ASSOC);

if ($suggestions) {
    foreach ($suggestions as $suggestion) {
        $nomeAutor = htmlspecialchars($suggestion['nome_autor']);
        echo '<div class="author-suggestion clickable" style="color: green;">' . $nomeAutor . '</div>';
    }
} else {
    echo 'Nenhuma sugestão encontrada.'; 
}
?>
