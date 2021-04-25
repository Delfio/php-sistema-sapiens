<?php
    class Professor
    {
        private $connection;
        private $banco = 'bd_aula05';
        private $user = 'postgres';
        private $password = '123456';
        private $hostname = 'localhost';
        private $porta = '15432';

        function __construct() {
            $this->connection = new PDO("pgsql:host={$this->hostname};port={$this->porta};dbname={$this->banco};user={$this->user};password={$this->password}");
        }

        function cadastrar($nome, $email, $password): bool {
            $query_insert = "INSERT INTO tbl_professores(pro_nome, pro_email, pro_pass) VALUES(:n, :e, :p)";

            try {
                $sql = $this->connection->prepare($query_insert);

                $sql->bindValue(":n", $nome);
                $sql->bindValue(":e", $email);
                $sql->bindValue(":p", sha1($password));

                $sql->execute();
                return true;
                
            } catch (Throwable $th) {
                echo $th->getMessage();
                return false;
            }
        }

        function listarTodos() {
            $query_select = "SELECT * FROM tbl_professores";

            return $this->connection->query($query_select);
        }

        function buscarPeloNome($nome) {
            $query_select = "SELECT * FROM tbl_professores WHERE pro_nome LIKE '%{$nome}%'";

            return $this->connection->query($query_select);
        }

        function buscarPorId($id) {
            $query_select = "SELECT * FROM tbl_professores WHERE pro_id = {$id}";

            return $this->connection->query($query_select);
        }

        function atualizar($id, $nome, $email, $password) {

            if($password) {
                $query_update = "UPDATE tbl_professores SET pro_nome = :n, pro_email = :e, pro_pass = :p WHERE pro_id = :i";    
            } else {
                $query_update = "UPDATE tbl_professores SET pro_nome = :n, pro_email = :e WHERE pro_id = :i";    
            }

            $sql = $this->connection->prepare($query_update);

            $sql->bindValue(':n', $nome);
            $sql->bindValue(':e', $email);
            $sql->bindValue(':i', $id);

            if($password) {
                $sql->bindValue(':p', sha1($password));
            }

            $sql->execute();

            return ($sql->rowCount() <= 1);

        }

        function deletar($id):bool {
            $query_delete = "DELETE FROM tbl_professores WHERE pro_id = :i";

            $sql = $this->connection->prepare($query_delete);
        
            $sql->bindValue(':i', $id);

            $sql->execute();

            return ($sql->rowCount() >= 1);
        }
    }
