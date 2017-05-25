<?php
echo $this->Form->create($user);
echo $this->Form->control('name', [
    'label' => 'First name'
]);
echo $this->Form->control('surname', [
    'label' => 'Last name'
]);

echo $this->Form->control('username');
echo $this->Form->control('password');

echo $this->Form->control('type', [
    'options' => ['author' => 'Author', 'visitor' => 'Visitor']
]);
echo $this->Form->button('Submit');
echo $this->Form->end();
