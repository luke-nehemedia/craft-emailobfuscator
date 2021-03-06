<?php
/**
 * Craft Emailobfuscator plugin for Craft CMS 3.x
 *
 * A simple plugin that adds a twig tag to obfuscate email addresses (by rot13) in text fields.
 *
 * @link      http://luke.nehemedia.de
 * @copyright Copyright (c) 2018 Lucas Bares
 */

/**
 * Craft Emailobfuscator en Translation
 *
 * Returns an array with the string to be translated (as passed to `Craft::t('craft-emailobfuscator', '...')`) as
 * the key, and the translation as the value.
 *
 * http://www.yiiframework.com/doc-2.0/guide-tutorial-i18n.html
 *
 * @author    Lucas Bares
 * @package   CraftEmailobfuscator
 * @since     2.0.0
 */
return [
    'plugin-loaded'     => 'Craft Emailobfuscator plugin loaded',
    'install-success'   =>  'EMail obfuscator plugin sucessfully installed. You can now use the |obfuscateEmail tag on text fields.',
];
