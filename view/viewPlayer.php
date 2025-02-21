<?php
//LA VIEW POUR LA CLASS ViewPlayer


class ViewPlayer {
    public string $signUpMessage = "";
    public string $playersList = "";

    // Ajout de la méthode setSignUpMessage()
    public function setSignUpMessage(string $message) {
        $this->signUpMessage = $message;
    }

    // Ajout de la méthode setPlayersList()
    public function setPlayersList(string $playersList) {
        $this->playersList = $playersList;
    }

    public function displayView(): string {
        return "
            <h1>Accueil</h1>
            <h2>Inscription d'un Joueur</h2>
            <form method='post' action='index.php'>
                <input type='text' name='pseudo' placeholder='Votre Pseudo' required>
                <input type='email' name='email' placeholder='Votre Email' required>
                <input type='password' name='psswrd' placeholder='Votre Mot de Passe' required>
                <input type='number' name='score' placeholder='Votre Score' required>
                <button type='submit'>Envoyer</button>
            </form>
            <p>{$this->signUpMessage}</p>
            <h2>Liste des joueurs</h2>
            {$this->playersList}
        ";
    }
}

?>

