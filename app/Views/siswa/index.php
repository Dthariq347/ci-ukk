<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">


    <?= $this->include('templates/dashboard'); ?>

</div>

<?= $this->endSection(); ?>