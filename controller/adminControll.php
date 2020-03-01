<?php
require_once('model/EditPosts.php');
require_once('model/ModelPosts.php');
require_once('model/Users.php');

class adminControll{

    //TEST LOGIN AND GO TO ADMIN PART IF IT'S TRUE
    public function adminIdRequest($id, $pass){
        $aIR = new AntoineSmagghe\Projet_4\Users();
        $validUser = $aIR->testUser($id, $pass);

        $data = $validUser->fetch();
        $passVerify = password_verify($pass, $data['pass']);
        if ($passVerify){
            $_SESSION['id'] = $data['id_user'];
            $_SESSION['name'] = $data['name_user'];
            $validUser->closeCursor();
            header('Location: index.php?pge=admin');
        }else{
            throw new Exception('Impossible de se connecter mauvaise mot de passe ou mauvais identifiant.');
        }
    }

    //ADMIN CREATE POST FOR PUBLISH
    public function adminEdit($postTitle, $postText){
        $aE = new AntoineSmagghe\Projet_4\EditPosts();
        $addPost = $aE->publish($postTitle, $postText);     

        if ($addPost === false){
            throw new Exception('Impossible de publier!');
        }else{
            header('Location: index.php?pge=home');
        }
        require('view/adminPostEdit.php');
    }

    //ADMIN MODIFIE EXISTING POST
    public function updateArticle($idPost){
        $takePost = new AntoineSmagghe\Projet_4\ModelPosts();
        $takeInfo = $takePost->takePost($idPost);
        $data = $takeInfo->fetch();
        $modifyThisTitle = $data['title'];
        $modifyThisText = $data['text'];
        $takeInfo->closeCursor();
        $_SESSION['wantModify'] = true;
        require('view/adminPostEdit.php');
    }

    //ADMIN PUBLISH AN EXISTING POST
    public function adminUpdate($idPost, $postText, $postTitle){
        $aU = new AntoineSmagghe\Projet_4\EditPosts();
        $update = $aU->updateExistingPost($idPost, $postText, $postTitle);
        if ($update){
            $_SESSION['wantModify'] = false;
            header('Location: index.php?pge=article&action=show&idPost=' . $idPost);
        }else{
            throw new Exception('Impossible de modifier le billet en base de donnée.');
        }
    }

    //ADMIN DELETE POST
    public function adminDelPost($idPost){
        $aDP = new AntoineSmagghe\Projet_4\EditPosts();
        $delPost = $aDP->delPost($idPost);
        if ($delPost){
            header('Location: index.php?pge=home');
        }else{
            throw new Exception('Impossible de supprimer le billet.');
        }
    }

    //ADMIN DELETE COMMENT
    //  $from variable is to stay on the good page when you delete the commentaire. 
    //  There is the post page and the signalement page.
    public function adminDelComm($idComm, $idPost, $from){  
        $aDC = new AntoineSmagghe\Projet_4\ModelComment();
        $delComment = $aDC->delComment($idComm);
        if($delComment){
            if (isset($from) && $from === "signal"){
                header('Location: index.php?pge=admin&action=viewSignalement');
            } else if (isset($idPost) && isset($from) && $from === "article"){
                header('Location: index.php?pge=article&action=show&idPost=' . $idPost);
            } else {
                throw new Exception('Page de redirection introuvable.');
            }
        }else{
            throw new Exception('Impossible de supprimer le commentaire.');
        }
    }

    //ADMIN CHECK SIGNALEMENTS
    public function viewSignalement(){
        $vS = new AntoineSmagghe\Projet_4\ModelComment();
        $viewSign = $vS->viewSignals();
        $iA = new AntoineSmagghe\Projet_4\ModelComment();
        $countSign = $iA->countSignalement();
        $_SESSION['countSign'] = $countSign;
        require('view/signalements.php');
    }

    //ADMIN VALID A SIGNALEMENT
    public function validCommSignaled($idComm){
        $vaS = new AntoineSmagghe\Projet_4\ModelComment();
        $validSign = $vaS->updateSignalement($idComm);
        if ($validSign){
            header('Location: index.php?pge=admin&action=viewSignalement');
        }else{
            throw new Exception('Impossible de valider le signalement.');
        }
    }

    //ADMIN INDEX PAGE
    public function indexAdmin(){
        $iA = new AntoineSmagghe\Projet_4\ModelComment();
        $countSign = $iA->countSignalement();
        $_SESSION['countSign'] = $countSign;
        require('view/indexAdmin.php');
    }

    //ADMIN LOGOUT
    public function adminLogOut(){
        $_SESSION = array();
        session_destroy();
        header('Location: index.php?pge=admin');
    }
}