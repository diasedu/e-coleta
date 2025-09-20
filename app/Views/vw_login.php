<!DOCTYPE html>
<html lang="pt-BR">

<?= view('templates/vw_head', ['titulo' => 'Login']) ?>

<body class="bg-primary">
    <div class="container-sm bg-light shadow rounded"
        style="width: 30%; margin: 10% 35%; padding: 30px;">
        <form id="form" action="auth" method="post">
            <div class="row mb-3">
                <div class="col">
                    <label for="email">Email</label>
                    <input type="email" class="form-control shadow" id="email" name="email" required/>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="pass">Senha</label>
                    <input type="password" class="form-control shadow" id="pass" name="pass" required/>
                </div>
            </div>

            <div id="msg"></div>

            <hr>

            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary btn-block shadow" id="authBtn">Entrar</button>
                    <button 
                        type="button" 
                        class="btn btn-secondary btn-block shadow"
                        data-toggle="modal" 
                        data-target="#registerModal"    
                    >Desejo me cadastrar</button>
                </div>
            </div>
        </form>

        <!-- Modal -->
        <div class="modal fade" id="registerModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerModalLabel">Cadastro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="userRegister" method="post" id="userRegister">
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="user_name">Nome</label>
                                    <input type="text" class="form-control shadow" id="user_name" name="user_name" required/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="user_email">E-mail</label>
                                    <input type="email" class="form-control shadow" id="user_email" name="user_email" required/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="user_pass">Senha</label>
                                    <input type="password" class="form-control shadow" id="user_pass" name="user_pass" required/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="user_confirm_pass">Confirmar a senha</label>
                                    <input type="password" class="form-control shadow" id="user_confirm_pass" name="user_confirm_pass" required/>
                                </div>
                            </div>
                            
                            <div id="registerMsg"></div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary shadow" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary shadow" id="registerBtn">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?= view('templates/vw_footer') ?>

    <script src="<?= base_url('public/js/login.js?v= ' . time()) ?>"></script>
</body>

</html>