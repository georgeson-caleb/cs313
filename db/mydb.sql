CREATE TABLE users (
   id SERIAL UNIQUE NOT NULL PRIMARY KEY,
   username varchar(255) NOT NULL,
   email varchar(255), NOT NULL,
   password varchar(255) NOT NULL,
);

CREATE TABLE cats (
   id SERIAL UNIQUE NOT NULL PRIMARY KEY,
   name varchar(255) NOT NULL,
   fav_food varchar(255),
   fav_pastime varchar(255),
   age int,
   owner_id int REFERENCES users (id)
);

CREATE TABLE pictures (
   id SERIAL UNIQUE NOT NULL PRIMARY KEY,
   image_name varchar(255) NOT NULL,
   comments TEXT[],
   likes int,
   cat_id int REFERENCES cats (id)
);