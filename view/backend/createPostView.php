<?php $title = "Administration du blog"; ?>
<?php $nav = "admin-create-post"; ?>

<?php ob_start(); ?>

<?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])) : ?>
    <div class="alert alert-success"><?= $_SESSION['success']; ?></div>
<?php endif; ?>
<?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])) : ?>
    <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
<?php endif; ?>

<!-- Add Post Section Form-->
<div class="row justify-content-center" id="post-create">
    <div class="col-sm-11 col-lg-6">
        <h3 class="text-center text-uppercase ">
            Créer mon article
        </h3>
        <hr>
        <p></p>
    </div>

    <div class="row">
        <form method="post" action="index.php?action=createPost" class="center mb-3">
            <div class="form-group">
                <h4>Titre de l'article</h4>
                <input type="text" class="form-control" name="title" required>
            </div>
            <div class="form-group">
                <h4>Extrait de l'article</h4>
                <textarea class="form-control" name="fragment" required rows="5"
                          cols="30" placeholder="Décrivez votre extrait"></textarea>
            </div>
            <div class="form-group">
                <h4>Contenu de l'article</h4>
                <textarea id="editor" class="form-control" name="content" required rows="20"
                          cols="30" placeholder="Décrivez votre article"></textarea>
            </div>
    </div>

    <div class="row justify-content-md-center">
        <div class="col-lg-3">
            <div class="form-group">
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '    ' ?>">
                <button type="submit" name="submit" class="btn btn-primary" id="btn-create-post">Enregistrer
                </button>
            </div>
            </form>
        </div>
        <div class="col-lg-3">
            <a class="btn btn-danger" id="btn-cancel-post" href="index.php?action=dashboardAdmin">Annuler</a>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require_once 'template.php'; ?>

<?php unset($_SESSION['error']); ?>

<?php unset($_SESSION['success']); ?>
