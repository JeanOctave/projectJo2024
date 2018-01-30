drop database jo2024;
create database jo2024;
use jo2024;

create table media(
    idMedia int(3) not null auto_increment,
    label varchar(50),
    link varchar(255),
    primary key(idMedia)
);

create table place(
    idPlace int(3) not null auto_increment,
    label varchar(255),
    primary key(idPlace)
);

create table people(
    idPeople int(3) not null auto_increment,
    firstName varchar(50),
    lastName varchar(50),
    mail varchar(50),
    salt varchar(255),
    active enum("0", "1"),
    pswd varchar(50),
    primary key(idPeople)
);

create table user(
    idPeople int(3) not null auto_increment,
    firstName varchar(50),
    lastName varchar(50),
    mail varchar(50),
    salt varchar(255),
    active enum("0", "1"),
    pswd varchar(50),
    preference varchar(255),
    primary key(idPeople)
);

create table competitor(
    idPeople int(3) not null auto_increment,
    firstName varchar(50),
    lastName varchar(50),
    mail varchar(50),
    salt varchar(255),
    active enum("0", "1"),
    pswd varchar(50),
    stat varchar(50),
    primary key(idPeople)
);

create table events(
    idEvent int(3) not null auto_increment,
    label varchar(50),
    descriptions varchar(2000),
    dateEvent date,
    startEvent varchar(50),
    endEvent varchar(50),
    typeEvent varchar(50),
    nbInscription int(6),
    idMedia int(3),
    idPlace int(3),
    primary key(idEvent),
    foreign key (idMedia) references media(idMedia),
    foreign key (idPlace) references place(idPlace)
);

create table participate(
    idEvent int(3),
    idPeople int(3),
    foreign key (idEvent) references events(idEvent),
    foreign key (idPeople) references user(idPeople)
);

create table sport(
    idSport int(3) not null auto_increment,
    label varchar(50),
    primary key(idSport)
);

create table practice(
    idPeople int(3),
    idSport int(3),
    foreign key (idPeople) references competitor(idPeople),
    foreign key (idSport) references sport(idSport)
);

create table countries(
    idCountries int(3) not null auto_increment,
    label varchar(50),
    link varchar(255),
    primary key(idCountries)
);

create table medal(
    idMedal int(3) not null auto_increment,
    gold int(3),
    silver int(3),
    brown int(3),
    idCountries int(3),
    idPeople int(3),
    primary key(idMedal),
    foreign key (idCountries) references countries(idCountries),
    foreign key(idPeople) references competitor(idPeople)
);

create table team(
    idTeam int(3) not null auto_increment,
    label varchar(50),
    idCountries int(3),
    primary key(idTeam),
    foreign key (idCountries) references countries(idCountries)
);

create table belong(
    idPeople int(3),
    idTeam int(3),
    foreign key (idPeople) references competitor(idPeople),
    foreign key (idTeam) references team(idTeam)
);

create table classification(
    idClassification int(3) not null,
    label varchar(50),
    primary key(idClassification)
);

create table classify(
    idCountries int(3),
    idClassification int(3),
    year date,
    foreign key (idCountries) references countries(idCountries),
    foreign key (idClassification) references classification(idClassification)
);

create table admins(
    idAdmin int(3) not null auto_increment,
    firstName varchar(50),
    lastName varchar(50),
    mail varchar(50),
    salt varchar(255),
    pswd varchar(50),
    primary key(idAdmin)
);


