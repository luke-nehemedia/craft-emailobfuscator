<?php

namespace lucasbares\craftemailobfuscator;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;
use yii\web\View;

class CraftEmailobfuscatorPropaganistasAssets extends AssetBundle
{
    public function init()
    {
        // path to the original javascript file of propaganistas
        $this->sourcePath = CRAFT_VENDOR_PATH.DIRECTORY_SEPARATOR.'propaganistas'.DIRECTORY_SEPARATOR.'email-obfuscator'.DIRECTORY_SEPARATOR.'assets';

        // add the JS-File to the AssetBundle
        $this->js = ['EmailObfuscator.js'];

        // specify that it should be added to the head of the document
        $this->jsOptions = ['position' => View::POS_HEAD];

        parent::init();
    }
}