<?php

use app\models\auxiliares\categoria_inmueble;
use app\models\auxiliares\tipo_inmueble;
use yii\bootstrap5\Html;
    use yii\grid\GridView;
    use yii\helpers\Url;

    /** @var app\controllers\InmuebleController $model */
    $this->title = 'Inmuebles';
?>

<div class="px-10 py-5">
    <a href="<?= Yii::getAlias('@web/agente/inmueble/create')?>" class="p-2 mb-4 block w-max rounded-md bg-amber-400 text-neutral-900 hover:text-neutral-900">Crear inmueble</a>

    <?php
        echo GridView::widget([
            'dataProvider' => $model,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'imagen',
                    'format' => 'html',
                    'value' => function ($model) {
                        return Html::img(Yii::getAlias('@web/').$model->imagen, ['alt' => 'Imagen', 'style' => 'width:100px;']);
                    },
                ],
                'nombre',
                'ubicacion',
                'precio',
                'habitaciones',
                [
                    'attribute' => 'baños',
                    'format' => 'html',
                    'value' => function ($model) {
                        return Html::label($model->banios);
                    },
                ],
                'niveles',
                [
                    'attribute' => 'tamaño',
                    'format' => 'html',
                    'value' => function ($model) {
                        return Html::label($model->tamanio);
                    },
                ],

                [
                    'attribute' => 'Tipo',
                    'format' => 'html',
                    'value' => function ($model) {
                        return Html::label(tipo_inmueble::find()->select('tipo')->where(['id' => $model->tipo_inmueble_id])->scalar());
                    },
                ],
                [
                    'attribute' => 'Categoria',
                    'format' => 'html',
                    'value' => function ($model) {
                        return Html::label(categoria_inmueble::find()->select('categoria')->where(['id' => $model->categoria_inmueble_id])->scalar());
                    },
                ],
                [
                    'attribute' => 'año de construcción',
                    'format' => 'html',
                    'value' => function ($model) {
                        return Html::label($model->anio_construccion);
                    },
                ],
                'fecha_publicacion',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions'=>['style'=>'width:70px; text-align:center;'],
                    'template' => '{update} {delete}',
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'update') { // Aquí defines la estructura de la URL para la acción de edición
                            return Url::to(['agente/inmueble/' . $model->id . '/edit']);
                        }else if($action === 'delete'){
                            return Url::to(['agente/inmueble/' . $model->id . '/delete']);
                        }
                    },
                ]
            ],
        ]);
    ?>
</div>