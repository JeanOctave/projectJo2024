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
    preference varchar(50),
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
    descriptions varchar(255),
    dateEvent date,
    startEvent varchar(50),
    endEvent varchar(50),
    typeEvent varchar(50),
    idMedia int(3),
    idPlace int(3),
    primary key(idEvent),
    foreign key (idMedia) references media(idMedia),
    foreign key (idPlace) references place(idPlace)
);

create table participate(
    idEvent int(3) not null,
    idPeople int(3) not null,
    primary key(idEvent, idPeople),
    foreign key (idEvent) references events(idEvent),
    foreign key (idPeople) references user(idPeople)
);

create table sport(
    idSport int(3) not null auto_increment,
    label varchar(50),
    primary key(idSport)
);

create table practice(
    idPeople int(3) not null,
    idSport int(3) not null,
    primary key(idPeople, idSport),
    foreign key (idPeople) references competitor(idPeople),
    foreign key (idSport) references sport(idSport)
);

create table medal(
    idMedal int(3) not null auto_increment,
    typeM varchar(50),
    primary key(idMedal)
);

create table reward(
    idPeople int(3) not null,
    idMedal int(3) not null,
    primary key(idPeople, idMedal),
    foreign key (idPeople) references competitor(idPeople),
    foreign key (idMedal) references medal(idMedal)
);

create table countries(
    idCountries int(3) not null auto_increment,
    label varchar(50),
    primary key(idCountries)
);

create table team(
    idTeam int(3) not null,
    label varchar(50),
    idCountries int(3),
    primary key(idTeam),
    foreign key (idCountries) references countries(idCountries)
);

create table belong(
    idPeople int(3) not null,
    idTeam int(3) not null,
    primary key(idPeople, idTeam),
    foreign key (idPeople) references competitor(idPeople),
    foreign key (idTeam) references team(idTeam)
);

create table classification(
    idClassification int(3) not null,
    label varchar(50),
    year date,
    primary key(idClassification)
);

create table classify(
    idCountries int(3) not null,
    idClassification int(3) not null,
    primary key(idCountries, idClassification),
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


