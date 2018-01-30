------- trigger copy of table user to people -----
drop trigger if exists copyFieldUser;
Delimiter //
create trigger copyFieldUser
after insert on user 
for each row
begin
    declare nbP, nbC int;
    select count(*) as nbPeople into nbP
    from people
    where idPeople = new.idPeople;

    if nbP = 0
        then
            insert into people values (new.idPeople, new.firstName, new.lastName, new.mail, new.salt,
            new.active, new.pswd);
    end if;
    
    select count(*) as nbCompetitor into nbC
    from competitor 
    where idPeople = new.idPeople;

    if nbC > 0
        then
            SIGNAL SQLSTATE'45000'
            set message_text = 'he is competitor';
    end if;
end //
Delimiter ;

------- trigger copy of table competitor to people -----
drop trigger if exists copyFielCompetitor;
Delimiter //
create trigger copyFieldCompetitor
after insert on competitor 
for each row
begin
    declare nbP, nbU int;
    select count(*) as nbPeople into nbP
    from people
    where idPeople = new.idPeople;

    if nbP = 0
        then
            insert into people values (new.idPeople, new.firstName, new.lastName, new.mail, new.salt,
            new.active, new.pswd);
    end if;
    
    select count(*) as nbUser into nbU
    from user
    where idPeople = new.idPeople;

    if nbU > 0
        then
            SIGNAL SQLSTATE'45000'
            set message_text = 'he is user';
    end if;
end //
Delimiter ;

insert into user values (2, "kong", "pagna", "pagna@gmail.com", "djfjfj455", "1", "pg", "natation");
insert into competitor values (null, "kong", "pagna", "pagna@gmail.com", "djfjfj455", "1", "pg", "Mondial");

---- trigger addData Medal ----
/*drop trigger if exists addDataMedal;
Delimiter //
create trigger addDataMedal
after insert on competitor
for each row
begin
 insert into medal values(null, 0, 0, 0, new.idCountries, 3);       
end //
Delimiter ;*/