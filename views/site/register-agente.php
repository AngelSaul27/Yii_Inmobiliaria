<?php
    /** @var yii\web\View $this */
    /** @var yii\bootstrap5\ActiveForm $form */
    /** @var app\models\RegisterForm $model */

    use yii\bootstrap5\ActiveForm;
    use yii\bootstrap5\Html;

    $this->title = 'Registro | Agente';
?>
<div class="w-full h-full flex flex-col align-items-center justify-center py-20 bg-center" style="background-image: url('<?= Yii::getAlias('@web/resources/backrground.jpg')?>')">

    <?php $form = ActiveForm::begin() ?>
    <div class="rounded-md bg-white shadow px-4 w-[600px] px-3 py-3">
        <h1 class="font-bold text-2xl"><?= Html::encode($this->title) ?></h1>
        <p class="font-light text-sm mt-1 mb-2">Completa todos los campos por favor.</p>

        <label class="text-gray-500">Nombre de Usuario</label>
        <?= $form->field($model, 'username')->input('text', ['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm', 'placeholder' => 'Nombre'])->label(false) ?>

        <div class="grid grid-cols-2 gap-4">
            <div class="space-y-1">
                <label class="text-gray-500">Correo</label>
                <?= $form->field($model, 'email')->input('email', ['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm', 'placeholder' => 'Correo electronico'])->label(false) ?>
                <label class="text-gray-500 -mt-10 block">Contraseña</label>
                <?= $form->field($model, 'password')->input('password', ['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm', 'placeholder' => 'Contraseña'])->label(false) ?>

                <label class="text-gray-500 -mt-10 block">Fotografia</label>
                <?= $form->field($model, 'imagen')->fileInput(['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm'])->label(false) ?>
            </div>
            <div class="space-y-1">
                <label class="text-gray-500">Correo de Contacto</label>
                <?= $form->field($model, 'correo_contacto')->input('email', ['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm', 'placeholder' => 'Correo de Contacto'])->label(false) ?>
                <label class="text-gray-500 -mt-10 block">Telefono de Contacto</label>
                <?= $form->field($model, 'numero_contacto')->input('number', ['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm', 'placeholder' => 'Numero de Contacto'])->label(false) ?>

                <a href="<?= Yii::getAlias('@web/register')?>" class="text-gray-500 font-light text-sm -mt-2 block text-end">Registrate como usuario aquí</a>

                <button class="w-full rounded-md px-3 py-2 text-xl font-light bg-amber-400 text-neutral-900 mt-3 mb-2">
                    Registrate
                </button>
            </div>
        </div>

    </div>
    <?php ActiveForm::end() ?>

</div>