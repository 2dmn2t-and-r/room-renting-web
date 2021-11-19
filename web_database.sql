drop schema if exists WEB_DATABASE;

create schema WEB_DATABASE;

use WEB_DATABASE;

-- CHARACTER SET utf8 COLLATE utf8_unicode_ci
create table ROOM (
    roomId		int AUTO_INCREMENT,
    roomName    varchar(100), 
    type 		char(1),
    floor		int,
    seat        int,
    price		int,
    statusRo	char(1),
    openTime	time,
    closeTime	time,
    address		varchar(100),
    description	varchar(200),
    image		varbinary(1024),
    primary key (roomId)
);

create table USER (
	userId 		int AUTO_INCREMENT,
    username	varchar(100),
    sex			char(1),
    birthday 	date,
    phone		char(10),
    address		varchar(100),
    email		varchar(20),
    password	varchar(40),
    type 		char(1),
    avatar 		varchar(1024),
	primary key (userId)
);

create table  RESERVATION (
	resId		int AUTO_INCREMENT,
    bookDate	date,
    useDate		date,
    startTime	time,
    endTime		time,
    totalPrice	int,
    statusR		char(1),
    roomId		int	not null,
    userId		int	not null,
    primary key (resId),
    foreign key (roomId) references ROOM (roomId) on delete cascade on update cascade,
    foreign key (userId) references USER (userId) on delete cascade on update cascade
);

create table NEWS (
	newsId		int AUTO_INCREMENT,
    title		varchar(100),
    createDate	date,
    modifyDate	date,
    content		varchar(200),
    image		varchar(1024),
    public		boolean,
    primary key (newsId)
);

create table ROOM_COMMENT (
	commentId	int AUTO_INCREMENT,
    date		date,
    content		varchar(200),
    userId		int	not null,
    roomId		int	not null,
    primary key	(commentId),
    foreign key (userId) references USER (userId) on delete cascade,
    foreign key (roomId) references ROOM (roomId) on delete cascade
);

create table NEWS_COMMENT (
	commentId	int AUTO_INCREMENT,
    date		date,
    content		varchar(200),
    userId		int	not null,
    newsId		int	not null,
    primary key	(commentId),
    foreign key (userId) references USER (userId) on delete cascade,
    foreign key (newsId) references NEWS (newsId) on delete cascade
);