<?php

echo $this->Form->create($topic);

echo $this->Form->control('title');
echo $this->Form->control('teaser');
echo $this->Form->control('description', [
    'rows' => 4
]);
echo $this->Form->control('author_id', [
    'options' => $authors
]);
echo $this->Form->submit('Save');
echo $this->Form->end();

echo $this->Html->link('Manage presentations',
    ['controller' => 'presentations', 'action' => 'manage', $topic->id],
    ['class' => 'button']
);
