<?php include __DIR__.'/layout/header.php'; ?>
    <h1>Bonjour <?= $name;?> ! </h1>
    <a href="<?= route('toto');?>">Route Toto</a>
    <?php dump($req);?>
    <?php dump($req->input());?>


<?php include __DIR__.'/layout/footer.php'; ?>
