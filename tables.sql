create table T_utilisateur (
    U_mail varchar(255) primary key,
    U_mdp char(64),
    U_pseudo varchar(255),
    U_nom varchar(255),
    U_prenom varchar(255),
    U_admin boolean
);

create table T_typeMaison (
    T_type char(2) primary key,
    T_description varchar(255)
);

create table T_energie (
    E_id_engie serial primary key,
    E_description varchar(255)
);

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
    A_etat varchar(255),
    A_proprietaire varchar(255),
    A_type_maison char(2),
    A_id_engie bigint unsigned
);

alter table T_annonce add constraint fk_annonce_utilisateur foreign key (A_proprietaire) references T_utilisateur (U_mail);
alter table T_annonce add constraint fk_annonce_typeMaison foreign key (A_type_maison) references T_typeMaison (T_type);
alter table T_annonce add constraint fk_annonce_energie foreign key (A_id_engie) references T_energie (E_id_engie);

create table T_discussion (
    D_idannonce bigint unsigned,
    D_utilisateur varchar(255),
    D_non_lu_proprietaire boolean,
    D_non_lu_utilisateur boolean
);

alter table T_discussion add constraint pk_discussion primary key (D_idannonce, D_utilisateur);
alter table T_discussion add constraint fk_discussion_annonce foreign key (D_idannonce) references T_annonce (A_idannonce);
alter table T_discussion add constraint fk_discussion_utilisateur foreign key (D_utilisateur) references T_utilisateur (U_mail);

create table T_message (
    M_dateheure_message time,
    M_envoyeur varchar(255),
    M_texte_message varchar(255),
    M_idannonce bigint unsigned,
    M_utilisateur varchar(255)
);

alter table T_message add constraint pk_message primary key (M_dateheure_message, M_envoyeur);
alter table T_message add constraint fk_message_annonce foreign key (M_idannonce) references T_discussion (D_idannonce);
alter table T_message add constraint fk_message_utilisateur foreign key (M_utilisateur) references T_discussion (D_utilisateur);

create table T_photo (
    P_id_photo serial primary key,
    P_titre varchar(255),
    P_nom varchar(255),
    P_idannonce bigint unsigned
);

alter table T_photo add constraint fk_photo_annonce foreign key (P_idannonce) references T_annonce (A_idannonce);

insert into T_typeMaison (T_type, T_description) values
('T1', ''),
('T2', ''),
('T3', ''),
('T4', ''),
('T5', ''),
('T6', '');