<?php
//MODEL POUR LA CLASS ModelPlayer


class ModelPlayer implements InterfaceModel {
    public PDO $bdd;

    public function __construct() {
        try {
            $this->bdd = new PDO("mysql:host=localhost;dbname=supergame", "root", ""); 
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function add(array $data): string {
        $query = $this->bdd->prepare("INSERT INTO players (pseudo, email, score, pssword) VALUES (?, ?, ?, ?)");
        $query->execute([$data['pseudo'], $data['email'], $data['score'], $data['psswrd']]);
        
        return "{$data['pseudo']} a été ajouté en BDD.";
    }

    public function getAll(): ?array {
        $query = $this->bdd->query("SELECT pseudo, score FROM players ORDER BY score DESC");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByEmail(string $email): ?array {
        $query = $this->bdd->prepare("SELECT * FROM players WHERE email = ?");
        $query->execute([$email]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}

?>
