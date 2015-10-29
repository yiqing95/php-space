<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/9/29
 * Time: 8:59
 */
?>

Hello , <?php echo $firstname ?> !


<?php $names = array('Fabien', 'yiqing') ?>
<?php foreach ($names as $name) : ?>
    <?php echo $view->render('_part.php', array('firstname' => $name)) ?>
<?php endforeach ?>

gloable var：
<p>The google tracking code is: <?php echo $ga_tracking ?></p>
