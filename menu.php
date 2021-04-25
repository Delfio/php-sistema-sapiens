<?php
if (isset($_SESSION['id_user'])) {
    $nome = $_SESSION['user_nome'];
}
?>
<header class="topnav">
    <div class="menu">
        <a class="active" href="dashboard.php">Sistema Sapiens</a>
        <div class="dropdown">
            <button class="dropbtn">Cadastrar
                <i class="material-icons">arrow_drop_down</i>
            </button>
            <div class="dropdown-content">
                <a href="lista-de-usuario.php">Usuários</a>
                <a href="lista-de-professores.php">Professores</a>
                <a href="lista-de-alunos.php">Alunos</a>
            </div>

        </div>
        <a href="#about">Relatórios</a>
        <a href="info.php">Info</a>
        <a href="#about">Contato</a>
    </div>
    <div class="profile">
        <div class="dropdown">
            <button class="dropbtn"> <?php echo $nome; ?>
                <i class="material-icons">arrow_drop_down</i>
            </button>
            <div class="dropdown-content left-content">
                <a href="#">Perfil</a>
                <a href="#">Trocar senha</a>
                <p class="divider"></p>
                <a href="#">Sair</a>
            </div>

        </div>
    </div>
</header>