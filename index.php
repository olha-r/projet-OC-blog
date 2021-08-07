<?php
session_start();

use OC\Blog\Controller\BackendController;
use OC\Blog\Controller\FrontendController;

require_once 'controller/frontendController.php';
require_once 'controller/backendController.php';
$frontendController = new FrontendController();
try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'homePage') {
            $frontendController->home_page();
        }   elseif ($_GET['action'] === 'listPosts') {
            $frontendController->listPosts();
        } elseif ($_GET['action'] === 'post') {
            $frontendController->post();
        } elseif ($_GET['action'] === 'addComment') {
            $frontendController->addComment();
        } elseif ($_GET['action'] === 'contactUs') {
            $frontendController->contactMail();
        } elseif ($_GET['action'] === 'signUp') {
            $frontendController->addNewUser();
        } elseif ($_GET['action'] === 'signIn') {
            $frontendController->login_user();
        } elseif ($_GET['action'] === 'dashboard') {
            $frontendController->user_dashboard();
        } elseif ($_GET['action'] === 'logout') {
            $frontendController->logout();
        } elseif ($_GET['action'] === 'editUser') {
            $frontendController->updateUserInfo();
        } elseif ($_GET['action'] === 'editPassword') {
            $frontendController->updateUserPassword();
        } elseif ($_GET['action'] === 'deleteUserComment') {
            $frontendController->deleteUserComment();
        } elseif ($_GET['action'] === 'deleteUser') {
            $frontendController->deleteUser();
        } elseif ($_GET['action'] === 'dashboardAdmin') {
            (new BackendController())->displayAllPosts();
        } elseif ($_GET['action'] === 'createPost') {
            (new BackendController())->addPost();
        } elseif ($_GET['action'] === 'displayComments') {
            (new BackendController())->displayAllComments();
        } elseif ($_GET['action'] === 'deletePost') {
            (new BackendController())->deletePost();
        } elseif ($_GET['action'] === 'modifyPost') {
            (new BackendController())->modifyPost();
        } elseif ($_GET['action'] === 'editPost') {
            (new BackendController())->editPost();
        } elseif ($_GET['action'] === 'validateComment') {
            (new BackendController())->validateComment();
        } elseif ($_GET['action'] === 'notValidateComment') {
            (new BackendController())->notValidateComment();
        }
    } else {
        $frontendController->home_page();
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
