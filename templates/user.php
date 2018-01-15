<?php
/**
 * @var User $user
 */
?>
<?= $this->renderInclude('includes/header') ?>
<section>
    <h1><?=$user->fullName()?></h1>
</section>