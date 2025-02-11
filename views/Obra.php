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
                                        <a class="nav-link" href="" data-toggle="dropdown">
                                            <img src="../public/img/perfil.png" alt="Imagem do usuário" style="width: 40px; border-radius:50%;" />
                                            <span class="xp-user-live"></span>
                                        </a>
                                        <ul class="dropdown-menu small-menu">
                                            <li><a href=""><span class="material-icons">person_outline</span><?php echo 'Olá, ' . $userName; ?></li>
                                            <li><a href="../Controllers/LogoutController.php"><span class="material-icons">logout</span>Sair</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="xp-breadcrumbbar text-center">
                    <h4 class="page-title">Obras</h4>
                    <ol class="breadcrumb">
                        <li class="sub-titulo"><a>School Library / Obras</a></li>
                    </ol>
                </div>
            </div>
        </div>
<!--------NavbBar END--------------------------------->





<!--------Select dinamico--Start---------------------->
        <div class="row">
            <div class="col-md-3 col-sm-6 b5" id="select-editora">
                <select class="form-control" id="select-editoras">
                    <option value="">Selecione Editora</option>
                    <?php
                    require_once __DIR__ . '/../Config/bootstrap.php';
                    $query = $pdo->query("SELECT NomeEditora FROM editora;");
                    $registros = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($registros as $registro) {
                        echo "<option value=\"" . $registro['NomeEditora'] . "\">" . $registro['NomeEditora'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3 col-sm-6 b5" id="select-status">
                <select class="form-control" id="tabela-obras">
                    <option value="">Selecione Situação</option>
                    <option value="Disponível">Disponível</option>
                    <option value="Emprestado">Emprestado</option>
                    <option value="Reservado">Reservado</option>
                    <option value="Manutenção">Manutenção</option>
                    <option value="Descontinuado">Descontinuado</option>
                </select>
            </div>
            <div class="col-md-3 col-sm-6 b5" id="select-genero">
                <select class="form-control" id="select-generos">
                    <option value="">Selecione Gênero</option>
                    <?php
                    require_once __DIR__ . '/../Config/bootstrap.php';
                    $query = $pdo->query("SELECT NomeGenero FROM genero;");
                    $registros = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($registros as $registro) {
                        echo "<option value=\"" . $registro['NomeGenero'] . "\">" . $registro['NomeGenero'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
<!--------Select dinamico--END------------------------>




<!--------Tabela Principal-content-Start-------------->
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
                                    <a href="../Reports/Obras.php" target="_blank" class="btn btn-primary" id="printReport">
                                        <i class="material-icons">&#xe8ad;</i>
                                        <span>Imprimir</span>
                                    </a>
                                    <h2 class="ml-lg-2">Obras</h2>
                                </div>
                                <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                                    <div class="container">
                                        <div class="box-search">
                                            <input type="search" class="form-control" placeholder="Digite Título da Obra ou Nome do Autor" id="pesquisar">
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
                                        <th>Titulo</th>
                                        <th>SubTitulo</th>
                                        <th>Autor</th>
                                        <th>Edição</th>
                                        <th>Ano</th>
                                        <th>Copia</th>
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

                                        $sql = "SELECT * FROM obra WHERE Situacao IN ('Disponível', 'Emprestado', 'Reservado', 'Manutenção', 'Descontinuado') ORDER BY data_registro DESC";
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
                                                echo "<td>" . htmlspecialchars($Obrar_data['SubTitulo']) . "</td>";
                                                echo "<td style='width: 250px;'>" . htmlspecialchars($Obrar_data['Autor']) . "</td>";
                                                echo "<td>" . htmlspecialchars($Obrar_data['Edicao']) . "</td>";
                                                echo "<td>" . htmlspecialchars($Obrar_data['Ano']) . "</td>";
                                                echo "<td>" . htmlspecialchars($Obrar_data['Copia']) . "</td>";
                                                echo "<td style='width: 230px;'>" . htmlspecialchars($Obrar_data['Acervo']) . "</td>";
                                                echo "<td>" . htmlspecialchars($Obrar_data['Genero']) . "</td>";
                                                echo "<td>" . htmlspecialchars($Obrar_data['Editora']) . "</td>";
                                                echo "<td style='color: " . htmlspecialchars($statusColor) . ";'>" . htmlspecialchars($Obrar_data['Situacao']) . "</td>";
                                                
                                                echo "<td class='col-lg-3'>
                                                <a href='#editEmployeeModal' class='edit editarObra btn btn-warning' data-toggle='modal'>Editar</a>
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




<!---------Modal Adicionar Obras-Start------------->
                <div class="modal fade" tabindex="-1" id="addEmployeeModal" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Adicionar Obra</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="<?php echo BASE_URL; ?>/Models/Insert_Obra.php" id="cadastroForm">
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" autocomplete="off">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>ISBN</label>
                                        <input type="text" name="AddIsbn" id="AddIsbn" maxlength="60" class="form-control" required>
                                        <label>Título Livro</label>
                                        <input type="text" name="AddTitulo" id="AddTitulo" maxlength="60" class="form-control" required>
                                        <label>Subtítulo</label>
                                        <input type="text" name="AddSubtitulo" id="AddSubtitulo" maxlength="60" class="form-control" required>
                                        <label>Autores</label>
                                        <input type="text" name="AddAutor" id="AddAutor" maxlength="60" placeholder="Digite nome do autor" class="form-control" required>
                                        <div id="authorSuggestions"></div>
                                        <label>Edição</label>
                                        <input type="text" name="AddEdição" id="AddEdição" maxlength="60" class="form-control" required>
                                        <label>Ano</label>
                                        <input type="text" name="AddAno" id="AddAno" maxlength="4" class="form-control" required>
                                        <label>Cópia</label>
                                        <input type="text" name="AddCopia" id="AddCopia" maxlength="60" class="form-control" required>
                                        <label>Acervo</label>
                                        <input type="text" name="AddAcervo" id="AddAcervo" placeholder="Digite o acervo do livro" maxlength="60" class="form-control" required>
                                        <div id="acervoSuggestions"></div>
                                        <label>Gêneros</label>
                                        <select type="text" name="AddEGenero" id="AddEGenero" class="form-control" required>
                                            <?php
                                            require_once __DIR__ . '/../Config/bootstrap.php';
                                            $query = $pdo->query("SELECT NomeGenero FROM genero ORDER BY NomeGenero;");
                                            $registros = $query->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($registros as $registro) {
                                                echo "<option value=\"" . $registro['NomeGenero'] . "\">" . $registro['NomeGenero'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Editoras</label>
                                        <select type="text" name="AddEditora" id="AddEditora" class="form-control" required>
                                            <?php
                                            require_once __DIR__ . '/../Config/bootstrap.php';
                                            $query = $pdo->query("SELECT NomeEditora FROM editora ORDER BY NomeEditora ASC;");
                                            $registros = $query->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($registros as $registro) {
                                                echo "<option value=\"" . $registro['NomeEditora'] . "\">" . $registro['NomeEditora'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Status Livro</label>
                                        <select type name="AddSituacao" id="AddSituacao" maxlength="15" class="form-control" required>
                                            <option value="Disponível">Disponível</option>
                                            <option value="Manutenção">Manutenção</option>
                                            <option value="Descontinuado">Descontinuado</option>
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
<!---------Modal Obras-END------------------------->






<!---------Modal Editar Obras-Start----------------->
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
                                        <label>Subtítulo</label>
                                        <input type="text" name="editaSubtitulo" id="editaSubtitulo" maxlength="60" class="form-control">
                                        <label>Autores</label>
                                        <input type="text" name="editaAutor" id="editaAutor" class="form-control">
                                        <label>Edição</label>
                                        <input type="text" name="editaEdicao" id="editaEdicao" maxlength="60" class="form-control">
                                        <label>Ano</label>
                                        <input type="text" name="editaAno" id="editaAno" maxlength="60" class="form-control">
                                        <label>Cópia</label>
                                        <input type="text" name="editaCopia" id="editaCopia" maxlength="60" class="form-control">
                                        <label>Acervo</label>
                                        <input type="text" name="editaAcervo" id="editaAcervo" maxlength="60" class="form-control">
                                        <label>Gêneros</label>
                                        <select type="text" name="editaGenero" id="editaGenero" class="form-control">
                                            <?php
                                            require_once __DIR__ . '/../Config/bootstrap.php';
                                            // Query
                                            $query = $pdo->query("SELECT NomeGenero FROM genero;");
                                            $registros = $query->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($registros as $registro) {
                                                echo "<option value=\"" . $registro['NomeGenero'] . "\">" . $registro['NomeGenero'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Editoras</label>
                                        <select type="text" name="editaEditora" id="editaEditora" class="form-control">
                                            <?php
                                            require_once __DIR__ . '/../Config/bootstrap.php';
                                            // Query
                                            $query = $pdo->query("SELECT NomeEditora FROM editora;");
                                            $registros = $query->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($registros as $registro) {
                                                echo "<option value=\"" . $registro['NomeEditora'] . "\">" . $registro['NomeEditora'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Status Livro</label>
                                        <select name="editaSituacao" id="editaSituacao" maxlength="15" class="form-control">
                                            <option value="Manutenção">Manutenção</option>
                                            <option value="Descontinuado">Descontinuado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <input type="submit" name="update" id="update" class="btn btn-success" value="Atualizar">
                                </div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../public/js/FiltrarTabela.js"></script>
<script src="../public/js/EditCamposObra.js"></script>
<script src="../public/js/SweetAlert_Update_Obra.js"></script>
<script src="../public/js/SweetAlert_Insert_Obra.js"></script>
<script src="../public/js/BuscarNomeAutores.js"></script>
<script src="../public/js/BuscarAcervo.js"></script>
<script src="../public/js/MenuSidebar.js"></script>
<script src="../public/js/Pesquisar.js"></script>

</html>