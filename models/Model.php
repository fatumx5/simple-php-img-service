<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace models;
use database\DB;

/**
 * Abstract class for sevre data model
 *
 * @author Фатум
 */
abstract class Model {
    protected $pdo;
    protected $table;
    //put your code here
    
    /**
     * Method to get singleton object with connection to db
     */
    public function __construct() {
        $this->pdo = DB::instance();
    }
    
}
