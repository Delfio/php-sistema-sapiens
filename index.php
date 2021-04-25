<!-- // Copyright 2021 Delfio Francisco
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
    require_once './classes/validator.php';
    $user = new Usuario;

    include("head.php")
?>
    <main>
        <div class="form-principal">
            <section class="splash-principal">
                <img src="./assets/img/animation_500_x_500.gif" alt="gif-login">
            </section>
            <section class="formulario-login">
                <form action="" method="post">
                    <h2>Bem vindo !</h2>
                    <div class="container-input">
                        <div class="input">
                            <label for="email">
                            <i class="small material-icons">email</i></label>
                            <input type="text" class="campo-imput" placeholder="Email" id="email" name="email">
                        </div>
                        <div class="input">
                            <label for="password">
                            <i class="small material-icons">https</i></label>
                            <input type="password" class="campo-imput" placeholder="Senha" id="password" name="password">
                        </div>
                        <div class="forgot-password">
                            <a href="#">Forgot password</a>
                        </div>
                    </div>
                    <div class="buttons">
                        <button type="submit">
                            Entrar
                        </button>
                        <a href="cadastrar.php">
                            Cadastrar
                        </a>
                    </div>
                </form>
                <?php
                    if(isset($_POST['email']) && isset($_POST['password']))
                    {
                        $email           = addslashes($_POST['email']);
                        $password        = addslashes($_POST['password']);

                        if(empty($email) || empty($password)) {
                            echo '<script type="text/javascript">showModal("erro", "Necessário preencher todos os campos!");</script>';
                            return;
                        }

                        if(!$user->connectar('bd_aula05', 'localhost', '15432', 'postgres', '123456')) {
                            echo '<script type="text/javascript">showModal("erro", "Sem conexão com o BD");</script>';
                            return;
                        }

                        if(!$user->Logar($email, $password))
                        {
                            echo '<script type="text/javascript">showModal("erro", "Usuário inválido!");</script>';
                            return;
                        }

                        echo '<script type="text/javascript">showModal("sucesso", "Usuário logado com sucesso!");</script>';
                        
                        header("location: dashboard.php");
                    }
                ?>
            </section>
        </div>
    </main>
<?php
    include("footer.php")
?>