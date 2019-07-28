<?php include __DIR__.'/layout/header.php'; ?>
    <div class="col-6 mx-auto">
        <?php if(isset($errors)):
            foreach ($errors as $msg): ;?>
        <div class="alert alert-danger">
            <?= $msg;?>
        </div>
        <?php endforeach; endif;?>
        <div class="card">
            <div class="card-header">Ajout</div>
            <div class="card-body">
                <form action="<?= route('adminPost');?>" method="post">
                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input  type="text" class="form-control" name="name" id="name" value="<?= @$formValues['name'];?>" placeholder="Le nom du jeux vidéo">
                    </div>
                    <div class="form-group">
                        <label for="editor">&Eacute;diteur</label>
                        <input required type="text" class="form-control" name="editor" id="editor" value="<?= @$formValues['editor'];?>" placeholder="L'éditeur du jeux vidéo">
                    </div>
                    <div class="form-group">
                        <label for="release_date">Date de sortie</label>
                        <input required type="date" class="form-control" name="release_date" id="release_date" value="<?= @$formValues['release_date'];?>">
                    </div>
                    <div class="form-group">
                        <label for="platform">Console / Support</label>
                        <select required class="custom-select" id="platform" name="platform">
                            <option disabled selected>-</option>
                            <?php foreach ($platforms as $platform): ;?>
                            <option value="<?= $platform->id ;?>"><?= $platform->name ;?></option>
                            <?php endforeach ;?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
<?php include __DIR__.'/layout/footer.php'; ?>
