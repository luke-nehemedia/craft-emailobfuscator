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

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;

use yii\base\Event;

/**
 * Craft3 Email Obfuscator
 *
 * A simple plugin that makes propaganistas/email-obfuscator available in Craft.
 *
 * @author    Lucas Bares
 * @package   CraftEmailobfuscator
 * @since     2.0.0
 *
 */
class CraftEmailobfuscator extends Plugin
{
    /**
     * @var CraftEmailobfuscator
     */
    public static $plugin;

    /**
     * Version
     * @var string
     */
    public $schemaVersion = '2.0.0';

    /**
     * initialization
     *
     * Registers an AssetBundle and a TwigExtension
     *
     * @todo more options for the assets like: 1) inline js, 2) jQuery fetching all mails after load
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // registering the AssetBundle with propaganistas js file
        $this->view->registerAssetBundle(CraftEmailobfuscatorPropaganistasAssets::class);

        // registering propaganistas email obfuscator
        Craft::$app->view->registerTwigExtension(new \Propaganistas\EmailObfuscator\Twig\Extension);

        // show success message with template tag information
        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                    Craft::$app->session->setNotice(Craft::t('craft-emailobfuscator','install-success'));
                }
            }
        );

        // log installation
        Craft::info( Craft::t('craft-emailobfuscator', 'plugin-loaded'),__METHOD__ );
    }

}
