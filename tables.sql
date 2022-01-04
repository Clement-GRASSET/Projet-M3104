create table T_utilisateur (
    U_mail varchar(255) primary key not null,
    U_mdp char(64) not null,
    U_pseudo varchar(255) unique not null,
    U_nom varchar(255) not null,
    U_prenom varchar(255) not null,
    U_admin boolean not null
);

create table T_typeMaison (
    T_type char(2) primary key not null,
    T_description varchar(255) not null
);

create table T_energie (
    E_id_engie serial primary key not null,
    E_description varchar(255) not null
);

create table T_annonce (
    A_idannonce serial primary key not null,
    A_titre varchar(255) not null,
    A_cout_loyer decimal(14, 2) not null,
    A_cout_charges decimal(14, 2) not null,
    A_type_chauffage varchar(255) not null,
    A_superficie decimal(14, 2) not null,
    A_description varchar(255) not null,
    A_adresse varchar(255) not null,
    A_ville varchar(255) not null,
    A_CP varchar(5) not null,
    A_etat varchar(255) not null,
    A_proprietaire varchar(255) not null,
    A_type_maison char(2) not null,
    A_id_engie bigint unsigned
);

alter table T_annonce add constraint fk_annonce_utilisateur foreign key (A_proprietaire) references T_utilisateur (U_mail) on delete cascade;
alter table T_annonce add constraint fk_annonce_typeMaison foreign key (A_type_maison) references T_typeMaison (T_type);
alter table T_annonce add constraint fk_annonce_energie foreign key (A_id_engie) references T_energie (E_id_engie);

create table T_discussion (
    D_iddiscussion serial primary key not null,
    D_idannonce bigint unsigned not null,
    D_utilisateur varchar(255) not null,
    D_non_lu_proprietaire boolean not null,
    D_non_lu_utilisateur boolean not null
);

alter table T_discussion add constraint fk_discussion_annonce foreign key (D_idannonce) references T_annonce (A_idannonce) on delete cascade;
alter table T_discussion add constraint fk_discussion_utilisateur foreign key (D_utilisateur) references T_utilisateur (U_mail) on delete cascade;

create table T_message (
    M_idmessage serial primary key not null,
    M_dateheure_message timestamp default now() not null,
    M_envoyeur varchar(255) not null,
    M_texte_message varchar(255) not null,
    M_iddiscussion bigint unsigned not null
);

alter table T_message add constraint fk_message_discussion foreign key (M_iddiscussion) references T_discussion (D_iddiscussion) on delete cascade;

create table T_photo (
    P_id_photo serial primary key not null,
    P_titre varchar(255) not null,
    P_nom varchar(255) not null,
    P_idannonce bigint unsigned not null
);

alter table T_photo add constraint fk_photo_annonce foreign key (P_idannonce) references T_annonce (A_idannonce) on delete cascade;

insert into T_typeMaison (T_type, T_description) values
('T1', 'Type T1'),
('T2', 'Type T2'),
('T3', 'Type T3'),
('T4', 'Type T4'),
('T5', 'Type T5'),
('T6', 'Type T6');

insert into T_energie (E_description) values
('Fioul'), ('Gaz'), ('Electrique');