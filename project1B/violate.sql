-- constraint: set the id of Movie as unique primary key
-- a movie with id 831 alrealy exists
INSERT INTO Movie
VALUES (831, 'hahaha', 1999, 'G', 'mycompany');
-- Error: Duplicate entry '831' for key 'PRIMARY'

-- constraint: check the validation of MPAA rating
-- this statement will violate the constraint since the rating of movie must be 'G', 'PG', 'PG-13', 'R' and 'NC-17'
INSERT INTO Movie
VALUES (20016, 'hahaha', 1999, 'Go', 'mycompany');

-- constraint: check the validation of year
-- this statement will violate the constraint since year 999 is not in the within range(1895,3000)
INSERT INTO Movie
VALUES (20016, 'hahaha', 999, 'G', 'mycompany');

-- constraint: set id of Actor as unique primary key
-- an Actor with id 1 exists
INSERT INTO Actor
VALUES (1, 'bunny', 'bear', 'F', 1993-05-18, NULL);
-- Error: Duplicate entry '1' for key 'PRIMARY'

-- constraint: check that if sex is either Female or Male
-- this statement will violate the constriant since the sex of an Actor must be 'F' or 'M' 
INSERT INTO Actor
VALUES (20016, 'bunny', 'bear', 'A', 1993-05-18, NULL);

-- constraint: set id of Director as unique primary key
-- an Director with id 1 exists
INSERT INTO Director
VALUES (3141, 'bunny', 'bear', 1993-05-18, NULL);
-- Error: Duplicate entry '3141' for key 'PRIMARY'

-- constraint: link the foreign key mid to primary key id in table Movie
-- it violates the constraint since there is no match id in table Movie
INSERT INTO MovieGenre
VALUES (20016, 'romantic');
-- Error: cannot add or update a child row: a foreign key constraint fails...

-- constraint: link the foreign key mid to primary key id in table Movie
-- there is no match id in table Movie
INSERT INTO MovieDirector
VALUES (20016, 3141);
-- Error: cannot add or update a child row: a foreign key constraint fails...

-- constraint: link the foreign key did to primary key id in table Director
-- there is no match id in table Director
INSERT INTO MovieDirector
VALUES (831, 20017);
-- Error: cannot add or update a child row: a foreign key constraint fails...

-- constraint: link the foreign key mid to primary key id in table Movie
-- there is no match id in table Movie
INSERT INTO MovieActor
VALUES (20016, 1, 'Alice');
-- Error: cannot add or update a child row: a foreign key constraint fails...

-- constraint: link the foreign key aid to primary key id in table Actor
-- there is no match id in table Actor
INSERT INTO MovieActor
VALUES (831, 20017, 'Alice');
-- Error: cannot add or update a child row: a foreign key constraint fails...

-- constraint: link the foreign key mid to primary key id in table Movie
-- there is no match id in table Movie
INSERT INTO Review
VALUES ('hahaha', 2016-10-16, '20016', 3, 'good');
-- Error: cannot add or update a child row: a foreign key constraint fails...

-- constraint: check that rating is in the correct range
-- this statement will violate the constaint since the rating value is supposed to be in range[0,5]
INSERT INTO Review
VALUES ('hahaha', 2016-10-16, '831', 6, 'good');