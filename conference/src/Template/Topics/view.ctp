<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Topic'), ['action' => 'edit', $topic->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Topic'), ['action' => 'delete', $topic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $topic->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Topics'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Topic'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Presentations'), ['controller' => 'Presentations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Presentation'), ['controller' => 'Presentations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="topics view large-9 medium-8 columns content">
    <h3><?= h($topic->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $topic->has('user') ? $this->Html->link($topic->user->name, ['controller' => 'Users', 'action' => 'view', $topic->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($topic->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($topic->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($topic->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($topic->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($topic->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Presentations') ?></h4>
        <?php if (!empty($topic->presentations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Topic Id') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('FreeSpots') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($topic->presentations as $presentations): ?>
            <tr>
                <td><?= h($presentations->id) ?></td>
                <td><?= h($presentations->topic_id) ?></td>
                <td><?= h($presentations->date) ?></td>
                <td><?= h($presentations->freeSpots) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Presentations', 'action' => 'view', $presentations->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Presentations', 'action' => 'edit', $presentations->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Presentations', 'action' => 'delete', $presentations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $presentations->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
