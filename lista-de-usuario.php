<?php
session_start();
require_once './classes/usuario.php';
$usuario = new Usuario;

include ("head.php");
include ("menu.php");
include ("footer.php");
?>


<main class="usuario">
    <div class="titulo">
        <h3>Usuarios cadastrados no sistema</h3>
    </div>

    <header class="add-user">

        <div class="search">
            <form action="" method="post" class="search-box">
                <input name="find-user" placeholder="Digite sua busca" type="text">
                <div class="buttons-search-box">
                    <button class="button-pesquisar" type="submit">Pesquisar</button>
                    <a href="add-usuario.php">
                        Adicionar
                    </a>
                </div>
            </form>
        </div>
    </header>


    <?php
    if (isset($_POST['find-user'])) {
        $busca = $_POST['find-user'];
        try {
            print "<table class=" . "list-users" . ">";
            print "<tr>";
            print "    <th>Nome</th>";
            print "    <th>E-mail</th>";
            print "    <th>Password</th>";
            print "    <th>Ação</th>";
            print "</tr>";

            foreach ($usuario->buscarPeloNome($busca) as $row) {
                print "<tr>";

                $nome = $row['user_nome'];
                $email = $row['email'];
                $paswd = $row['password'];
                $id = $row['id_user'];

                print "    <td>{$nome}</td>";
                print "    <td>{$email}</td>";
                print "    <td>{$paswd}</td>";
                print "    <td> 
                        <a href=" . "edit-usuario.php?id={$id}" . " /> Editar |
                        <a href=" . "excluir-usuario.php?id={$id}" . " /> Excuir 
                    </td>";
                print "</tr>";
            }

            print "</table>";
        } catch (Throwable $th) {
            echo $th->getMessage();
        }
    } else {
        print "<table class=" . "list-users" . ">";
        print "<tr>";
        print "    <th>Nome</th>";
        print "    <th>E-mail</th>";
        print "    <th>Password</th>";
        print "    <th>Ação</th>";
        print "</tr>";
        foreach ($usuario->listarTodos() as $row) {
            print "<tr>";

            $nome = $row['user_nome'];
            $email = $row['email'];
            $paswd = $row['password'];
            $id = $row['id_user'];

            print "    <td>{$nome}</td>";
            print "    <td>{$email}</td>";
            print "    <td>{$paswd}</td>";
            print "    <td> 
                        <a href=" . "edit-usuario.php?id={$id}" . " /> Editar |
                        <a href=" . "excluir.php?id={$id}" . " /> Excuir 
                    </td>";
            print "</tr>";
        }
        print "</table>";
    }

    ?>
</main>