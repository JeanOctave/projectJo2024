--- admins ---

INSERT INTO `admins` (`idAdmin`, `firstName`, `lastName`, `mail`, `salt`, `pswd`) VALUES
(1, 'pagna', 'kong', 'p@gmail.com', NULL, 'cp77gC17bNhP8hfF5lqBZ8dWtcdSNCyhcmhEU6uGWNPjVLL6gg'),
(4, 'yaha@yah.com', 'yaha@yah.com', 'yaha@yah.com', '1', 'cp77gC17bNhP8hfF5lqBZ8dWtcdSNCyhcmhEU6uGWNPjVLL6gg'),
(5, 'cena', 'JONH', 'jonhcena@yahoo.com', '1', 'DK0/c7ZZal0JCtkRxEwcoVnyRgUhsHRGVlDxLjVIfL/Ym+5PQM');

----- classification ----

INSERT INTO `classification` (`idClassification`, `label`) VALUES
(1, 'ClassificationA'),
(2, 'ClassificationB'),
(3, 'ClassificationC'),
(4, 'ClassificationD'),
(5, 'ClassificationE');

----- competitor -----

INSERT INTO `competitor` (`idPeople`, `firstName`, `lastName`, `mail`, `salt`, `active`, `pswd`, `stat`) VALUES
(3, 'ABE', 'Norifumi', 'ABE@gmail.com', 'rkkkrkrk456', '0', 'smdlepr', 'mondial'),
(4, 'Ablett', 'Gary', 'Ablett@gmail.com', 'rkkkrkrk456', '0', 'dmepamqw', 'mondial'),
(7, 'Jabotinsky', 'Vladimir', 'Jabotinsky@gmail.com', 'djdkfl', '1', 'dmfprm', 'mondial'),
(8, 'Diniz', 'Yohan', 'Diniz@gmail.com', 'dmeprmsmx', '1', 'dpepwmxm', 'mondial'),
(9, 'Ryner', 'Teddy', 'Ryner@gmail.com', 'vnfsmsm', '1', 'qmmdmep', 'mondial'),
(10, 'Kotula', 'Kylee ', 'Kotula@gmail.com', 'dfsdfsd', '1', 'hfghd', 'mondial'),
(11, 'Bo-ra', 'Lee', 'Bo-ra@gmail.com', 'dmeprmsmx', '1', 'dpepwmxm', 'mondial'),
(12, 'Redgrave', 'Steve', 'Redgrave@gmail.com', 'jygsdfs', '1', 'fgfdts', 'mondial'),
(13, 'Suguri', 'Fumie', 'Suguri@gmail.com', 'ghdrt', '1', 'oikujhtrq', 'mondial'),
(14, 'Béranger', 'Paul', 'Béranger@gmail.com', 'ghdrt', '1', 'oikujhtrq', 'mondial');


----- countries -----

insert into countries values
(null, 'United States', 'front/img/countries/unitedStates.jpg'),
(null, 'Great Britain', 'front/img/countries/greatBritain.png'),
(null, 'China', 'front/img/countries/china.jpg'),
(null, 'Russia', 'front/img/countries/russia.png'),
(null, 'Germany', 'front/img/countries/germany.png'),
(null, 'Japan', 'front/img/countries/japan.png'),
(null, 'France', 'front/img/countries/france.png'),
(null, 'South Korea', 'front/img/countries/southKorea.png'),
(null, 'Italy', 'front/img/countries/Italy.png'),
(null, 'Australia', 'front/img/countries/australia.png');

----- media -----

INSERT INTO `media` (`idMedia`, `label`, `link`) VALUES
(1, 'diving', 'front/img/events/diving.jpeg'),
(2, 'swimming', 'front/img/events/swimming.jpg'),
(3, 'synchronised swimming', 'front/img/events/SwimmingSync.jpg'),
(4, 'water polo', 'front/img/events/waterPolo.jpg'),
(5, 'concert of M.pokora', 'front/img/events/mPokoraConcert.jpg'),
(6, 'paintball', 'front/img/events/paintBall.jpg'),
(7, 'electro music', 'front/img/events/electroMusicConcert.jpg');

----- place -----

INSERT INTO `place` (`idPlace`, `label`) VALUES
(1, 'Piscine olympique de Saint-Denis'),
(2, 'Piscine olympique de Saint-Denis'),
(3, 'Piscine olympique de Saint-Denis'),
(4, 'Centre de water-polo'),
(5, 'Champ-de-Mars'),
(6, 'Champ-de-Mars'),
(7, 'Champ-de-Mars');

----- events ------

INSERT INTO `events` (`idEvent`, `label`, `descriptions`, `dateEvent`, `startEvent`, `endEvent`, `typeEvent`, `nbInscription`, `idMedia`, `idPlace`) VALUES
(1, 'Diving', 'Diving is the sport of jumping or falling into water from a platform or springboard, usually while performing acrobatics. Diving is an internationally recognized sport that is part of the Olympic Games. In addition, unstructured and non-competitive diving is a recreational pastime.\r\n\r\nDiving is one of the most popular Olympic sports with spectators. Competitors possess many of the same characteristics as gymnasts and dancers, including strength, flexibility, kinaesthetic judgment and air awareness. Some professional divers were originally gymnasts or dancers as both the sports have similar characteristics to diving. Dmitri Sautin holds the record for most Olympic diving medals won, by winning eight medals in total between 1992 and 2008.', '2018-02-17', '2018-02-17', '2018-05-17', 'games', 20, 1, 1),
(2, 'Swimming', 'Swimming is an individual or team sport that uses arms and legs to move the body through water. The sport takes place in pools or open water (e.g., in a sea or lake). Competitive swimming is one of the most popular Olympic sports, with varied distance events in butterfly, backstroke, breaststroke, freestyle, and individual medley. In addition to these individual events, four swimmers can take part in either a freestyle or medley relay. Swimming each stroke requires specific techniques, and in competition, there are specific regulations concerning the acceptable form for different strokes. There are also regulations on what types of swimsuits, caps, jewelry and injury tape are allowed at competitions. Although it is possible for competitive swimmers to incur several injuries from the sport -- such as tendinitis in the shoulder-- there are also multiple health benefits associated with the sport.', '2018-03-12', '2018-03-12', '2018-03-20', 'games', 20, 2, 2),
(3, 'Synchronized swimming', 'Synchronized swimming, (renamed as artistic swimming), is a hybrid form of swimming, dance, and gymnastics, consisting of swimmers performing a synchronised routine (either solo, duet, mixed duet, free team, free combination, and highlight) of elaborate moves in the water, accompanied by music.\r\n\r\nSynchronized swimming demands advanced water skills, and requires great strength, endurance, flexibility, grace, artistry and precise timing, as well as exceptional breath control when upside down underwater. During routines, swimmers may not touch the bottom of the pool.\r\n\r\nFollowing the addition of a new mixed-pair event, FINA World Aquatics competitions are open to men since the 16th 2015 championships in Kazan, and the other international, national and provincial/state competitions allow male competitors in every event. However, men are currently still barred from competing in the Olympics. Both USA Synchro and Synchro Canada allow men to compete with women. Most European countries allow men to compete also, France even allows male only podiums, according to the number of participants. In the past decade more men are becoming involved in the sport and a global biannual competition called Men\'s Cup has been steadily growing.\r\n\r\nCompetitors show off their strength, flexibility, and aerobic endurance required to perform difficult routines. Swimmers perform two routines for the judges, one technical and one free, as well as age group routines and figures.\r\n\r\nSynchronised swimming is both an individual and team sport. Swimmers compete individually during figures, and then as a team during the routine. Figures are made up of a combination of skills and positions that often require control, strength, and flexibility. Swimmers are ranked individually for this part of the competition. The routine involves teamwork and synchronization. It is choreographed to music and often has a theme.', '2018-05-21', '2018-05-21', '2018-06-02', 'games', 36, 3, 3),
(4, 'Water polo', 'Water polo is a competitive team sport played in the water between two teams. The game consists of four quarters, usually of eight minutes, in which the two teams attempt to score goals and throw the ball into their opponent\'s goal. The team with the most goals at the end of the game wins the match. Each team made up of six field players and one goalkeeper. Except for the goalkeeper, players participate in both offensive and defensive roles. Water polo is typically played in an all-deep pool seven feet (or two meters) deep.\r\n\r\nSpecial equipment for water polo includes a water polo ball, which floats on the water; numbered and coloured caps; and two goals, which either float in the water or are attached to the side of the pool.\r\n\r\nThe game is thought to have originated in Scotland in the late 19th century as a sort of water rugby. William Wilson is thought to have developed the game during a similar period. The game thus developed with the formation of the London Water Polo League and has since expanded, becoming widely popular in various places around the world, including Europe, the United States, Brazil, China, Canada and Australia.', '2018-01-05', '2018-01-05', '2018-01-11', 'games', 15, 4, 4),
(5, 'concert of M.Pokora', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum mollis dui sed dui gravida, ac tempor felis euismod. Mauris lacinia, felis a pellentesque blandit, orci nisi fringilla libero, vitae iaculis turpis velit ut elit. Aliquam et quam sit amet tellus lacinia egestas sed quis velit. Morbi et dolor quis nibh lobortis lobortis. Nullam rhoncus dapibus odio, eu convallis leo auctor in. Cras posuere, eros ac fermentum dignissim, nisi dolor faucibus magna, at ornare augue nisi et velit. Sed laoreet sit amet libero non efficitur. Aliquam bibendum id elit eu lobortis.\r\n\r\nCras semper diam eget erat luctus euismod. Ut pellentesque iaculis nunc nec tristique. Aliquam pharetra, nibh ut congue eleifend, justo magna pharetra velit, eget congue mi orci at lectus. Quisque finibus sapien vitae ex pharetra fringilla. Nullam sed ipsum eget magna lacinia dictum. Pellentesque dapibus iaculis est in vehicula. In laoreet tincidunt lectus in efficitur. Integer placerat iaculis turpis, nec euismod risus vulputate at. Integer nec mattis nunc. Etiam vehicula, ligula vitae mollis mattis, diam diam feugiat lorem, non vehicula diam tortor laoreet neque. Duis sodales tempor fermentum. Duis dictum massa neque, vel lacinia massa feugiat ut. Integer facilisis sem vel consequat aliquam.', '2018-06-13', '2018-06-13', '2018-06-15', 'activities', 1000, 5, 5),
(6, 'painball in openspace', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum mollis dui sed dui gravida, ac tempor felis euismod. Mauris lacinia, felis a pellentesque blandit, orci nisi fringilla libero, vitae iaculis turpis velit ut elit. Aliquam et quam sit amet tellus lacinia egestas sed quis velit. Morbi et dolor quis nibh lobortis lobortis. Nullam rhoncus dapibus odio, eu convallis leo auctor in. Cras posuere, eros ac fermentum dignissim, nisi dolor faucibus magna, at ornare augue nisi et velit. Sed laoreet sit amet libero non efficitur. Aliquam bibendum id elit eu lobortis.\r\n\r\nCras semper diam eget erat luctus euismod. Ut pellentesque iaculis nunc nec tristique. Aliquam pharetra, nibh ut congue eleifend, justo magna pharetra velit, eget congue mi orci at lectus. Quisque finibus sapien vitae ex pharetra fringilla. Nullam sed ipsum eget magna lacinia dictum. Pellentesque dapibus iaculis est in vehicula. In laoreet tincidunt lectus in efficitur. Integer placerat iaculis turpis, nec euismod risus vulputate at. Integer nec mattis nunc. Etiam vehicula, ligula vitae mollis mattis, diam diam feugiat lorem, non vehicula diam tortor laoreet neque. Duis sodales tempor fermentum. Duis dictum massa neque, vel lacinia massa feugiat ut. Integer facilisis sem vel consequat aliquam.', '2018-04-03', '2018-04-03', '2018-05-03', 'activities', 200, 6, 6),
(7, 'electro music', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum mollis dui sed dui gravida, ac tempor felis euismod. Mauris lacinia, felis a pellentesque blandit, orci nisi fringilla libero, vitae iaculis turpis velit ut elit. Aliquam et quam sit amet tellus lacinia egestas sed quis velit. Morbi et dolor quis nibh lobortis lobortis. Nullam rhoncus dapibus odio, eu convallis leo auctor in. Cras posuere, eros ac fermentum dignissim, nisi dolor faucibus magna, at ornare augue nisi et velit. Sed laoreet sit amet libero non efficitur. Aliquam bibendum id elit eu lobortis.\r\n\r\nCras semper diam eget erat luctus euismod. Ut pellentesque iaculis nunc nec tristique. Aliquam pharetra, nibh ut congue eleifend, justo magna pharetra velit, eget congue mi orci at lectus. Quisque finibus sapien vitae ex pharetra fringilla. Nullam sed ipsum eget magna lacinia dictum. Pellentesque dapibus iaculis est in vehicula. In laoreet tincidunt lectus in efficitur. Integer placerat iaculis turpis, nec euismod risus vulputate at. Integer nec mattis nunc. Etiam vehicula, ligula vitae mollis mattis, diam diam feugiat lorem, non vehicula diam tortor laoreet neque. Duis sodales tempor fermentum. Duis dictum massa neque, vel lacinia massa feugiat ut. Integer facilisis sem vel consequat aliquam.', '2018-07-21', '2018-07-21', '2018-07-22', 'activities', 500, 7, 7);


----- people -----

INSERT INTO `people` (`idPeople`, `firstName`, `lastName`, `mail`, `salt`, `active`, `pswd`) VALUES
(1, 'ferid', 'gery', 'gg@gmail.com', '979a19d12f07db107a871bfaa33bb273', '1', '97ahGS6zfGmbk'),
(2, 'kong', 'pagna', 'pagna@gmail.com', '82fe0145f56da6b067037652d336154b', '1', '82OKDyASM1quQ'),
(3, 'germe', 'germa', 'gg@gmail.com', 'rkkkrkrk456', '0', 'gg'),
(4, 'germe', 'germa', 'gg@gmail.com', 'rkkkrkrk456', '0', 'gg'),
(5, 'ferida', 'berie', 'ferid@ff.fr', '2afb06e24de89e377ea0b135759c65a7', '1', '2a7dg00QnSJ0Q');

----- sport -----

INSERT INTO `sport` (`idSport`, `label`) VALUES
(1, 'Beach-volley'),
(2, 'Marathon'),
(3, 'Triathlon'),
(4, 'Fencing'),
(5, 'Taekwondo'),
(6, 'Archery'),
(7, 'Handball'),
(8, 'Table tennis'),
(9, 'Soccer'),
(10, 'Rudgby'),
(11, 'Boxing'),
(12, 'Basketball'),
(13, 'Judo'),
(14, 'Fighting'),
(15, 'lifting'),
(16, 'Atletics'),
(17, 'Swimming'),
(18, 'Water-polo'),
(19, 'Badminton'),
(20, 'Volley-ball'),
(21, 'Shooting'),
(22, 'Gymnastic'),
(23, 'Field hockey'),
(24, 'Canoe'),
(25, 'Rowing'),
(26, 'Horse riding'),
(27, 'Cycling'),
(28, 'BMX'),
(29, 'VTT'),
(30, 'Golf'),
(31, 'Sail');

----- user -----

INSERT INTO `user` (`idPeople`, `firstName`, `lastName`, `mail`, `salt`, `active`, `pswd`, `preference`) VALUES
(1, 'ferid', 'gery', 'gg@gmail.com', '979a19d12f07db107a871bfaa33bb273', '1', '97ahGS6zfGmbk', ',Marathon'),
(2, 'kong', 'pagna', 'pagna@gmail.com', '82fe0145f56da6b067037652d336154b', '1', '82OKDyASM1quQ', 'Handball,Water-polo,Volley-ball'),
(5, 'ferida', 'berie', 'ferid@ff.fr', '2afb06e24de89e377ea0b135759c65a7', '1', '2a7dg00QnSJ0Q', 'Beach-volley,Triathlon');

----- medal ----

INSERT INTO `medal` (`idMedal`, `gold`, `silver`, `brown`, `idCountries`, `idPeople`) VALUES
(1, 0, 0, 0, 3, 3),
(2, 0, 0, 0, 1, 4),
(3, 0, 0, 0, 4, 7),
(4, 5, 2, 3, 7, 8),
(5, 5, 2, 3, 7, 9),
(6, 2, 6, 4, 3, 10),
(7, 10, 5, 2, 8, 11),
(8, 7, 3, 8, 2, 12),
(9, 4, 8, 0, 6, 13),
(10, 6, 10, 4, 7, 14);