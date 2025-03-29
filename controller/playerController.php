<?php
// Contrôleur qui gère les actions liées aux joueurs (Player)
class PlayerController extends AbstractController {
    // Attribut pour gérer l'affichage de la vue joueur
    private ?ViewPlayer $player;

    // Constructeur : initialise les vues (header, footer, player) et le modèle associé (ModelPlayer)
    public function __construct(){
        $this->player = new ViewPlayer();
        $this->setHeader(new ViewHeader());
        $this->setFooter(new ViewFooter());
        $this->setModel(new ModelPlayer());
    }

    // Getter et setter pour l'attribut $player
    public function getPlayer(): ?ViewPlayer { return $this->player; }
    public function setPlayer(?ViewPlayer $player): self { $this->player = $player; return $this; }

    public function addPlayer(): ?string {
        // Vérifie si le formulaire a été soumis
        if (isset($_POST['submit'])) {
    
            // Vérifie que tous les champs sont remplis
            if (empty($_POST['pseudo']) || empty($_POST['email']) || empty($_POST['score']) || empty($_POST['password'])) {
                return 'Veuillez remplir tous les champs !';
            }
    
            // Vérifie le format de l'email et du score (nomnbre entier attendu)
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || !filter_var($_POST['score'], FILTER_VALIDATE_INT)) {
                return 'Email et/ou score pas au bon format !';
            }
    
            // Nettoyage des données reçues
            $pseudo = sanitize($_POST['pseudo']);
            $email = sanitize($_POST['email']);
            $score = sanitize($_POST['score']);
            $password = sanitize($_POST['password']);
    
            // Hash du mot de passe (+de sécu)
            $password = password_hash($password, PASSWORD_BCRYPT);
    
            // Vérifie si un joueur utilise déjà cet email
            $model = $this->getModel();
            if ($model instanceof ModelPlayer) {
                $data = $model->setEmail($email)->getByEmail();
                if (!empty($data[0])) {
                    return 'Email déjà pris par un autre Joueur !';
                }
    
                // Enregistre le joueur en base de données
                return $model
                    ->setPseudo($pseudo)
                    ->setScore($score)
                    ->setPassword($password)
                    ->add();
            }
        }
    
        // Aucun formulaire soumis => ne rien faire
        return '';
    }
    
    
    // Méthode pour récupérer et afficher tous les joueurs
    public function getAllPlayers(): ?string {
        // Récupère tous les joueurs depuis la base de données
        $data = $this->getModel()->getAll();
        $playersList = '';

        // Génère un petit bloc HTML avec pseudo et score du joueur
        foreach($data as $player){
            ob_start();
?>
            <article>
                <h2><?php echo $player['pseudo']." - ".$player['score'] ?></h2>
            </article>
<?php
            $playersList .= ob_get_clean();
        }

        return $playersList;
    }

    // Méthode principale pour afficher la page joueur avec header, contenu et footer
    public function render(): void {
        echo $this->getHeader()->displayView(); // Affiche le header

        // Gère l'ajout de joueur + récupère tous les joueurs + affiche la vue joueur
        echo $this->getPlayer()
                  ->setSignUpMessage($this->addPlayer())
                  ->setPlayersList($this->getAllPlayers())
                  ->displayView();

        echo $this->getFooter()->displayView(); // Affiche le footer
    }
}
