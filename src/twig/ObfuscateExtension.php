<?php 
/**
 * Craft Emailobfuscator plugin for Craft CMS 3.x
 *
 * A simple plugin that adds a twig tag to obfuscate email addresses (by rot13) in text fields.
 *
 * @link      http://luke.nehemedia.de
 * @copyright Copyright (c) 2018 Lucas Bares
 */
namespace lucasbares\craftemailobfuscator\twig;

use Twig_Extension;
use Twig_SimpleFilter;


/**
 * Twig Extension
 *
 * Twig extension for "obfuscateEmail" - orgininal by propaganistas (no longer deployed on packagist)
 *
 * @author    Lucas Bares
 * @package   CraftEmailobfuscator
 * @since     2.1.0
 *
 */
class ObfuscateExtension extends Twig_Extension
{

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'craftemailobfuscator.emailObfuscator';
    }

    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array An array of filters
     */
    public function getFilters()
    {
        return array(
            new Twig_SimpleFilter(
                'obfuscateEmail',
                array($this, 'parse'),
                array('is_safe' => array('html'))
            ),
        );
    }

    /**
     * Twig filter callback.
     *
     * @return string Filtered content
     */
    public function parse($content)
    {
        return $this->_obfuscateEmail($content);
    }
    
    protected function _obfuscateEmail($string){
        // Casting $string to a string allows passing of objects implementing the __toString() magic method.
        $string = (string) $string;
    
        // Safeguard string.
        $safeguard = '$%$!!$%$';
    
        // Safeguard several stuff before parsing.
        $prevent = array(
            '|<input [^>]*@[^>]*>|is', // <input>
            '|(<textarea(?:[^>]*)>)(.*?)(</textarea>)|is', // <textarea>
            '|(<head(?:[^>]*)>)(.*?)(</head>)|is', // <head>
            '|(<script(?:[^>]*)>)(.*?)(</script>)|is', // <script>
        );
        foreach ($prevent as $pattern) {
            $string = preg_replace_callback($pattern, function ($matches) use ($safeguard) {
                return str_replace('@', $safeguard, $matches[0]);
            }, $string);
        }
    
        // Define patterns for extracting emails.
        $patterns = array(
            '|\<a[^>]+href\=\"mailto\:([^">?]+)(\?[^?">]+)?\"[^>]*\>(.*?)\<\/a\>|ism', // mailto anchors
            '|[_a-z0-9-]+(?:\.[_a-z0-9-]+)*@[a-z0-9-]+(?:\.[a-z0-9-]+)*(?:\.[a-z]{2,3})|i', // plain emails
        );
    
        foreach ($patterns as $pattern) {
            $string = preg_replace_callback($pattern, function ($parts) use ($safeguard) {
                // Clean up element parts.
                $parts = array_map('trim', $parts);
    
                // ROT13 implementation for JS-enabled browsers
                $js = '<script type="text/javascript">Rot13.write(' . "'" . str_rot13($parts[0]) . "'" . ');</script>';
    
                // Reversed direction implementation for non-JS browsers
                if (stripos($parts[0], '<a') === 0) {
                    // Mailto tag; if link content equals the email, just display the email, otherwise display a formatted string.
                    $nojs = ($parts[1] == $parts[3]) ? $parts[1] : (' > ' . $parts[1] . ' < ' . $parts[3]);
                } else {
                    // Plain email; display the plain email.
                    $nojs = $parts[0];
                }
                $nojs = '<noscript><span style="unicode-bidi:bidi-override;direction:rtl;">' . strrev($nojs) . '</span></noscript>';
    
                // Safeguard the obfuscation so it won't get picked up by the next iteration.
                return str_replace('@', $safeguard, $js . $nojs);
            }, $string);
        }
    
        // Revert all safeguards.
        return str_replace($safeguard, '@', $string);
    }

}