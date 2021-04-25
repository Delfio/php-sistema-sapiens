<?php
session_start();
require_once './classes/professor.php';
$professor = new Professor;

include("head.php");
include("menu.php");
include("footer.php");
?>
<main class="usuario">
    <div class="titulo">
        <h3>Adicionar um novo professor</h3>
    </div>

    <div class="form">
        <form action="#" method="post">
            <div class="section">
                <h3>Informações do novo professor</h3>
                <div class="row">
                    <div class="info">
                        <label for="nome">Nome</label>
                        <input placeholder="Nome do professor" type="text" name="pro_nome" id="nome">
                    </div>
                    <div class="info">
                        <label for="email">E-mail</label>
                        <input placeholder="E-mail do professor" type="email" name="pro_email" id="email">
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="row">
                    <div class="info">
                        <label for="senha">Senha</label>
                        <input placeholder="Nova senha" type="password" name="pro_pass" id="senha">
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
            if (isset($_POST['pro_nome'])) {

                $nome = addslashes($_POST['pro_nome']);
                $email = addslashes($_POST['pro_email']);
                $pass = addslashes($_POST['pro_pass']);

                try {
                    if($professor->cadastrar($nome, $email, $pass)) {
                        echo '<script type="text/javascript">showModal("sucesso", "Professor adicioando com sucesso!");</script>';
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
