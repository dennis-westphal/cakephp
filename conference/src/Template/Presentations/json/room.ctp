<?php
/* @var $presentations \App\Model\Entity\Presentation[] */

$output = [];
// Iterate over all presentations
foreach($presentations as $presentation) {
    // Get day and hour/minute
    $day = $presentation->date->format('d.m.Y');
    $hourMinuteStart = $presentation->date->format('h:i');

    // Construct the end date by adding the time presentations take
    $endDate = $presentation->date->add(new \DateInterval('PT'.$interval.'M'));
    $hourMinuteEnd = $endDate->format('h:i');

    // The duration is an array with start and end time
    $duration = [$hourMinuteStart, $hourMinuteEnd];

    // Add the presentation's duration to the output array under the day
    $output[$day][] = $duration;
}

echo json_encode($output);
