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
    include ('head.php');
?>
    <main>
        <div class="form-principal">
            <section class="splash-principal">
                <img src="./assets/img/animation_500_x_500.gif" alt="gif-login">
            </section>
            <section class="formulario-login">
                <form action="" method="post">
                    <h2>Faça seu cadastro!</h2>
                    <div class="container-input">
                        <div class="input">
                            <label for="name">
                            <i class="small material-icons">person</i></label>
                            <input type="text" class="campo-imput" placeholder="Nome" id="name" name="name">
                        </div>
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
                        <div class="input">
                            <label for="confirm-password">
                            <i class="small material-icons">https</i></label>
                            <input type="password" class="campo-imput" placeholder="Confirmar senha" id="confirm-password" name="confirm-password">
                        </div>
                        <div class="forgot-password">
                            <a href="#">Forgot password</a>
                        </div>
                    </div>
                    <div class="buttons">
                        <button type="submit">
                            Cadastrar
                        </button>
                        <a href="index.php">
                            Entrar
                        </a>
                    </div>
                </form>

                <?php
                    if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm-password']))
                    {
                        $name            = addslashes($_POST['name']);
                        $email           = addslashes($_POST['email']);
                        $password        = addslashes($_POST['password']);
                        $confirmPassword = addslashes($_POST['confirm-password']);

                        if(!empty($password) && !empty($confirmPassword))
                        {
                            if($password != $confirmPassword)
                            {
                                echo "Senhas não batem !";
                                return;    
                            } 
                            if($user->connectar('bd_aula05', 'localhost', '15432', 'postgres', '123456'))
                            {
                                if(!$user->Cadastrar($name, $email, $password))
                                {
                                    echo '<script type="text/javascript">showModal("erro", "Usuário já cadastrado!");</script>';
                                    
                                    return;
                                }
                                echo '<script type="text/javascript">showModal("sucesso", "Usuário cadastrado com sucesso!");</script>';

                                return;
                            }
                            
                            echo '<script type="text/javascript">showModal("erro", "Não foi possível conectar ao banco de dados!");</script>';
                            return;
                        } 
                        
                        echo '<script type="text/javascript">showModal("erro", "Necessário preencher todos os campos !");</script>';
                        return;
                    }

                ?>
            </section>
        </div>
    </main>
<?php
    include ('footer.php')
?>