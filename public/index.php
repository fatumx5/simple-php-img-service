<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'help.php';
//debug($_SERVER);
$query = trim($_SERVER['REQUEST_URI'], '/');


require_once '../vendor/autoload.php';


require_once '../Autoloader.php';


use routes\Router;
use controllers\ImageProcessing;

use Autoloader as Autoloader;
Autoloader\Autoloader::autoload();

$loader = new Twig_Loader_Filesystem('..\res\views');
$twig = new Twig_Environment($loader, array('cache' => '..\res\tpl_cache',));
$imagine = new Imagine\Gd\Imagine();
$serviceContainer = ['template-engine'=>$twig, 'image-processor' => $imagine];


Router::add('^$', ['controller'=>'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');



Router::dispatch($query, $serviceContainer);

