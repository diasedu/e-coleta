<!DOCTYPE html>
<html lang="pt-BR">

<?= view('templates/vw_head', ['titulo' => 'Login']) ?>

<body class="bg-primary">
    <div class="container-sm bg-light"
        style="border: solid gray; width: 30%; margin: 10% 35%; padding: 30px; border-radius: 3%">
        <form id="form">
            <div class="row">
                <div class="col">
                    <label for="nome" style="display: block; text-align: center;">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" />
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="email" style="display: block; text-align: center;">E-mail</label>
                    <input type="text" class="form-control" id="email" name="email" />
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                    <label for="senha" style="display: block; text-align: center;">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" />
                </div>
            </div>

            <div id="msg"></div>

            <hr>

            <div class="row">
                <div class="col">
                    <button class="btn btn-primary" type="submit" style="float: right; margin-left: 15px" id="cadastrar"><i class="fa-solid fa-floppy-disk"></i> Cadastrar</button>
                    <a href="<?= base_url('/login'); ?>" class="btn btn-secondary" type="" style="float: right; margin-left: 15px"><i class="fa-solid fa-circle-chevron-left"></i> Voltar</a>
                </div>
            </div>

        </form>
    </div>

    <?= view('templates/vw_footer') ?>

    <script>
        $('form').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "cadastrarUsuario",
                method: "POST",
                data: $(this).serialize(),
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

                    window.location.href = '<?= base_url('/login') ?>';
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown);
                }
            });
        });
    </script>
</body>

</html>