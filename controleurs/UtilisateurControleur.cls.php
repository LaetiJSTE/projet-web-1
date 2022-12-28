<?php
class UtilisateurControleur extends Controleur
{

    function __construct($modele, $module, $action)
    {
        parent::__construct($modele, $module, $action);
        if (isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('accueil/index');
        }
    }

    /**
     * Méthode invoquée par défaut si aucune action n'est indiquée
     */
    public function index()
    {
        
    }

    public function un(){

    }

   
    public function nouveau()
    {
    }
    public function connexion()
    {
    }



    /**
     * Méthode qui permet d'ajouter un elm dans la DB et redirection vers la page de connexion
     */
    public function ajouter()
    {
        $this->modele->ajouter($_POST);
        Utilitaire::nouvelleRoute('utilisateur/connexion');
    }


    /**
     * Méthode qui permet aux uti de se connecter
     */
    public function connecter()
    {

        $courriel = $_POST['uti_courriel'];
        $mdp = $_POST['uti_mdp'];

        $utilisateur = $this->modele->un($courriel);

         // ajouter des if pour la validaton
        $erreur = false;
        if (!$utilisateur || !password_verify($mdp, $utilisateur->uti_mdp)) {
            $erreur = "Combinaison courriel/mot de passe erronée";
        }


        if (!$erreur &&  !$courriel == "" && ! $mdp== "") {
            // Sauvegarder l'état de connexion
            $_SESSION['utilisateur'] = $utilisateur;

            //Rediriger vers 
            Utilitaire::nouvelleRoute('accueil/index');
        } else {
            
            $this->gabarit->affecterActionParDefaut('index');
           
        }
    }

    /**
     * Méthode qui permet aux uti de se deconnecter
     */
    public function deconnexion()
    {
        unset($_SESSION['utilisateur']);
        Utilitaire::nouvelleRoute('accueil/index');
    }
}
