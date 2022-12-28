<?php
class EnchereControleur extends Controleur
{

    function __construct($modele, $module, $action)
    {
        parent::__construct($modele, $module, $action);
    }

    /**
     * Méthode invoquée par défaut si aucune action n'est indiquée
     */
    public function index()
    {
        Utilitaire::nouvelleRoute('enchere/tout');
    }


    /**
     * Méthode qui permet l'affichage d'un timbre
     */
    public function un()
    {
        if (!isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('utilisateur/connexion');
        }
        $tmbe_id = $_GET['tmbe_id'];
        $this->gabarit->affecter('timbre', $this->modele->un($tmbe_id));
    }

    /**
     * Méthode qui permet la modification d'un timbre
     */
    public function modifie()
    {
        if (!isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('utilisateur/connexion');
        }

        $tmbe_id = $_GET['tmbe_id'];

        // ajouter des if pour la validaton
        $this->gabarit->affecter('timbre', $this->modele->un($tmbe_id));
    }


    public function nouveau()
    {
    }


    /**
     * Méthode qui permet l'affichage de tous les timbres
     */
    public function tout()
    {
        $this->gabarit->affecter('timbres', $this->modele->tout());
    }

    /**
     * Méthode qui permet l'affichage de tous les timbres d'un utilisateur connecté
     */
    public function mes()
    {
        if (!isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('utilisateur/connexion');
        }
        $this->gabarit->affecter('encheres', $this->modele->toutTimbre($_SESSION['utilisateur']->uti_id));
    }


    /**
     * Méthode qui permet l'ajout d'un timbre + image pour un utilisateur coonnecter
     */
    public function ajouterTimbre()
    {

        if (!isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('utilisateur/connexion');
        }
        $fileName = $_FILES['img_nom']['name'];
        $fileTmpName = $_FILES['img_nom']['tmp_name'];
        $fileError = $_FILES['img_nom']['error'];

        if (!$fileError) {
            $fileDestination = 'asset/imgBD/'.$fileName;
            move_uploaded_file($fileTmpName, $fileDestination);
        }
        // ajouter des if pour la validaton
        $this->modele->ajouterTimbre($_SESSION['utilisateur']->uti_id, $fileName);
        Utilitaire::nouvelleRoute('enchere/mes');
    }

    /**
     * Méthode qui permet la suppression d'Un timbre et de son image
     */
    public function supprimeTimbre()
    {
        if (!isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('utilisateur/connexion');
        }
        $id = $_POST['id'];
        $img = $_POST['tmbe_img'];
        $this->modele->supprimeTimbre($id);
        unlink('asset/imgBD/' . $img);
        Utilitaire::nouvelleRoute('enchere/mes');
    }

    /**
     * Méthode qui permet la modification d'un timbre avec id
     */
    public function modifierTimbre()
    {
        if (!isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('utilisateur/connexion');
        }
        $tmbe_id = $_POST['tmbe_id'];
        $this->modele->modifiertimbre($tmbe_id);
        Utilitaire::nouvelleRoute('enchere/mes');
    }


    /**
     * Méthode qui permet la mise sur une enchère
     */
    public function mise()
    {

        if (!isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('utilisateur/connexion');
        }
        $echre_prix = $_POST['echre_prix'];
        $mise_prix = $_POST['mise_prix'];
        $tmbe_id = $_POST['tmbe_id'];

        if ($mise_prix > $echre_prix) {
            $this->modele->mise($tmbe_id, $mise_prix, $_SESSION['utilisateur']->uti_id);
            Utilitaire::nouvelleRoute('enchere/tout');
        } else {
            Utilitaire::nouvelleRoute('enchere/un?tim_id=' . $tmbe_id);
        }
    }

    /**
     * Méthode qui permet la recherche
     */
    public function recherche()
    {
        $recherche = $_POST['recherche'];

        if ($_POST['recherche'] !== "") {
            $this->gabarit->affecter('timbres', $this->modele->recherche($recherche));
        } else {
            Utilitaire::nouvelleRoute('enchere/tout');
        }
    }
}
