<?php
    use app\models\auxiliares\categoria_inmueble;
    use app\models\auxiliares\tipo_inmueble;
use yii\bootstrap5\ActiveForm;

$this->title = $model->titulo ?? 'Inmueble'; ?>

<div class="px-10 py-5">
    <div class="grid grid-cols-3 gap-2">
        <div class="col-span-2 shadow-sm">
            <div class="relative overflow-hidden">
                <img src="<?= Yii::getAlias('@web/carousel/1.jpg') ?>" alt="" class="object-cover rounded-t-md h-[400px] w-full">
                <div class="absolute bottom-0 px-2 py-1 bg-red-600 text-white">
                    <span class="font-semibold tracking-wide text-uppercase text-sm"><?= categoria_inmueble::getCategoria($model->categoria_inmueble_id)?></span>
                </div>
                <div class="absolute top-0 right-0 rounded-tr-md px-2 py-1 bg-blue-600 text-white">
                    <span class="font-semibold tracking-wide text-uppercase text-sm"><?= tipo_inmueble::getTipo($model->tipo_inmueble_id)?></span>
                </div>
            </div>

            <div class="px-4">
                <h1 class="text-3xl font-bold mb-2 mt-3"><?= $model->nombre ?></h1>
                <p class="font-[400] text-2xl text-red-600 mt-2 mb-4">$<?= number_format($model->precio, '2', '.', ',') ?></p>
            </div>

            <div class="flex flex-col gap-2 my-3">
                <div class="grid grid-cols-6 gap-2">
                    <div class="flex flex-col items-center justify-start font-light text-xs text-gray-500">
                        <svg class="h-5 w-5" preserveAspectRatio="xMidYMid meet" data-bbox="28.153 28.153 143.693 143.693" viewBox="28.153 28.153 143.693 143.693" xmlns="http://www.w3.org/2000/svg" data-type="color" role="presentation" aria-hidden="true">
                            <g>
                                <path d="M28.153 28.153v143.693h143.693V28.153H28.153zm135.694 8v44.339H36.153V36.153h127.694zM36.153 163.847V88.492h127.693v75.354H36.153z" fill="#DADADA" data-color="1"></path>
                                <path d="M96.246 41.723H43.661v31.262h52.585V41.723zm-8 23.261H51.661V49.723h36.585v15.261z" fill="#DADADA" data-color="1"></path>
                                <path d="M156.339 41.723h-52.585v31.262h52.585V41.723zm-8 23.261h-36.585V49.723h36.585v15.261z" fill="#DADADA" data-color="1"></path>
                            </g>
                        </svg>
                        <span>Habitaciones</span>
                    </div>
                    <div class="flex flex-col items-center justify-start font-light text-xs text-gray-500">
                        <svg class="h-5 w-5" preserveAspectRatio="xMidYMid meet" data-bbox="28.932 28.931 143.122 142.137" viewBox="28.932 28.931 143.122 142.137" xmlns="http://www.w3.org/2000/svg" data-type="color" role="presentation" aria-hidden="true">
                            <g>
                                <path d="M47.107 111.33l11.498 51.738H36.932V36.932h18.14l4.775 12.734 7.49-2.809-6.723-17.926H28.932v142.137H158.78l13.274-59.738H47.107zm105.255 51.738H66.801L57.08 119.33h105.002l-9.72 43.738z" fill="#DADADA" data-color="1"></path>
                            </g>
                        </svg>
                        <span>Baños</span>
                    </div>
                    <div class="flex flex-col items-center justify-start font-light text-xs text-gray-500">
                        <svg class="h-5 w-5" preserveAspectRatio="xMidYMid meet" data-bbox="34.57 31.149 130.859 137.702" viewBox="34.57 31.149 130.859 137.702" xmlns="http://www.w3.org/2000/svg" data-type="color" role="presentation" aria-hidden="true">
                            <g>
                                <path fill="#DADADA" d="M165.429 160.851v8H34.57v-8h130.859z" data-color="1"></path>
                                <path fill="#DADADA" d="M165.429 96v8H34.57v-8h130.859z" data-color="1"></path>
                                <path fill="#DADADA" d="M165.429 31.149v8H34.57v-8h130.859z" data-color="1"></path>
                                <path fill="#DADADA" d="M99.663 52.766v8H46.557v-8h53.106z" data-color="1"></path>
                                <path fill="#DADADA" d="M119.685 74.383v8H66.579v-8h53.106z" data-color="1"></path>
                                <path fill="#DADADA" d="M157.872 117.617v8h-53.106v-8h53.106z" data-color="1"></path>
                                <path fill="#DADADA" d="M133.106 139.234v8H80v-8h53.106z" data-color="1"></path>
                            </g>
                        </svg>
                        <span>Niveles</span>
                    </div>
                    <div class="flex flex-col items-center justify-start font-light text-xs text-gray-500">
                        <svg class="h-5 w-5" preserveAspectRatio="xMidYMid meet" data-bbox="30.57 30.57 138.86 138.86" viewBox="30.57 30.57 138.86 138.86" xmlns="http://www.w3.org/2000/svg" data-type="color" role="presentation" aria-hidden="true">
                            <g>
                                <path d="M30.57 30.57v138.86h138.86V30.57H30.57zm130.86 130.86H38.57V38.57h122.86v122.86z" fill="#DADADA" data-color="1"></path>
                                <path d="M87.175 112.825h-41.65v41.649h41.649v-41.649zm-8 33.65h-25.65v-25.649h25.649v25.649z" fill="#DADADA" data-color="1"></path>
                            </g>
                        </svg>
                        <span>MT2</span>
                    </div>
                    <div class="flex flex-col items-center justify-start font-light text-xs text-gray-500">
                        <svg class="h-5 w-5" preserveAspectRatio="xMidYMid meet" data-bbox="30.439 30.57 138.859 138.86" viewBox="30.439 30.57 138.859 138.86" xmlns="http://www.w3.org/2000/svg" data-type="color" role="presentation" aria-hidden="true">
                            <g>
                                <path d="M30.439 30.57v138.86h138.859V30.57H30.439zm130.859 8v37.907h-18.755V53.198h-28.811v23.279H86.246V53.198H57.435v23.279H38.439V38.57h122.859zm-26.755 84.508h-12.811v-15.386h12.811v15.386zm-20.81-23.386v23.386H86.246V99.692H57.435v23.386H38.439v-38.6h122.859v38.601h-18.755V99.692h-28.81zm-35.487 23.386H65.435v-15.386h12.811v15.386zm0-46.6H65.435v-15.28h12.811v15.28zm56.297 0h-12.811v-15.28h12.811v15.28zM38.439 161.43v-30.352h122.859v30.352H38.439z" fill="#DADADA" data-color="1"></path>
                            </g>
                        </svg>
                        <span>Año de construccion</span>
                    </div>
                    <div class="flex flex-col items-center justify-start font-light text-xs text-gray-500">
                        <svg class="h-5 w-5" preserveAspectRatio="xMidYMid meet" data-bbox="50.836 31.854 98.328 126.783" viewBox="50.836 31.854 98.328 126.783" xmlns="http://www.w3.org/2000/svg" data-type="color" role="presentation" aria-hidden="true">
                            <g>
                                <path d="M100 31.854c-27.109 0-49.164 22.055-49.164 49.164 0 26.254 44.393 72.663 46.282 74.626l2.882 2.993 2.882-2.993c1.89-1.963 46.282-48.372 46.282-74.626 0-27.109-22.055-49.164-49.164-49.164zm0 115.181c-13.717-14.854-41.164-48.246-41.164-66.017 0-22.698 18.466-41.164 41.164-41.164s41.164 18.466 41.164 41.164c0 17.771-27.447 51.164-41.164 66.017z" fill="#DADADA" data-color="1"></path>
                                <path d="M100 62.648c-10.129 0-18.37 8.241-18.37 18.37s8.241 18.37 18.37 18.37 18.37-8.241 18.37-18.37-8.241-18.37-18.37-18.37zm0 28.741c-5.718 0-10.37-4.652-10.37-10.37s4.652-10.37 10.37-10.37 10.37 4.652 10.37 10.37-4.652 10.37-10.37 10.37z" fill="#DADADA" data-color="1"></path>
                            </g>
                        </svg>
                        <span>Ubicación</span>
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-2 text-center">
                    <span class="font-bold text-lg"><?= $model->habitaciones?></span>
                    <span class="font-bold text-lg"><?= $model->banios?></span>
                    <span class="font-bold text-lg"><?= $model->niveles?></span>
                    <span class="font-bold text-lg"><?= $model->tamanio?></span>
                    <span class="font-bold text-lg"><?= $model->anio_construccion?></span>
                    <span class="font-bold text-sm"><?= $model->ubicacion?></span>
                </div>
            </div>
        </div>
        <div class="col-span-1 px-5">
            <div class="bg-gray-50 shadow-sm text-neutral-700 p-3 rounded-sm">
                <img src="<?= Yii::getAlias('@web/'.$agente['imagen']) ?>" alt="" class="object-cover rounded-md h-[200px] w-full">

                <h1 class="text-xl font-bold my-2 text-uppercase"><?= $agente['username'] ?></h1>

                <div class="flex flex-col mb-3 mt-2">
                    <span class="text-lg font-semibold mb-0">Email</span>
                    <span class="text-md font-light"><?= $agente['correo_contacto'] ?></span>
                    <span class="text-lg font-semibold mt-2">Telefono</span>
                    <span class="text-md font-light"><?= $agente['numero_contacto'] ?></span>
                </div>

                <?php $form = ActiveForm::begin(['action' => '/user/cita/'.$model->id.'/register']) ?>
                    <button class="p-2 rounded-md bg-amber-400 text-neutral-900 hover:text-neutral-900 w-full">
                        Solicitar visita
                    </button>
                <?php ActiveForm::end()?>
            </div>
        </div>
    </div>
</div>

