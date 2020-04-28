<h2>Edition article</h2>
<?php
    echo validation_errors();
?>
<?php echo form_open("news/update/" . $news_item['id']); ?>
    <label>Titre :
        <input type="text" name='title' value="<?php echo $news_item['title'] ?>" />
    </label>
    <label>Texte :
        <textarea name="text" id="text" cols="30" rows="10"><?php echo $news_item['text'] ?></textarea>
    </label>

    <input type="submit" name="submit" value="Wow">
</form>