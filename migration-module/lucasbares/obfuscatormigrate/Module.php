<?php
namespace lucasbares\obfuscatormigrate;

use Craft;
use Twig\TwigFilter;
use miranj\obfuscator\twigextensions\ObfuscatorTwigExtension;

class Module extends \yii\base\Module
{
	public function init()
	{
		parent::init();

		// Custom initialization code goes here...
		
		if (Craft::$app->request->getIsSiteRequest()) {
			
			$extension = new ObfuscateMigrateExtension();
			Craft::$app->view->registerTwigExtension($extension);
		}
	}
}