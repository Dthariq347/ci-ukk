<!DOCTYPE html>
<html lang="en" class="no-focus">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title><?= $title; ?></title>

    <meta name="description" content="Portal LTMPT">
    <meta name="author" content="LTMPT">
    <meta name="robots" content="noindex, nofollow">



    <!-- Fonts and Codebase framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
    <link href="https://portal.ltmpt.ac.id/assets/plugins/bootstrap5/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" id="css-main" href="https://portal.ltmpt.ac.id/assets/css/codebase.css">
    <link href="https://portal.ltmpt.ac.id/assets/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
    <link rel="stylesheet" id="css-theme" href="https://portal.ltmpt.ac.id/assets/css/themes/corporate.min.css">
    <link rel="stylesheet" href="https://portal.ltmpt.ac.id/assets/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="https://portal.ltmpt.ac.id/assets/plugins/cropperjs/dist/cropper.css">
    <script src="<?= base_url(); ?>/fontawesome-free-6.0.0-beta3-web/js/all.min.js" crossorigin="anonymous"></script>
    <!-- END Stylesheets -->

    <style>
        .btn-primary:focus,
        .btn-primary:active {
            background: #204B87 !important;
        }

        .btn-outline-primary {
            border: black 1px solid;
            color: black;
            background: transparent;
        }

        .btn-primary:hover,
        .btn-primary:active {
            background: #32CD32;
            color: #fff;
        }


        .text-primary.text-white-hover:hover {
            color: #fff !important;
        }

        .impersonating {
            padding: 10px;
            background-color: #fff;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 100;
            /*border-bottom: 1px solid #204B87;*/
        }


        .pic-container {
            cursor: pointer;
            overflow: hidden;
        }

        .pic-container.pic-medium {
            width: 96px;
            height: 96px;
        }

        .pic-container.pic-circle {
            border-radius: 50%;
        }

        .pic-overlay {
            background-color: #ccc;
            opacity: 0.5;
            width: 100%;
            height: 100%;
            margin: 0;
            position: relative;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .pic-container:hover .pic-overlay {
            top: -100%;
        }

        .pic-overlay a {
            display: block;
            padding: 10px;
        }

        .pic-xs .pic-overlay a {
            padding: 5px;
        }

        .info-tooltip {
            position: absolute;
            bottom: 0;
            right: 0;
            padding: 5px;
            margin-right: 10px;
            border-bottom-left-radius: 2px;
            border-bottom-right-radius: 2px
        }

        .btn-outline-danger {
            color: #ef5350;
            background-color: transparent;
            background-image: none;
            border-color: #ef5350;
        }

        button.swal2-cancel.swal2-styled {
            border: #204B87 1px solid !important;
            color: #204B87 !important;
            background: transparent !important;
        }

        button.swal2-cancel.swal2-styled:hover,
        button.swal2-cancel.swal2-styled:focus {
            border: #204B87 1px solid !important;
            background: #204B87 !important;
            color: #fff !important;
        }

        .nav-main-header a.active,
        .nav-main-header a:focus,
        .nav-main-header a:hover,
        .nav-main-header li.open>a.nav-submenu,
        .nav-main-header li:hover>a.nav-submenu {
            color: #fff;
            background-color: #204B87;
        }
    </style>

    <link rel="stylesheet" href="https://portal.ltmpt.ac.id/assets/plugins/bootstrap-pin-code/css/bootstrap-pincode-input.css">
    <link rel="stylesheet" href="https://portal.ltmpt.ac.id/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="https://portal.ltmpt.ac.id/assets/plugins/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/css/profile.css">

    <style>
        .input-group {
            padding-top: 6px !important;
        }
    </style>

</head>

<body>

    <div id="page-container" class="sidebar-inverse side-scroll page-header-fixed page-header-glass page-header-inverse main-content-boxed">


        <main id="main-container" class="bg-white ">


            <!-- Header -->
            <div class="content content-top">
                <div class="row push">
                    <div class="col-md d-md-flex align-items-md-center text-center">
                        <h1 class="mb-0">PROFILE SISWA</h1>
                    </div>
                    <div class="col-md d-md-flex align-items-md-center justify-content-md-end text-center">
                        <a href="<?= base_url('siswa'); ?>" class="btn btn-success btn-outline-success">
                            <i class="fa fa-arrow-circle-left mr-5"></i>Back to dashboard </a>
                    </div>
                </div>
            </div>
            <!-- END Header -->

            <!-- Page Content -->

            <div class="container">
                <div class="row">

                    <div class="col-md-7 col-xl-12">
                        <!-- Akun -->

                        <div class="card border-success">
                            <div class="card-header bg-white border-success">
                                <h2 class="block-title">Account</h2>
                            </div>
                            <div class="card-body">
                                <div class="row mb-6">
                                    <div class="col-sm-6">
                                        <div class="card border-0">
                                            <div class="card-body">
                                                <center><img class="img-profile rounded-circle w-50 p-2" src="<?= base_url(); ?>/img/<?= user()->userr_image; ?>"></center>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 m-auto">
                                        <div class="card col d-flex justify-content-center border-success">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label text-right d-none d-sm-block">Nama Lengkap</label>
                                                    <div class="col-lg-8">
                                                        <div class="input-group input-group-lg">
                                                            <input type="text" class="form-control input-lg" value="<?= user()->fullname; ?>" readonly>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label text-right d-none d-sm-block">Email Siswa</label>
                                                    <div class="col-lg-8">
                                                        <div class="input-group input-group-lg">
                                                            <input type="text" class="form-control input-lg" value="<?= user()->email; ?>" readonly>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label text-right d-none d-sm-block">Username Siswa</label>
                                                    <div class="col-lg-8">
                                                        <div class="input-group input-group-lg">
                                                            <input type="text" class="form-control input-lg" value="<?= user()->username; ?>" readonly>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        <footer id="page-footer" class="bg-white ">
            <div class="content py-15 font-size-xs clearfix">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; <?= date('h') ?> by: dzaky abiyyu thariq</span> <br>
                    <span>Version 1.0</span>
                </div>
            </div>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Page Container -->


    <script src="<?= base_url(); ?>/js/codebase2.core.min.js"></script>

    <script src="<?= base_url(); ?>/js/codebase.core.min.js"></script>









</body>

</html>