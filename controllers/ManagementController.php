<?php

namespace app\controllers;

use app\models\Carousel;
use app\models\CarouselForm;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\UploadedFile;

class ManagementController extends Controller
{

    public function behaviors()
    {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }

    /**
     * Carousel table.
     *
     * @return string
     */
    public function actionCarouselView(): string
    {
        $carousel = Carousel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $carousel,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('/site/management-carousel-view', ['carousel' => $dataProvider]);
    }

    /**
     * carousel create
     */
    public function actionCarouselCreate()
    {
        $model = new CarouselForm();
        $model->scenario = 'create';

        if($model->load(\Yii::$app->request->post())){
            $model->imagen = UploadedFile::getInstance($model, 'imagen');
            $result = $model->create();

            if($result){
                \Yii::$app->session->setFlash('success', 'Elemento creado exitosamente');
                return $this->redirect('/user-management/carousels');
            }

            \Yii::$app->session->setFlash('error', 'Elemento no creado');
        }

        return $this->render('/site/management-form-carousel', ['model' => $model]);
    }

    /**
     * carousel edit
     */
    public function actionCarouselEdit($id)
    {
        $data = Carousel::findOne(['id' => $id]);

        if($data !== null){
            $model = new CarouselForm();
            $model->scenario = 'edit';
            $model->titulo = $data->titulo;
            $model->descripcion = $data->descripcion;
            $model->imagen = $data->imagen;
            $model->fecha_activacion = $data->fecha_activacion;
            $model->fecha_desactivacion = $data->fecha_desactivacion;

            if($model->load(\Yii::$app->request->post())){
                $model->imagen = UploadedFile::getInstance($model, 'imagen');
                $result = $model->update($id);

                if($result){
                    \Yii::$app->session->setFlash('success', 'Elemento editado exitosamente');
                    return $this->redirect('/user-management/carousels');
                }

                \Yii::$app->session->setFlash('error', 'Elemento no actualizado');
            }

            return $this->render('/site/management-form-carousel', ['model' => $model]);
        }

        return $this->goBack();
    }

    /**
     * carousel remove
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionCarouselRemove($id): \yii\web\Response
    {
        if(\Yii::$app->request->post()){
            $model = Carousel::findOne(['id' => $id]);
            if($model !== null){
                $model->delete();
            }
        }
        return $this->redirect('/user-management/carousels');
    }

}