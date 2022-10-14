<?php
/**
 * @var $block TGHP\$tghp:classCase$\Blocks\ExampleBlock
 */

$blockClassName = $block->getCode();
?>
<?php if($blockClassName): ?>
    <div class="block <?= $blockClassName ?>">
        <div class="<?= $blockClassName ?>__title">
            <?= $block->getTitle() ?>
        </div>
    </div>
<?php endif ?>
