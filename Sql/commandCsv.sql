/* insert data database not even report to csv */

/* insert table sport */
LOAD DATA LOCAL INFILE '/home/tibdev/Public/www/Developpement/file/csv/sport.csv'
  INTO TABLE `sport`
  FIELDS TERMINATED BY ','
  OPTIONALLY ENCLOSED BY '"'
  LINES TERMINATED BY '\n'
  IGNORE 1 LINES
  (idSport, label);

/* insert table countries */
LOAD DATA LOCAL INFILE '/home/tibdev/Public/www/Developpement/file/csv/countries.csv'
  INTO TABLE `countries`
  FIELDS TERMINATED BY ','
  OPTIONALLY ENCLOSED BY '"'
  LINES TERMINATED BY '\n'
  IGNORE 1 LINES
  (idCountries, label);