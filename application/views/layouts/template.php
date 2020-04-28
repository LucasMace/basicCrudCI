<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url().'css/style.css'; ?>">
    <title>Tuto</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="<?php echo base_url() ?>">Accueil</a></li>
            <li><a href="<?php echo base_url() . "news/create" ?>">Créer article</a></li>
        </ul>
    </nav>
    <main>
        <?php if($this->session->success) { ?>
            <div class="success">
                <?php echo $this->session->success ?>
            </div>
        <?php } ?>
        <?php
            echo $content;
        ?>
    </main>
</body>
</html>