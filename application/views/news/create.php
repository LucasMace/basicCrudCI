<h2>New article</h2>
<?php
    echo validation_errors();
?>
<?php echo form_open("news/store"); ?>
    <label>Titre :
        <input type="text" name='title' />
    </label>
    <label>Texte :
        <textarea name="text" id="text" cols="30" rows="10"></textarea>
    </label>

    <input type="submit" name="submit" value="Wow">

</form>