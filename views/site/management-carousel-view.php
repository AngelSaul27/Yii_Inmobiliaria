<?php

    use yii\bootstrap5\Html;
    use yii\grid\GridView;
    use yii\helpers\Url;

    /** @var app\controllers\ManagementController $carousel */
    $this->title = 'Carousel';
?>

<div class="px-10 py-5">
    <a href="<?= Yii::getAlias('@web/user-management/carousel/create')?>" class="p-2 mb-4 block w-max rounded-md bg-amber-400 text-neutral-900 hover:text-neutral-900">Crear carousel</a>

    <?php
        echo GridView::widget([
            'dataProvider' => $carousel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'imagen',
                    'format' => 'html',
                    'value' => function ($model) {
                        return Html::img(Yii::getAlias('@web/').$model->imagen, ['alt' => 'Imagen', 'style' => 'width:100px;']);
                    },
                ],
                'titulo',
                'descripcion',
                'fecha_activacion',
                'fecha_desactivacion',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions'=>['style'=>'width:70px; text-align:center;'],
                    'template' => '{update} {delete}',
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'update') { // Aquí defines la estructura de la URL para la acción de edición
                            return Url::to(['user-management/carousel/' . $model->id . '/edit']);
                        }else if($action === 'delete'){
                            return Url::to(['user-management/carousel/' . $model->id . '/remove']);
                        }
                    },
                ]
            ],
        ]);
    ?>
</div>