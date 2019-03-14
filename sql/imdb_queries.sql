# Deployed by Abbosjon Kudratov  copyright © 2019


##1. What are the names of all movies released in 1995?
SELECT name FROM `movies` WHERE year=1995;



##2. How many people played a part in the movie ”Lost in Translation”?
SELECT count(actor_id) FROM roles as R JOIN movies as M on M.id=R.movie_id
WHERE M.name="Lost in Translation";

SELECT count(*) FROM roles r JOIN movies m ON m.id=r.movie_id WHERE m.name="Lost in Translation";


##3. What are the names of all the people who played a part in the movie ”Lost in Translation”?
SELECT first_name, last_name, M.name FROM actors  A JOIN roles R on A.id=R.actor_id JOIN  movies M on R.movie_id=M.id 
WHERE M.name="Lost in Translation";


##4. Who directed the movie ”Fight Club”?
SELECT first_name, last_name FROM directors as D JOIN movies_directors as MD on D.id=MD.director_id 
JOIN movies as M on MD.movie_id=M.id
WHERE M.name="Fight Club";



##5. How many movies has Clint Eastwood directed?
SELECT count(*) FROM movies M JOIN movies_directors  MD on MD.movie_id=M.id JOIN directors D 
on D.id=MD.director_id 
WHERE D.first_name="Clint" && D.last_name="Eastwood";
##display every info where Eastwood Clint directed a movie
SELECT * FROM movies M JOIN movies_directors  MD on MD.movie_id=M.id JOIN directors D 
on D.id=MD.director_id 
WHERE D.first_name="Clint" && D.last_name="Eastwood";



##6. What are the names of all movies Clint Eastwood has directed?
SELECT M.name FROM movies M JOIN movies_directors  MD on MD.movie_id=M.id JOIN directors D 
on D.id=MD.director_id 
WHERE D.first_name="Clint" && D.last_name="Eastwood";


##7. What are the names of all directors who have directed at least one horror film?
SELECT D.first_name, D.last_name, MG.genre, M.name, M.year FROM directors as D JOIN movies_directors as MD 
on MD.director_id=D.id JOIN movies as M on MD.movie_id=M.id JOIN movies_genres as MG 
on M.id=MG.movie_id
WHERE MG.genre="Horror";



##8. What are the names of every actor who has appeared in a movie directed by Christopher Nolan?
SELECT A.first_name, A.last_name, M.name as movie_name, M.year, CONCAT(D.first_name, ' ',D.last_name) as Director  FROM 
actors A JOIN roles  R on A.id=R.actor_id JOIN movies M on R.movie_id=M.id 
JOIN movies_directors MD on M.id=MD.movie_id JOIN directors D on MD.director_id=D.id
WHERE D.first_name="Christopher" && D.last_name="Nolan";

