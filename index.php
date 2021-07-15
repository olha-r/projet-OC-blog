<?php
session_start();
require('controller/frontendController.php');
require('controller/backendController.php');
try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'homePage') {
            require_once ('view/frontend/homePageView.php');
        }
        elseif ($_GET['action'] === 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] === 'post') {
            post();
        }
        elseif ($_GET['action'] === 'addComment') {
            addComment();
        }
        elseif ($_GET['action'] === 'contactUs') {
            contactMail();
        }
        elseif ($_GET['action'] === 'signUp') {
            addNewUser();
        }
        elseif ($_GET['action'] === 'signIn') {
            login_user();
        }
        elseif ($_GET['action'] === 'dashboard') {
            require_once('view/frontend/profileView.php');
        }
        elseif ($_GET['action'] === 'logout') {
            logout();
        }
        elseif ($_GET['action'] === 'dashboardAdmin') {
            displayAllPosts();
        }
        elseif ($_GET['action'] === 'createPost') {
            addPost();
        }
        elseif ($_GET['action'] === 'displayComments') {
            displayAllComments();
        }
        elseif ($_GET['action'] === 'deletePost') {
            deletePost();
        }
        elseif ($_GET['action'] === 'modifyPost') {
            modifyPost();
        }
        elseif ($_GET['action'] === 'editPost') {
            editPost();
        }
        elseif ($_GET['action'] === 'validateComment') {
            validateComment();
        }
        elseif ($_GET['action'] === 'notValidateComment') {
            notValidateComment();
        }

    }
    else {
        require_once ('view/frontend/homePageView.php');
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
