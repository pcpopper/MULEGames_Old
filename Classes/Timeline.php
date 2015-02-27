<?php
/**
 * Created by PhpStorm.
 * User: Darren Eidson
 * Date: 2/26/15
 * Time: 4:10 PM
 */

class Timeline {

    public $modal = null;
    private $magnification = 10;

    public function __construct($modal, $totalTime) {
        $this->modal = $modal;
        $width = round($totalTime * $this->magnification) . "px;";
        $this->modal = str_ireplace('timelineLine', "timelineLine\" style=\"width: $width", $this->modal);
        $this->addTimeStamps($totalTime);
    }

    private function addTimeStamps($totalTime) {
        $i = 0;
        $timeStamps = null;
        while ($i < $totalTime) {
            $left = ($i * $this->magnification) . "px;";
            $seconds = $i . "s";
            if (($i % 50) == 0) {
                $timeStamps .= "        <div id=\"timelineTimeStampMajor\" style=\"left: $left\">$seconds</div>\n";
            } else {
                $timeStamps .= "        <div id=\"timelineTimeStampMinor\" style=\"left: $left\">$seconds</div>\n";
            }
            $i += 10;
        }
        $this->modal = str_ireplace('##timestamps##', $timeStamps, $this->modal);
    }

    public function printTimeline($events) {
        $blankLine =  "|<br>";
        $timeline = $blankLine . $blankLine;
        $i = 0;
        foreach ($events as $event) {
            $timeline .= '|--' . $event->gameTime . '--' . $event->gameEvent . '<br>' . $blankLine . $blankLine;
            $i++;
            if ($i >= 10) {
                break;
            }
        }
        $timeline .= $blankLine . $blankLine;
        $this->modal = str_ireplace('##content##', $timeline, $this->modal);
    }

}