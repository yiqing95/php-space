<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/28
 * Time: 1:44
 */

/**
 * # --------------------------------------------------------------------- #
 *
 *  http://slides.rmcreative.ru/2015/fwdays-i18n-l10n/#/
 *
 * # --------------------------------------------------------------------- #
 */
// using composer here !
require_once(__DIR__ . DIRECTORY_SEPARATOR . str_repeat('../', 1) . 'bootstrap.php');

echo \MessageFormatter::formatMessage(
    'en_US', 'Value: {value, number}', ['value' => 123456,789]
);
// Value: 123,456.789

echo \MessageFormatter::formatMessage(
    'en_US', 'Price: {price, number, currency}', ['price' => 100]
);
// Price: $100.00

echo \MessageFormatter::formatMessage(
    'en_US', 'Value: {value, number, percent}', ['value' => 123]
);
// Value: 123%


// Date and time

echo \MessageFormatter::formatMessage(
    'en_US', 'Date: {d, date, short} | {d, date, medium} | {d, date, long}
     | {d, date, full}', ['d' => $d]
);
// Date: 4/18/15 | Apr 18, 2015 | April 18, 2015
//| Saturday, April 18, 2015

echo \MessageFormatter::formatMessage(
    'ru_UA', 'Date: {d, date, short} | {d, date, medium} | {d, date, long}
     | {d, date, full}', ['d' => $d]
);

// Дата: 18.04.15 | 18 апр. 2015 г. | 18 апреля 2015 г.
//   | суббота, 18 апреля 2015 г.

//Spellout
echo \MessageFormatter::formatMessage(
    'en_US', '{n,number} is spelled as {n, spellout}', ['n' => 42]
);
// 42 is spelled as forty-two

echo \MessageFormatter::formatMessage(
    'en_US', 'I am {n, spellout,%spellout-ordinal} agent', ['n' => 47]
);
// I am forty-seventh agent

// Plurals
$message = 'Здесь {n, plural, =0{котов нет} =1{есть один кот} one{# кот}
            few{# кота} many{# котов} other{# кота}}!';
echo \MessageFormatter::formatMessage('ru_UA', $message, ['n' => 1]);
// Здесь есть один кот!

$message = 'There {n, plural, =0{are no cats}
            =1{is one cat} other{are # cats}}!';
echo \MessageFormatter::formatMessage('en_US', $message, ['n' => 1]);
// There is one cat!

/**
 * ## ------------------------------------------------------------------------------  ##
 *                                   Using  yii
 *
 */
UsingYii() ;

echo \Yii::t('app', 'You are the {n, ordinal} visitor here!', ['n' => 42]);
// You are the 42nd visitor here!

echo \Yii::t('app', '{name} is a {gender} and {gender, select, female{she}
    male{he} other{it}} loves Yii!', [
    'name' => 'Snoopy',
    'gender' => 'dog',
]);
// Snoopy is a dog and it loves Yii!


$message = 'There {0, plural, =0{are no cats}
            =1{is one cat} other{are # cats}} except {1}!';
echo \MessageFormatter::formatMessage('en_US', $message, [1, 'Simon']);