<table id="news_table">
    <thead>
        <th>ID</th>
        <th>Titre</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php foreach ($news as $news_item) { ?>
            <tr>
                <td><?php echo $news_item['id'] ?></td>
                <td class="title">
                    <a href="news/show/<?php echo $news_item['id'] ?>">
                        <?php echo $news_item['title'] ?>
                    </a>
                </td>
                <td class="action">
                    <a href="news/edit/<?php echo $news_item['id'] ?>">Editer</a>
                    <a href="news/delete/<?php echo $news_item['id'] ?>">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>