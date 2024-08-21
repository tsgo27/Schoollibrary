<?php
require_once __DIR__ . '/../Config/web-extends.php';

/** @var PDO $pdo */

$input = $_POST['input'];

// Atualiza a consulta SQL para incluir livros com status "Emprestado" e "Reservado"
$query = $pdo->prepare("SELECT Titulo, SubTitulo, Situacao FROM obra WHERE LOWER(Titulo) LIKE LOWER(:input) LIMIT 10");
$query->bindValue(':input', '%' . $input . '%', PDO::PARAM_STR);
$query->execute();

$results = $query->fetchAll(PDO::FETCH_ASSOC);

if ($results) {
    foreach ($results as $result) {
        $titulo = htmlspecialchars($result['Titulo']);
        $subtitulo = htmlspecialchars($result['SubTitulo']);
        $situacao = htmlspecialchars($result['Situacao']); // Obtém o status do livro

        if ($situacao == 'Disponível') {
            // Formatando a sugestão com a cor verde para o título se disponível
            $suggestion = '<div class="titulo-suggestion clickable" data-titulo="' . $titulo . '" data-subtitulo="' . $subtitulo . '">
                            <span style="color: green;">' . $titulo . '</span>
                           </div>';
        } else {
            // Exibe mensagem indicando que o livro está indisponível
            $suggestion = '<div class="titulo-suggestion">
                            <span style="color: red;">' . $titulo . ' - Livro Indisponível</span>
                           </div>';
        }

        echo $suggestion;
    }
} else {
    echo 'Sem sugestões ou livro não disponível'; 
}
?>
