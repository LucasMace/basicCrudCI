<article>
    <h2><?php echo $news_item['title'] ?></h2>

    <p><?php echo $news_item['text'] ?> </p>

    <div class="action">
        <a href="../edit/<?php echo $news_item['id'] ?>"> Edit</a>
        <a href="../delete/<?php echo $news_item['id']  ?>">Supprimer article</a>
    </div>
</article>