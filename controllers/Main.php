<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controllers;
use models\ImageUtil;



/**
 * Class which renders home page
 *
 * @author Фатум
 */
class Main {
    /**
     * Method which renders home page
     * @param map  $serviceContainer Associates service's name to service's obj
     * @return void
     */
    public function indexAction($serviceContainer){
        session_start();
        if (isset($_SESSION['token'])){
            $model = new ImageUtil();
            $images=$model->getImage($_SESSION['token']);
            echo $serviceContainer['template-engine']->render('index.html', array('images'=>$images));
        } else {
             echo $serviceContainer['template-engine']->render('index.html', array('images'=> ''));
        }
       
    }
    
}
