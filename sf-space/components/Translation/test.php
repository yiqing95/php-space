<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/24
 * Time: 20:45
 */

require_once(__DIR__ . DIRECTORY_SEPARATOR . str_repeat('../',3). 'bootstrap.php');

?>
<?php
/**
 * 此组件的核心访问点是 Translator
 */

use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\MessageSelector;

/**
 * + ---------------------------------------------------- +
 *
 * The term locale refers roughly to the user's language and country.
 * It can be any string that your application uses to manage translations and other format differences (e.g. currency format).
 * The ISO 639-1 language code, an underscore (_), then the ISO 3166-1 alpha-2 country code (e.g. fr_FR for French/France) is recommended.
 *
 * + ----------------------------------------------------- +
 */
$translator = new Translator('zh_CN', new MessageSelector());

/**
 * The component comes with some default Loaders and you can create your own Loader too
 *
 * At first, you should add one or more loaders to the Translator:
 */

// ...
$translator->addLoader('array', new ArrayLoader());

// ...
$translator->addResource('array', array(
    'Hello World!' => 'Bonjour',
), 'fr_FR');

// ...
$translator->addLoader('yaml', new YamlFileLoader());
$translator->addResource('yaml', 'path/to/messages.fr.yml', 'fr_FR');

// ...
$translator->setFallbackLocales(array('en'));

