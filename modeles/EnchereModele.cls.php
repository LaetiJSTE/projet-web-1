<?php
class EnchereModele extends AccesBd
{
    /**
     * requete SQL INSERT - ajout un timbre dans différentes tables
     */
    public function ajouterTimbre($uti_id, $fileName)
    {
        $tmbe_id =
            $this->creer(
                "INSERT INTO timbre 
                        VALUES (0,:tmbe_nom, :tmbe_creation, :tmbe_pays, :tmbe_couleurs, :tmbe_conditions,:tmbe_dimensions,:tmbe_certifie, :tmbe_uti_id)",
                [
                    'tmbe_nom' => $_POST['tmbe_nom'],
                    'tmbe_creation' => $_POST['tmbe_creation'],
                    'tmbe_pays' => $_POST['tmbe_pays'],
                    'tmbe_couleurs' => $_POST['tmbe_couleurs'],
                    'tmbe_conditions' => $_POST['tmbe_conditions'],
                    'tmbe_dimensions' => $_POST['tmbe_dimensions'],
                    'tmbe_certifie' => $_POST['tmbe_certifie'],
                    'tmbe_uti_id' => $uti_id
                ]
            );

        $this->creer(
            "INSERT INTO enchere 
                    VALUES (0,:echre_prix,0,:echre_dateDebut, :echre_dateFin,0,0,:echre_uti_id, :echre_tmbe_id)",
            [
                'echre_prix' => $_POST['echre_prix'],
                'echre_dateDebut' => $_POST['echre_dateDebut'],
                'echre_dateFin' => $_POST['echre_dateFin'],
                'echre_uti_id' => $uti_id,
                'echre_tmbe_id' => $tmbe_id
            ]
        );


        $this->creer(
            "INSERT INTO image (img_nom, img_tmbe_id) 
                        VALUES (:img_nom, :img_tmbe_id)",
            ['img_nom' => $fileName, 'img_tmbe_id' => $tmbe_id]
        );
    }


    /**
     * requetes SQL delete - suppression d'une enchère 
     */
    public function supprimeTimbre($id)
    {
        $this->supprimer(
            "DELETE FROM enchere 
                    where echre_tmbe_id = :echre_tmbe_id",
            ['echre_tmbe_id' => $id]
        );
        $this->supprimer(
            "DELETE FROM image 
                    where img_tmbe_id = :img_tmbe_id",
            ['img_tmbe_id' => $id]
        );
        $this->supprimer(
            "DELETE FROM timbre 
                    where tmbe_id = :tmbe_id",
            ['tmbe_id' => $id]
        );
    }


    /**
     * requete SQL select  - afficher TOUT les timbres 
     */
    public function toutTimbre($uti_id)
    {
        $sql =
            "SELECT * FROM timbre 
                    JOIN image ON img_tmbe_id = tmbe_id 
                    JOIN enchere ON echre_tmbe_id = tmbe_id 
                    WHERE tmbe_uti_id = $uti_id";

        return $this->lireTout($sql);
    }

    /**
     * requete SQL select  - afficher UN timbre
     */
    public function un($tmbe_id)
    {
        $sql =
            "SELECT * FROM timbre 
                    JOIN enchere ON echre_tmbe_id = tmbe_id
                    JOIN image ON img_tmbe_id = tmbe_id
                    WHERE tmbe_id = $tmbe_id";

        return $this->lireUn($sql);
    }

    /**
     * requete SQL update  - modifier un timbre 
     */
    public function modifierTimbre($tmbe_id)
    {
        $this->modifier(
            "UPDATE timbre 
                SET tmbe_nom=:tmbe_nom, tmbe_creation=:tmbe_creation, tmbe_pays = :tmbe_pays, tmbe_couleurs=:tmbe_couleurs, tmbe_conditions=:tmbe_conditions,tmbe_dimensions=:tmbe_dimensions,tmbe_certifie=:tmbe_certifie
                WHERE tmbe_id=:tmbe_id",
            [
                'tmbe_nom' => $_POST['tmbe_nom'],
                'tmbe_creation' => $_POST['tmbe_creation'],
                'tmbe_pays' => $_POST['tmbe_pays'],
                'tmbe_couleurs' => $_POST['tmbe_couleurs'],
                'tmbe_conditions' => $_POST['tmbe_conditions'],
                'tmbe_dimensions' => $_POST['tmbe_dimensions'],
                'tmbe_certifie' => $_POST['tmbe_certifie'],
                'tmbe_id' => $tmbe_id
            ]
        );
    }

    /**
     * requete SQL select  - afficher tout dans un timbre
     */
    public function tout()
    {

        $sql = "SELECT * FROM timbre 
        JOIN image ON img_tmbe_id = tmbe_id 
        JOIN enchere ON echre_tmbe_id = tmbe_id ";
        return $this->lireTout($sql);
    }

    /**
     * requete SQL insert et UPDATE - ajouter une mise et modifier la table enchère
     */
    public function mise($tmbe_id, $mise_prix, $uti_id)
    {
        $this->creer(
            "INSERT INTO mise VALUES (:mise_prix, :mise_uti_id, :mise_echre_id)",
            [
                'mise_prix' => $mise_prix,
                'mise_uti_id' => $uti_id,
                'mise_echre_id' => $tmbe_id
            ]
        );

        $this->modifier(
            "UPDATE enchere SET
        echre_prix = :echre_prix WHERE echre_id = :echre_id",
            [
                'echre_id' => $tmbe_id,
                'echre_prix' => $mise_prix

            ]
        );
    }

    /**
     * requete SQL select  -recherche
     */
    public function recherche($recherche)
    {

        return $this->lireTout(
            "SELECT * FROM timbre 
        JOIN image ON img_tmbe_id = tmbe_id 
        JOIN enchere ON echre_tmbe_id = tmbe_id
        WHERE tmbe_nom LIKE :recherche 
        OR tmbe_couleurs LIKE :recherche 
        OR tmbe_pays LIKE :recherche",
            ['recherche' => '%' . $recherche . '%']
        );
    }
}
