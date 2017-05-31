<?php
/* @var $topic \App\Model\Entity\Topic */
/* @var $rooms \App\Model\Entity\Room[] */
?>

<h1><?= $topic->title ?></h1>

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
            <td><?= $presentation->date->format('d.m.Y H:i:s') ?></td>
            <td><?= $presentation->room->name ?></td>
            <td><?= $presentation->freeSpots ?></td>
            <td><?= $this->Html->link('Remove', ['action' => 'delete', $presentation->id]) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<h2>Add new presentation</h2>

<?= $this->Form->create(null, ['url' => ['action' => 'add', $topic->id]]) ?>
    <div class="row uniform">
        <div class="3u 12u$(small)">
            <?= $this->Form->select('room', $rooms, ['empty' => true, 'id' => 'room']) ?>

            <label for="room">Room</label>
        </div>
        <div class="3u 12u$(small)">
            <?= $this->Form->text('date', ['placeholder' => 'Date', 'disabled' => true, 'id' => 'date']) ?>
            <label for="date">Date</label>
        </div>
        <div class="3u$ 12u$(small)">
            <?= $this->Form->text('time', ['placeholder' => 'Time', 'disabled' => true, 'id' => 'time']) ?>
            <label for="time">Time</label>
        </div>
    </div>

    <div style="text-align: right">
        <?= $this->Form->submit('Save') ?>
    </div>
<?= $this->Form->end() ?>

<script>
    var dateTimeOptions = <?= json_encode($dateTimeOptions) ?>;
    var roomPresentationsUrl = '<?= \Cake\Routing\Router::url(['action' => 'room']) ?>';
</script>

<?php
    // Add script the presentations javascript that is used to handle the input fields
    $this->Html->script('presentations.js', ['block' => 'scriptBottom']);
?>
