CREATE TABLE `teams` (
	`team_id` int(11) NOT NULL AUTO_INCREMENT,
	`naam` varchar(255) NOT NULL,
	CONSTRAINT PK_TEAMS PRIMARY KEY(`team_id`),
	CONSTRAINT UK_TEAMS_NAAM UNIQUE(`naam`)
);

CREATE TABLE `spelers` (
	`speler_id` int(11) NOT NULL AUTO_INCREMENT,
	`naam` varchar(50) NOT NULL,
	`tussenvoegsel` varchar(50) NULL,
	`achternaam` varchar(50) NOT NULL,
	CONSTRAINT PK_SPELERS PRIMARY KEY(`speler_id`)
);

CREATE TABLE `team_spelers` (
	`speler_id` int(11) NOT NULL,
	`team_id` int(11) NOT NULL,
	CONSTRAINT PK_TEAM_SPELERS PRIMARY KEY(`speler_id`, `team_id`),
	CONSTRAINT FK_TEAM_SPELER_SPELERS_SPELER_ID FOREIGN KEY(`speler_id`) REFERENCES `spelers`(`speler_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT FK_TEAM_SPELER_TEAMS_TEAM_ID FOREIGN KEY(`team_id`) REFERENCES `teams`(`team_id`) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE `soorten` (
	`soort` varchar(50) NOT NULL,
	CONSTRAINT PK_SOORTEN PRIMARY KEY(`soort`)
);

CREATE TABLE `wedstrijden` (
	`wedstrijd_id` int(11) NOT NULL AUTO_INCREMENT,
	`soort` varchar(50) NOT NULL,
	`team1` int(11) NOT NULL,
	`team2` int(11) NOT NULL,
	`team1_score` int(11) NOT NULL,
	`team2_score` int(11) NOT NULL,
	`status` tinyint(1) NOT NULL,
	CONSTRAINT PK_WEDSTRIJDEN PRIMARY KEY(`wedstrijd_id`),
	CONSTRAINT FK_WEDSTRIJDEN_SOORTEN_SOORT FOREIGN KEY(`soort`) REFERENCES `soorten`(`soort`) ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT FK_WEDSTRIJDEN_TEAMS_TEAM_ID1 FOREIGN KEY(`team1`) REFERENCES `teams`(`team_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT FK_WEDSTRIJDEN_TEAMS_TEAM_ID2 FOREIGN KEY(`team2`) REFERENCES `teams`(`team_id`) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE `groepen` (
  `groep_id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  PRIMARY KEY (`groep_id`),
  UNIQUE KEY `UK_GROEPEN_NAAM` (`naam`)
);

CREATE TABLE `permissies` (
  `permissie_id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(50) NOT NULL,
  `prefix` varchar(50) NOT NULL,
  `info` varchar(255) NOT NULL,
  PRIMARY KEY (`permissie_id`),
  UNIQUE KEY `UK_PERMISSIES_NAME` (`naam`),
  UNIQUE KEY `UK_PERMISSIES_PREFIX_INFO` (`prefix`,`info`)
);

CREATE TABLE `middelen` (
  `middel_id` int(11) NOT NULL AUTO_INCREMENT,
  `namespace` varchar(50) NOT NULL,
  `controller` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  PRIMARY KEY (`middel_id`),
  UNIQUE KEY `UK_MIDDELEN_NAMESPACE_CONTROLLER_ACTION` (`namespace`,`controller`,`action`)
);

CREATE TABLE `groep_permissies` (
  `groep_id` int(11) NOT NULL,
  `permissie_id` int(11) NOT NULL,
  PRIMARY KEY (`groep_id`,`permissie_id`),
  CONSTRAINT `FK_GROEP_PERMISSIES_GROEPEN_GROEP_ID` FOREIGN KEY (`groep_id`) REFERENCES `groepen` (`groep_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_GROEP_PERMISSIES_PERMISSIES_PERMISSIE_ID` FOREIGN KEY (`permissie_id`) REFERENCES `permissies` (`permissie_id`) ON UPDATE CASCADE
);

CREATE TABLE `permissie_middelen` (
  `permissie_id` int(11) NOT NULL,
  `middel_id` int(11) NOT NULL,
  PRIMARY KEY (`permissie_id`,`middel_id`),
  CONSTRAINT `FK_PERMISSIES_MIDDELEN_PERMISSIE_ID` FOREIGN KEY (`permissie_id`) REFERENCES `permissies` (`permissie_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_PERMISSIES_MIDDELEN_MIDDEL_ID` FOREIGN KEY (`middel_id`) REFERENCES `middelen` (`middel_id`) ON UPDATE CASCADE
);

CREATE TABLE `gebruikers` (
	`gebruiker_id` int(11) NOT NULL AUTO_INCREMENT,
	`gebruikersnaam` varchar(50) NOT NULL,
	`wachtwoord` varchar(50) NOT NULL,
	`groep_id` INT(11) NOT NULL,
	CONSTRAINT PK_GEBRUIKERS PRIMARY KEY(`gebruiker_id`),
	CONSTRAINT FK_GEBRUIKERS_GROEPEN_GROEP_ID FOREIGN KEY(`groep_id`) REFERENCES `groepen`(`groep_id`) ON UPDATE CASCADE ON DELETE RESTRICT
)