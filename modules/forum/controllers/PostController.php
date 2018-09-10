<?php
namespace app\modules\forum\controllers;

use yii\web\Controller;

class PostController extends Controller
{
    public function actionIndex(){
        
        return $this->render('index',['content'=>'test']);
    }
}