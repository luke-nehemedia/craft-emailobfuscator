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

use lucasbares\craftemailobfuscator\models\Settings;

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
 * @version   2.2.0
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
        if( $this->settings->includeJS && !Craft::$app->getRequest()->isConsoleRequest) {
            $this->view->registerAssetBundle(CraftEmailobfuscatorAssets::class);
        }

        // registering propaganistas email obfuscator
        if (!Craft::$app->getRequest()->isConsoleRequest) {
            Craft::$app->view->registerTwigExtension(new twig\ObfuscateExtension);

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
        }



        // log installation
        Craft::info( Craft::t('craft-emailobfuscator', 'plugin-loaded'),__METHOD__ );
    }

    // Protected Methods
    // =========================================================================

    /**
     * Creates settings model
     *
     * @return Settings
     */

    protected function createSettingsModel(): Settings
    {
        return new Settings();
    }

    /**
     * Settings HTML
     *
     * @return string The rendered settings HTML
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate('craft-emailobfuscator/settings', [
            'settings' => $this->getSettings()
        ]);
    }
}
