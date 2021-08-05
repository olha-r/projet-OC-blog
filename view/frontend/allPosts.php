<?php $title = 'Mon blog'; ?>
<?php $nav = "list_post"; ?>

<?php ob_start(); ?>

<div class="row justify-content-center" style="text-align: center; background-color: #eeeeee">
    <div class="col-lg-11">

    <?php
    echo 'Page : ';
    for ($i = 1; $i <= $nb_pages; $i++) {
        echo '<a href="index.php?action=listPosts&page=' . $i . '">' . $i . '</a> ';
    } ?>
</div>
</div>



<?php
while ($data = $posts->fetch()) {
    $id = (int)$data['id']; ?>


    <div class="row justify-content-center" id="post-content">
        <div class="col-lg-11">
            <h3>
                <i class="fas fa-bookmark"></i>
                <?= htmlspecialchars($data['title']) ?>
            </h3>
            <hr>
            <p></p>
            <p><?= nl2br(htmlspecialchars($data['fragment'])) ?></p>
            <p></p>
            <hr>
            <div class="row">
                <div class="col-xs-7 col-sm-8 col-md-6 col-lg-6">
                <span>
                    Publié le
                    <em><?= $data['creation_date_fr'] ?></em>
                </span>
                </div>
                <div class="col-xs-5 col-sm-2 col-md-offset-3 col-md-3 col-lg-offset-4 col-lg-2">
                    <a href="index.php?action=post&amp;id=<?= $data['id'] ?>" class="btn btn-primary">Commentaires</a>

                </div>

            </div>

        </div>

    </div>

    <?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require_once 'template.php'; ?>