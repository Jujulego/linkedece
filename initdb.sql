-- Gestion de fichiers
-- table Multimedia
create table Multimedia (
    id int not null auto_increment primary key,
    type varchar(3) not null,
    fichier varchar(500) not null unique,
    date_ajout datetime not null,
    lieu varchar(500)
 ) engine=InnoDB;

-- Gestion des utilisateurs
-- table Utilisateur
create table Utilisateur (
    pseudo varchar(100) not null primary key,
    email varchar(500) not null unique,
    mot_de_passe varchar(100) not null,
    type varchar(3) not null,
    nom varchar(100) not null,
    prenom varchar(100) not null,
    naissance date not null,
    poste varchar(250) not null,
    secteur varchar(250) not null,
    photo_profil int,
    image_fond int,

    constraint fk_utilisateur_photoprofil
      foreign key (photo_profil)
      references Multimedia(id)
      on delete set null,

    constraint fk_utilisateur_imagefond
      foreign key (image_fond)
      references Multimedia(id)
      on delete set null
 ) engine=InnoDB;

-- Relation entre 2 utilisateurs
create table Relation (
    id int not null auto_increment primary key,
    utilisateur1 varchar(100) not null,
    utilisateur2 varchar(100) not null,

    constraint fk_relation_utilisateur1
      foreign key (utilisateur1)
      references Utilisateur(pseudo)
      on delete cascade,

    constraint fk_relation_utilisateur2
      foreign key (utilisateur2)
      references Utilisateur(pseudo)
      on delete cascade
 ) engine=InnoDB;

-- Gestion des albums
create table Album (
    id int not null auto_increment primary key,
    nom varchar(250) not null,
    utilisateur varchar(100) not null,

    constraint fk_album_utilisateur
      foreign key (utilisateur)
      references Utilisateur(pseudo)
      on delete cascade
 ) engine=InnoDB;

create table AlbumMultimedia (
    id int not null auto_increment primary key,
    album int not null,
    multimedia int not null,

    constraint fk_albummultimedia_album
      foreign key (album)
      references Album(id)
      on delete cascade,

    constraint fk_albummultimedia_multimedia
      foreign key (multimedia)
      references Multimedia(id)
      on delete cascade
 ) engine=InnoDB;

-- Gestion CV
-- représente un ensemble de lignes du CV
create table Stage (
    id int not null auto_increment primary key,
    societe varchar(250) not null,
    poste varchar(250) not null,
    date_debut date not null,
    date_fin date not null,
    utilisateur varchar(100) not null,

    constraint fk_stage_utilisateur
      foreign key (utilisateur)
      references Utilisateur(pseudo)
      on delete cascade
 ) engine=InnoDB;

create table Formation (
    id int not null auto_increment primary key,
    ecole varchar(250) not null,
    competence varchar(250) not null,
    date_debut date not null,
    date_fin date not null,
    utilisateur varchar(100) not null,

    constraint fk_formation_utilisateur
      foreign key (utilisateur)
      references Utilisateur(pseudo)
      on delete cascade
 ) engine=InnoDB;

-- Gestion des posts
create table Post (
    id int not null auto_increment primary key,
    message varchar(250) not null,
    auteur varchar(100) not null,
    date datetime default current_timestamp not null,

    constraint fk_post_utilisateur
      foreign key (auteur)
      references Utilisateur(pseudo)
      on delete cascade
 ) engine=InnoDB;

create table Publication (
    post int not null primary key,
    lieu varchar(250),
    public bool not null default false,
    multimedia int,

    constraint fk_publication_post
      foreign key (post)
      references Post(id)
      on delete cascade,

    constraint fk_publication_multimedia
      foreign key (multimedia)
      references Multimedia(id)
      on delete set null
 ) engine=InnoDB;

create table Commentaire (
    post int not null auto_increment primary key,
    cible int not null,

    constraint fk_commentaire_post
      foreign key (post)
      references Post(id)
      on delete cascade,

    constraint fk_commentaire_cible
      foreign key (post)
      references Post(id)
      on delete cascade
 ) engine=InnoDB;

create table Partage (
    id int not null auto_increment primary key,
    utilisateur varchar(100) not null,
    publication int not null,
    jaime boolean not null default false,

    constraint fk_partage_utilisateur
      foreign key (utilisateur)
      references Utilisateur(pseudo)
      on delete cascade,

    constraint fk_partage_publication
      foreign key (publication)
      references Publication(post)
      on delete cascade
 ) engine=InnoDB;

-- Gestion de la messagerie
create table Groupe (
    id int not null auto_increment primary key,
    nom varchar(250) not null
 ) engine=InnoDB;

create table GroupeUtilisateur (
    id int not null auto_increment primary key,
    groupe int not null,
    utilisateur varchar(100) not null,

    constraint fk_groupeutilisateur_groupe
      foreign key (groupe)
      references Groupe(id)
      on delete cascade,

    constraint fk_groupeutilisateur_utilisateur
      foreign key (utilisateur)
      references Utilisateur(pseudo)
      on delete cascade
 ) engine=InnoDB;

create table Message (
    id int not null auto_increment primary key,
    groupe int not null,
    auteur varchar(100),
    message varchar(500) not null,
    date datetime default current_timestamp not null,

    constraint fk_message_groupe
      foreign key (groupe)
      references Groupe(id)
      on delete cascade,

    constraint fk_message_utilisateur
      foreign key (auteur)
      references Utilisateur(pseudo)
      on delete set null
) engine=InnoDB;