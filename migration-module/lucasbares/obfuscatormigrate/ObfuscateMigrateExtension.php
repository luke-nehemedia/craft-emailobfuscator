<?php
/**
 * Obfuscator plugin for Craft CMS 3.x, 4.x
 *
 * Adds a Twig filter to obfuscate emails using Hivelogic Enkoder.
 *
 * @link      https://miranj.in/
 * @copyright Copyright (c) 2018 Miranj
 */

namespace lucasbares\obfuscatormigrate;

use \miranj\obfuscator\twigextensions\ObfuscatorTwigExtension;
use Craft;
use Craft\web\twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\Markup;


class ObfuscateMigrateExtension extends ObfuscatorTwigExtension
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getName()
    {
        return Craft::t('Obfuscator Migrator');
    }
    
    public function getFilters()
    {
        $needs_env = ['needs_environment' => true];
        return [
            new TwigFilter('obfuscateEmail', [$this, 'enkodeEmailsFilter'], $needs_env),
        ];
    }
}
