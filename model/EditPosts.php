<?php
namespace AntoineSmagghe\Projet_4;
require_once('Manager.php');

class EditPosts extends Manager{
    // SEND POST IN DATABASE FOR PUBLICATION
    public function publish($title, $text){
        $db = $this->connectDB();
        $addPost = $db->prepare('INSERT INTO oui.posts (title, text) VALUES (?, ?)');
        $postAdded = $addPost->execute(array($title, $text));

        return $postAdded;
    }

    // UPDATE AN EXISTING POST
    public function updateExistingPost($idPost, $postText, $postTitle){
        $db = $this->connectDB();
        $updatePost = $db->prepare('UPDATE oui.posts SET title = ?, text = ? WHERE id = ?');
        $result = $updatePost->execute(array($postTitle, $postText, $idPost));

        return $result;
    }

    // DELETE A POST
    public function delPost($idPost){
        $db = $this->connectDB();
        $delPost = $db->prepare('DELETE FROM oui.posts WHERE posts.id = ?');
        $delPost->execute(array($idPost));

        return $delPost;
    }

    // ADD A COMMENT ON A POST
    public function userAddComment($idPost, $name, $newComment){
        $db = $this->connectDB();
        $addComment = $db->prepare('INSERT INTO oui.comment (id_posts, name, txt) VALUES (?, ?, ?)');
        $affectedLines = $addComment->execute(array($idPost, $name, $newComment));
        
        return $affectedLines;
    }
}
