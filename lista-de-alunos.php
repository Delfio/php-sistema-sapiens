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
        <h3>Alunos cadastrados no sistema</h3>
    </div>

    <header class="add-user">

        <div class="search">
            <form action="" method="post" class="search-box">
                <input name="find-user" placeholder="Digite sua busca" type="text">
                <div class="buttons-search-box">
                    <button class="button-pesquisar" type="submit">Pesquisar</button>
                    <a href="add-aluno.php">
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

            foreach ($aluno->buscarPeloNome($busca) as $row) {
                print "<tr>";

                $nome = $row['aln_nome'];
                $email = $row['aln_email'];
                $paswd = $row['aln_pass'];
                $id = $row['aln_id'];

                print "    <td>{$nome}</td>";
                print "    <td>{$email}</td>";
                print "    <td>{$paswd}</td>";
                print "    <td> 
                        <a href=" . "edit-aluno.php?id={$id}" . " /> Editar |
                        <a href=" . "excluir-aluno.php?id={$id}" . " /> Excuir 
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
        foreach ($aluno->listarTodos() as $row) {
            print "<tr>";

            $nome = $row['aln_nome'];
            $email = $row['aln_email'];
            $paswd = $row['aln_pass'];
            $id = $row['aln_id'];

            print "    <td>{$nome}</td>";
            print "    <td>{$email}</td>";
            print "    <td>{$paswd}</td>";
            print "    <td> 
                        <a href=" . "edit-aluno.php?id={$id}" . " /> Editar |
                        <a href=" . "excluir.php?id={$id}" . " /> Excuir 
                    </td>";
            print "</tr>";
        }
        print "</table>";
    }

    ?>
</main>