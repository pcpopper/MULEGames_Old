<?php
require_once('GameEvent.php');
/**
 * Created by PhpStorm.
 * User: Darren Eidson
 * Date: 2/26/15
 * Time: 12:10 PM
 */

class GameEvents {

    public $firstTime = 100;
    public $lastTime = 0;
    public $eventList = array();

    public function __construct() {
        $args = func_get_args();
        if (count($args)) {
            foreach ($args as $event) {
                $this->constructData($event);
            }
        }
    }

    private function constructData($data) {
        foreach ($data as $event) {
            $data = new GameEvent();
            $splitEvent = explode(",", $event);
            foreach ($splitEvent as $value) {
                $text = explode(":", $value);
                switch ($text[0]) {
                    case 'Time':
                        array_shift($text);
                        $data->localTime = trim(implode(":", $text));
                        break;
                    case 'Game Time':
                        $data->gameTime = trim($text[1]);
                        break;
                    default:
                        $data->gameEvent = trim(implode("", $text));
                }
            }
            $this->setMinMax($data->gameTime);
            array_push($this->eventList, $data);
        }
    }

    private function setMinMax($time) {
        if ($time < $this->firstTime) {
            $this->firstTime = $time;
        }

        if ($time > $this->lastTime) {
            $this->lastTime = $time;
        }
    }

}