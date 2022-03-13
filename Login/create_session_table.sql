CREATE TABLE Session_Tokens (
	Session_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Session_Create_Date DATETIME,
	Session_Start_Time DATETIME,
	Session_End_Time DATETIME,
	Username VARCHAR(60) NOT NULL
  	);
