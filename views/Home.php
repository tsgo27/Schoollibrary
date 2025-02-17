<?php
require_once __DIR__ . '/../Config/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Library | Home</title>
    <link rel="stylesheet" href="../views/css/layout-main.css">
    <link rel="shortcut icon" href="../public/img/favicon-colegio.ico" type="image/x-icon"/>
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
                    <h4 class="page-title">Home</h4>
                    <ol class="breadcrumb">
                        <li class="sub-titulo"><a>School Library / Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
<!--------NavbBar END--------------------------------->



    <?php
    // Include Charts-Google
    require_once __DIR__ . '/../Includes/Cards.php';
    require_once __DIR__ . '/../Includes/Grafico_barras.php';
    require_once __DIR__ . '/../Includes/Grafico_pizza.php';
       
    ?>
        
    </div>
     

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../public/js/MenuSidebar.js"></script>
</html>