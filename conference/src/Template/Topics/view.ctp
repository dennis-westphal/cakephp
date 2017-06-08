<?php
/* @var $topic \App\Model\Entity\Topic */
?>

<h1><?= $topic->title ?></h1>
<p class="author">Author:
    <?= $this->Html->link($topic->user->name.' '.$topic->user->surname, ['action' => 'author', $topic->user->id]) ?>
</p>

<?= $topic->description ?>

<table>
    <thead>
    <tr>
        <th>Date</th>
        <th>Room</th>
        <th>Free places</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($topic->presentations as $presentation): ?>
    <tr>
        <td><?= $presentation->date->format('d.m.Y H:i:s') ?> (in <?= $this->Countdown->tillDate($presentation->date) ?>)</td>
        <td><?= $presentation->room->name ?></td>
        <td><?= $presentation->freeSpots ?></td>
        <td><?= $this->Html->link('Register', ['controller' => 'presentations', 'action' => 'register', $presentation->id]) ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
