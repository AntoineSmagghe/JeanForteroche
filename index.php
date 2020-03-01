<?php
session_start();
require_once('controller/controll.php');
require_once('controller/adminControll.php');

try {
    //VARIABLE PGE => ROOT SHEET
    if (isset($_GET['pge'])){

        //HOME PAGE WITH 5 RECENT ARTICLES
        if ($_GET['pge'] === "home"){
            $openCtrl = new controll();
            if (isset($_POST['numberLoad'])) {
                $openCtrl->indexPostView($_POST['numberLoad']);
            } else {
                $openCtrl->indexPostView();
            }

        // ABOUT THIS WEBSITE AND LEGAL MENTIONS
        } else if ($_GET['pge'] === "about"){
            $openCtrl = new controll();
            $openCtrl->aboutPge();

        //ARTICLE WITH COMMENTS
        } else if ($_GET['pge'] === "article"){
            $openCtrl = new controll();
            if (isset($_GET['idPost']) && isset($_GET['action']) && $_GET['action'] === 'show'){
                $idPost = $_GET['idPost'];

                //USER ADD A NEW COMMENT ON ARTICLE
                if(isset($_POST['comment']) && !empty($_POST['comment'])){
                    $newComment = htmlspecialchars($_POST['comment']);
                    $openCtrl->userPublishComment($idPost, $_POST['pseudo'], $newComment);
                }
                $openCtrl->onePostView($idPost);

            //SIGNAL A COMMENT
            } else if (isset($_GET['action']) && $_GET['action'] === 'signal') {
                $openCtrl = new controll();
                if (isset($_GET['idComm']) && isset($_GET['idPost'])){
                    $openCtrl->userSignalComment($_GET['idPost'], $_GET['idComm']);
                } else {
                    throw new Exception('Erreur, numéro de commentaire ou de billet introuvable');
                }
            } else {
                throw new Exception('Erreur, numéro d\'article ou action introuvable');
            }

        //ADMINISTRATION PART
        } else if ($_GET['pge'] === "admin"){            
            $adminCtrl = new adminControll();
            if (isset($_SESSION['id'])){
                if (isset($_GET['action'])){

                    //CREATE ARTICLE
                    if ($_GET['action'] === "edit"){
                        require_once('view/adminPostEdit.php');
                        
                        //PUBLISH
                        if (isset($_POST['textEdit']) && !empty($_POST['textEdit'])){
                            //UPDATE AN EXISTING ARTICLE
                            if (isset($_GET['idPost']) && isset($_SESSION['wantModify']) && $_SESSION['wantModify'] === true){
                                $idPost = htmlspecialchars($_GET['idPost']);
                                $postText = $_POST['textEdit'];
                                $postTitle = $_POST['titlePostEdit'];
                                $adminCtrl->adminUpdate($idPost, $postText, $postTitle);
                            
                            //POST A NEW ARTICLE
                            }else{
                                $_SESSION['wantModify'] = false;
                                $postTitle = $_POST['titlePostEdit'];
                                $postText = $_POST['textEdit'];
                                $adminCtrl->adminEdit($postTitle, $postText);
                            }
                        }
                        
                    //CREATE ARTICLE
                    } else if ($_GET['action'] === "createArticle"){
                        $_SESSION['wantModify'] = false;
                        header('Location: index.php?pge=admin&action=edit');
                        
                    //UPDATE ARTICLE
                    } else if($_GET['action'] === "updatePost" && isset($_GET['idPost'])){
                        $adminCtrl->updateArticle($_GET['idPost']);
                                                
                    //DELETE ARTICLE
                    } else if($_GET['action'] === "delete"){
                        if(isset($_GET['idPost'])){
                            $adminCtrl->adminDelPost($_GET['idPost']);
                        }else{
                            throw new Exception('Mauvais numéro de billet.');
                        }

                    //DELETE COMMENT
                    } else if($_GET['action'] === "deleteComm"){
                        if(isset($_GET['idComm']) && isset($_GET['idPost'])){
                            if (isset($_GET['from'])) {
                                $from = htmlspecialchars($_GET['from']);
                            }
                            $adminCtrl->adminDelComm($_GET['idComm'], $_GET['idPost'], $from);
                        }else{
                            throw new Exception('Mauvais numéro de commentaire.');
                        }
                    
                    //VIEW SIGNALEMENTS
                    } else if ($_GET['action'] === "viewSignalement"){
                        $adminCtrl->viewSignalement();
                    
                    //VALIDE THE COMMENTS AFTER ADMIN READ
                    } else if ($_GET['action'] === "validComm"){
                        if (isset($_GET['idComm'])){
                            $adminCtrl->validCommSignaled($_GET['idComm']);
                        }

                    //LOGOUT THE ADMIN
                    }else if($_GET['action'] === "logout"){
                        $adminCtrl->adminLogOut();
                    }
                
                //WELCOME ADMIN PAGE
                } else {
                    $adminCtrl->indexAdmin();
                }
            
            //IF THE LOGIN FORM ARE COMPLETE -> TEST THE IDs
            } else if (isset($_POST['idAdmin']) && isset($_POST['pass'])){
                $adminCtrl->adminIdRequest($_POST['idAdmin'], $_POST['pass']);
            
            //ADMIN LOGIN FORM
            }else{
                require('view/login.php');
            }
        }else{
            throw new Exception('Page inconnue :\'(');
        }

    //HOME PAGE WITH 5 RECENT ARTICLES
    } else {
        $openCtrl = new controll();
        $openCtrl->indexPostView();
    }

//ERRORS
} catch (Exception $e) {
    $messageError = $e->getMessage();
    require("view/errorView.php");
}
