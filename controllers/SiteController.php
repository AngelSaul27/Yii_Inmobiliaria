<?php

namespace app\controllers;

use app\models\AgenteModel;
use app\models\auxiliares\categoria_inmueble;
use app\models\auxiliares\tipo_inmueble;
use app\models\Carousel;
use app\models\CitaForm;
use app\models\Inmueble;
use app\models\RegisterForm;
use app\models\UserModel;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\LoginForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function behaviors()
    {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $carousel = Carousel::find()
            ->where(['<=', 'fecha_activacion', date('Y-m-d')])
            ->andWhere(['>=', 'fecha_desactivacion', date('Y-m-d')])
            ->all();

        $inmuble = Inmueble::find();
        $last= $inmuble->orderBy(['id' => SORT_ASC])->limit(4)->all();
        $houses = $inmuble->where(['tipo_inmueble_id' => 1])->limit(4)->all();
        $deparments = $inmuble->where(['tipo_inmueble_id' => 2])->limit(4)->all();

        return $this->render('index',
            ['carousel' => $carousel, 'lasts' => $last, 'houses' => $houses, 'deparments' => $deparments]
        );
    }

    /**
     * View inmueble detalle
     *
     * @return Response|string
     */
    public function actionInmuebleView($id)
    {
        $model = Inmueble::findOne(['id' => $id]);
        if($model === null) return $this->goBack();

        $agente = AgenteModel::find()
            ->select(['agente_venta.*', 'user.username', 'user.imagen'])
            ->innerJoin('user', 'user.id = agente_venta.user_id')
            ->where(['agente_venta.id' => $model->agente_venta_id])
            ->asArray()
            ->one();

        if($agente === null) return $this->goBack();

        return $this->render('inmueble-view', ['model' => $model, 'agente' => $agente]);
    }

    /**
     * View inmuebles listado
     *
     * @return Response|string
     */
    public function actionInmueblesView(): String{
        $carousel = Carousel::find()
            ->where(['<=', 'fecha_activacion', date('Y-m-d')])
            ->andWhere(['>=', 'fecha_desactivacion', date('Y-m-d')])
            ->all();

        $inmuble = Inmueble::find()->all();

        return $this->render('inmuebles-view', ['model' => $inmuble, 'carousel' => $carousel]);
    }

    /**
     * View categoria inmuebles.
     *
     * @return Response|string
     */
    public function actionInmueblesCategoria($id){
        $categoria = tipo_inmueble::getTipo($id);

        if($categoria === null){
            Yii::$app->session->setFlash('error', 'Categoria desconocida');
            return $this->goBack();
        }

        $carousel = Carousel::find()
            ->where(['<=', 'fecha_activacion', date('Y-m-d')])
            ->andWhere(['>=', 'fecha_desactivacion', date('Y-m-d')])
            ->all();

        $inmuble = Inmueble::find()->where(['tipo_inmueble_id' => $id])->all();

        return $this->render('inmuebles-view', ['model' => $inmuble, 'carousel' => $carousel, 'titulo' => $categoria]);
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
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Register User action.
     *
     * @return Response|string
     */
    public function actionRegister(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();
        $model->scenario = 'usuario';

        if($model->load(Yii::$app->request->post())){
            $model->imagen = UploadedFile::getInstance($model, 'imagen');
            $result = $model->registerUsuario();

            if($result){
                \Yii::$app->session->setFlash('success', 'Registrado exitosamente');
                return $this->redirect('/login');
            }

            \Yii::$app->session->setFlash('error', 'No pudimos registrarte');
        }

        return $this->render('/site/register-user', ['model' => $model]);
    }

    /**
     * Register Agent action.
     *
     * @return Response|string
     */
    public function actionRegisterAgente(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();
        $model->scenario = 'agente';

        if($model->load(Yii::$app->request->post())){
            $model->imagen = UploadedFile::getInstance($model, 'imagen');
            $result = $model->registerAgente();

            if($result){
                \Yii::$app->session->setFlash('success', 'Registrado exitosamente');
                return $this->redirect('/login');
            }

            \Yii::$app->session->setFlash('error', 'No pudimos registrarte');
        }

        return $this->render('/site/register-agente', ['model' => $model]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
