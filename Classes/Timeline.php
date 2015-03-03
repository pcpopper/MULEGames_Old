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

    public function __construct($modal, $totalTime, $eventList) {
        $this->modal = $modal;
        $width = ceil(($totalTime * $this->magnification) / 100) * 100 . "px;";
        $this->modal = str_ireplace('timelineLine', "timelineLine\" style=\"width: $width", $this->modal);
        $this->addEventLines($eventList);
        $this->addTimeStamps($totalTime);
    }

    private function addEventLines($eventList) {
//        $i = 0;
//        $eventLine = null;
//        foreach ($eventList as $event) {
//            $eventLine .= "            <div class=\"eventLine\" id=\"event_$i\"><div class=\"circle\"></div></div>";
//            $i++;
//            if ($i >= 10) {
//                break;
//            }
//        }
//        $this->modal =  str_ireplace('##content##', $eventLine, $this->modal);
    }

    private function addTimeStamps($totalTime) {
        $i = 0;
        $minus = 0;
        $timeStamps = null;
        $timeStampLines = null;
        while ($i < $totalTime) {
            $minus -= 1;
            $lineLeft = ($i * $this->magnification + $minus) . "px;";
            $seconds = $i . "s";
            if (($i % 50) == 0) {
                $timeStamps .= "                <div class=\"timelineTimeStampMajor\">$seconds</div>\n";
            } else {
                $timeStamps .= "                <div class=\"timelineTimeStampMinor\">$seconds</div>\n";
            }
            $timeStampLines .= "                <div class=\"timelineTimeStampLine\" style=\"left: $lineLeft\"></div>\n";
            $i += 10;
        }
        $lineLeft = (round($totalTime) * $this->magnification + $minus + 1) . "px;";
        $seconds = $i . "s";
        $timeStamps .= "                <div class=\"timelineTimeStampMinor\">$seconds</div>\n";
        $timeStampLines .= "                <div class=\"timelineTimeStampLine\" style=\"left: $lineLeft\"></div>\n";
        $this->modal = str_ireplace('##timestamps##', ltrim($timeStamps), $this->modal);
        $this->modal = str_ireplace('##image##', ltrim($timeStampLines), $this->modal);
    }
}