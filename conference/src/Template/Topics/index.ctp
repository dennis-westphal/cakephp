<?php
/* @var $topics \App\Model\Entity\Topic[] */
?>

<table class="striped">
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th></th>
        </tr>
    </thead>
    <?php foreach($topics as $topic): ?>
        <tr>
            <td><?= $topic->title ?></td>
            <td><?= $topic->user->name ?> <?= $topic->user->surname ?></td>
            <td><?= $this->Html->link('Details', ['action' =>'view', $topic->id]) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
