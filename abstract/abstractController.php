<?php
//LA CLASSE ABSTRAITE AbstractController.php

abstract class AbstractController {
    public ViewHeader $header;
    public ViewFooter $footer;
    public InterfaceModel $model;

    public function __construct(InterfaceModel $model) {
        $this->header = new ViewHeader();
        $this->footer = new ViewFooter();
        $this->model = $model;
    }

    public function renderView(string $content): void {
        echo $this->header->displayView();
        echo $content;
        echo $this->footer->displayView();
    }
}

?>

