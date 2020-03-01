<?php
namespace AntoineSmagghe\Projet_4;
require_once("Manager.php");

class Users extends Manager{
    
    //VALID THE USER BY ID AND PASS (PASSWORD_BCRYPT)
    public function testUser($id){
        $db = $this->connectDB();
        $idValid = $db->prepare('SELECT * FROM oui.user WHERE name_user = ? OR mail_user = ?');
        $idValid->execute(array($id, $id));

        return $idValid;
    }
}
