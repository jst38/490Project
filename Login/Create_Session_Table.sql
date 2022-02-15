CREATE TABLE IF NOT EXISTS `Session_Tokens` (`Session_ID` INT NOT NULL AUTO_INCREMENT
  ,`Session_Create_Date` DATETIME2
	,`Session_Start_Time` DATETIME2
  ,`Session_End_Time` DATETIME2
  ,`Username` VARCHAR(60) NOT NULL
	,PRIMARY KEY (`Session_ID`)
  )
