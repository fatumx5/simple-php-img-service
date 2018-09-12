<?php
namespace controllers;
use models\AuthUtil;



/**
 * Класс-обработчик запросов на регистрацию и авторизацию
 * 
 * Class which handles requests for sign up or authorization
 * 
 * @author Фатум
 */
class Auth {
    
    private static $errors = [];
    private static $notifications = [];
    /**
     * Метод обработчик запроса на авторизацию. Рендерит шаблон
     * 
     * Method which handles requests for sign up and renders template
     * 
     * @param map  $serviceContainer Associates service's name to service's obj
     * @return void
     */
    public function signUpAction ($serviceContainer) {
        
        if (isset($_POST['login'])){
            if (self::passwordValidate()){
                if(self::loginValidate()){
                    $model= new AuthUtil();
                    if(!$model->IsExist($_POST['login'])){

                        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
                        $login = $_POST['login'];
                        self::createUser($model, $login, $password);
                        self::$notifications = ['User created succesfully'];
                        
                    } else{
                        self::$errors = ['This login is existale already'];
                    }
                }
            } 
        }
        echo $serviceContainer['template-engine']->render('register.html', array('errors' => self::$errors, 
                                                                                 'notifications' => self::$notifications));
        
    }
    
    /**
     * Метод обработчик запроса на регистрацию. Рендерит шаблон
     * 
     * Method which handles requests for login and renders template
     * 
     * @param map  $serviceContainer Associates service's name to service's obj
     * @return void
     */
    public function loginAction($serviceContainer){
         if (isset($_POST['login'])){
             if(self::loginValidate()){
                 $model= new AuthUtil();
                 if(password_verify($_POST["password"], $model->Find($_POST['login']))){
                    self::authentificate($model, $model->Find($_POST['login']), $_POST['login']);
                    header('Location: /');
                } else {
                    self::$errors = ['Wrong login or password'];
                }
            }
        }
        echo $serviceContainer['template-engine']->render('login.html', array('errors' => self::$errors, 
                                                                              'notifications' => self::$notifications));
    }
    
    /**
     * Метод обработчик запроса на выход из аккаунта. Редиректит на главную
     * 
     * Method which handles requests for logout and redirects to home page
     * 
     * @return void
     */
    public static function logoutAction(){
        session_start();
        if ($_SESSION['token']){
            $model = new AuthUtil();

            $model->deleteSessionToken($_SESSION['token']);
        
        }
        session_destroy();
        header('Location: /');
        
    }

    /**
     * Метод выполняющий проверку допусимого содержания логина
     * 
     * Method which check if login valid
     * @return boolean
     */
    private function loginValidate(){
        if(preg_match("/^[a-zA-Z0-9]+$/",$_POST['login'])){
            if(!(strlen($_POST['login']) > 3 or strlen($_POST['login'])) < 30){
                return true;
            }
        } 
        self::$errors = ['Invalid login'];
        return false;
    }
    
    private function passwordValidate(){
        if($_POST['password']===$_POST['password-submit']){
            if(strlen($_POST['password']) > 5){
                if(strlen($_POST['password'])< 100){
                    return true;
                }
                self::$errors= ['Password is too long'];
            } else {
                self::$errors = ['Password is too weak or missed'];
            } 
            
        } else {
            self::$errors = ['Password line and password\'s submit line are diffrent'];
        }
        return false;
    }

        /**
     *  
     * @param obj $model object for db operations
     * @param string $login 
     * @param string $password
     */
    private function createUser($model, $login, $password){
        $userData = ['login' => $login, 'password' => $password];
        if($model->createUser($userData)){
            return true;
        }
        return false;
    }

    /**
     * 
     * @param obj $model object for db operations
     * @param string $hash 
     * @param string $login
     */
    private static function authentificate($model, $hash, $login){
        session_start();
        session_regenerate_id();
        $token = crypt($hash, crypt($hash,$salt=null));
        $model->setSessionToken($token, $login);
        
        setcookie('PHPSESSION', 3600);
       
        $_SESSION['token']=$token;
    }
}

