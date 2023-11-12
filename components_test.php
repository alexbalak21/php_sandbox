<?php
$test = "Test inner content";
?>

<?php ob_start(); ?>
<h1><?= $test ?></h1>
<?php $component = ob_get_clean(); ?>


<?php
$component2 = <<<COMP
<h2>$test</h2>
<div>

</div>
COMP;
echo $component2;
?>

<?php

?>


<!-- COMPONENT TEST ON A LIST -->



<?php
function gen_list(array $array)
{


    ob_start(); ?>
    <ul>
        <?php foreach ($array as $item) : ?>
            <li><?= $item ?></li>
        <?php endforeach ?>
    </ul>
<?php return ob_get_clean();
}
?>

<div>
    <h1>List</h1>
    <?= gen_list([1, 2, 3, 4, 5]) ?>
</div>