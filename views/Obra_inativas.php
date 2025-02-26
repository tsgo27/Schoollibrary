<?php
require_once __DIR__ . '/../Config/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Library | Obra</title>
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


    <!--------NavbBar Start------------------------------->
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
                    <h4 class="page-title">Obras</h4>
                </div>
            </div>
        </div>
        <!--------NavbBar END--------------------------------->




        <!--------Tabela Principal-content-Start-------------->
        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                                    <a href="../Reports/config_relatorio_obra_inativa.php" target="_blank" class="btn btn-primary" id="printReport">
                                        <i class="material-icons">&#xe8ad;</i>
                                        <span>Imprimir</span>
                                    </a>
                                    <h2 class="ml-lg-2">Obras</h2>
                                </div>
                                <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                                    <div class="container">
                                        <div class="box-search">
                                            <input type="search" class="form-control" placeholder="Digite título da obra" id="pesquisar">
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
                                        <th>ISBN</th>
                                        <th>Titulo Livro</th>
                                        <th>Autor</th>
                                        <th>Edição</th>
                                        <th>Ano</th>
                                        <th>Quantidade</th>
                                        <th>Acervo</th>
                                        <th>Gênero</th>
                                        <th>Editora</th>
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

                                        $sql = "SELECT * FROM obra WHERE Situacao IN ('Inativo') ORDER BY data_registro DESC";
                                        $result = $pdo->query($sql);

                                        if ($result->rowCount() > 0) {
                                            while ($Obrar_data = $result->fetch(PDO::FETCH_ASSOC)) {
                                                // Define a cor do status com base no valor de Situacao
                                                $statusColor = '';
                                                switch ($Obrar_data['Situacao']) {
                                                    case 'Disponível':
                                                        $statusColor = '#008000';  // Verde para disponível
                                                        break;
                                                    case 'Emprestado':
                                                        $statusColor = '#dc3545';  // Vermelho para emprestado
                                                        break;
                                                    case 'Reservado':
                                                        $statusColor = '#6a6fd0';  // Amarelo para reservado
                                                        break;
                                                    default:
                                                        $statusColor = '#6c757d';  // Cinza para outros estados
                                                        break;
                                                }

                                                echo "<tr>";
                                                echo "<td>" . htmlspecialchars($Obrar_data['codObra']) . "</td>";
                                                echo "<td style='width: 360px;'>" . htmlspecialchars($Obrar_data['Isbn']) . "</td>";
                                                echo "<td style='width: 280px;'>" . htmlspecialchars($Obrar_data['Titulo']) . "</td>";
                                                echo "<td style='width: 250px;'>" . htmlspecialchars($Obrar_data['Autor']) . "</td>";
                                                echo "<td>" . htmlspecialchars($Obrar_data['Edicao']) . "</td>";
                                                echo "<td>" . htmlspecialchars($Obrar_data['Ano']) . "</td>";
                                                echo "<td>" . htmlspecialchars($Obrar_data['Copia']) . "</td>";
                                                echo "<td style='width: 230px;'>" . htmlspecialchars($Obrar_data['Acervo']) . "</td>";
                                                echo "<td>" . htmlspecialchars($Obrar_data['Genero']) . "</td>";
                                                echo "<td>" . htmlspecialchars($Obrar_data['Editora']) . "</td>";
                                                echo "<td style='color: " . htmlspecialchars($statusColor) . ";'>" . htmlspecialchars($Obrar_data['Situacao']) . "</td>";

                                                echo "<td class='col-lg-3'>
                                                <a href='#editEmployeeModal' class='edit editarObra btn btn-warning' data-toggle='modal' title='Editar obra'>Editar</a>
                                                <a href='#' class='btn btn-info visualizarObra' data-id='" . htmlspecialchars($Obrar_data['codObra']) . "' data-status='" . htmlspecialchars(trim($Obrar_data['Situacao'])) . "' title='Visualizar detalhes' style='color: white; background-color: #007bff; font-size: 14px; padding: 5px 10px;'>
                                                <i class='material-icons'>library_books</i>
                                                </a>
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
                <!--------Tabela Principal-content-END---------------->



                <!--------Modal de Detalhes da Obra-------------------->
                <div id="detalhesObraModal" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" style="max-width: 30%;">
                        <div class="modal-content" style="border: none; box-shadow: none;">
                            <div class="modal-header" style="border-bottom: none;">
                                <h5 class="modal-title">
                                    <i class="material-icons">library_books</i> Detalhes da Obra
                                </h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <tbody id="detalhesObraBody">
                                        <!-- Os dados serão carregados aqui via AJAX -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--------Modal de Detalhes da Obra---------------->







                <!---------Modal Editar Obra-Start----------------->
                <div class="modal fade" tabindex="-1" id="editEmployeeModal" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Obra</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="<?php echo BASE_URL; ?>/Models/Update_Obra.php" id="cadastroFormu">
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" autocomplete="off">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="hidden" name="codObra" id="codObra" class="form-control">
                                        <label>ISBN</label>
                                        <input type="text" name="editaIsbn" id="editaIsbn" maxlength="60" class="form-control">
                                        <label>Título Livro</label>
                                        <input type="text" name="editaTitulo" id="editaTitulo" maxlength="60" class="form-control">
                                        <label>Autores</label>
                                        <input type="text" name="editaAutor" id="editaAutor" class="form-control">
                                        <label>Edição</label>
                                        <input type="text" name="editaEdicao" id="editaEdicao" maxlength="60" class="form-control">
                                        <label>Ano</label>
                                        <input type="text" name="editaAno" id="editaAno" maxlength="60" class="form-control">
                                        <label>Quantidade</label>
                                        <input type="text" name="editaCopia" id="editaCopia" maxlength="60" class="form-control">
                                        <label>Acervo</label>
                                        <input type="text" name="editaAcervo" id="editaAcervo" maxlength="10" class="form-control">
                                        <label>Gêneros</label>
                                        <select type="text" name="editaGenero" id="editaGenero" class="form-control">
                                            <?php
                                            require_once __DIR__ . '/../Config/bootstrap.php';
                                            // Query
                                            $query = $pdo->query("SELECT nome_genero FROM genero;");
                                            $registros = $query->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($registros as $registro) {
                                                echo "<option value=\"" . $registro['nome_genero'] . "\">" . $registro['nome_genero'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Editoras</label>
                                        <select type="text" name="editaEditora" id="editaEditora" class="form-control">
                                            <?php
                                            require_once __DIR__ . '/../Config/bootstrap.php';
                                            // Query
                                            $query = $pdo->query("SELECT nome_editora FROM editora;");
                                            $registros = $query->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($registros as $registro) {
                                                echo "<option value=\"" . $registro['nome_editora'] . "\">" . $registro['nome_editora'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Situação</label>
                                        <select type="text" name="editaSituacao" id="editaSituacao" maxlength="15" class="form-control">
                                            <option value="Disponível">Disponível</option>
                                            <option value="Manutenção">Manutenção</option>
                                            <option value="Inativo">Inativo</option>
                                            <option value="Descontinuado">Descontinuado</option>
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
                    <!---------Modal Editar--Obras-END------------------>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../public/js/EditCamposObra.js"></script>
<script src="../public/js/SweetAlert_Update_Obra.js"></script>
<script src="../public/js/MenuSidebar.js"></script>
<script src="../public/js/Pesquisar.js"></script>
<script src="../public/js/Modal.js"></script>

</html>