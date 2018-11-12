<?php
/**
 * Craft Emailobfuscator plugin for Craft CMS 3.x
 *
 * A simple plugin that adds a twig tag to obfuscate email addresses (by rot13) in text fields.
 *
 * @link      http://luke.nehemedia.de
 * @copyright Copyright (c) 2018 Lucas Bares
 */

namespace lucasbares\craftemailobfuscator\models;

use craft\base\Model;

class Settings extends Model
{
    public $includeJS = true;
}