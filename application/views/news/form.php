<h2><?php echo $page_title ?></h2>
<?php
    echo validation_errors();
?>
<div class="row justify-content-center">
    <form action="<?php echo site_url($action) ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $news_item['id'] ?? '' ?>">
        <div class="form-group">
            <label for="title">Titre :</label>
            <input id="title" type="text" name='title' class="form-control" 
            value="<?php echo $news_item['title'] ?? '' ?>"/>
        </div>
        <div class="form-group">
            <label for="textarea">Texte :</label>
                <textarea
                id="textarea" 
                name="text" 
                class="form-control" 
                rows="10"><?php echo $news_item['text'] ?? '' ?></textarea>
            </label>
        </div>

        <input type="submit" name="submit" class="btn btn-primary" value="Wow">

    </form>
</div>