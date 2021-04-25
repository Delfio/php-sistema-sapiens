<?php
session_start();
require_once './classes/aluno.php';
$aluno = new Aluno;

include("head.php");
include("menu.php");
include("footer.php");
?>
<main class="usuario">
    <div class="titulo">
        <h3>Adicionar um novo aluno</h3>
    </div>

    <div class="form">
        <form action="#" method="post">
            <div class="section">
                <h3>Informações do novo aluno</h3>
                <div class="row">
                    <div class="info">
                        <label for="nome">Nome</label>
                        <input placeholder="Nome do aluno" type="text" name="aln_nome" id="nome">
                    </div>
                    <div class="info">
                        <label for="email">E-mail</label>
                        <input placeholder="E-mail do aluno" type="email" name="aln_email" id="email">
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="row">
                    <div class="info">
                        <label for="senha">Senha</label>
                        <input placeholder="Nova senha" type="password" name="aln_pass" id="senha">
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
            if (isset($_POST['aln_nome'])) {

                $nome = addslashes($_POST['aln_nome']);
                $email = addslashes($_POST['aln_email']);
                $pass = addslashes($_POST['aln_pass']);

                try {
                    if($aluno->cadastrar($nome, $email, $pass)) {
                        echo '<script type="text/javascript">showModal("sucesso", "Aluno adicioando com sucesso!");</script>';
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
