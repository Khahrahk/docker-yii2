<?php

namespace app\controllers;

use app\models\GroupForm;
use app\models\Groups;
use app\models\Number;
use app\models\PostForm;
use app\models\LoginForm;
use app\models\Person;
use app\models\RegisterForm;
use Yii;
use yii\data\Pagination;
use yii\data\Sort;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

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
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->login()) {
                return $this->goHome();
            }
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->register()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionProfile()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('profile', [

        ]);
    }

    public function actionAdmin()
    {
        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin == 1) {

            $query = Groups::find();
            $count = $query->count();
            $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 4]);
            $sort = new Sort([
                'attributes' => [
                    'id' => [
                        'label' => 'id'
                    ],
                    'name' => [
                        'label' => 'Группа'
                    ],
                ]
            ]);
            $model = $query
                ->orderBy($sort->orders)
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
            return $this->render('admin', ['pagination' => $pagination, 'model' => $model, 'sort' => $sort]);
        } else {
            return $this->goHome();
        }
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

    public function actionNumbers()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $query = Person::find()->joinWith('number')->joinWith('groups');
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 4]);
        $sort = new Sort([
            'attributes' => [
                'fullName' => [
                    'label' => 'Имя'
                ],
                'date' => [
                    'label' => 'Дата рождения'
                ],
                'location' => [
                    'label' => 'Местонахождение'
                ],
                'number'
            ]
        ]);
        $model = $query
            ->orderBy($sort->orders)
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('numbers', ['pagination' => $pagination, 'model' => $model, 'sort' => $sort]);
    }

    public function actionSearch()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $q = Yii::$app->request->get('q');
        $query = Person::find()
            ->where(['like', 'fullName', $q])
            ->joinWith('number');
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 4]);
        $sort = new Sort([
            'attributes' => [
                'fullName' => [
                    'label' => 'Имя'
                ],
                'date' => [
                    'label' => 'Дата рождения'
                ],
                'location' => [
                    'label' => 'Местонахождение'
                ],
                'number'
            ]
        ]);
        $model = $query
            ->orderBy($sort->orders)
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('search', ['pagination' => $pagination, 'model' => $model, 'sort' => $sort]);
    }

    public function actionPostcreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new PostForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->create()) {
                return $this->redirect(['numbers']);
            }
        }
        return $this->render('post/create', [
            'model' => $model,
        ]);
    }

    public function actionPostview($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $query_person = Person::findOne($id);
        $query_groups = Person::find()->leftJoin('groups', 'person.personGroup = groups.id')->where(['person.id' => $id])->with('groups')->one();
        return $this->render('post/view', [
            'query' => $query_person,
            'query1' => $query_groups,
        ]);
    }

    public function actionPostdelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if (!empty(Person::findOne($id))) {
            if (!empty(Number::findOne($id))) {
                Number::findOne($id)->delete();
            }
            Person::findOne($id)->delete();
            return $this->redirect(['numbers']);
        } else {
            return $this->goHome();
        }
    }

    public function actionPostedit($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $query_person = Person::findOne($id);
        $query_number = Number::findOne($id);
        if ($query_person->load(Yii::$app->request->post())) {
            //не совсем понял как связанные массивы в yii сохранять, но так вроде получается
            $query_person->fullName = Yii::$app->request->post()['Person']['fullName'];
            $query_person->date = Yii::$app->request->post()['Person']['date'];
            $query_person->location = Yii::$app->request->post()['Person']['location'];
            $query_person->personGroup = Yii::$app->request->post()['Person']['personGroup'];
            $query_number->number = Yii::$app->request->post()['Number']['number'];


            if ($query_person->save() && $query_number->save()) {
                return $this->redirect(['numbers']);
            }
        } else {
            return $this->render('post/edit', [
                'model' => $query_person,
            ]);
        }
    }


    public function actionGroupcreate()
    {
        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin == 1) {
            $model = new GroupForm();
            if ($model->load(Yii::$app->request->post())) {
                if ($model->create()) {
                    return $this->redirect(['admin']);
                }
            }
            return $this->render('admin/create', [
                'model' => $model,
            ]);
        } else {
            return $this->goHome();
        }
    }

    public function actionGroupdelete($id)
    {
        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin == 1) {
            $query = Groups::findOne($id)->delete();
            if ($query) {
                return $this->redirect(['admin']);
            }
        } else {
            return $this->goHome();
        }
    }

    public function actionGroupedit($id)
    {
        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin == 1) {
            $query = Groups::findOne($id);
            if ($query->load(Yii::$app->request->post())) {
                $query->id = $id;
                $query->name = Yii::$app->request->post()['Groups']['name'];

                if ($query->save()) {
                    return $this->redirect(['admin']);
                }
            } else {
                return $this->render('admin/edit', [
                    'model' => $query,
                ]);
            }
        } else {
            return $this->goHome();
        }
    }
}
