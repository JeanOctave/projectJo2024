---- procedure check heritage for user ----
drop procedure if exists checkHeritageForU;
Delimiter //
create procedure checkHeritageForU(firstN varchar(50), lastN varchar(50), ml varchar(50),
                                   slt varchar(255), actv varchar(1), psw varchar(50), prf varchar(50))
begin
  declare nbU, nbC int;
  select count(idPeople) as nbMaxU into nbU
  from user;

  select count(idPeople) as nbMaxC into nbC
  from competitor;


  if nbU >= 0 && nbC >= 0
    then
      insert into user values (nbU + nbC + 1, firstN, lastN, ml, slt, actv, psw, prf);
  end if;
END //
Delimiter ;

---- procedure check heritage for competitor ----
drop procedure if exists checkHeritageForC;
Delimiter //
create procedure checkHeritageForC(firstN varchar(50), lastN varchar(50), ml varchar(50),
                                   slt varchar(255), actv varchar(1), psw varchar(50), st varchar(50))
begin
  declare nbU, nbC int;
  select count(idPeople) as nbMaxU into nbU
  from user;

  select count(idPeople) as nbMaxC into nbC
  from competitor;


  if nbU >= 0 && nbC >= 0
    then
      insert into competitor values (nbU + nbC + 1, firstN, lastN, ml, slt, actv, psw, st);
  end if;
END //
Delimiter ;

call checkHeritageForU('germe', 'germa', 'gg@gmail.com', 'rkkkrkrk456', '0', 'gg', 'soccer, basketball, rudby');
call checkHeritageForC('germe', 'germa', 'gg@gmail.com', 'rkkkrkrk456', '0', 'gg', 'mondial');