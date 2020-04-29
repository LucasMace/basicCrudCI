<h2>S'inscrire</h2>


<div class="row justify-content-center">
    <form action="<?php echo site_url('register/validation') ?>" method="post">
        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password">
        </div>
        <div class="form-group">
            <label for="passwordRepeat">Retaper votre mot de passe :</label>
            <input type="password" name="passwordRepeat" id="passwordRepeat">
        </div>
        <input type="submit" name="submit" class="btn btn-primary" value="Se connecter">
    </form>
</div>