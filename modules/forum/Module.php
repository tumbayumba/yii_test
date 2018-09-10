<?php
namespace app\modules\forum;

use Yii;

class Module extends \yii\base\Module
{
    public $layout = 'main2';
    
    public function init()
    {
        parent::init();
        if (Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'app\modules\forum\commands';
        }
        $this->params['foo'] = 'bar';
        // ... остальной инициализирующий код ...
    }
}