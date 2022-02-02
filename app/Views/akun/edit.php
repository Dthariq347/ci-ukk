<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title><?= $title; ?></title>
</head>

<body>
    <?= $this->extend('templates/index'); ?>

    <?= $this->section('page-content'); ?>
    <h1 class="mt-2" style="text-align: center;">EDIT DATA PETUGAS / ADMIN</h1>



    <form action="/admin/updateakun/<?= $home['id']; ?>" method="post" style="padding: 20px;" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $home['id']; ?>">
        <div class="form-group">
            <label for="id">ID</label>
            <input type="text" name="id" class="form-control <?= ($validation->hasError('id')) ? 'is-invalid' : ''; ?> " id="id" value="<?= (old('id')) ? old('id') : $home['id']; ?>" placeholder="id" readonly>
            <div class="invalid-feedback">
                <?= $validation->getError('id'); ?>
            </div>

        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?> " id="email" value="<?= (old('email')) ? old('email') : $home['email']; ?>" placeholder="Email" readonly>
            <div class="invalid-feedback">
                <?= $validation->getError('email'); ?>
            </div>

        </div>
        <div class="form-group">
            <label for="username">username</label>
            <input type="text" name="username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?> " id="username" value="<?= (old('username')) ? old('username') : $home['username']; ?>" placeholder="Username">
            <div class="invalid-feedback">
                <?= $validation->getError('username'); ?>
            </div>

        </div>
        <div class="form-group">
            <label for="password_hash">password_hash</label>
            <input type="password" name="password_hash" class="form-control <?= ($validation->hasError('password_hash')) ? 'is-invalid' : ''; ?> " id="password_hash" value="<?= (old('password_hash')) ? old('password_hash') : $home['password_hash']; ?>" placeholder="First name">
            <div class="invalid-feedback">
                <?= $validation->getError('password_hash'); ?>
            </div>

        </div>

        <button type="submit" class="btn btn-success btn-block">Edit</button>
    </form>
    <?= $this->endSection(); ?>
</body>

</html>