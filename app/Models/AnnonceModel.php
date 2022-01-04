<?php

namespace App\Models;

use CodeIgniter\Model;

class AnnonceModel extends Model
{
    protected $table = 'T_annonce';
    protected $primaryKey = 'A_idannonce';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'A_titre',
        'A_cout_loyer',
        'A_cout_charges',
        'A_type_chauffage',
        'A_superficie',
        'A_description',
        'A_adresse',
        'A_ville',
        'A_CP',
        'A_etat',
        'A_proprietaire',
        'A_type_maison',
        'A_id_engie'
    ];

    public function addData($annonce) : array
    {
        $energieModel = new EnergieModel();
        $photoModel = new PhotoModel();
        $typeMaisonModel = new TypeMaisonModel();
        $utilisateurModel = new UtilisateurModel();

        if (!empty($annonce['A_id_engie']))
            $annonce['A_energie'] = $energieModel->find($annonce['A_id_engie'])['E_description'];

        $annonce['A_typeMaison'] = $typeMaisonModel->find($annonce['A_type_maison'])['T_description'];

        $annonce['A_photos'] = $photoModel->where(['P_idannonce'=>$annonce['A_idannonce']])->findAll();

        $annonce['A_proprietaire'] = $utilisateurModel->where(['U_mail'=>$annonce['A_proprietaire']])->first();

        return $annonce;
    }
}
