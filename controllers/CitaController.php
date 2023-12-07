<?php

namespace app\controllers;

use app\models\AgenteModel;
use app\models\Cita;
use app\models\CitaForm;
use app\models\Inmueble;
use app\models\UserModel;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\web\Controller;

class CitaController extends Controller
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
     * vista de citas de un agente
     */
    public function actionView(){
        $citas = Cita::find()
            ->select(['cita.*', 'inmueble.imagen', 'inmueble.nombre', 'inmueble.precio'])
            ->innerJoin('inmueble', 'inmueble.id = cita.inmueble_id')
            ->with('inmueble')
            ->where(['inmueble.agente_venta_id' => AgenteModel::getId()]);

        $dataProvider = new ActiveDataProvider([
            'query' => $citas,
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        return $this->render('/site/agente-citas', ['cita' => $dataProvider]);
    }

    /**
     * citas de usuarios
     */
    public function actionUser(){
        $citas = Cita::find()
            ->select(['cita.*', 'inmueble.imagen', 'inmueble.nombre', 'inmueble.precio'])
            ->innerJoin('inmueble', 'inmueble.id = cita.inmueble_id')
            ->with('inmueble')
            ->where(['user_id' => \Yii::$app->user->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $citas,
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        return $this->render('/site/user-citas', ['cita' => $dataProvider]);
    }

    /**
     * eliminar cita de usuario
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionUnsubscribe($id){
        $cita = Cita::findOne(['id' => $id, 'user_id' => \Yii::$app->user->id]);
        if($cita!==null){
            $cita->delete();
            \Yii::$app->session->setFlash('success', 'Cita removida exitosamente');

            return $this->redirect('/user/citas');
        }
    }

    /**
     * asignar fecha de cita
     */
    public function actionAssigned($id){
        $citas = Cita::find()
            ->innerJoin('inmueble', 'inmueble.id = cita.inmueble_id')
            ->where(['inmueble.agente_venta_id' => AgenteModel::getId()])
            ->where(['cita.id' => $id])
            ->one();

        if($citas !== null){
            $model = new CitaForm();
            $model->id = $id;
            $model->fecha_cita = $citas->fecha_cita;

            if($model->load(\Yii::$app->request->post())){
                $result = $model->assignedCita();

                if($result){
                    \Yii::$app->session->setFlash('success', 'Cita actualizada');
                    return $this->redirect('/agente/citas');
                }else{
                    \Yii::$app->session->setFlash('warning', 'No pudimos actualizar la fecha: '.$model->getErrors('fecha_cita')[0]);
                    return $this->redirect('/agente/cita/'.$id.'/update');
                }
            }

            return $this->render('/site/agente-form-cita', ['model' => $model]);
        }

        return $this->goBack();
    }

    /**
     * registrarse en una cita
     */
    public function actionRegister($id){
        if(\Yii::$app->user->isGuest){
            return $this->redirect('/login');
        }else{
            if(UserModel::getRoleName() !== UserModel::ROLE_USUARIO){
                \Yii::$app->session->setFlash('warning', 'No tienes permitido hacer esto');
                return $this->goBack();
            }
        }

        $properties = Inmueble::find()->select('id')->where(['id' => $id])->scalar();

        if($properties !== null){
            $result = CitaForm::registerCita($id);
            if($result){
                \Yii::$app->session->setFlash('success', 'Cita registrada exitosamente');
            }else{
                \Yii::$app->session->setFlash('warning', 'No tan rapido, ya tienes una cita registrada');
            }
        }
        return $this->redirect('/inmueble/'.$id);
    }

}