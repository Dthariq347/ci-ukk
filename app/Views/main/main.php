<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="<?= base_url(); ?>/css/style.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans:wght@700&display=swap" rel="stylesheet">
    <title><?= $title; ?></title>
</head>

<body>
    <div class="container">
        <section class="banner">
            <div class="image-banner">
                <img src="<?= base_url(); ?>/img/header.JPG" alt="">
            </div>
        </section>
        <section class="button">
            <div class="text-siswa">
                <ul>
                    <li>
                        <a href="<?= base_url('login'); ?>">
                            <span class="icon"></span>
                            <span class="title">
                                <p class="neon-button">LOGIN</p>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </section>

        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; <?= date('h') ?> by: dzaky abiyyu thariq</span> <br>
                    <span>Version 1.0</span>
                </div>
            </div>
        </footer>
    </div>

</body>

</html>