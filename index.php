<?php
/**
 * Created by PhpStorm.
 * User: Darren Eidson
 * Date: 2/26/15
 * Time: 11:18 AM
 */

ini_set('auto_detect_line_endings',TRUE);

require_once('Classes/GameEvents.php');
require_once('Classes/FileHandler.php');
require_once('Classes/Timeline.php');
require_once('Classes/PageRenderer.php');

$page = new PageRenderer('Timeline');
$page->addPageElement('css', 'Page');
$page->addPageElement('css', 'Timeline');

if (isset($_GET['file'])) {
    $data = new FileHandler();
    if (count($data->rows) > 0) {
        $events = new GameEvents($data->rows);
        $totalTime = ($events->lastTime - $events->firstTime);

        $timelineModal = $page->getPageModal('Timeline');
        $timeline = new Timeline($timelineModal, $totalTime);
        $timeline->printTimeline($events->eventList);
        $page->addPageModal($timeline->modal);
    }
}

//$page->addPageModal('Footer');
$page->renderPage();