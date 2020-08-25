<?php
/**
 * Craft Emailobfuscator plugin for Craft CMS 3.x
 *
 * A simple plugin that adds a twig tag to obfuscate email addresses (by rot13) in text fields.
 *
 * @link      http://luke.nehemedia.de
 * @copyright Copyright (c) 2018 Lucas Bares
 */
 
namespace lucasbares\craftemailobfuscator;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;
use yii\web\View;

/**
 * Asset-Bundle with javascript to parse email
 *
 *
 * @author    Lucas Bares
 * @package   CraftEmailobfuscator
 * @since     2.2.0
 * @version   2.2.0
 *
 */
class CraftEmailobfuscatorAssets extends AssetBundle
{
    public function init()
    {
        // path to the original javascript file of propaganistas
        $this->sourcePath = '@lucasbares/craftemailobfuscator/assets';

        // add the JS-File to the AssetBundle
        $this->js = ['EmailObfuscator.js'];

        // specify that it should be added to the head of the document
        $this->jsOptions = ['position' => View::POS_HEAD];

        parent::init();
    }
}