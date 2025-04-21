<!DOCTYPE html>
<html lang="pt-BR">

<?= view('templates/vw_head', ['titulo' => 'Login']) ?>

<body class="bg-primary">
    <div class="container-sm bg-light shadow rounded"
        style="width: 30%; margin: 10% 35%; padding: 30px;">
        <form id="form">
            <div class="row mb-3">
                <div class="col">
                    <label for="email">Email</label>
                    <input type="text" class="form-control shadow" id="email" name="email" />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control shadow" id="senha" name="senha" />
                </div>
            </div>

            <div id="msg"></div>

            <hr>

            <div class="row">
                <div class="col">
                    <button class="btn btn-primary shadow" type="submit" style="float: right; margin-left: 15px" id="logar">Entrar</button>
                    <button class="btn btn-secondary shadow" type="button" style="float: right; margin-left: 15px" data-toggle="modal" data-target="#modalEscolherCadastro">Desejo me cadastrar</button>
                </div>
            </div>
        </form>

        <!-- Modal -->
        <div class="modal fade" id="modalEscolherCadastro" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalEscolherCadastroLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEscolherCadastroLabel">Tipo de Cadastro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <a href="<?= base_url('/cadastro/usuario') ?>" class="text-white btn btn-secondary btn-block shadow"><?= sprintf("%s Solicitante", ICONE_SOLICITANTE) ?></a>
                        <a href="<?= base_url('/cadastro/coletor') ?>" class="text-white btn btn-secondary btn-block shadow"><?= sprintf("%s Coletor", ICONE_COLETOR) ?></a>
                    </div>
                    <div class="modal-footer">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= view('templates/vw_footer') ?>

    <script>
        $('form').submit(function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);

            $.ajax({
                url: "login/autenticarLogin",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                cache: false,
                beforeSend: function() {
                    $('#msg').html('<i class="fa-solid fa-spinner fa-spin"></i>');
                },
                success: function(jsonRes) {
                    if (jsonRes['level'] == 'ERROR') 
                    {
                        $('#msg').html(jsonRes['msg']);
                        return;
                    }

                    window.location.href = '<?= base_url('arealogada/principal') ?>';
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown);
                }
            });
        });
    </script>
</body>

</html>