<?php
// Classe abstraite contrôleur de base pour tous les contrôleurs MVC du projet.
// Fournit des éléments communs (header, footer, modèle) à tous les contrôleurs concrets.
abstract class AbstractController {
    // Attributs principaux :
    // - $header : composant du header de la vue (ViewHeader)
    // - $footer : composant du footer de page (ViewFooter)
    // - $model : modèle métier qui doit implémenter l'interface InterfaceModel
    private ?ViewHeader $header;
    private ?ViewFooter $footer;
    private ?InterfaceModel $model;

    // Chaque setter retourne l'instance actuelle ($this)
    
    public function getHeader(): ?ViewHeader { return $this->header; }
    public function setHeader(?ViewHeader $header): self {
        $this->header = $header;
        return $this;
    }

    public function getFooter(): ?ViewFooter { return $this->footer; }
    public function setFooter(?ViewFooter $footer): self {
        $this->footer = $footer;
        return $this;
    }

    public function getModel(): ?InterfaceModel { return $this->model; }
    public function setModel(?InterfaceModel $model): self {
        $this->model = $model;
        return $this;
    }

    // Méthode abstraite à implémenter dans les classes enfants. Son but est de gérer l'affichage
    public abstract function render(): void;
}
