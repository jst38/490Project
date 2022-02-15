CREATE TABLE IF NOT EXISTS `Users` (`User_ID` INT NOT NULL AUTO_INCREMENT
	,`Email` VARCHAR(100) UNIQUE NOT NULL
  ,`Fname` VARCHAR(60) NOT NULL
  ,`Lname` VARCHAR(60) NOT NULL
  ,`Username` VARCHAR(60) NOT NULL
	,`Password` VARCHAR(60) NOT NULL
	,`Create_Date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
	,PRIMARY KEY (`User_ID`)
	)
