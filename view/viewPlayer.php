<?php
// Gère l'affichage de la page joueur (formulaire + liste)
class ViewPlayer {

    // Message d'inscription + liste des joueurs
    private ?string $signUpMessage = '';
    private ?string $playersList = '';

    // Getters et setters
    public function getSignUpMessage(): ?string {
        return $this->signUpMessage;
    }

    public function setSignUpMessage(?string $message): ViewPlayer {
        $this->signUpMessage = $message;
        return $this;
    }

    public function getPlayersList(): ?string {
        return $this->playersList;
    }

    public function setPlayersList(?string $playersList): ViewPlayer {
        $this->playersList = $playersList;
        return $this;
    }

    // Affiche le formulaire d'inscription et la liste des joueurs
    public function displayView(): string {
        ob_start();
?>
        <h1>Inscription d'un Joueur</h1>
<form action="" method="post">
    <input type="text" name="pseudo" placeholder="Votre Pseudo">
    <input type="text" name="email" placeholder="Votre Email">
    <input type="text" name="password" placeholder="Votre Mot de Passe">
    <input type="number" name="score" placeholder="Votre Score">
    <input type="submit" name="submit" value="Envoyer">
</form>

<p><?php echo $this->getSignUpMessage() ?></p>

<h2>Liste des Joueurs</h2>
<section>
    <?php echo $this->getPlayersList() ?>
</section>

<?php
        return ob_get_clean();
    }
}
