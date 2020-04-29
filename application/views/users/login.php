<h2>Se connecter</h2>


<div class="row justify-content-center">
    <form action="<?php echo site_url('login/validation') ?>" method="post">
        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password">
        </div>
        <input type="submit" name="submit" class="btn btn-primary" value="Se connecter">
    </form>
</div>