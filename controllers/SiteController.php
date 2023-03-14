<?php

namespace app\controllers;

use app\models\GroupForm;
use app\models\Number;
use app\models\Person;
use http\Params;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\Pagination;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');

    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        return $this->render('index');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionNumbers()
    {
        $model = new GroupForm();
        $model->load(Yii::$app->request->post());
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model_var = $model->attributes = Yii::$app->request->post('GroupForm');
            $res_model = $model_var['groupby'];

            if ($res_model == "0") {
                $query = Person::find()->joinWith('number')->orderBy([
                    'Full_name' => SORT_ASC
                ]);
            } elseif ($res_model == "1") {
                $query = Person::find()->joinWith('number')->orderBy([
                    'DOB' => SORT_ASC
                ]);
            } elseif ($res_model == "2") {
                $query = Person::find()->joinWith('number')->orderBy([
                    'Location' => SORT_ASC
                ]);
            } else {
                $query = Person::find()->joinWith('number');
            }
            $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 4, 'forcePageParam' => true, 'pageSizeParam' => false]);
            $posts = $query->offset($pages->offset)
//                ->limit($pages->limit)
                ->all();
            return $this->render('numbers', compact(
                'posts',
//                'pages',
                'model',
                'res_model'));
        } else {
            $query = Person::find()->joinWith('number');
            $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 4, 'forcePageParam' => false, 'pageSizeParam' => false]);
            $posts = $query->offset($pages->offset)
//                ->limit($pages->limit)
                ->all();
            return $this->render('numbers', compact(
                'posts',
//                'pages',
                'model'));
        }
    }
}
