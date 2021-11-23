create table T_annonce (
    A_idannonce serial primary key,
    A_titre varchar(255),
    A_cout_loyer decimal(14, 2),
    A_cout_charges decimal(14, 2),
    A_type_chauffage varchar(255),
    A_superficie decimal(14, 2),
    A_description varchar(255),
    A_adresse varchar(255),
    A_ville varchar(255),
    A_CP varchar(5),
    A_etat varchar(255)
);

create table T_energie (
    E_id_engie serial primary key,
    E_description varchar(255)
);

create table T_utilisateur (
    U_mail varchar(255) primary key,
    U_mdp char(64),
    U_pseudo varchar(255),
    U_nom varchar(255),
    U_prenom varchar(255),
    U_admin boolean
);

create table T_message (
    M_dateheure_message time,
    M_texte_message varchar(255)
);

create table T_photo (
    P_id_photo serial primary key,
    P_titre varchar(255),
    P_nom varchar(255)
);

create table T_typeMaison (
    T_type char(2) primary key,
    T_description varchar(255)
);