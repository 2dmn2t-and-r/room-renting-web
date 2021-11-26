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

create table INFOMATION (
    infoId      int AUTO_INCREMENT,
    title1      varchar(200),
    content1    varchar(500),
    image1      varchar(500),
    title2      varchar(200),
    content2    varchar(500),
    image2      varchar(500),
    address     varchar(200),
    email       varchar(200),
    phone       char(10),
    facebook    varchar(200),
    twitter     varchar(200),
    instagram   varchar(200),
    tiktok      varchar(200),
    primary key	(infoId)
);

insert into INFOMATION (title1, content1, image1, title2, content2, image2, address, email, phone, facebook, twitter, instagram, tiktok) values (
    "ROOM PRO",
    "We provide renting meeting rooms, halls and stages for your professional events.",
    "https://firebasestorage.googleapis.com/v0/b/react-native-c15bd.appspot.com/o/DCT%20Trading%20Offices%20-%20Istanbul%20_%20Office%20Snapshots.jfif?alt=media&token=9c0ccbb3-3b96-4672-837a-4827566d384f",
    "About us",
    "Everything about customers are all what we are concerned. Therefore, lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Egestas egesta.",
    "https://firebasestorage.googleapis.com/v0/b/react-native-c15bd.appspot.com/o/Deco%20Shapes.jfif?alt=media&token=22e2899d-c45e-4346-8f46-898fe2872e16",
    "Linh Trung, Thu Duc, Ho Chi Minh City",
    "nhduc2001kt@gmail.com",
    "0935735723",
    "https://www.facebook.com/profile.php?id=100009976037363",
    "https://www.facebook.com/profile.php?id=100009976037363",
    "https://www.facebook.com/profile.php?id=100009976037363",
    "https://www.facebook.com/profile.php?id=100009976037363"
);