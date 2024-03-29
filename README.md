# Email obfuscator plugin for Craft CMS 3.x

A simple plugin that adds a twig tag to obfuscate email addresses (by ROT13) in text fields.

![Plugin Logo](resources/img/plugin-logo.png)

## Requirements

This plugin is made for Craft CMS 3.0.0-beta.23 or later.
It requires the [Email-Obfuscator by Propaganistas](https://github.com/Propaganistas/Email-Obfuscator) since this plugin is merely a wrapper for his Twig Extension.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require lucasbares/craft-emailobfuscator

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Craft Emailobfuscator.

You can also update your craft's `composer.json` file and run `composer update`. 

## Using the Plugin

This plugin adds the Twig Extension made by [Propaganistas](https://github.com/Propaganistas/Email-Obfuscator) to Craft. It masks all email addresses by ROT13 ciphering or CSS reverse text direction. A simple javascript file decodes the masked emails on the frontend.

To use it, just use the `obfuscateEmail` Twig filter on any text field or string:

```twig
{{ "Sample Text"|obfuscateEmail }}
{{ textfield|obfuscateEmail }}
```

## Configuring the Plugin
### InludeJS
By default the plugin inserts the necessary JavaScript to your front end html. There is a setting to turn this off if you want to include the JS code manually. The relevant JS code is available at https://github.com/Propaganistas/Email-Obfuscator/tree/master/assets


## Craft 4 - Migration to [Craft-Obfuscator](https://github.com/miranj/craft-obfuscator)
Unfortunately, I will not update this plugin for Craft 4. [@Miranj has a plugin](https://github.com/miranj/craft-obfuscator) with almost the same functionality. To use it with the same twig filters and make the transition more easy, I wrote a small module which you can install. 

#### Install migration module
1. Copy the migration module into `craft/modules`
2. Uninstall this plugin :( and install [Craft-Obfuscator](https://github.com/miranj/craft-obfuscator)
3. Update your site to Craft 4
4. Update your `composer.json` to autoload the module (see example file in folder) and run `composer dump-autoload -a`
5. Now your templates should work againg ;) 


## Credits
- [Propaganistas](https://github.com/Propaganistas) for developing this great Twig Extension
- [nystudio107](https://nystudio107.com/blog) for providing great articles on Craft3 plugin development



Brought to you by [Lucas Bares](http://luke.nehemedia.de)
