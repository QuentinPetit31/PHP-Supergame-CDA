<?php
//LE FICHIER POUR L'INTERFACE InterfaceModel

interface InterfaceModel {
    public function add(array $data): string;
    public function getAll(): ?array;
    public function getByEmail(string $email): ?array;
}

?>
