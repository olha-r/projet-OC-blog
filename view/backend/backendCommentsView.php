
<?php ob_start(); ?>
<?php
if(isset($_SESSION['success']))
{
    ?>
    <div class="alert alert-success">
        <?php echo $_SESSION['success']; ?>
    </div>
    <?php
}
unset($_SESSION['success']);
if(isset($_SESSION['error']))
{
    ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['error']; ?>
    </div>
    <?php
}
unset($_SESSION['error']);
?>

<section class="page-section" style="background-color: #eeeeee">
    <div class="container-fluid">
        <table class="table table-hover">
            <h3> Liste des commentaires </h3>
            <thead>
            <tr>
                <th scope="col">Date de commentaire</th>
                <th scope="col">Author de commentaire</th>
                <th scope="col">Commentaires</th>
                <th colspan="2">Action</th>
            </tr>

            </thead>
            <tbody>
            <?php
            while ($comments = $all_comments->fetch())
            {
                ?>
                <tr>
                    <td><?= $comments['comment_date'] ?></td>
                    <td><?= htmlspecialchars($comments['user_name']) ?></td>
                    <td><?= htmlspecialchars($comments['comment']) ?></td>

                    <td> <form action="index.php?action=validateComment" method="POST">
                            <input type="hidden" value="<?= $comments['id_comment']; ?>" name="commentId" >
                            <input type="submit" value="Valider" name="validate"  class="btn btn-warning">
                        </form>
                    </td>

                    <td> <form action="index.php?action=notValidateComment" method="POST">
                            <input type="hidden" value="<?= $comments['id_comment']; ?>" name="commentId" >
                            <input type="submit" value="Ne pas valider" name="not_validate"  class="btn btn-danger">
                        </form>
                    </td>

                </tr>
                <?php
            }
            $all_comments->closeCursor();

            ?>
            </tbody>
        </table>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require 'backendTemplate.php'; ?>