<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo site_url('asset/css/style.css'); ?>">
    <link 
        rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous">
    <title>Tuto</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="<?php echo base_url() ?>">Accueil</a></li>
            <li><a href="<?php echo site_url("news/create") ?>">Créer article</a></li>
            <li class="right-nav">
            <?php
                if($this->session->is_logged){ ?>
                    <li>Bonjour <?php echo $this->session->username ?></li>
                    <li><a href='<?php echo site_url('logout') ?>'>Se déconnecter</a></li>
            <?php } else { ?>
                    <li><a href="<?php echo site_url('login') ?>">Se connecter</a></li>
                    <li><a href="<?php echo site_url('register') ?>">S'inscrire</a></li>
            <?php }
            ?>  
            </li>
        </ul>
    </nav>
    <div class="row justify-content-center">
        <main class="col-sm-8">
            <?php if($this->session->success) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->success ?>
                </div>
            <?php } ?>
            <?php if($this->session->error) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo $this->session->error ?>
                </div>
            <?php } ?>
            <?php
                echo $contents;
            ?>
        </main>        
    </div>
</body>
</html>