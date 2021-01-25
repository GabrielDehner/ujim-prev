<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <base href="<?= base_url() ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?= base_url('/favicon.png') ?>">
    <title>UJIM - Unión Juvenil de las Iglesias en Misiones</title>

    <meta property="og:url" content="<?= base_url() ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="UJIM - Unión Juvenil de las Iglesias en Misiones"/>
    <meta property="og:description" content="Unión Juvenil de las Iglesias en Misiones"/>
    <meta property="og:image" content="<?= base_url('/favicon.png') ?>"/>

    <meta http-equiv="Cache-Control" content="private, max-age=2592000">

    <link rel="stylesheet" href="<?= base_url('assets/libs/bootstrap-4.1.1-dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/general.css') ?>">

    <?php if ($controller === 'home') { ?>
        <link rel="stylesheet" href="<?= base_url('assets/css/home.css') ?>">
    <?php } elseif ($controller === 'register') { ?>
        <link rel="stylesheet" href="<?= base_url('assets/libs/select2/css/select2.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/libs/sweetalert2/sweetalert2.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/register.css') ?>">
    <?php } elseif ($controller === 'competition') { ?>
        <link rel="stylesheet" href="<?= base_url('assets/css/competition.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/libs/fontawesome-free-5.1.0-web/css/all.css') ?>">
    <?php } elseif ($controller === 'information') { ?>
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/libs/datatables/css/dataTables.bootstrap.min.css">

    <?php } elseif ($controller === 'registerHosts') { ?>
        <link href="<?php echo base_url('assets/libs/bootstrapV/css/bootstrap.min.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/libs/datatables/css/dataTables.bootstrap.min.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
    <?php } elseif ($controller === 'reports') { ?>
        <link href="<?php echo base_url('assets/libs/bootstrap-4.1.1-dist/css/bootstrap.min.css')?>" rel="stylesheet">

    <?php } elseif ($controller === 'updateUsers') { ?>
        <link href="<?php echo base_url('assets/libs/bootstrapV/css/bootstrap.min.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/libs/datatables/css/dataTables.bootstrap.min.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">

    <?php }?>
</head>

<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?= base_url() ?>">
            <img src="<?= base_url('assets/images/LOGO UJIM.png') ?>" alt="" width="50px">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                    <a class="btn btn-danger mt-2 mb-2 mt-lg-0 mb-lg-0 mr-lg-2" href="<?= base_url('concurso') ?>">CONCURSO</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-success btn-registrate" href="<?= base_url('registro') ?>">Registrate!</a>
                </li>
            </ul>
        </div>
    </nav>
</header>