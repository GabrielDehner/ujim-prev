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

    <?php if ($controller === 'homeAdmin') { ?>
        <link rel="stylesheet" href="<?= base_url('assets/css/home.css') ?>">
        
    <?php } elseif ($controller === 'login') { ?>
        <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
        
    







        <?php } elseif ($controller === 'information') { ?>
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/libs/datatables/css/dataTables.bootstrap.min.css">

    <?php } elseif ($controller === 'registerHosts') { ?>
        <link href="<?php echo base_url('assets/libs/bootstrapV/css/bootstrap.min.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/libs/datatables/css/dataTables.bootstrap.min.css')?>" rel="stylesheet">
        
    <?php } elseif ($controller === 'reports') { ?>
        <link rel="stylesheet" href="<?= base_url('assets/css/home.css') ?>">
       
    <?php } elseif ($controller === 'updateUsers') { ?>
        <link href="<?php echo base_url('assets/libs/bootstrapV/css/bootstrap.min.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/libs/datatables/css/dataTables.bootstrap.min.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
       

        
    <?php } ?>
        
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
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hospedaje
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= base_url('registerHosts') ?>">Gestionar Hospedadores</a>
                        <a class="dropdown-item" href="<?= base_url('information') ?>">Gestionar Lugares</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('updateUsers') ?>">Gestionar Usuarios</a>         
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('reports') ?>">Gestionar Reportes</a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ver Tutoriales
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="https://www.youtube.com/watch?v=OXTQh9DWozI&feature=youtu.be" target="_blank">Cómo ayudar a registrar? (Video para cualquiera)</a>
                        <a class="dropdown-item" href="https://youtu.be/OKyxGx0WXVM" target="_blank">Cómo usar la página? (Vídeo sólo para Administradores)</a>
                    
                    </div>
                </li>
            </ul>
            
        
            <ul class="navbar-nav ml-auto">
              
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('login/log_out') ?>">Cerrar Sesi&oacute;n</a>
                </li>
            </ul>
        </div>
    </nav>
</header>