 create table users
 	(	id int AUTO_INCREMENT,
 		username varchar(250),
 		email varchar(250),
 		password varchar(250),
 		fullname varchar(250),
 		dob date,
 		primary key (id)
 		 );


 create table posts
 	(	id int AUTO_INCREMENT,
 		title varchar(250),
 		body text,
 		publishDate date,
 		userID int,
 		primary key (id),
 		foreign key (userID) REFERENCES users(id)
 		 );