<?php
require_once __DIR__ . '/../Config/web-extends.php';
//Token randômico
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Library | Empréstimos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../views/css/layout-main.css">
    <link rel="shortcut icon" href="../public/img/favicon-colegio.ico" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;1,100;1,300&display=swap" rel="stylesheet">
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
                    <h4 class="page-title">Empréstimos</h4>
                    <ol class="breadcrumb">
                        <li class="sub-titulo"><a>School Library / Empréstimos</a></li>
                    </ol>
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
                                    <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
                                        <i class="material-icons">&#xE147;</i>
                                        <span>Adicionar</span>
                                    </a>
                                    <a href="../Reports/Emprestimos.php" target="_blank" class="btn btn-primary" id="gerarRelatorio">
                                        <i class="material-icons">&#xe8ad;</i>
                                        <span>Imprimir</span>
                                    </a>
                                    <h2 class="ml-lg-2">Empréstimos</h2>
                                </div>
                                <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                                    <div class="container">
                                        <div class="box-search">
                                            <input type="search" class="form-control" placeholder="Digite o Nome do Aluno ou o Título da Obra" id="pesquisar">
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
                                        <th>Aluno</th>
                                        <th>Titulo</th>
                                        <th>Subtítulo</th>
                                        <th>Empréstimo</th>
                                        <th>Devolução</th>
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

                                        $sql = "SELECT * FROM emprestimo WHERE StatusEmprestimo IN ('Disponível', 'Emprestado', 'Reservado', 'Manutenção', 'Descontinuado') ORDER BY data_registro DESC";
                                        $result = $pdo->query($sql);

                                        if ($result->rowCount() > 0) {
                                            while ($user_data = $result->fetch(PDO::FETCH_ASSOC)) {
                                                // Define a cor do status com base no valor de Situacao
                                                $statusColor = '';
                                                switch ($user_data['StatusEmprestimo']) {
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
                                                echo "<td>" . htmlspecialchars($user_data['codEmprestimo']) . "</td>";
                                                echo "<td>" . htmlspecialchars($user_data['MatriculaAluno']) . "</td>";
                                                echo "<td>" . htmlspecialchars($user_data['NomeAluno']) . "</td>";
                                                echo "<td class='table-cell-wrap'>" . htmlspecialchars($user_data['TituloLivro']) . "</td>";
                                                echo "<td class='table-cell-wrap'>" . htmlspecialchars($user_data['SubTituloLivro']) . "</td>";
                                                echo "<td>" . htmlspecialchars($user_data['DataEmprestimo']) . "</td>";
                                                echo "<td style='width: 150px;'>" . htmlspecialchars($user_data['DataDevolucao']) . "</td>";
                                                echo "<td style='color: " . htmlspecialchars($statusColor) . ";'>" . htmlspecialchars($user_data['StatusEmprestimo']) . "</td>";
                                                

                                                echo "<td class='col-lg-3'>
                                                <a href='#editEmployeeModal' class='edit editarEmprestimo btn btn-warning' data-toggle='modal'>Editar</a>
                                                <button class='comprovante btn btn-info' data-cod-emprestimo='{$user_data['codEmprestimo']}' style='width: 82px;'>Cupom</button>
                                                <button class='observacao btn btn-primary' data-toggle='modal' data-target='#observacaoModal_{$user_data['codEmprestimo']}'style='width: 160px;'>Detalhes</button>
                                                </td>";
                                                echo "</tr>";


                                            // Modal inserir Observação-- Start--------------->
                                                echo "<div class='modal fade' id='observacaoModal_{$user_data['codEmprestimo']}' tabindex='-1' role='dialog' aria-labelledby='observacaoModalLabel' aria-hidden='true'>
                                            <div class='modal-dialog' role='document'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='observacaoModalLabel'>Pendências Aluno</h5>
                                                        <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                                                            <span aria-hidden='true'>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <!-- Formulário para a observação -->
                                                        <form method='POST' action='../Models/Insert_Detalhes_Aluno.php'>
                                                            <input type='hidden' name='codEmprestimo' value='{$user_data['codEmprestimo']}'>
                                                            <div class='form-group'>
                                                                <label for='observacaoTextarea'>Escreva aqui Obsevações:</label>
                                                                <textarea id='observacaoTextarea' name='observacao' class='form-control' rows='3'></textarea>
                                                            </div>
                                                            <div class='modal-footer'>
                                                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
                                                                <button type='submit' class='btn btn-primary'>Salvar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>";
                                            // Modal Observação--End--------------->
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



<!---------Popup Adicionar Emprétimos-Start---------->
                <div class="modal fade" tabindex="-1" id="addEmployeeModal" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Adicionar Emprestimo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="../Models/Insert_Emprestimo.php" id="cadastroForm">
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" autocomplete="off">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Matrícula</label>
                                        <input type="text" name="AddMatricula" id="AddMatricula" maxlength="9" class="form-control" required>
                                        <label>Aluno</label>
                                        <input type="text" name="AddAluno" id="AddAluno" maxlength="60" class="form-control" required readonly>
                                        <label>Título Livro</label>
                                        <input type="text" name="AddTitulo" id="AddTitulo" maxlength="60" placeholder="Digite nome do livro" class="form-control" required>
                                        <div id="tituloSuggestions"></div>
                                        <label>Subtítulo</label>
                                        <input type="text" name="AddSubtitulo" id="AddSubtitulo" maxlength="60" class="form-control" required>
                                        <div id="SubTituloSuggestions"></div>
                                        <label>Data do Emprestimo</label>
                                        <input type="date" name="DataEmprestimo" id="DataEmprestimo" maxlength="10" class="form-control" required>
                                        <label>Data da Devolução</label>
                                        <input type="date" name="DataDevolução" id="DataDevolução" maxlength="10" class="form-control" required>
                                        <label>Situação</label>
                                        <select name="AddStatus_Livro" id="AddStatus_Livro" class="form-control" required>
                                            <option value="Emprestado">Emprestado</option>
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
<!---------Popup Emprétimos--END--------------------->



<!---------Popup Editar Emprétimos-Start------------->
                <div class="modal fade" tabindex="-1" id="editEmployeeModal" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Emprestimo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="../Models/Update_Emprestimo.php" id="cadastroFormu">
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" autocomplete="off">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="hidden" name="codEmprestimo" id="codEmprestimo" class="form-control">
                                        <label>Matricula</label>
                                        <input type="text" name="editaMatricula" id="editaMatricula" maxlength="60" class="form-control">
                                        <label>Aluno</label>
                                        <input type="text" name="editaAluno" id="editaAluno" maxlength="60" class="form-control" readonly>
                                        <label>Titulo Livro</label>
                                        <input type="text" name="editaTitulo" id="editaTitulo" maxlength="60" class="form-control">
                                        <label>Subtitulo</label>
                                        <input type="text" name="editaSubtitulo" id="editaSubtitulo" maxlength="60" class="form-control">
                                        <label>Data Emprestimo</label>
                                        <input type="date" name="editaEmprestimo" id="editaEmprestimo" maxlength="60" class="form-control">
                                        <label>Data Devolução</label>
                                        <input type="date" name="editaDevolucao" id="editaDevolucao" maxlength="60" class="form-control">
                                        <label>Status Livro</label>
                                        <select name="Status_Livro" id="Status_Livro" class="form-control">
                                            <option value="Disponível">Disponível</option>
                                            <option value="Emprestado">Emprestado</option>
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
<!---------Popup Editar-Emprétimos-END--------------->
            </div>
        </div>
    </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="../public/js/EditCamposEmprestimo.js"></script>
<script src="../public/js/SweetAlert_Insert_Emprestimo.js"></script>
<script src="../public/js/SweetAlert_Update_Emprestimo.js"></script>
<script src="../public/js/BuscarNomeAluno.js"></script>
<script src="../public/js/BuscarTituloLivro.js"></script>
<script src="../Public/js/Comprovante.js"></script>
<script src="../public/js/PesquisarEmprestimo.js"></script>
<script src="../public/js/MenuSidebar.js"></script>

</html>