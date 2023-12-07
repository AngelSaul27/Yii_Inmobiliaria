<?php

namespace app\models;

use yii\base\Model;
use yii\validators\FileValidator;

class InmuebleForm extends Model
{
    public $imagen, $nombre, $ubicacion, $precio, $habitaciones;
    public $banios, $niveles, $tamanio, $anio_construccion;
    public $fecha_publicacion, $tipo_inmueble_id, $categoria_inmueble_id;

    public function rules(): array
    {
        return [
            [
                [
                    'imagen','nombre','ubicacion','precio','habitaciones',
                    'banios','niveles','tamanio','anio_construccion',
                    'fecha_publicacion','tipo_inmueble_id',
                    'categoria_inmueble_id'
                ],
                'required', 'message' => 'Campos necesarios','on' => 'create'
            ],
            [
                ['imagen'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, webp',
                'message' => 'Solo archivos png, jpg y jpeg', 'on' => 'create'
            ],
            ['anio_construccion', 'date', 'format' => 'php:Y', 'message' => 'Formato incorrecto', 'on' => 'create'],
            ['fecha_publicacion', 'date', 'format' => 'php:Y-m-d', 'message' => 'Formato incorrecto', 'on' => 'create'],

            [
                [
                    'nombre','ubicacion','precio','habitaciones',
                    'banios','niveles','tamanio','anio_construccion',
                    'fecha_publicacion','tipo_inmueble_id',
                    'categoria_inmueble_id'
                ],
                'required', 'message' => 'Campos necesarios','on' => 'edit'
            ],
            ['anio_construccion', 'date', 'format' => 'php:Y', 'message' => 'Formato incorrecto', 'on' => 'edit'],
            ['fecha_publicacion', 'date', 'format' => 'php:Y-m-d', 'message' => 'Formato incorrecto', 'on' => 'edit'],
        ];
    }

    public function create(): bool
    {
        if($this->validate()){

            $model = new Inmueble();
            $model->imagen = $this->generatedNameFile();
            $model->nombre = $this->nombre;
            $model->ubicacion = $this->ubicacion;
            $model->precio = $this->precio;
            $model->habitaciones = $this->habitaciones;
            $model->banios = $this->banios;
            $model->niveles = $this->niveles;
            $model->tamanio = $this->tamanio;
            $model->anio_construccion = $this->anio_construccion;
            $model->fecha_publicacion = $this->fecha_publicacion;
            $model->tipo_inmueble_id = $this->tipo_inmueble_id;
            $model->categoria_inmueble_id = $this->categoria_inmueble_id;
            $model->agente_venta_id = AgenteModel::getId()->id;

            if($model->save()){
                $this->imagen->saveAs($model->imagen);
                return true;
            }
        }

        return false;
    }

    private function generatedNameFile(): string
    {
        return 'inmuebles/' . $this->imagen->baseName .'_'.(date("d_m_Y_h_i_s")). '.' . $this->imagen->extension;
    }

    public function edit($id): bool
    {
        if($this->validate()){
            $rutaAntigua = null;

            $model = Inmueble::findOne(['id' => $id]);
            $model->nombre = $this->nombre;
            $model->ubicacion = $this->ubicacion;
            $model->precio = $this->precio;
            $model->habitaciones = $this->habitaciones;
            $model->banios = $this->banios;
            $model->niveles = $this->niveles;
            $model->tamanio = $this->tamanio;
            $model->anio_construccion = $this->anio_construccion;
            $model->fecha_publicacion = $this->fecha_publicacion;
            $model->tipo_inmueble_id = $this->tipo_inmueble_id;
            $model->categoria_inmueble_id = $this->categoria_inmueble_id;

            if($this->imagen !== null){
                $rules = new FileValidator(
                    ['extensions' => 'png, jpg, jpeg, webp', 'skipOnEmpty' => false]
                );

                $apply = $rules->validate($this->imagen, $error);

                if ($apply) {
                    if (!empty($model->imagen)) {
                        $rutaAntigua = \Yii::getAlias('@webroot/') . $model->imagen;
                        if (file_exists($rutaAntigua)) {
                            $model->imagen = self::generatedNameFile();
                        }
                    }
                }
            }

            if($model->save()){
                if ($rutaAntigua !== null && file_exists($rutaAntigua)) {
                    unlink($rutaAntigua);
                    $this->imagen->saveAs($model->imagen);
                }

                return true;
            }
        }

        return false;
    }

}