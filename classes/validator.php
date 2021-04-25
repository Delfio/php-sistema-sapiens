<!-- // Copyright 2021 delfi
// 
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
// 
//     http://www.apache.org/licenses/LICENSE-2.0
// 
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License. -->

<?php 
    Class Usuario {

        private $pdo;
        public $msgerro;

        // Conexão com o banco de dados
        public function connectar($db_name, $host, $port, $user, $pswd)
        {
            global $pdo;
            try
            {
                $pdo = new PDO("pgsql:host=127.0.0.1;port=15432;dbname=bd_aula05;user=postgres;password=123456");

                return true;
            } catch (PDOException $err) {
                echo $err->getMessage();
                $msgerro = $err->getMessage();

                return false;
            }
        }

        public function Cadastrar($name, $email, $password)
        {
            global $pdo;
            try {

                $sql = $pdo->prepare("SELECT id_user from tbl_usuario WHERE tbl_usuario.email = :email");
                $sql->bindValue(":email", $email);
                $sql->execute();

                if($sql->rowCount() > 0)
                {
                    return false;
                };

                $sql = $pdo->prepare("INSERT INTO tbl_usuario(user_nome, email, password) VALUES(:user_nome, :email, :password)");

                $sql->bindValue(":email", $email);
                $sql->bindValue(":password", sha1($password));
                $sql->bindValue(":user_nome", $name);

                $sql->execute();

                return true;
            } catch (Throwable $th) {
                echo $th->getMessage();
                $msgerro = $th->getMessage();
                return false;
            }
        }
        public function Logar($email, $password)
        {
            global $pdo;
            try {
                $sql = $pdo->prepare("SELECT id_user, user_nome from tbl_usuario WHERE tbl_usuario.email = :email AND tbl_usuario.password = :password");
                

                $sql->bindValue(":email", $email);
                $sql->bindValue(":password", sha1($password));

                $sql->execute();


                if($sql->rowCount() <= 0)
                {
                    return false;
                };

                $dados = $sql->fetch();

                session_start();

                $_SESSION['user_nome'] = $dados['user_nome'];
                $_SESSION['id_user'] = $dados['id_user'];
                return true;
            } catch (Throwable $th) {
                echo $th->getMessage();
                $msgerro = $th->getMessage();
                return false;
            } 
        }
    }
    
?>