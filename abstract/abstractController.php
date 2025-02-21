<?php
//LA CLASSE ABSTRAITE AbstractController.php

abstract class AbstractController {
    private ViewHeader $header;
    private ViewFooter $footer;
    private InterfaceModel $model;

    private function __construct(InterfaceModel $model) {
        $this->header = new ViewHeader();
        $this->footer = new ViewFooter();
        $this->model = $model;
    }

    private function renderView(string $content): void {
        echo $this->header->displayView();
        echo $content;
        echo $this->footer->displayView();
    }
}

?>

