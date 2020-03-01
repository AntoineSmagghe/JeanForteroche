<?php

/**
 * CONNECT TO DATABASE
 * phpmyadmin online : 
 * http://antoinesmagghe.com/phpmyadmin
 *
 */

namespace AntoineSmagghe\Projet_4;
use \PDO;

class Manager{
	protected function connectDB(){
		try{
			$host = 'localhost';
			$database ='oui';
			$charset = 'utf8mb4';
			$user = 'antoinedb';
			$password = 'bofighthe';
			$db = new PDO('mysql:host=' . $host . ';dbname=' . $database . ';charset=' . $charset, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		} catch(Exception $e) {
			throw new Exception("Identification server incorrect. veuillez vérifier vos login et mot de passe de connexion à la base de donnée.");
		}
		
        return $db;
    }
}
