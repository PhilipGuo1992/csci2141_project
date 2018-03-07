CREATE DATABASE IF NOT EXISTS CSCI2141_project;
USE CSCI2141_project;

/* Table for the Genre of the TV Show */
CREATE TABLE GENRE(
	genre_id INT UNIQUE NOT NULL,
    genre_type VARCHAR(25),
    
    PRIMARY KEY(genre_id)
);

/* Table for the production company */
CREATE TABLE PRODUCTION (
	prod_id INT UNIQUE NOT NULL,
    prod_name VARCHAR(20),
    
    PRIMARY KEY(prod_id)
);

/* Table for the TV Show */
CREATE TABLE TV_SHOW (
	show_id INT UNIQUE NOT NULL,
    genre_id INT,
    prod_id INT,
    duration TIME,
    show_language VARCHAR(25),
    time_slot_id DATE,
    rating VARCHAR(10),
    
    PRIMARY KEY(show_id),
	FOREIGN KEY(genre_id) REFERENCES GENRE(genre_id),
    FOREIGN KEY(prod_id) REFERENCES PRODUCTION(prod_id)
);

/* Table for the season of the TV Show */
CREATE TABLE SEASON (
	season_id INT UNIQUE NOT NULL,
    show_id INT NOT NULL,
    season_num INT NOT NULL,
    season_name VARCHAR(50),
    
    PRIMARY KEY(season_id),
    FOREIGN KEY(show_id) REFERENCES TV_SHOW(show_id)
    
);

/* Table for the episodes of a season */
CREATE TABLE EPISODE (
	episode_id INT UNIQUE NOT NULL,
    season_id INT NOT NULL,
    episode_num INT,
    episode_name VARCHAR(50),
    viewer_rating FLOAT,
    
    PRIMARY KEY(episode_id),
    FOREIGN KEY(season_id) REFERENCES SEASON(season_id)
);

/* Table for the actors of a TV Program */
CREATE TABLE ACTOR (
	actor_id INT,
    actor_FName VARCHAR(25),
    actor_LName VARCHAR(25),
    actor_age INT,
    actor_gender CHAR,
    
    PRIMARY KEY(actor_id)
);

/* Table for the contract between an actor and a show */
CREATE TABLE CONTRACT (
	contract_id INT UNIQUE NOT NULL,
	show_id INT NOT NULL,
    actor_id INT NOT NULL,
    actor_type VARCHAR(20),

	PRIMARY KEY(contract_id),
    FOREIGN KEY(show_id) REFERENCES TV_SHOW(show_id),
    FOREIGN KEY(actor_id) REFERENCES ACTOR(actor_id)
);


/* Table for the commercial */
CREATE TABLE COMMERCIAL (
	commercial_id INT UNIQUE NOT NULL,
    commercial_brand VARCHAR(20),
    revenue FLOAT,
    duration TIME,
    
    PRIMARY KEY(commercial_id)
);

/* Table for the commercial_slot */
CREATE TABLE COMMERCIAL_SLOT (
	commercial_slot_id INT UNIQUE NOT NULL,
	commercial_id INT NOT NULL,
    show_id INT NOT NULL,
    
    PRIMARY KEY(commercial_slot_id),
    FOREIGN KEY(commercial_id) REFERENCES COMMERCIAL(commercial_id),
    FOREIGN KEY(show_id) REFERENCES TV_SHOW(show_id)
);

/*Table for the timeslot of a program */
CREATE TABLE TIMESLOT (
	timeslot_id INT UNIQUE NOT NULL,
    episode_id INT,
    timeslot_time DATE UNIQUE NOT NULL,
    
    PRIMARY KEY(timeslot_id),
    FOREIGN KEY(episode_id) REFERENCES EPISODE(episode_id)
    );

/*Table for the subtitle of a program */
CREATE TABLE SUBTITLE (
	subtitle_id INT UNIQUE NOT NULL,
    show_id INT,
    subtitles_language VARCHAR(15),
    
    PRIMARY KEY(subtitle_id),
    FOREIGN KEY(show_id) REFERENCES TV_SHOW(show_id)
    
);

/* Add foreign key from TV_SHOW.time_slot_id to TIMESLOT.timeslot_time */

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `csci2141_project`.`TV_SHOW` 
ADD INDEX `fk_TV_SHOW_TIMESLOT1_idx` (`time_slot_id` ASC);

ALTER TABLE `csci2141_project`.`TV_SHOW` 
ADD CONSTRAINT `fk_TV_SHOW_TIMESLOT1`
  FOREIGN KEY (`time_slot_id`)
  REFERENCES `csci2141_project`.`TIMESLOT` (`timeslot_time`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

