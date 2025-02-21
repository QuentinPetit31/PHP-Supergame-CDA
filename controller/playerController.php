<?php
//LE CONTROLLER pour la class PlayerController

//__DIR__ me permet de récupérer le chemin absolu du fichier pour éviter une erreur de chargement malgré le bon chemin indiqué...(error: Failed to open stream: No such file or directory)

require_once __DIR__ . "/../abstract/abstractController.php";
require_once __DIR__ . "/../view/viewPlayer.php";
require_once __DIR__ . "/../model/playerModel.php";


class PlayerController extends AbstractController {
    public ViewPlayer $playerView;

    public function __construct() {
        $model = new ModelPlayer();
        parent::__construct($model);
        $this->playerView = new ViewPlayer();
    }

    public function addPlayer(): void {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['score']) && !empty($_POST['psswrd'])) {
                $message = $this->model->add($_POST);
                $this->playerView->setSignUpMessage($message);
            }
        }
    }

    public function getAllPlayers(): void {
        $players = $this->model->getAll();
        $html = "";

        if ($players) {
            foreach ($players as $player) {
                $html .= "<div class='player'>
                            <h3>{$player['pseudo']}</h3>
                            <p>Score : {$player['score']}</p>
                          </div>";
            }
        } else {
            $html = "<p>Aucun joueur trouvé.</p>";
        }

        $this->playerView->setPlayersList($html);
    }

    public function render(): void {
        $this->addPlayer();
        $this->getAllPlayers();
        $this->renderView($this->playerView->displayView());
    }
}

?>

