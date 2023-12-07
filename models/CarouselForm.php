<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\validators\FileValidator;

class CarouselForm extends Model
{

    public $imagen, $titulo, $descripcion, $fecha_activacion, $fecha_desactivacion;

    public function rules()
    {
        return [
            [['descripcion', 'titulo'], 'safe', 'on' => 'create'],
            ['fecha_activacion', 'date', 'format' => 'php:Y-m-d', 'message' => 'Formato incorrecto', 'on' => 'create'],
            ['fecha_desactivacion', 'date', 'format' => 'php:Y-m-d', 'message' => 'Formato incorrecto', 'on' => 'create'],
            [
                ['imagen', 'fecha_activacion', 'fecha_desactivacion']
                , 'required', 'message' => 'Campos obligatorios', 'on' => 'create'
            ],
            [
                ['imagen'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, webp',
                'message' => 'Solo archivos png, jpg y jpeg', 'on' => 'create'
            ],

            [['descripcion', 'titulo'], 'safe', 'on' => 'edit'],
            ['fecha_activacion', 'date', 'format' => 'php:Y-m-d', 'message' => 'Formato incorrecto', 'on' => 'edit'],
            ['fecha_desactivacion', 'date', 'format' => 'php:Y-m-d', 'message' => 'Formato incorrecto', 'on' => 'edit'],
        ];
    }

    public function create(): bool
    {
        if($this->validate())
        {
            $carousel = new Carousel();
            $carousel->titulo = $this->titulo;
            $carousel->descripcion = $this->descripcion;
            $carousel->imagen = $this->generatedNameFile();
            $carousel->fecha_activacion = $this->fecha_activacion;
            $carousel->fecha_desactivacion = $this->fecha_desactivacion;

            if($carousel->save()){
                $this->imagen->saveAs($carousel->imagen);
                return true;
            }
        }
        return false;
    }

    private function generatedNameFile(): string
    {
        return 'carousel/' . $this->imagen->baseName .'_'.(date("d_m_Y_h_i_s")). '.' . $this->imagen->extension;
    }

    public function update($id): bool
    {
        if ($this->validate())
        {
            $rutaAntigua = null;

            $carousel = Carousel::findOne(['id' => $id]);
            $carousel->titulo = $this->titulo;
            $carousel->descripcion = $this->descripcion;
            $carousel->fecha_activacion = $this->fecha_activacion;
            $carousel->fecha_desactivacion = $this->fecha_desactivacion;

            if($this->imagen !== null){
                $rules = new FileValidator(
                    ['extensions' => 'png, jpg, jpeg, webp', 'skipOnEmpty' => false]
                );

                $apply = $rules->validate($this->imagen, $error);

                if ($apply) {
                    if (!empty($carousel->imagen)) {
                        $rutaAntigua = Yii::getAlias('@webroot/') . $carousel->imagen;
                        if (file_exists($rutaAntigua)) {
                            $carousel->imagen = self::generatedNameFile();
                        }
                    }
                }
            }

            if($carousel->save()){
                if ($rutaAntigua !== null && file_exists($rutaAntigua)) {
                    unlink($rutaAntigua);
                    $this->imagen->saveAs($carousel->imagen);
                }

                return true;
            }
        }

        return false;
    }

}