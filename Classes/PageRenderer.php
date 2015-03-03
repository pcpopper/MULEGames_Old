<?php
/**
 * Created by PhpStorm.
 * User: mulegames
 * Date: 2/26/15
 * Time: 4:16 PM
 */

class PageRenderer {

    public $pageElements = null;
    public $pageTitle = null;

    public function __construct($title) {
        $this->pageTitle = $title;
    }

    public function addPageElement($type, $file) {
        switch ($type) {
            case 'css':
                $this->pageElements .= "        <link rel=\"stylesheet\" type=\"text/css\" href=\"css/$file.css\" media=\"screen\">\n";
                break;
            case 'js':
                $this->pageElements .= "        <script type=\"text/javascript\" src=\"js/$file.js\"></script>\n";
                break;
            default:
        }
    }

    public function getPageModal($modal) {
        return file_get_contents("Modals/".basename($modal).".php", true);
    }

    public function addPageModal($modal) {
        echo $modal;
    }

    public function parsePageModal() {
        $args = func_get_args();
        $modal = $this->getPageModal($args[0]);
        $parseArray = $args[1];

        foreach ($parseArray as $item) {
            $modal = str_replace($item[0], $item[2], $modal);
            print_r($item[0]);
        }

        echo $modal;
    }

    public function includePageModal($modal) {
        include("Modals/" . basename($modal) . ".php");
    }
}