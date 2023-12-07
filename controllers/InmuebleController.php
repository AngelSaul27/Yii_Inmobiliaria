<?php

namespace app\controllers;

use app\models\auxiliares\categoria_inmueble;
use app\models\auxiliares\tipo_inmueble;
use app\models\Inmueble;
use app\models\InmuebleForm;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\UploadedFile;

class InmuebleController extends Controller
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
     * listado de inmuebles
     */
    public function actionView(): string
    {
        $inmueble = Inmueble::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $inmueble,
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        return $this->render('/site/agente-inmuebles', ['model' => $dataProvider]);
    }

    /**
     * creación de un inmueble
     */
    public function actionCreate(){
        $categorias = categoria_inmueble::find()->all();
        $tipos = tipo_inmueble::find()->all();

        $model = new InmuebleForm();
        $model->scenario = 'create';

        if($model->load(\Yii::$app->request->post())){
            $model->imagen = UploadedFile::getInstance($model, 'imagen');
            $result = $model->create();

            if($result){
                \Yii::$app->session->setFlash('success', 'Elemento creado exitosamente');
                return $this->redirect('/agente/inmuebles');
            }

            \Yii::$app->session->setFlash('error', 'Elemento no creado');
        }

        return $this->render('/site/agente-form-inmueble',
            ['categoria' => $categorias, 'tipo' => $tipos, 'model' => $model]
        );
    }

    /**
     * edición de un inmueble
     */
    public function actionEdit($id){
        $data = Inmueble::findOne(['id' => $id]);

        if($data !== null){
            $categorias = categoria_inmueble::find()->all();
            $tipos = tipo_inmueble::find()->all();

            $model = new InmuebleForm();
            $model->scenario = 'edit';
            $model->imagen = $data->imagen;
            $model->nombre = $data->nombre;
            $model->ubicacion = $data->ubicacion;
            $model->precio = $data->precio;
            $model->habitaciones = $data->habitaciones;
            $model->banios = $data->banios;
            $model->niveles = $data->niveles;
            $model->tamanio = $data->tamanio;
            $model->anio_construccion = $data->anio_construccion;
            $model->fecha_publicacion = $data->fecha_publicacion;
            $model->tipo_inmueble_id = $data->tipo_inmueble_id;
            $model->categoria_inmueble_id = $data->categoria_inmueble_id;

            if($model->load(\Yii::$app->request->post())){
                $model->imagen = UploadedFile::getInstance($model, 'imagen');
                $result = $model->edit($id);

                if($result){
                    \Yii::$app->session->setFlash('success', 'Elemento actualizado exitosamente');
                    return $this->redirect('/agente/inmuebles');
                }

                \Yii::$app->session->setFlash('error', 'Elemento no actualizado');
            }

            return $this->render('/site/agente-form-inmueble',
                ['categoria' => $categorias, 'tipo' => $tipos, 'model' => $model]
            );
        }

        return $this->goBack();
    }

    /**
     * eliminación de un inmueble
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id): \yii\web\Response
    {
        if(\Yii::$app->request->post()){
            $model = Inmueble::findOne(['id' => $id]);
            if($model !== null){
                $image = $model->imagen;
                if($image !== null){
                    unlink($image);
                }
                $model->delete();
            }
        }

        return $this->redirect('/agente/inmuebles');
    }

}