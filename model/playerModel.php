<?php
// Modèle qui gère les données des joueurs (Player)
class ModelPlayer implements InterfaceModel {
    
    // Attributs liés aux infos du joueur + connexion à la base de données
    private ?int $id;
    private ?string $pseudo;
    private ?string $email;
    private ?int $score;
    private ?string $password;
    private ?PDO $bdd;

    // Constructeur : se connecte à la base de données grâce à la fonction connect()
    public function __construct(){
        $this->bdd = connect();
    }

    // Getters et setters pour accéder et modifier les données du joueur

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }

    public function getPseudo(): ?string { return $this->pseudo; }
    public function setPseudo(?string $pseudo): self { $this->pseudo = $pseudo; return $this; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(?string $email): self { $this->email = $email; return $this; }

    public function getScore(): ?int { return $this->score; }
    public function setScore(?int $score): self { $this->score = $score; return $this; }

    public function getPassword(): ?string { return $this->password; }
    public function setPassword(?string $password): self { $this->password = $password; return $this; }

    public function getBdd(): ?PDO { return $this->bdd; }
    public function setBdd(?PDO $bdd): self { $this->bdd = $bdd; return $this; }

    // Ajoute un joueur dans la base de données
    public function add(): string {
        try {
            $pseudo = $this->getPseudo();
            $email = $this->getEmail();
            $score = $this->getScore();
            $password = $this->getPassword();

            // Prépare la requête SQL pour insérer un joueur
            $req = $this->getBdd()->prepare('INSERT INTO players (pseudo, email, score, psswrd) VALUES (?,?,?,?)');

            // Lie les valeurs aux paramètres de la requête
            $req->bindParam(1, $pseudo, PDO::PARAM_STR);
            $req->bindParam(2, $email, PDO::PARAM_STR);
            $req->bindParam(3, $score, PDO::PARAM_INT);
            $req->bindParam(4, $password, PDO::PARAM_STR);

            $req->execute();

            return "$pseudo a été enregistré avec succès !";

        } catch (Exception $error) {
            // En cas d'erreur, on retourne le message
            return $error->getMessage();
        }
    }

    // Récupère tous les joueurs enregistrés dans la bdd
    public function getAll(): array | null {
        try {
            $req = $this->getBdd()->prepare('SELECT id, pseudo, email, score, psswrd FROM players');
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            return $data;

        } catch (Exception $error) {
            echo $error->getMessage();
        }
    }

    // Récupère un joueur grâce à son email
    public function getByEmail(): array | null {
        try {
            $email = $this->getEmail();
            $req = $this->getBdd()->prepare('SELECT id, pseudo, email, score, psswrd FROM players WHERE email = ?');
            $req->bindParam(1, $email, PDO::PARAM_STR);
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            return $data;

        } catch (Exception $error) {
            echo $error->getMessage();
        }
    }
}
