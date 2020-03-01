<?php
require_once('model/ModelPosts.php');
require_once('model/EditPosts.php');
require_once('model/ModelComment.php');

class controll{

    // TAKE THE HOME PAGE VIEW WITHE THE ARTICLES PREVIEW
    public function indexPostView($numberPosts=0){
        if ($numberPosts !== 0){
            $aNP = new AntoineSmagghe\Projet_4\ModelPosts();
            $newPosts = $aNP->takePostWhenScroll($numberPosts);
            while($data = $newPosts->fetch()){
                $idPost[] = $data['id'];
                $titlePost[] = $data['title'];
                $datePost[] = $data['datePost'];
                $textPost[] = $data['text'];
            };
            $newPosts->closeCursor();
            $dataToSend = array(
                'id' => $idPost,
                'title' => $titlePost,
                'date' => $datePost,
                'text' => $textPost
            );
            $jsonData = json_encode($dataToSend);
            echo $jsonData;
        }else {
            $iPV = new AntoineSmagghe\Projet_4\ModelPosts();
            $posts = $iPV->takePosts();
            require_once('view/indexPublic.php');
        }
    }
    
    // SHOW ONE ARTICLE
    public function onePostView($idPost){
        $oPV = new AntoineSmagghe\Projet_4\ModelPosts();
        $post = $oPV->takePost($idPost);
        
        $oPVcomment = new AntoineSmagghe\Projet_4\ModelComment();
        $comments = $oPVcomment->getComments($idPost);
        require('view/articlePublic.php');
    }

    // THE ABOUT PAGE
    public function aboutPge(){
        require('view/about.php');
    }

    // PUBLISH COMMENT ACTION
    public function userPublishComment($idPost, $name, $newComment){
        $add = new AntoineSmagghe\Projet_4\EditPosts();
        $addComment = $add->userAddComment($idPost, $name, $newComment);

        if ($addComment){
            header('Location: index.php?pge=article&action=show&idPost=' . $idPost);
        }else {
            throw new Exception('Impossible d\'ajouter des commentaires!');
        }
    }

    // SIGNAL COMMENTS BY THE PUBLIC USERS
    public function userSignalComment($idPost, $idComm){
        $signal = new AntoineSmagghe\Projet_4\ModelComment();
        $signalComm = $signal->signalComment($idComm);

        if ($signalComm){
            header('Location: index.php?pge=article&action=show&idPost=' . $idPost);
        }else{
            throw new Exception('Impossible de signaler le commentaire');
        }
    }
}
