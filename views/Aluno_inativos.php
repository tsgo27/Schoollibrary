<?php
require_once __DIR__ . '/../Config/bootstrap.php';
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
    require_once __DIR__ . '/../elements/Menu_Sidebar.php';
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
                                        <a class="nav-link d-flex align-items-center" href="" data-toggle="dropdown" style="text-decoration: none;">
                                            <div class="d-flex flex-column justify-content-center text-right mr-2" style="min-height: 46px;">
                                                <span style="font-weight: bold; white-space: nowrap;"><?php echo 'Olá, ' . $userName; ?></span>
                                            </div>
                                            <img src="../public/img/perfil.png" alt="Imagem do usuário" class="user-profile-img" />
                                            <span class="xp-user-live"></span>
                                        </a>
                                        <ul class="dropdown-menu small-menu">
                                            <li><a href="Usuarios.php"><span class="material-icons">person</span>Perfil</a></li>
                                            <li><a href="<?php echo BASE_URL; ?>/Controllers/LogoutController.php"><span class="material-icons">logout</span>Sair</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="xp-breadcrumbbar text-center">
                    <h4 class="page-title">Alunos - Inativo</h4>
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
                                    <a href="../Reports/config_relatorio_aluno_inativo.php" target="_blank" class="btn btn-primary" id="gerarRelatorio">
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
                                        <th>Turma</th>
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

                                        $sql = "SELECT * FROM alunos WHERE user_status = 'Inativo' ORDER BY data_registro DESC";
                                        $result = $pdo->query($sql);

                                        if ($result->rowCount() > 0) {
                                            while ($user_data = $result->fetch(PDO::FETCH_ASSOC)) {

                                                echo "<td>" . htmlspecialchars($user_data['id_aluno']) . "</td>";
                                                echo "<td>" . htmlspecialchars($user_data['matricula']) . "</td>";
                                                echo "<td>" . htmlspecialchars($user_data['turma']) . "</td>";
                                                echo "<td>" . htmlspecialchars($user_data['nome']) . "</td>";
                                                echo "<td style='width: 150px;'>" . htmlspecialchars($user_data['telefone']) . "</td>";
                                                echo "<td>" . htmlspecialchars($user_data['email']) . "</td>";
                                                echo "<td>" . htmlspecialchars($user_data['user_status']) . "</td>";

                                                echo "<td class='col-lg-3'>
                                                    <a href='#editEmployeeModal' class='edit editarUsuario btn btn-warning' data-toggle='modal' title='Editar aluno'>Editar</a>
                                                    </td>";
                                                echo "</tr>";
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




                <!-------------Modal Editar Aluno----------------->
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
                                        <input type="tel" name="editarTelefone" id="editarTelefone" maxlength="14" class="form-control">
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
<script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../public/js/EditCampos_Alunos.js"></script>
<script src="../public/js/MenuSidebar.js"></script>
<script src="../public/js/Pesquisar.js"></script>
</html>