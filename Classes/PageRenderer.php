<?php
/**
 * Created by PhpStorm.
 * User: mulegames
 * Date: 2/26/15
 * Time: 4:16 PM
 */

class PageRenderer {

    private $pageHtml = null;

    public function __construct($title) {
        $this->buildHead($title);
    }

    private function buildHead($title) {
        $this->pageHtml = "<!DOCTYPE html>\n" .
        "<html>\n" .
        "    <head>\n" .
        "        <title>MULE Games Analytics- $title</title>\n";
    }

    public function addPageElement() {
        $args = func_get_args();
        switch ($args[0]) {
            case "css":
                $this->pageHtml .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/$args[1].css\" media=\"screen\">";
                break;
            case "js":
                $this->pageHtml .= "<script type=\"text/javascript\" src=\"//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js\"></script>";
                break;
            default:
        }
    }

    public function getPageModal($modal) {
        return file_get_contents("Modals/".basename($modal).".php", true);
    }

    public function addPageModal($modal) {
        $this->pageHtml .= $modal;
    }

    public function renderPage() {
        echo $this->pageHtml;
    }
}