create database apab_structure;
use apab_structure;

create table filials
(
	id_filial int NOT NULL PRIMARY KEY auto_increment,
	name_filial varchar(300) not null,
	date_create datetime default CURRENT_TIMESTAMP not null

);

create unique index filials_id_filial_uindex
	on filials (id_filial);

create table stations
(
	id_station int NOT NULL PRIMARY KEY auto_increment,
	name_station varchar(300) not null,
	link_station varchar(300) not null,
	id_filial int NOT NULL,
	date_create datetime default CURRENT_TIMESTAMP not null,
    foreign key(id_filial) REFERENCES filials (id_filial)
);

create unique index stations_id_sation_uindex
	on stations (id_sation);


create table users
(
	id_user int NOT NULL PRIMARY KEY auto_increment,
	email varchar(300) not null,
	remember_token varchar(120),
	password varchar(300) not null,
    date_created datetime default CURRENT_TIMESTAMP not null

);

create unique index users_id_user_uindex
	on users (id_user);

    create table grants
(
	id_grant int NOT NULL PRIMARY KEY auto_increment,
	grant_name varchar(300) not null,
	grant_name_rus varchar(300),
    date_created datetime default CURRENT_TIMESTAMP not null
);


create unique index grants_id_grant_uindex
	on grants (id_grant);

    create table users_grants
(
	id_users_grants int NOT NULL PRIMARY KEY auto_increment,
	id_user int NOT NULL,
	id_grant int NOT NULL,
	date_create datetime default CURRENT_TIMESTAMP not null,
    foreign key(id_user) REFERENCES users (id_user),
    foreign key(id_grant) REFERENCES grants (id_grant)
);

create unique index users_grants_id_users_grants_uindex
	on users_grants (id_users_grants);

