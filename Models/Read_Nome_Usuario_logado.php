<?php

/*
* Exibir nome do user logado
*
*/

try {
    if (!isset($pdo)) {
        throw new Exception('A conexão com o banco de dados não foi estabelecida.');
    }

    $matricula = $_SESSION['matricula'] ?? null;
    if ($matricula) {
        $stmt = $pdo->prepare("SELECT nome FROM usuarios WHERE matricula = ?");
        $stmt->execute([$matricula]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $userName = $user['nome'];
        } else {
            throw new Exception('Usuário não encontrado.');
        }
    } else {
        throw new Exception('Sessão de matrícula não encontrada.');
    }
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    exit();
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
    exit();
}
