<!DOCTYPE html>
<html lang="pt-br">
<head>
    <base href="<?=site_url()?>">
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 text-center mb-5">
                    <h2 class="heading-section" style="display:flex; justify-content:center; align-items:center;">
                        <img src="https://megachamados.cloud/img/logo.png" width="200px">
                        <div style="width:200px;">
                        <img src="https://megachamados.cloud/img/logo_prefeitura.jpg" width="100px">
                        </div>
                    </h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-user-o"></span>
                        </div>
                        <h3 class="text-center mb-4">Já possui uma conta?</h3>
                        <form method="post" action="<?php echo site_url('auth/login'); ?>" class="login-form">
                            <div class="form-group">
                                <input type="text" class="form-control rounded-left" name="login" placeholder="Nome de Usuário" required="">
                                <?php echo form_error('login', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group d-flex">
                                <input type="password" class="form-control rounded-left" name="senha" placeholder="Senha" required="">
                                <?php echo form_error('senha', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group d-flex">
                                <select name="setor" class="form-control rounded-left" required>
                                    <option value="" disabled selected>Selecione o setor</option>
                                    <?php 
                                        foreach ($setores as $setor) {      
                                    ?>
                                    <option value="<?=$setor->id_setor?>"><?=$setor->name?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('setor', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group d-md-flex justify-content-center">
                                <div >
                                    <label class="checkbox-wrap checkbox-primary">Lembrar-me
                                        <input type="checkbox" checked="">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <?php if(isset($login_error)){ ?>
                            <div class="alert alert-danger" role="alert">
                                <?=$login_error?>
                            </div>
                            <?php } ?>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary rounded submit p-3 px-5">Acessar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Adicione os links para os arquivos JS do Bootstrap e Font Awesome (opcional) -->
    <!-- Se você quiser usar componentes interativos do Bootstrap ou ícones adicionais do Font Awesome -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>
