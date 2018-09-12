<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace models;

/**
 * Class for sevre data model of Auth
 * @author Фатум
 */
class AuthUtil extends Model{
   
    
    public $table = 'Users';
    
    /**
     * Method to check if user with this login already exist
     * @param string $login Login you need to check
     * @return boolean
     */
    public function IsExist($login){
        $sql= "SELECT COUNT(Name) FROM ($this->table) WHERE Name = '".$login.'\'';
        
        $res = $this->pdo->execute($sql);
        if ($res[0]['COUNT(Name)']>0){
            return true;
        }
        return false;
    }
    
    /**
     * Method to write new user in db
     * @param map $userData Array with user's data
     * @return string 
     */
    public function createUser($userData){
        $userData['created_at']=(string)date(DATE_ATOM);
        
        $sql = "INSERT INTO $this->table (Name, Password, Created_at) VALUES ('" 
                                                .$userData['login'].'\', \''
                                                .$userData['password'].'\', \''
                                                .$userData['created_at'].'\');';
        
        if($this->pdo->query($sql)){
            return true;
        }
        return false;
    }
    
    /**
     * Metod to find user's passwor hash by login
     * @param string $login Login you need to find
     * @return string
     */
    public function Find($login){
        $sql= "SELECT * FROM ($this->table) WHERE Name = '".$login.'\'';
        $res = $this->pdo->execute($sql);
        return $res[0]['Password'];
    }
    
    /**
     * 
     * @param string $token Token you need to set
     * @param string $login Login to find relation you need
     */
    public function setSessionToken($token, $login){
        $sql = "UPDATE ($this->table) SET Remember_token = '".$token.'\' WHERE Name = \''.$login.'\';';
        $res = $this->pdo->execute($sql);
    }
    
    /**
     * 
     * @param string $token Token you need to delete
     */
    public function deleteSessionToken($token){
        
        $sql = "UPDATE $this->table SET Remember_token= '' WHERE Remember_token = '".$token.'\';';
        //$sql = "SELECT * FROM ($this->table) WHERE Remember_token = '".$token.'\';';
        $res = $this->pdo->query($sql);
        
        
    }
}
