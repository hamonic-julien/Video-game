<?php include __DIR__.'/layout/header.php'; ?>
    <div class="col-4 mx-auto">
        <?php if(isset($errors)):
            foreach ($errors as $msg): ;?>
        <div class="alert alert-danger">
            <?= $msg;?>
        </div>
        <?php endforeach; endif;?>
        <div class="card">
            <div class="card-header">Authentification</div>
            <div class="card-body">
                <form action="<?= route('login-process');?>" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input required type="email" class="form-control" name="email" id="email" value="<?= @$formValues['email'];?>" placeholder="exemple@mail.fr">
                    </div>
                    <div class="form-group">
                        <label for="pass">Mot de passe</label>
                        <input required type="password" class="form-control" name="pass" id="pass" value="">
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Connexion</button>
                </form>
            </div>
        </div>
    </div>
<?php include __DIR__.'/layout/footer.php'; ?>
