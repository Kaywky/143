-- set the id of Movie as unique primary key
-- id, title and year must have values
-- check the validation of MPAA rating
-- check the validation of year
CREATE TABLE Movie(
	id int NOT NULL,
	title varchar(100) NOT NULL,
	year int NOT NULL,
	rating varchar(10), 
	company varchar(50),
	PRIMARY KEY (id),
	CHECK (rating IS NULL OR rating='G' OR rating='PG' OR rating='PG-13' OR rating='R' OR rating='NC-17'),
	CHECK (year>1895 AND year<3000)
	)ENGINE=INNODB;

-- set id of Actor as unique primary key
-- id, dob must have values
-- check that if sex is either Female or Male
CREATE TABLE Actor(
	id int NOT NULL,
	last varchar(20), 
	first varchar(20), 
	sex varchar(6), 
	dob date NOT NULL,
	dod date,
	PRIMARY KEY (id),
	CHECK (sex = 'F' OR sex = 'M')
	)ENGINE=INNODB;

-- set id of Director as unique primary key
-- id, dob must have values
CREATE TABLE Director(
	id int NOT NULL,
	last varchar(20), 
	first varchar(20), 
	dob date NOT NULL,
	dod date,
	PRIMARY KEY (id)
	)ENGINE=INNODB;

-- link the foreign key mid to primary key id in table Movie
CREATE TABLE MovieGenre(
	mid int NOT NULL,
	genre varchar(20),
	FOREIGN KEY (mid) REFERENCES Movie(id)
	)ENGINE=INNODB;

-- link the foreign key mid to primary key id in table Movie
-- link the foreign key did to primary key id in table Director
CREATE TABLE MovieDirector(
	mid int NOT NULL,
	did int NOT NULL,
	FOREIGN KEY (mid) REFERENCES Movie(id),
	FOREIGN KEY (did) REFERENCES Director(id)
	)ENGINE=INNODB;

-- link the foreign key mid to primary key id in table Movie
-- link the foreign key aid to primary key id in table Actor
CREATE TABLE MovieActor(
	mid int NOT NULL,
	aid int NOT NULL,
	role varchar(50),
	FOREIGN KEY (mid) REFERENCES Movie(id),
	FOREIGN KEY (aid) REFERENCES Actor(id)
	)ENGINE=INNODB;

-- link the foreign key mid to primary key id in table Movie
-- check that rating is in the correct range
CREATE TABLE Review(
	name varchar(20), 
	time timestamp, 
	mid int NOT NULL,
	rating int NOT NULL,
	comment varchar(500),
	FOREIGN KEY (mid) REFERENCES Movie(id),
	CHECK(rating>=0 AND rating<=5)
	)ENGINE=INNODB;

CREATE TABLE MaxPersonID(
	id int NOT NULL
	)ENGINE=INNODB;

CREATE TABLE MaxMovieID(
	id int NOT NULL
	)ENGINE=INNODB;