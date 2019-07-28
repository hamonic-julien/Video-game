<?php include __DIR__.'/layout/header.php'; ?>
    <div class="row">
        <div class="col-12">
            <a href="<?= route('home');?>?order=name" class="btn btn-primary">Trier par nom</a>&nbsp;
            <a href="<?= route('home');?>?order=editor" class="btn btn-info">Trier par éditeur</a>&nbsp;
            <!-- TODO (optionnel) n'afficher ce bouton que s'il y a un tri -->
            <a href="<?= route('home');?>" class="btn btn-dark">Annuler le tri</a><br>
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">&Eacute;diteur</th>
                        <th scope="col">Date de sortie</th>
                        <th scope="col">Console / Support</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($videogames as $videogame): ;?>
                    <tr>
                        <td><?=$videogame->id;?></td>
                        <td><?=$videogame->name;?></td>
                        <td><?=$videogame->editor;?></td>
                        <td><?=$videogame->release_date;?></td>
                        <td><?=$platforms->firstWhere('id', $videogame->platform_id)->name;?></td>
                    </tr>
                <?php endforeach ;?>
                </tbody>
            </table>
        </div>
    </div>

<?php include __DIR__.'/layout/footer.php'; ?>
