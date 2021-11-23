create table T_annonce (
    A_idannonce serial,
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

);

create table T_utilisateur (

);

create table T_message (

);

create table T_photo (

);

create table T_typeMaison (

);