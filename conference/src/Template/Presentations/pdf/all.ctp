<?php
/* @var $this \Dompdf\View\PdfView */
/* @var $presentations \App\Model\Entity\Presentation[] */
?>

<?php $this->start('header'); ?>
<h1>Presentations</h1>
<?php $this->end(); ?>

<table cellspacing="10" cellpadding="10">
    <thead>
    <tr>
        <th>Room</th>
        <th>Topic</th>
        <th>Time</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($presentations as $presentation): ?>
    <tr>
        <td><?= $presentation->room->name ?></td>
        <td><?= $presentation->topic->title ?></td>
        <td><?= $presentation->date->format('d.m.Y H:i:s') ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
