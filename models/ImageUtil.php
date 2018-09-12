<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace models;

/**
 * Class for sevre data model of image service
 *
 * @author Фатум
 */
class ImageUtil extends Model{
    //put your code here
    protected $tableUsr = 'Users';
    protected $tableImg = 'Images';

    /**
     * 
     * @param string $path Path you need tosave
     * @param string $token Token to find relation you need
     * @return boolean
     */
    public function saveImagePath($path, $token){
        
        $sql = "SELECT UserID FROM ($this->tableUsr) WHERE Remember_token = '".$token.'\'';
        $res = $this->pdo->execute($sql);
        $params['path'] = $path; 
        $params['UserID'] = (string)$res[0]['UserID'];
        $params['created_at'] = (string)date(DATE_ATOM);
        $sql = "INSERT INTO $this->tableImg (URL, UserID, Created_at) VALUES ('"
                                                      .$params['path'].'\', \''
                                                      .$params['UserID'].'\', \''
                                                      .$params['created_at'].'\');';
        
        if($this->pdo->query($sql)){
            return true;
        }
        return false;
    }
    
    /**
     * 
     * @param string $token Token to find relation you need
     * @return array
     */
    public function getImage($token){
        $sql = "SELECT URL FROM ($this->tableImg) WHERE UserID IN (".
                "SELECT UserID FROM ($this->tableUsr) WHERE Remember_token = '".$token.'\')';
        
        $res=$this->pdo->execute($sql);
        $images=[];
        
        foreach ($res as $k => $v){
            array_push($images, $v['URL']);
        }
        return $images;
        
    }
}
