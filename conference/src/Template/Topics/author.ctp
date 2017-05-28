<?php
/* @var $topics \App\Model\Entity\Topic[] */
?>

<header>
    <h1>Your topics</h1>
    <p>View the topics you created, edit and delete them and create new topics here</p>
</header>
<table>
    <thead>
    <tr>
        <th>Title</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach($topics as $topic): ?>
        <tr>
            <td><?= $topic->title ?></td>
            <td><?= $this->Html->link('Edit', ['action' => 'edit', $topic->id]); ?></td>
            <td>
                <?= $this->Form->postLink(
                    'Delete',
                    ['action' => 'delete', $topic->id],
                    ['confirm' => 'Are you sure you want to delete this topic?']
                ) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->Html->link('Add a new topic', ['action' => 'add'], ['class' => 'button']) ?>
