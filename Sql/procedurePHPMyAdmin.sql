DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addedit_classification` (IN `iid` INT, IN `iclassification` VARCHAR(20), IN `iyear` VARCHAR(20))  NO SQL
BEGIN
 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addedit_event` (IN `iid` INT, IN `ilabel` VARCHAR(50), IN `idescriptions` VARCHAR(50), IN `idateEvent` VARCHAR(50), IN `istartEvent` VARCHAR(50), IN `iendEvent` VARCHAR(50), IN `itypeEvent` VARCHAR(50), IN `iidPlace` INT(5), IN `iidMedia` INT(5))  NO SQL
BEGIN
IF(iid = 0) THEN
    	INSERT INTO events( label,descriptions,dateEvent,startEvent, 	endEvent,typeEvent,idPlace,idMedia) VALUES(    ilabel,idescriptions,idateEvent,istartEvent, 	iendEvent,itypeEvent,iidPlace,iidMedia);
 
   ELSE
	UPDATE events SET
    label=ilabel,
    descriptions=idescriptions,
    dateEvent=idateEvent,
    startEvent=istartEvent, 	
    endEvent=iendEvent,
    typeEvent=itypeEvent,
    idPlace=iidPlace,
    idMedia=iidMedia
    WHERE idEvent = iid;
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addedit_event_pic` (IN `iid` INT, IN `ilabel` VARCHAR(50), IN `ilink` VARCHAR(100))  NO SQL
BEGIN
	IF iid = 0 THEN
    INSERT INTO media (label,link) VALUES (ilabel,ilink);
    SELECT last_insert_id() AS um_id;
    ELSE
    UPDATE media SET
    label=ilabel,
    link=ilink
    WHERE  id=iid;
SELECT iid AS um_id;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addedit_place` (IN `iid` INT, IN `ilabel` VARCHAR(50))  NO SQL
BEGIN
	IF iid = 0 THEN
    INSERT INTO place (label) VALUES (ilabel);
    ELSE
    UPDATE place SET 
    label = ilabel
    WHERE idPlace = iid;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addedit_sport` (IN `iid` INT, IN `ilabel` VARCHAR(50))  NO SQL
BEGIN
	IF iid = 0 THEN
    	INSERT INTO sport (label) VALUES(ilabel);
    ELSE
    UPDATE sport SET 
    label = ilabel
    WHERE idSport = iid;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_classify` (IN `idclass` INT, IN `idcountry` INT, IN `iyear` VARCHAR(20))  NO SQL
BEGIN
	UPDATE classify SET
    idClassification = idclass,
    year = iyear
    WHERE idCountries = idcountry;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get` ()  NO SQL
SELECT * FROM events$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_competitor_detail` (IN `iid` INT(3))  NO SQL
BEGIN
	SELECT coun.label as lableCountry,t.label AS teamlabel, com.*, sp.label AS labelsport, me.typeM AS medalalbel 		FROM team AS t 
		INNER JOIN countries AS coun ON coun.idCountries = t.idCountries
		INNER JOIN belong AS be ON t.idTeam = be.idTeam
		INNER JOIN competitor AS com ON be.idPeople = com.idPeople
		INNER JOIN practice ON com.idPeople = practice.idPeople
		INNER JOIN sport AS sp ON practice.idSport = sp.idSport
        INNER JOIN reward ON reward.idPeople = com.idPeople
        INNER JOIN medal AS me ON me.idMedal = reward.idMedal
WHERE com.idPeople = iid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_pays` ()  NO SQL
BEGIN
SELECT clsf.label AS  
labelclsf,clsf.idClassification AS idclsf, cou.*, classify.year FROM classification AS clsf
INNER JOIN classify ON clsf.idClassification = classify.idClassification
INNER JOIN countries AS cou ON classify.idCountries = cou.idCountries;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `kkk` ()  NO SQL
BEGIN
    DECLARE i int DEFAULT 241;
    WHILE i <= 241 DO
        INSERT INTO classify (idClassification) VALUES (i);
        SET i = i + 1;
    END WHILE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_addedit_admin` (IN `iid` INT, IN `ifirstName` VARCHAR(50), IN `ilastName` VARCHAR(50), IN `imail` VARCHAR(50), IN `isalt` VARCHAR(50), IN `ipswd` VARCHAR(50))  NO SQL
BEGIN
	IF iid = 0 THEN
    	INSERT INTO admins(firstName ,lastName ,mail,salt ,pswd) VALUES(ifirstName,ilastName ,imail,isalt ,ipswd);
    ELSE
    UPDATE admins SET 
    firstName = ifirstName,
    lastName = ilastName,
    mail = imail,
    pswd = ipswd
    WHERE idAdmin = iid;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_addedit_participant` (IN `ifirstname` VARCHAR(20), IN `ilastname` VARCHAR(20), IN `iemail` VARCHAR(20), IN `isalt` VARCHAR(100), IN `iactive` TINYINT(5), IN `ipassword` VARCHAR(50), IN `ipreference` VARCHAR(20))  NO SQL
BEGIN
	INSERT INTO user ( 	firstName , 	lastName,mail,salt ,active ,pswd,preference)
    VALUES(ifirstname,ilastname,iemail,isalt,iactive,ipassword,ipreference);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_get_event` ()  NO SQL
BEGIN
	SELECT events.*, place.label as placelabel FROM events 
INNER JOIN place  ON events.idPlace = place.idPlace;
END$$

DELIMITER ;