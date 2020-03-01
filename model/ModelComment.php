<?php
namespace AntoineSmagghe\Projet_4;
require_once('Manager.php');

class ModelComment extends Manager{
    
    //TAKE 5 COMMENTS FOR ONE ARTICLE
    public function getComments($idPost){
        $db = $this->connectDB();
        $comments = $db->prepare('SELECT id_comment, id_posts, name, txt, DATE_FORMAT(date_comment, "le %d %b %Y à %H:%i") AS dateComment FROM oui.comment WHERE id_posts = ? ORDER BY date_comment DESC');
        $comments->execute(array($idPost));
        
        return $comments;
    }

    //DELETE COMMENT BY HIS ID
    public function delComment($idComment){
        $db = $this->connectDB();
        $delComm = $db->prepare('DELETE FROM oui.comment WHERE comment.id_comment = ?');
        $delComm->execute(array($idComment));

        return $delComm;
    }

    //SIGNAL COMMENT
    public function signalComment($idComment){
        $db = $this->connectDB();
        $signComm = $db->prepare('UPDATE oui.comment SET `signal` = 1 WHERE id_comment = ?');
        $signComm->execute(array($idComment));

        return $signComm;
    }

    //VIEW THE SIGNED COMMENTS FOR ADMIN
    public function viewSignals(){
        $db = $this->connectDB();
        $viewSign = $db->query('SELECT id_comment, id_posts, name, txt, DATE_FORMAT(date_comment, "le %d %b %Y à %H:%i") AS dateComment FROM oui.comment WHERE `signal` = 1');

        return $viewSign;
    }

    //VALID A SIGNALEMENT
    public function updateSignalement($idComm){
        $db = $this->connectDB();
        $update = $db->prepare('UPDATE oui.comment SET `signal` = 0 WHERE id_comment = ?');
        $update->execute(array($idComm));

        return $update;
    }

    //COUNT THE NUMBER OF SIGNALEMENT
    public function countSignalement(){
        $db = $this->connectDB();
        $count = $db->query('SELECT COUNT(`signal`) FROM oui.comment WHERE `signal` = 1');
        $data = $count->fetch();

        return $data[0];
    }
}
