<div class="wrapper">
    <div class="body-overlay"></div>
    <div id="sidebar">
        <div class="sidebar-header">
            <h3><img src="../public/img/logo-book.png" class="img-fluid" /><span>School Library</span></h3>
        </div>
        <ul class="list-unstyled component m-0">
            <!-- Home Menu Item -->
            <li class="active">
                <a href="Home.php" class="dashboard"><i class="material-icons">home</i>Home</a>
            </li>
            <!-- Cadastros Menu Item -->
            <li class="dropdown">
                <a href="#cadastrosSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle submenu-trigger" data-submenu="cadastrosSubmenu">
                    <i class="material-icons">add_circle</i>Cadastros
                </a>
                <ul class="collapse list-unstyled menu" id="cadastrosSubmenu">
                    <li><a href="Emprestimo.php">Empréstimos</a></li>
                    <li><a href="Reserva.php">Reservas</a></li>
                    <li><a href="Obra.php">Obras</a></li>
                    <li><a href="Autor.php">Autores</a></li>
                    <li><a href="Editora.php">Editoras</a></li>
                    <li><a href="Acervo.php">Acervos</a></li>
                    <li><a href="Genero.php">Gêneros</a></li>
                    <li><a href="Usuarios.php">Usuários</a></li>
                    <li><a href="Aluno.php">Alunos</a></li>
                </ul>
            </li>
            <!-- Itens Inativos Menu Item -->
            <li class="dropdown">
                <a href="#inactiveItemsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle submenu-trigger" data-submenu="inactiveItemsSubmenu">
                    <i class="material-icons">subtitles_off</i>Itens Inativos
                </a>
                <ul class="collapse list-unstyled menu" id="inactiveItemsSubmenu">
                    <li><a href="Autor-inativos.php">Autores</a></li>
                    <li><a href="Editora-inativos.php">Editoras</a></li>
                    <li><a href="Acervo-inativos.php">Acervos</a></li>
                    <li><a href="Genero-inativos.php">Gêneros</a></li>
                    <li><a href="Aluno-inativos.php">Alunos</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
