CREATE TABLE Session_Tokens (
	Session_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	User_ID Int NOT NULL
	Session_Create_Date DATETIME,
	Session_Start_Time DATETIME,
	Session_End_Time DATETIME,
	FOREIGN KEY (User_ID) REFERENCES Users(User_ID)
  	);
