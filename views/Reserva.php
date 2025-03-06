<?php
require_once __DIR__ . '/../Config/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Library | Reservas</title>
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


    <!---------NavbBar Start------------------------------->
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
                    <h4 class="page-title">Reservas</h4>
                </div>
            </div>
        </div>
        <!---------NavbBar END--------------------------------->




        <!--------Tabela Principal-content-Start--------------->
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
                                    <a href="../Reports/config_relatorio_reserva_ativo.php" target="_blank" class="btn btn-primary" id="gerarRelatorio">
                                        <i class="material-icons">&#xe8ad;</i>
                                        <span>Imprimir</span>
                                    </a>
                                    <h2 class="ml-lg-2">Reservas</h2>
                                </div>
                                <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                                    <div class="container">
                                        <div class="box-search">
                                            <input type="search" class="form-control" placeholder="Digite o nome do aluno ou o título da obra" id="pesquisar">
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
                                        <th>Aluno</th>
                                        <th>Titulo Livro</th>
                                        <th>Data Reserva</th>
                                        <th>Data Expiração</th>
                                        <th>Situação</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    try {
                                        if (!isset($pdo)) {
                                            throw new Exception('A conexão com o banco de dados não foi estabelecida.');
                                        }
                                        $sql = "SELECT * FROM reservas WHERE situacao_reserva IN ('Disponível', 'Emprestado', 'Reservado', 'Manutenção', 'Descontinuado') ORDER BY data_registro DESC";
                                        $result = $pdo->query($sql);

                                        if ($result->rowCount() > 0) {
                                            while ($user_data = $result->fetch(PDO::FETCH_ASSOC)) {
                                                // Define a cor do status com base no valor de Situacao
                                                $statusColor = '';
                                                switch ($user_data['situacao_reserva']) {
                                                    case 'Disponível':
                                                        $statusColor = '#008000';  // Verde para disponível
                                                        break;
                                                    case 'Reservado':
                                                        $statusColor = '#6a6fd0';  // Amarelo para reservado
                                                        break;
                                                    default:
                                                        $statusColor = '#6c757d';  // Cinza para outros estados
                                                        break;
                                                }

                                                echo "<tr>";
                                                echo "<td>" . htmlspecialchars($user_data['id_reserva']) . "</td>";
                                                echo "<td>" . htmlspecialchars($user_data['matricula_aluno']) . "</td>";
                                                echo "<td>" . htmlspecialchars($user_data['turma_aluno']) . "</td>";
                                                echo "<td>" . htmlspecialchars($user_data['nome_aluno']) . "</td>";
                                                echo "<td class='table-cell-wrap'>" . htmlspecialchars($user_data['titulo_livro']) . "</td>";
                                                echo "<td style='width: 150px;'>" . htmlspecialchars($user_data['data_reserva']) . "</td>";
                                                echo "<td style='width: 150px;'>" . htmlspecialchars($user_data['data_expiracao']) . "</td>";
                                                echo "<td style='color: " . htmlspecialchars($statusColor) . ";'>" . htmlspecialchars($user_data['situacao_reserva']) . "</td>";

                                                echo "<td class='col-lg-3'>
                                                    <a href='#editEmployeeModal' class='edit editarReserva btn btn-warning' data-toggle='modal' title='Editar reserva'>Editar</a>
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
                        <div class="clearfix">
                        </div>
                    </div>
                </div>
                <!--------Tabela Principal-content-END----------------->



                <!---------Modal Adicionar Reservas-Start------------->
                <div class="modal fade" tabindex="-1" id="addEmployeeModal" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Adicionar Reservas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="<?php echo BASE_URL; ?>/Models/Insert_Reservas.php" id="cadastroForm">
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" autocomplete="off">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Matrícula</label>
                                        <input type="text" name="add_matricula_aluno" id="add_matricula_aluno" maxlength="9" class="form-control">
                                        <label>Turma</label>
                                        <input type="text" name="add_turma_aluno" id="add_turma_aluno" maxlength="5" class="form-control" readonly>
                                        <label>Aluno</label>
                                        <input type="text" name="add_nome_aluno" id="add_nome_aluno" maxlength="60" class="form-control" readonly>
                                        <label>Título Livro</label>
                                        <input type="text" name="add_titulo_livro" id="add_titulo_livro" maxlength="60" placeholder="Digite nome do livro" class="form-control">
                                        <div id="tituloSuggestions"></div>
                                        <label>Data Reserva</label>
                                        <input type="date" name="add_data_reserva" id="add_data_reserva" maxlength="10" class="form-control">
                                        <label>Data Expiração</label>
                                        <input type="date" name="add_data_expiracao" id="add_data_expiracao" maxlength="10" class="form-control">
                                        <label>Situação</label>
                                        <select name="add_situacao" id="add_situacao" class="form-control" required>
                                            <option value="Reservado">Reservado</option>
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
                <!---------Modal Acervo Reservas--END----------------->



                <!---------Modal Editar Reservas-Start----------------->
                <div class="modal fade" tabindex="-1" id="editEmployeeModal" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Reservas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="<?php echo BASE_URL; ?>/Models/Update_Reservas.php" id="cadastroFormu">
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" autocomplete="off">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="hidden" name="codReserva" id="codReserva" class="form-control">
                                        <label>Matricula</label>
                                        <input type="text" name="editaMatricula" id="editaMatricula" maxlength="60" class="form-control">
                                        <label>Turma</label>
                                        <input type="text" name="editaTurma" id="editaTurma" maxlength="5" class="form-control" readonly>
                                        <label>Aluno</label>
                                        <input type="text" name="editaAluno" id="editaAluno" maxlength="60" class="form-control" readonly>
                                        <label>Titulo Livro</label>
                                        <input type="text" name="editaTitulo" id="editaTitulo" maxlength="60" class="form-control">
                                        <label>Data Reserva</label>
                                        <input type="date" name="editaReserva" id="editaReserva" maxlength="60" class="form-control">
                                        <label>Data Expiração</label>
                                        <input type="date" name="editaExpiracao" id="editaExpiracao" maxlength="60" class="form-control">
                                        <label>Situação</label>
                                        <select name="editaSituacao" id="editaSituacao" class="form-control">
                                            <option value="Disponível">Disponível</option>
                                            <option value="Reservado">Reservado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <input type="submit" name="update" id="update" class="btn btn-success" value="Atualizar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!---------Modal Editar--Reservas-END------------------>
            </div>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../public/js/EditCamposReservas.js"></script>
<script src="../public/js/SweetAlert_Insert_Reservas.js"></script>
<script src="../public/js/SweetAlert_Update_Reservas.js"></script>
<script src="../public/js/get_nome_aluno.js"></script>
<script src="../public/js/get_titulo_livro.js"></script>
<script src="../public/js/PesquisarEmprestimo.js"></script>
<script src="../public/js/MenuSidebar.js"></script>

</html>