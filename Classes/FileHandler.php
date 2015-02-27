<?php
/**
 * Created by PhpStorm.
 * User: Darren Eidson
 * Date: 2/26/15
 * Time: 3:16 PM
 */

class FileHandler {

    public $rows = array();

    public function __construct () {
        $this->getRowsFromFile();
        array_shift($this->rows);
    }

    private function getRowsFromFile() {
        if (($handle = fopen($_GET['file'], "r")) !== FALSE) {
            $data = array();
            while (($line = fgetcsv($handle, ",")) !== FALSE) {
                $num = count($line);
                $i = 0;
                for ($c = 0; $c < $num; $c++) {
                    array_push($data, $line[$c]);
                    $i++;
                    if (($i % 3) == 0) {
                        array_push($this->rows, implode(",", $data));
                        $data = array();
                        $i = 0;
                    }
                }
            }
            fclose($handle);
        }
    }
}