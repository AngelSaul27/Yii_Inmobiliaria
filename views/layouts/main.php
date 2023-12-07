<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\models\UserModel;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use webvimark\modules\UserManagement\components\GhostMenu;
use webvimark\modules\UserManagement\UserManagementModule;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
$this->registerJsFile("https://cdn.tailwindcss.com");
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header id="header" class="flex items-center justify-between shadow-sm bg-neutral-900 px-10 py-3">
        <a href="<?= Yii::getAlias('@web/')?>" class="flex items-center gap-2">
            <img src="<?= Yii::getAlias('@web/resources/logo.webp') ?>" class="w-8 h-10" alt="Inmobiliarias MX">
            <div class="flex flex-col">
                <h1 class="text-white text-2xl font-sembibold">Inmobiliaria</h1>
                <span class="text-gray-300 font-light text-sm text-uppercase">Encuentra tu hogar</span>
            </div>
        </a>

        <ul class="flex items-center text-white gap-3">
            <li>
                <a class="hover:text-white" href="<?= Yii::getAlias('@web/')?>">Inicio</a>
            </li>

            <li>
                <span data-dropdown-toggle="dropdown" class="hover:text-white cursor-pointer">Categoria</span>
            </li>
            <div id="dropdown" class="z-[300] hidden divide-y divide-gray-100 rounded-lg shadow w-44 bg-neutral-900">
                <ul class="py-2 text-sm text-gray-200">
                    <li>
                        <a href="<?= Yii::getAlias('@web/inmueble/ctg/2')?>" class="block px-4 py-2 hover:bg-neutral-800 hover:text-white">Depatamentos</a>
                    </li>
                    <li>
                        <a href="<?= Yii::getAlias('@web/inmueble/ctg/1')?>" class="block px-4 py-2 hover:bg-neutral-800 hover:text-white">Casas</a>
                    </li>
                </ul>
            </div>

            <?php if(!Yii::$app->user->isGuest) : ?>
                <?php if(UserModel::getRoleName() === UserModel::ROLE_USUARIO) : ?>
                    <li>
                        <a class="hover:text-white min-w-max block" href="<?= Yii::getAlias('@web/user/citas')?>">Mis citas</a>
                    </li>
                <?php elseif(UserModel::getRoleName() === UserModel::ROLE_AGENTE) : ?>
                    <li>
                        <a class="hover:text-white" href="<?= Yii::getAlias('@web/agente/citas')?>">Citas</a>
                    </li>
                    <li>
                        <a class="hover:text-white" href="<?= Yii::getAlias('@web/agente/inmuebles')?>">Inmuebles</a>
                    </li>
                <?php elseif(Yii::$app->user->identity->superadmin) : ?>
                    <li>
                        <span data-dropdown-toggle="user_sistema_dropdown" class="hover:text-white cursor-pointer">Administrador</span>
                    </li>
                    <div id="user_sistema_dropdown" class="z-[300] hidden divide-y divide-gray-100 rounded-lg shadow w-44 bg-neutral-900">
                        <ul class="py-2 text-sm text-gray-200">
                            <li>
                                <a class="block px-4 py-2 hover:bg-neutral-800 hover:text-white" href="<?= Yii::getAlias('@web/user-management/carousels')?>">Carousel</a>
                            </li>
                            <?php
                                foreach((UserManagementModule::menuItems())as $items){
                                    echo '<li><a class="block px-4 py-2 hover:bg-neutral-800 hover:text-white" href="'.($items['url'][0]) .'">'.($items['label']).'</a></li>';
                                }
                            ?>
                        </ul>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if(Yii::$app->user->isGuest) : ?>
            <li>
                <a class="hover:text-white" href="<?= Yii::getAlias('@web/login')?>">Ingresar</a>
            </li>
            <li>
                <a href="<?= Yii::getAlias('@web/register')?>" class="p-2 rounded-md bg-amber-400 text-neutral-900 hover:text-neutral-900">Registrate</a>
            </li>
            <?php else : ?>
                <form class="block w-full text-gray-700" method="post" action="<?= Yii::getAlias('@web/logout')?>" href="<?= Yii::getAlias('@web/logout')?>">
                    <?= Html::input('hidden',Yii::$app->request->csrfParam,Yii::$app->request->csrfToken)?>
                    <button type="submit" class="p-2 rounded-md bg-amber-400 text-neutral-900 hover:text-neutral-900">
                        Cerrar sesion
                    </button>
                </form>
            <?php endif; ?>
        </ul>
    </header>

    <main id="main" role="main" class="flex-shrink-0">
        <?= Alert::widget() ?>
        <?= $content ?>
    </main>

    <footer id="footer" class="flex items-center gap-2 bg-neutral-900 p-4 text-white">
        <div class="flex items-center gap-2 select-none">
            <img src="<?= Yii::getAlias('@web/resources/logo.webp') ?>" class="w-6 h-10">
            <div class="flex flex-col">
                <h1 class="text-white text-xl font-sembibold min-w-max">Inmobiliaria</h1>
                <span class="text-gray-300 font-light text-xs text-uppercase min-w-max">En cuentra tu hogar</span>
            </div>
        </div>
        <span class="font-light text-xs ml-5 min-w-max select-none">2023 ©</span>
        <div class="flex gap-2 items-center justify-content-end font-light w-full">
            <span>Casas</span>
            <span>Departamentos</span>
        </div>
    </footer>

    <?php $this->endBody() ?>
    <?php $this->registerJsFile(Yii::getAlias('https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js'), ['position' => \yii\web\View::POS_END]); ?>
</body>

</html>
<?php $this->endPage() ?>