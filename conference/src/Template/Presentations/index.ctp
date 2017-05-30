<?php
/* @var $topic \App\Model\Entity\Topic */
?>

<h1><?= $topic->title ?></h1>

<table>
    <thead>
    <tr>
        <th>Date</th>
        <th>Free places</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($topic->presentations as $presentation): ?>
        <tr>
            <td><?= $presentation->date->format('d.m.Y H:i:s') ?></td>
            <td><?= $presentation->freeSpots ?></td>
            <td><?= $this->Html->link('Remove', ['action' => 'delete', $presentation->id]) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<h2>Add new presentation</h2>

<form>
    <input type="date" name="day" />
</form>

<script>
    var minDate = new Date('<?= $minDate ?>');
    var maxDate = new Date('<?= $maxDate ?>');
    var minTime = '<?= $minTime ?>';
    var maxTime = '<?= $maxTime ?>';
</script>

<?php
    $this->Html->script('presentations.js', ['block' => 'scriptBottom']);
?>
