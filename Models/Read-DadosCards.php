<?php

/*
* Exibir valores cards
*
*/

try {
    // Consulta SQL para contar o número de alunos
    $sqlAlunos = "SELECT COUNT(*) AS total_alunos FROM alunos";
    $resultAlunos = $pdo->query($sqlAlunos);
    $rowAlunos = $resultAlunos->fetch(PDO::FETCH_ASSOC);
    $totalAlunos = $rowAlunos['total_alunos'];

    // Consulta SQL para contar o número de obras
    $sqlObras = "SELECT COUNT(*) AS total_obras FROM obra";
    $resultObras = $pdo->query($sqlObras);
    $rowObras = $resultObras->fetch(PDO::FETCH_ASSOC);
    $totalObras = $rowObras['total_obras'];

    // Consulta SQL para contar o número de obras emprestadas
    $sqlEmprestadas = "SELECT COUNT(*) AS TotalEmprestado FROM emprestimo WHERE StatusEmprestimo = 'Emprestado'";
    $resultEmprestadas = $pdo->query($sqlEmprestadas);
    $rowEmprestadas = $resultEmprestadas->fetch(PDO::FETCH_ASSOC);
    $TotalEmprestado = $rowEmprestadas['TotalEmprestado'];

    // Consulta SQL para contar o número de obras disponíveis
    $sqlDisponiveis = "SELECT COUNT(*) AS total_obras_disponiveis FROM obra WHERE Situacao = 'Disponivel'";
    $resultDisponiveis = $pdo->query($sqlDisponiveis);
    $rowDisponiveis = $resultDisponiveis->fetch(PDO::FETCH_ASSOC);
    $totalObrasDisponiveis = $rowDisponiveis['total_obras_disponiveis'];

} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    exit();
}
?>
