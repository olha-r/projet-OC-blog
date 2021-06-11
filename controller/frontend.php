<?php

        // Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

require_once('model/UsersManager.php');


        //POST FUNCTIONS

function listPosts()
{
    $postManager = new \Olha\Blog\Model\PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new \Olha\Blog\Model\PostManager();
    $commentManager = new \Olha\Blog\Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
  /* var_dump($post);
    die();*/
    require('view/frontend/postView.php');
}

        //COMMENT FUNCTIONS

function addComment()
{
    $commentManager = new \Olha\Blog\Model\CommentManager();
    $affectedLines = $commentManager->postComment($_GET['id'],$_POST['author'],$_POST['comment']);
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $_GET['id']);
    }
}


function contactMail()
{
    if (isset($_POST['submit'])) {
        $to = "ole4ka.safonova@gmail.com";
        $from = $_POST['email'];
        $name = $_POST['name'];
        $subject = "Message de blog";
        $message = $name . " Message:" . "\r\n" . $_POST['message'];

        $name = htmlspecialchars($name);
        $from = htmlspecialchars($from);
        $message = htmlspecialchars($message);
        $name = urldecode($name);
        $from = urldecode($from);
        $message = urldecode($message);
        $name = trim($name);
        $from = trim($from);
        $message = trim($message);

        $headers = "De:" . $from;

        mail($to, $subject, $message, $headers);
       return require ('view/frontend/thanksMail.php');
    }
    else
    {
        echo "Le message n'est pas envoyé";
    }
    require('view/frontend/contactMailView.php');
}

/*
function login ($login_name, $password) {
    $user = new \Olha\Blog\Model\UsersManager();
    $user_data = $user->getUserData();
    $password_ok = password_verify($password, $user_data['password']);
    if (empty($user_data)) {
        throw new Exception("Nous n'avons pas reconnu ton pseudo");
    }
    if (!$password_ok) {
        throw new Exception("Le mot de passe invalides.");
    }
    $_SESSION['login_name'] = $login_name;
    $_SESSION['id'] = (int) $user_data['id'];
    $_SESSION['email'] = $user_data['email'];
    $_SESSION['creation_date'] = $user_data['creation_date'];
    listPosts();
    require ('view/frontend/signInView.php');

}
*/

        //USERS FUNCTIONS


function addNewUser()
{
    if (isset($_POST['submit'])) {
    $newUser = new \Olha\Blog\Model\UsersManager();
    $user_data = $newUser->checkIfUserExist($_POST['new_login_name']);

    if (!empty($user_data)) {
        throw new Exception('Désolé mais ce pseudo existe déja!');
    }
    if (strlen($_POST['new_login_name']) >16) {
        throw new Exception('Ce pseudo existe dépasse 16 caractères ');
    }
    if (!preg_match('#(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W])(?=.{8,16})(?!.*[\s])#', $_POST['new_password_1'])){
        throw new Exception('Le mot de passe doit contenir: entre 8 et 16 caractères avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial.');
    }
    if ($_POST['new_password_1'] != $_POST['new_password_2']) {
        throw new Exception('Désolé mais les mots de passe saisis ne sont pas identiques. ');
    }

    if (!preg_match('#^[0-9a-z._-]+@[a-z0-9.-_]{2,}\.[a-z]{2,4}$#', $_POST['new_email'])) {
        throw new Exception("Désolé mais l'adresse mail saisie n'est pas valide.");
    }
    $new_password = password_hash($_POST['new_password_1'], PASSWORD_DEFAULT);
    $added_user = $newUser->insertNewUser($_POST['new_login_name'], $new_password, $_POST['new_email']);

    if ($added_user === false) {
        throw new Exception('Une erreur est survenue lors de l\'enregistrement');
    }
    }
    else {

    include ('view/frontend/signUpView.php');
    }
}

