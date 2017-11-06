CREATE TABLE USER(
	username varchar(20) PRIMARY KEY,
	name varchar(30) NOT NULL,
	email varchar(50) NOT NULL,
	mobno int(10) NOT NULL,
	paddr varchar(100) NOT NULL	
)

CREATE TABLE LOGIN(
	username varchar(20) PRIMARY KEY,
	password varchar(32) NOT NULL,
	FOREIGN KEY (username) REFERENCES USER(username)
)


CREATE TABLE CITY(
	name varchar(30) PRIMARY KEY,
	country varchar(30) NOT NULL,
	islandlocked boolean NOT NULL,
	xcoord int(5) NOT NULL,
	ycoord int(5) NOT NULL
)


CREATE TABLE ORDERTB(
	orderid INT PRIMARY KEY ,
	ordertime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	custname VARCHAR(20) NOT NULL,
	pickupdt DATETIME NOT NULL,
	content varchar(30) NOT NULL,
	weight int(3) NOT NULL,
	quantity int(2) NOT NULL, 
	FOREIGN KEY (custname) REFERENCES USER(username),
	method VARCHAR(4) NOT NULL
)

CREATE TABLE ORDERADDR(
	orderid INT PRIMARY KEY,
	fromname varchar(30) NOT NULL,
	frommobno int(10) NOT NULL,
	fromemail varchar(50) NOT NULL,
	fromaddr varchar(100) NOT NULL,
	fromlandmark varchar(30) NOT NULL,
	fromcity varchar(30) NOT NULL,
	frompincode int(10) NOT NULL,
	toname varchar(30) NOT NULL,
	tomobno int(10) NOT NULL,
	toemail varchar(50) NOT NULL,
	toaddr varchar(100) NOT NULL,
	tolandmark varchar(30) NOT NULL,
	tocity varchar(30) NOT NULL,
	topincode int(10) NOT NULL,
	FOREIGN KEY (orderid) REFERENCES ORDERTB(orderid),
	FOREIGN KEY (fromcity) REFERENCES CITY(name),
	FOREIGN KEY (tocity) REFERENCES CITY(name)	
)
