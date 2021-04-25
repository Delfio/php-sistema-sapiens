<?php
    session_start();
    require_once './classes/professor.php';
    $professor = new Professor;
    if(!isset($_SESSION['id_user']))
    {
        header("location: error.php");
        exit;
    }

    $id = $_GET['id'];

    if(!$id) {
        header("location: dashboard.php");
    }

    $info_professor = $professor->buscarPorId($id)->fetchAll()[0];

    if(!$info_professor) {   
        header("location: dashboard.php");
    }

    include ("head.php");
    include ("menu.php");
    include ("footer.php")
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
                        <input placeholder="Nome do professor" value="<?php echo $info_professor[1]?>" type="text" name="pro_nome" id="nome">
                    </div>
                    <div class="info">
                        <label for="email">E-mail</label>
                        <input placeholder="E-mail do professor" value="<?php echo $info_professor[3]?>" type="email" name="pro_email" id="email">
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
                    <button class="button-pesquisar" type="submit">Atualizar</button>
                </div>
            </div>
        </form>

        <?php
            if (isset($_POST['pro_nome'])) {

                $nome = addslashes($_POST['pro_nome']);
                $email = addslashes($_POST['pro_email']);
                $pass = addslashes($_POST['pro_pass']);

                try {
                    if($professor->atualizar($info_professor[0], $nome, $email, $pass)) {
                        echo '<script type="text/javascript">showModal("sucesso", "Professor alterado com sucesso!");</script>';
                    } else {
                        echo '<script type="text/javascript">showModal("erro", "Ocorreu um erro ao atualizar o professor!");</script>';
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
