<?php

/*
* Gráfico de Barras, buscar empréstimo
*
*/

$pdo->query("SET lc_time_names = 'pt_BR'");
$sqlEmprestimos = "SELECT DATE_FORMAT(DataEmprestimo, '%m') as Mes, DATE_FORMAT(DataEmprestimo, '%M')
as NomeMes, COUNT(*) as Quantidade FROM emprestimo GROUP BY Mes";
$resultEmprestimos = $pdo->query($sqlEmprestimos)->fetchAll(PDO::FETCH_ASSOC);



/*
* Gráfico de Pizza, Busca os alunos ativo inativos
*
*/

$sql = "SELECT * FROM Alunos";
$usuarios = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

// Conta os usuários ativos e inativos
$ativos = 0;
$inativos = 0;
foreach ($usuarios as $usuario) {
    if ($usuario['user_status'] == 'Ativo') {
        $ativos++;
    } else {
        $inativos++;
    }
}
?>
