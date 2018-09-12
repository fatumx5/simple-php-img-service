<?php

namespace controllers;
use models\ImageUtil;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Imagick\Imagine;

/**
 * Class for add new image
 *
 * @author Фатум
 */
class AddImage {
    
    private static $validTypes = ['jpeg', 
                                 'jpg',
                                 'gif',
                                 'png'];
    
    private static $errors = [];
    private static $notifications =[];

    /**
     * Method which add new image (and resize) and renders template 
     * @param map  $serviceContainer Associates service's name to service's obj
     */
    
    public function indexAction($serviceContainer){
        if(isset($_FILES['image']['name'])){
            session_start();
            $ext=pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            if(self::checkFileType($ext)){
               $dirName = uniqid();
                $fileName = uniqid();

                $newFileName = 'image/'.$dirName.'/'.$fileName.'.'.$ext;
                $newFileNameSmall = 'image/'.$dirName.'/'.$fileName.'_S.'.$ext;
                mkdir('image/'.$dirName);
                $model = new ImageUtil();
                if($model->saveImagePath($newFileNameSmall, $_SESSION['token'])){
                    move_uploaded_file($_FILES['image']['tmp_name'], 'image/'.$dirName.'/'.$fileName.'.'.$ext);
                    $serviceContainer['image-processor']->open($newFileName)
                                                        ->resize(new Box(100, 100))
                                                        ->save($newFileNameSmall, array('flatten' => false));
                    self::$notifications = ['Image uploaded successfully'];
                } 
            }
            
        }
        echo $serviceContainer['template-engine']->render('add_image.html', array('errors' => self::$errors, 
                                                                                 'notifications' => self::$notifications));
    }
    
    private function checkFileType($ext){
        $ext=mb_strtolower($ext);
        if(in_array($ext, self::$validTypes)){
            return true;
        }
        self::$errors = ['Invalid file type'];
        return false;
    }
}
