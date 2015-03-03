<?php
/**
 * Created by PhpStorm.
 * User: Darren Eidson
 * Date: 2/26/15
 * Time: 11:18 AM
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('auto_detect_line_endings',TRUE);

require_once('Classes/GameEvents.php');
require_once('Classes/FileHandler.php');
require_once('Classes/Timeline.php');
require_once('Classes/PageRenderer.php');

$page = new PageRenderer('Timeline');
$page->addPageElement('css','Page');
$page->addPageElement('css','Timeline');
$page->addPageElement('js','prototype');
$page->addPageElement('js','timeline');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>MULE Games Analytics- <?php echo $page->pageTitle ?></title>
        <?php echo ltrim($page->pageElements) ?>
    </head>
    <body>
<?php

if (isset($_GET['file'])) {
    $data = new FileHandler();
    if (count($data->rows) > 0) {
        $events = new GameEvents($data->rows);
        $totalTime = ($events->lastTime - $events->firstTime);
?>
        <script>
            Event.observe(window, 'load', function() {
                var timeline = new Timeline('<?php echo json_encode($events->eventList) ?>');
            });
        </script>
<?php
        $timelineModal = $page->getPageModal('Timeline');
        $timeline = new Timeline($timelineModal, $totalTime, $events->eventList);
//        $timeline->printTimeline($events->eventList);
        $page->addPageModal($timeline->modal);
    }
}

//$i = 0;
//while ($i < 28) {
//    $x = (100 * $i) + 18;
//    $left = $x . "px;";
//    $i++;
//    echo "<div style=\"height: 100px; width: 1px; background: red; position: absolute; top: 550px; left: $left\"></div>\n";
//}
//echo "<div style=\"height: 100px; width: 1px; background: red; position: absolute; top: 550px; left: 2800px;\"></div>\n";

$page->includePageModal('footer');
