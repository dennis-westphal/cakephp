<?php
/* @var $presentations \App\Model\Entity\Presentation[] */
$output = [];
// Iterate over all presentations
foreach($presentations as $presentation) {
    // Get day and hour/minute
    $day = $presentation->date->format('d.m.Y');
    $hourMinute = $presentation->date->format('h:i');

    // Add the hour/minute to the output array under the day
    $output[$day][] = $hourMinute;
}

echo json_encode($output);
