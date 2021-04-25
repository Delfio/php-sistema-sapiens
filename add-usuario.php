<?php
session_start();
require_once './classes/usuario.php';
$usuario = new Usuario;

include("head.php");
include("menu.php");
include("footer.php");
?>
<main class="usuario">
    <div class="titulo">
        <h3>Adicionar um novo usuario</h3>
    </div>

    <div class="form">
        <form action="#" method="post">
            <div class="section">
                <h3>Informações do novo usuario</h3>
                <div class="row">
                    <div class="info">
                        <label for="nome">Nome</label>
                        <input placeholder="Nome do usuario" type="text" name="user_nome" id="nome">
                    </div>
                    <div class="info">
                        <label for="email">E-mail</label>
                        <input placeholder="E-mail do usuario" type="email" name="email" id="email">
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="row">
                    <div class="info">
                        <label for="senha">Senha</label>
                        <input placeholder="Nova senha" type="password" name="password" id="senha">
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="row">
                    <button class="button-pesquisar" type="submit">Cadastrar</button>
                </div>
            </div>
        </form>

        <?php
            if (isset($_POST['user_nome'])) {

                $nome = addslashes($_POST['user_nome']);
                $email = addslashes($_POST['email']);
                $pass = addslashes($_POST['password']);

                try {
                    if($usuario->cadastrar($nome, $email, $pass)) {
                        echo '<script type="text/javascript">showModal("sucesso", "Usuario adicioando com sucesso!");</script>';
                    }
                } catch (Throwable $th) {
                    echo $th->getMessage();
                }
            } else {
                echo "nn";
            }
        ?>
    </div>
</main>
