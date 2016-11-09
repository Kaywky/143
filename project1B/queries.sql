SELECT CONCAT(first, ' ', last) FROM Actor A, (SELECT aid as ActorID FROM MovieActor WHERE mid=(SELECT id FROM Movie WHERE title='Die Another Day')) N WHERE A.id=N.ActorID;

SELECT COUNT(aid) FROM (SELECT aid FROM MovieActor GROUP BY aid HAVING COUNT(mid)>1) N;

SELECT COUNT(mid) FROM (SELECT mid FROM MovieActor GROUP BY mid HAVING COUNT(aid)>10) N;
 -- provide the count of all the movies which used more than 10 actors --

SELECT CONCAT(first, ' ', last) FROM Director WHERE id IN (SELECT did FROM MovieDirector WHERE mid=831);
 -- find the director(s) who directed the movie with id number 831 --