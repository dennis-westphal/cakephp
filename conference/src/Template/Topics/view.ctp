<?php
/* @var $topic \App\Model\Entity\Topic */
?>

<h1><?= $topic->title ?></h1>
<p class="author">Author: <?= $topic->user->name ?> <?= $topic->user->surname ?></p>

<?= $topic->description ?>
