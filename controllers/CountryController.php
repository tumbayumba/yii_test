<?php

namespace app\controllers;

use Yii;
use app\models\Country;
use app\models\CountrySearch;
use app\components\Foo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
//use yii\filters\auth\HttpBasicAuth;
//use yii\filters\HttpCache;
use yii\filters\PageCache;
use yii\caching\DbDependency;
use yii\base\Event;

/**
 * CountryController implements the CRUD actions for Country model.
 */
class CountryController extends Controller
{
    /*public function beforeAction($action) {
        $config = [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=demo',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ];
        $db2 = Yii::createObject($config);
        parent::beforeAction($action);
    }*/


    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            /*[
                'class' => HttpCache::className(),
                'only' => ['index'],
                'lastModified' => function ($action, $params) {
                    $q = new \yii\db\Query();
                    return $q->from('user')->max('updated_at');
                },
            ],*/
            'pageCache' => [
                'class' => PageCache::className(),
                'only' => ['index'],
                'duration' => 60,
                'dependency' => [
                    'class' => DbDependency::className(),
                    'sql' => 'SELECT COUNT(*) FROM country',
                ],
                'variations' => [
                    \Yii::$app->language,
                ]
            ],
            [
                'class' => 'app\components\ActionTimeFilter',
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update','delete'],
                'rules' => [
                    // разрешаем аутентифицированным пользователям
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // всё остальное по умолчанию запрещено
                ],
            ],
            /*'basicAuth' => [
                'class' => HttpBasicAuth::className(),
            ],*/
        ];
    }
    
    /**
     * Lists all Country models.
     * @return mixed
     */
    public function actionIndex()
    {
        //Yii::debug('action country index');
        
        //echo (new Country)->prop1;exit; //--> value1
        //echo (new Country)->getBehavior('myBehavior2')->prop1;exit; //--> value11
       
        //$foo = new Foo;
        //$foo->on(Foo::EVENT_HELLO,function(){ echo 'event';exit; });
        //$foo->off(Foo::EVENT_HELLO);
        //...
        //$foo->bar();
        
        $searchModel = new CountrySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionInfo() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'message' => 'hello world',
            'code' => 100,
        ];
    }
    
    public function actionDownload() {
        return \Yii::$app->response->sendFile(Yii::$app->basePath.'/web/img/spoon.jpg')->send();
    }

    /**
     * Displays a single Country model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Country model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Country();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->code]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Country model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->code]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Country model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Country model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Country the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Country::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
