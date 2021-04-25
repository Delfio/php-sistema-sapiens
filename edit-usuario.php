<?php
    session_start();
    require_once './classes/usuario.php';
    $usuario = new Usuario;
    if(!isset($_SESSION['id_user']))
    {
        header("location: error.php");
        exit;
    }

    $id = $_GET['id'];

    if(!$id) {
        header("location: dashboard.php");
    }

    $info_usuario = $usuario->buscarPorId($id)->fetchAll()[0];

    if(!$info_usuario) {   
        header("location: dashboard.php");
    }

    include ("head.php");
    include ("menu.php");
    include ("footer.php")
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
                        <input placeholder="Nome do usuario" value="<?php echo $info_usuario[1]?>" type="text" name="user_nome" id="nome">
                    </div>
                    <div class="info">
                        <label for="email">E-mail</label>
                        <input placeholder="E-mail do usuario" value="<?php echo $info_usuario[3]?>" type="email" name="email" id="email">
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
                    <button class="button-pesquisar" type="submit">Atualizar</button>
                </div>
            </div>
        </form>

        <?php
            if (isset($_POST['user_nome'])) {

                $nome = addslashes($_POST['user_nome']);
                $email = addslashes($_POST['email']);
                $pass = addslashes($_POST['password']);

                try {
                    if($usuario->atualizar($info_usuario[0], $nome, $email, $pass)) {
                        echo '<script type="text/javascript">showModal("sucesso", "Usuario alterado com sucesso!");</script>';
                    } else {
                        echo '<script type="text/javascript">showModal("erro", "Ocorreu um erro ao atualizar o usuario!");</script>';
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
