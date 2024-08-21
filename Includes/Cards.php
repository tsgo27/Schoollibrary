<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="CodedThemes">
    <meta name="keywords" content=" Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="CodedThemes">
    <link rel="icon" href="../Includes/images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../Includes/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../Includes/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="../Includes/icon/icofont/css/icofont.css">
    <link rel="stylesheet" href="../Includes/css/cards.css">
    <link rel="stylesheet" type="text/css" href="../Includes/css/jquery.mCustomScrollbar.css">
</head>

<body>
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="row">
                            <!-- card1 start -->
                            <div class="col-md-6 col-xl-3">
                                <div class="card widget-card-1">
                                    <div class="card-block-small">
                                        <i class="icofont icofont-book-alt bg-c-blue card1-icon"></i>
                                        <span class="text-c-blue f-w-600">Livros Cadastrados</span>
                                        <h4 class="card-text"><?php echo $totalObras; ?></h4>
                                        <div>
                                            <span class="f-left m-t-10 text-muted">
                                                <i class="text-c-blue f-16 icofont icofont-book-alt m-r-10"></i>Obras Cadastrados
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- card2 start -->
                            <div class="col-md-6 col-xl-3">
                                <div class="card widget-card-1">
                                    <div class="card-block-small">
                                        <i class="icofont icofont-book-alt bg-c-pink card1-icon"></i>
                                        <span class="text-c-pink f-w-600">Livros Emprestados</span>
                                        <h4><?php echo $TotalEmprestado; ?></h4>
                                        <div>
                                            <span class="f-left m-t-10 text-muted">
                                                <i class="text-c-pink f-16 icofont icofont-book-alt m-r-10"></i>Obras alugados
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- card3 start -->
                            <div class="col-md-6 col-xl-3">
                                <div class="card widget-card-1">
                                    <div class="card-block-small">
                                        <i class="icofont icofont-book-alt bg-c-green card1-icon"></i>
                                        <span class="text-c-green f-w-600">Livros Dísponiveis</span>
                                        <h4><?php echo $totalObrasDisponiveis; ?></h4>
                                        <div>
                                            <span class="f-left m-t-10 text-muted">
                                                <i class="text-c-green f-16 icofont icofont-book-alt m-r-10"></i>Obras para alugar
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- card4 start -->
                            <div class="col-md-6 col-xl-3">
                                <div class="card widget-card-1">
                                    <div class="card-block-small">
                                        <i class="icofont icofont-ui-user-group bg-c-yellow card1-icon"></i>
                                        <span class="text-c-yellow f-w-600">Leitores</span>
                                        <h4 class="card-text"><?php echo $totalAlunos; ?></h4>
                                        <div>
                                            <span class="f-left m-t-10 text-muted">
                                                <i class="text-c-yellow f-16 icofont icofont-ui-user-group m-r-10"></i>Alunos Cadastrados
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>