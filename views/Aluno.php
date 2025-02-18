<?php
require_once __DIR__ . '/../Config/bootstrap.php';
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Library | Alunos</title>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../views/css/layout-main.css">
    <link rel="shortcut icon" href="../public/img/favicon-colegio.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
</head>

<body>

    <?php
    // Include Menu Sidebar
    require_once __DIR__ . '/../Includes/Menu_Sidebar.php';
    ?>


    <!----NavbBar Start------------------------------------>
    <div id="content">
        <div class="top-navbar">
            <div class="xd-topbar">
                <div class="row">
                    <div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
                        <div class="xp-menubar">
                            <span class="material-icons text-white">signal_cellular_alt</span>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-3 order-3 order-md-2">
                    </div>
                    <div class="col-10 col-md-6 col-lg-8 order-1 order-md-3">
                        <div class="xp-profilebar text-right">
                            <nav class="navbar p-0">
                                <ul class="nav navbar-nav flex-row ml-auto">
                                    <li class="dropdown nav-item">
                                        <a class="nav-link" href="" data-toggle="dropdown">
                                            <img src="../public/img/perfil.png" alt="Imagem do usuário" style="width: 46px; border-radius:50%;" />
                                            <span class="xp-user-live"></span>
                                        </a>
                                        <ul class="dropdown-menu small-menu">
                                            <li><a href=""><span class="material-icons">person_outline</span><?php echo 'Olá, ' . $userName; ?></a></li>
                                            <li><a href="Usuarios.php"><span class="material-icons">settings</span>Perfil</a></li>
                                            <li><a href="<?php echo BASE_URL; ?>/Controllers/LogoutController.php"><span class="material-icons">logout</span>Sair</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="xp-breadcrumbbar text-center">
                    <h4 class="page-title">Alunos</h4>
                    <ol class="breadcrumb">
                        <li class="sub-titulo"><a>School Library / Alunos</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!---------NavbBar END--------------------------------->



        <!---------Tabela Principal-content-Start-------------->
        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                                    <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
                                        <i class="material-icons">&#xE147;</i>
                                        <span>Adicionar</span>
                                    </a>
                                    <a href="../Reports/Alunos.php" target="_blank" class="btn btn-primary" id="gerarRelatorio">
                                        <i class="material-icons">&#xe8ad;</i>
                                        <span>Imprimir</span>
                                    </a>
                                    <h2 class="ml-lg-2">Alunos</h2>
                                </div>
                                <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                                    <div class="container">
                                        <div class="box-search">
                                            <input type="search" class="form-control" placeholder="Informe nome Aluno" id="pesquisar">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Matrícula</th>
                                        <th>Nome</th>
                                        <th>Telefone</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    try {
                                        if (!isset($pdo)) {
                                            throw new Exception('A conexão com o banco de dados não foi estabelecida.');
                                        }

                                        $sql = "SELECT * FROM alunos WHERE user_status = 'Ativo' ORDER BY data_registro DESC";
                                        $result = $pdo->query($sql);

                                        if ($result->rowCount() > 0) {
                                            while ($user_data = $result->fetch(PDO::FETCH_ASSOC)) {

                                                // Consultar se o aluno tem empréstimo ativo
                                                $stmt = $pdo->prepare("SELECT COUNT(*) FROM emprestimo WHERE MatriculaAluno = :matricula AND StatusEmprestimo = 'Emprestado'");
                                                $stmt->bindParam(':matricula', $user_data['matricula'], PDO::PARAM_INT);
                                                $stmt->execute();
                                                $emprestimosAtivos = $stmt->fetchColumn();

                                                // Definir a classe do botão com base na condição
                                                $btnClass = $emprestimosAtivos > 0 ? 'btn-success' : 'btn-primary';
                                                $btnText = $emprestimosAtivos > 0 ? 'Empréstimos' : 'Sem Empréstimos';

                                                echo "<tr>";
                                                echo "<td>" . htmlspecialchars($user_data['id_Aluno']) . "</td>";
                                                echo "<td>" . htmlspecialchars($user_data['matricula']) . "</td>";
                                                echo "<td>" . htmlspecialchars($user_data['nome']) . "</td>";
                                                echo "<td style='width: 150px;'>" . htmlspecialchars($user_data['telefone']) . "</td>";
                                                echo "<td>" . htmlspecialchars($user_data['email']) . "</td>";
                                                echo "<td>" . htmlspecialchars($user_data['user_status']) . "</td>";

                                                echo "<td class='col-lg-3'>
                                                <a href='#editEmployeeModal' class='edit editarUsuario btn btn-warning' data-toggle='modal' title='Editar aluno'>
                                                Editar
                                                </a>
                                                <a href='#viewDetailsModal' class='btn btn-info text-white btn-sm' data-toggle='modal' 
                                                    data-id='" . htmlspecialchars($user_data['id_Aluno']) . "' 
                                                    data-nome='" . htmlspecialchars($user_data['nome']) . "' 
                                                    data-matricula='" . htmlspecialchars($user_data['matricula']) . "' 
                                                    data-telefone='" . htmlspecialchars($user_data['telefone']) . "' 
                                                    data-email='" . htmlspecialchars($user_data['email']) . "' 
                                                    data-status='" . htmlspecialchars($user_data['user_status']) . "' 
                                                    title='Ver dados'>
                                                    <i class='material-icons'>wysiwyg</i>
                                                </a>
                                                <a href='#emprestimosModal' class='btn $btnClass verEmprestimos text-white btn-sm' 
                                                    data-id='" . htmlspecialchars($user_data['id_Aluno']) . "' 
                                                    title='Empréstimos do aluno'>
                                                    <i class='material-icons'>library_books</i>
                                                </a>
                                            </td>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='12'>Nenhum resultado encontrado.</td></tr>";
                                        }
                                    } catch (PDOException $e) {
                                        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <!-------------Tabela Principal-content-END------------>




                <!-------------Modal para Exibir Detalhes Aluno-------------->
                <div class="modal fade" id="viewDetailsModal" tabindex="-1" role="dialog" aria-labelledby="viewDetailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="max-width: 35%; width: auto;">
                        <div class="modal-content" style="border-radius: 10px; padding: 15px;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewDetailsModalLabel"> <i class="material-icons">person</i> Detalhes do Aluno</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Nome:</strong> <span id="modal-nome"></span></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Matrícula:</strong> <span id="modal-matricula"></span></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Telefone:</strong> <span id="modal-telefone"></span></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Email:</strong> <span id="modal-email"></span></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <p><strong>Status:</strong> <span id="modal-status"></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-------------Modal para Exibir Detalhes Aluno-------------->






                <!-------------Modal para Exibir Empréstimo-------------->
                <div id="emprestimosModal" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" style="max-width: 26%; width: 100%;">
                        <div class="modal-content" style="border-radius: 10px;">
                            <div class="modal-header" style="border-bottom: 2px solid #ddd;">
                                <h5 class="modal-title"><i class="material-icons">library_books</i> Empréstimos Ativos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered" style="border-radius: 8px; overflow: hidden;">
                                    <thead>
                                        <tr>
                                            <th>Título da Obra</th>
                                            <th>Data Empréstimo</th>
                                            <th>Data Devolução</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-------------Modal para Exibir Empréstimo-------------->





                <!-------------Modal Adicionar Aluno-Start------------->
                <div class="modal fade" tabindex="-1" id="addEmployeeModal" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Adicionar Aluno</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="<?php echo BASE_URL; ?>/Models/Insert_Aluno.php" id="cadastroForm">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Matrícula</label>
                                        <input type="text" name="matricula" maxlength="9" class="form-control" required>
                                        <label>Nome</label>
                                        <input type="text" name="nome" maxlength="60" class="form-control" required>
                                        <label>Telefone</label>
                                        <input type="text" name="telefone" class="form-control phone_with_ddd" required>
                                        <label>E-mail</label>
                                        <input type="email" name="email" maxlength="60" class="form-control" required>
                                        <label>Status Aluno</label>
                                        <select name="user_status" class="form-control" required>
                                            <option value="Ativo">Ativo</option>
                                            <option value="Inativo">Inativo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <input type="submit" name="submit" id="submitAdicionar" class="btn btn-success" value="Adicionar">
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!-------------Modal Adicionar Aluno--END-------------->




                <!-------------Modal Editar Aluno-Start---------------->
                <div class="modal fade" tabindex="-1" id="editEmployeeModal" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Aluno</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="<?php echo BASE_URL; ?>/Models/Update_Aluno.php" id="updateForm">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="hidden" name="idAluno" id="idAluno" class="form-control">
                                        <label>Matrícula</label>
                                        <input type="text" name="matricula" id="matricula" maxlength="9" class="form-control">
                                        <label>Nome</label>
                                        <input type="text" name="editarNome" id="editarNome" maxlength="60" class="form-control">
                                        <label>Telefone</label>
                                        <input type="text" name="editarTelefone" id="editarTelefone" class="form-control phone_with_ddd">
                                        <label>E-mail</label>
                                        <input type="email" name="editarEmail" id="editarEmail" maxlength="100" class="form-control">
                                        <label>Status Aluno</label>
                                        <select name="editarStatus" id="editarStatus" class="form-control">
                                            <option value="Ativo">Ativo</option>
                                            <option value="Inativo">Inativo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" name="update" id="update" class="btn btn-success">Atualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-------------Modal Editar Aluno-END------------------>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $(document).ready(function() {
        $('.phone_with_ddd').mask('(00) 0000-00000'); // Mascara telefone
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../public/js/EditCampos_Alunos.js"></script>
<script src="../public/js/Get_buscar_emprestimos.js"></script>
<script src="../public/js/Get_detalhes_aluno.js"></script>
<script src="../public/js/SweetAlert_Insert_Aluno.js"></script>
<script src="../public/js/SweetAlert_Update_Aluno.js"></script>
<script src="../public/js/MenuSidebar.js"></script>
<script src="../public/js/Pesquisar.js"></script>

</html>