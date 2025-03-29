<?php
// Interface que tous les modèles doivent suivre
interface InterfaceModel {
    
    // Ajoute un élément dans la bdd
    public function add(): string;

    // Récupère tous les éléments de la bdds
    public function getAll(): array | null;
}
