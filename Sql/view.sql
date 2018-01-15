/* View all games */
create view selectAllGames as (
   select e.label as labelEvents , descriptions, dateEvent, startEvent, endEvent, typeEvent, nbInscription,
          m.label as labelMedia , m.link,
          p.label as labelPlace
   from events e, media m, place p
   where m.idMedia=e.idMedia
   and e.idPlace=p.idPlace
   and typeEvent = "games"
);