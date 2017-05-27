<?php
/* @var $topics \App\Model\Entity\Topic[] */
?>

<header>
    <h1>Join our conference</h1>
    <p>Get more details about available topics and presentations here</p>
</header>
<section class="tiles">
    <?php foreach($topics as $topic): ?>
        <article>
            <span class="image">
                <?= $this->Html->image('pic' . $topic->id . '.jpg') ?>
            </span>
            <a href="<?= $this->Url->build(['action' =>'view', $topic->id]) ?>">
                <h2><?= $topic->title ?></h2>
                <div class="content">
                    <p><?= $topic->teaser ?></p>
                </div>
            </a>
        </article>
    <?php endforeach; ?>
</section>
