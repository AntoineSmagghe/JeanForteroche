<?php
namespace AntoineSmagghe\Projet_4;
require_once('Manager.php');

class ModelPosts extends Manager{

    //TAKE 5 POSTS
    public function takePosts(){
        $db = $this->connectDB();
        $req = $db->prepare('SELECT id, title, text, DATE_FORMAT(date, "le %d %b %Y à %H:%i") AS datePost FROM oui.posts ORDER BY date DESC LIMIT 3');
        $req->execute();
        
        return $req;
    }

    //TAKE 1 POST WHEN SCROLL
    public function takePostWhenScroll($number){
        $db = $this->connectDB();
        $req = $db->prepare('SELECT id, title, text, DATE_FORMAT(date, "le %d %b %Y à %H:%i") AS datePost FROM oui.posts ORDER BY date DESC LIMIT :number, 1');
        $req->execute(array('number' => $number));

        return $req;
    }

    //TAKE ONE POST BY ID
    public function takePost($idPost){
        $db = $this->connectDB();
        $post = $db->prepare('SELECT id, title, text, DATE_FORMAT(date, "le %d %b %Y à %H:%i") AS datePost FROM oui.posts WHERE id = ?');
        $post->execute(array($idPost));
        
        return $post;
    }
}