<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace database;

/**
 * Class for connecting to db
 *
 * @author Фатум
 */
class DB {
    private $pdo;
    
    private static $instance;
    
    /**
     * private method singleton connection
     */
    private function __construct() {
        $ini = parse_ini_file('../config/app.ini');
        $dsn = $ini['db_connection'].':'.'host='.$ini['db_host'].'; 
                dbname='.$ini['db_name'].';charset='.$ini['db_charset'].'';
        $this->pdo=new \PDO($dsn, $ini['db_user'], $ini['db_pass']);
    }
   
    /**
     * Method to get singleton object with connection to db
     * @return obj $instance Object with connection to db
     */
    public function instance(){
        if(self::$instance === null){
            self::$instance = new self;
        }
        return self::$instance;
    }
    /**
     * Method for execute SQL query without needs to get some data
     * @param string $sql SQL query
     * @return boolean 
     */
    public function query($sql){
        $stmt= $this->pdo->prepare($sql);
        return $stmt->execute();
    }
    /**
     *  Method for execute SQL query to get some data
     * @param string $sql SQL query
     * @return map 
     */
    public function execute($sql){
        $stmt= $this->pdo->prepare($sql);
        $res=$stmt->execute();
        if ($res !==false){
            return $stmt->fetchAll();
        } 
        return [];
    }
}
