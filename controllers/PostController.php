<?php

namespace app\controllers;

use Yii;
use app\models\Post;
use app\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','update','view','delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['?'],//guests
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','create','update','view','delete'],
                        'roles' => ['@'],//auth
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
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
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Post model.
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
    
    public function actionTest(){
        //$posts = Yii::$app->db->createCommand('SELECT * FROM post')->queryAll();
        //$posts = Yii::$app->db->createCommand('SELECT * FROM post where id=1')->queryOne();
        //$titles = Yii::$app->db->createCommand('SELECT title FROM post')->queryColumn();
        //$count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM post')->queryScalar();
        
        //$command = Yii::$app->db->createCommand('SELECT * FROM post WHERE id=:id');
        //$post1 = $command->bindValue(':id', 1)->queryOne();
        //$post2 = $command->bindValue(':id', 2)->queryOne();
      
        /*$command = Yii::$app->db->createCommand('SELECT * FROM post WHERE id=:id')->bindParam(':id', $id);
        $id = 1;
        $post1 = $command->queryOne();
        $id = 2;
        $post2 = $command->queryOne();*/
        
        //$res = Yii::$app->db->createCommand('UPDATE post SET title="test1" WHERE id=1')->execute();
        /*$res = Yii::$app->db->createCommand()->insert('post', [
            'title' => 'test3',
            'body' => 'ads fas dfds f',
        ])->execute();*/
        //$res = Yii::$app->db->createCommand()->update('post', ['title' => 'test22'], 'id=2')->execute();
        //$res = Yii::$app->db->createCommand()->delete('post', 'id = 1')->execute();
        
        /*$res = Yii::$app->db->createCommand()->batchInsert('post', ['title', 'body'], [
            ['Tom', 30],
            ['Jane', 20],
            ['Linda', 25],
        ])->execute();*/
        
        //$count = Yii::$app->db->createCommand("SELECT COUNT([[id]]) FROM {{post}}")->queryScalar();
        //transaction
        /*$res = Yii::$app->db->transaction(function($db) {
            $db->createCommand()->insert('post', [ 'title' => 'test33', 'body' => 'ads fas dfds f', ])->execute();
            $db->createCommand()->insert('post', [ 'title' => 'test34', 'body' => 'ads fas dfds f', ])->execute();
        });*/
        //$table = Yii::$app->db->getTableSchema('post');
        ////////////////////////////////////////////////////////////////////////////////////////////
        $sub_query = (new \yii\db\Query)->select('count(*)')->from('post');
        //$res = (new \yii\db\Query)->select(['id','title'])->from('post')->limit(5)->all();
        $res = (new \yii\db\Query)->select(['id','title','cnt'=>$sub_query])->from('post')->limit(5)->indexBy('title')->all();
        /*$query = (new \yii\db\Query)->select(['id','title'])->from('post');
        foreach ($query->each() as $post) {
            // $user представляет одну строку из выборки
        }*/

        return $this->render('test',['data'=>$res]);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
