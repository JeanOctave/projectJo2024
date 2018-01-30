/* View all games */
create view selectAllGames as (
   select idEvent, e.label as labelEvents , descriptions, dateEvent, startEvent, endEvent, typeEvent, nbInscription,
          m.label as labelMedia , m.link,
          p.label as labelPlace
   from events e, media m, place p
   where m.idMedia=e.idMedia
   and e.idPlace=p.idPlace
   and typeEvent = "games"
);

/* View all activities */
create view selectAllActivities as (
   select idEvent, e.label as labelEvents , descriptions, dateEvent, startEvent, endEvent, typeEvent, nbInscription,
          m.label as labelMedia , m.link,
          p.label as labelPlace
   from events e, media m, place p
   where m.idMedia=e.idMedia
   and e.idPlace=p.idPlace
   and typeEvent = "activities"
);

/* View all competitor + countries */
create view selectCompetitorCountries as (
    select ctrs.idCountries as countries, firstname, lastname, stat, sp.label
    from countries ctrs, medal m, competitor comp, sport sp, practice prc
    where ctrs.idCountries = m.idCountries
    and m.idPeople = comp.idPeople
    and comp.idPeople = prc.idPeople
    and prc.idSport = sp.idSport
);

/* View total medal by countries */
create view selectMedalByCountries as (
    select c.idCountries as theCountries, link, sum(gold) as totalGold, sum(silver) as totalSilver, sum(brown) as totalBrown, sum(gold + silver + brown) as nbTotalMedal
    from countries c, medal m 
    where c.idCountries = m.idCountries
    group by c.idCountries
    order by nbTotalMedal DESC
);