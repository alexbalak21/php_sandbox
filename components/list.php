<?php
function gen_list(array $array): string
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