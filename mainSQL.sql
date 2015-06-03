SELECT `ProviderID`,`CarTypeID`,`ServiceID` FROM `service` WHERE 
`CityID` = (SELECT `CityID` FROM `city` WHERE `Name` = 'Delhi')


SELECT `DayBaseFare`, `DayBaseKm`, `DayFarePerKm`, `ProviderID`, `CarTypeID`, `service`.`ServiceID` FROM `service`, `fare` WHERE 
(`CityID` = (SELECT `CityID` FROM `city` WHERE `Name` = 'Delhi'))
AND
(`fare`.`SERVICEID` = `service`.`ServiceID`)


SELECT `DayBaseFare`, `DayBaseKm`, `DayFarePerKm`, `ProviderName`, `TypeName`, `service`.`ServiceID` FROM `cartype`,`provider`,`service`, `fare` WHERE 
(`CityID` = (SELECT `CityID` FROM `city` WHERE `Name` = 'Delhi'))
AND
(`fare`.`SERVICEID` = `service`.`ServiceID`)
AND
(`provider`.`ProviderID` = `service`.`ProviderID`)
AND
(`cartype`.`CarTypeID` = `service`.`CarTypeID`)


/*Without ServiceID*/
SELECT `DayBaseFare`, `DayBaseKm`, `DayFarePerKm`, `ProviderName`, `TypeName` FROM `cartype`,`provider`,`service`, `fare` WHERE 
(`CityID` = (SELECT `CityID` FROM `city` WHERE `Name` = 'Delhi'))
AND
(`fare`.`SERVICEID` = `service`.`ServiceID`)
AND
(`provider`.`ProviderID` = `service`.`ProviderID`)
AND
(`cartype`.`CarTypeID` = `service`.`CarTypeID`)


SELECT `Charge`, `ProviderName`, `TypeName` FROM 
(
	(SELECT `DayBaseFare` AS `Charge`, `fare`.`ServiceID` AS `SID` FROM `fare`, `service`, `city` 
		WHERE `DayBaseKm` >= 6
		AND (`fare`.`ServiceID` = `service`.`ServiceID`)
		AND (`service`.`CityID` = `city`.`CityID`)
		AND (`city`.`Name` = 'Delhi')
	)
	UNION
	(SELECT (`DayBaseFare` + ((6-`DayBaseKm`)*`DayFarePerKm`) ) AS `Charge`, `fare`.`ServiceID` AS `SID` FROM `fare`, `service`, `city`  
		WHERE `DayBaseKm` < 6
		AND (`fare`.`ServiceID` = `service`.`ServiceID`)
		AND (`service`.`CityID` = `city`.`CityID`)
		AND (`city`.`Name` = 'Delhi')	
	)
), `provider`, `cartype`,`service` 
	WHERE `SID` = `service`.`ServiceID`
	AND `service`.`ProviderID` = `provider`.`ProviderID`
	AND `service`.`CarTypeID` = `cartype`.`CarTypeID`




SELECT `Charge`, `ProviderName`, `TypeName` FROM 
(
	((SELECT `DayBaseFare` AS `Charge`, `fare`.`ServiceID` AS `SID` FROM `fare`, `service`, `city` 
		WHERE `DayBaseKm` >= 6
		AND (`fare`.`ServiceID` = `service`.`ServiceID`)
		AND (`service`.`CityID` = `city`.`CityID`)
		AND (`city`.`Name` = 'Delhi')
	)
	UNION
	(SELECT (`DayBaseFare` + ((6-`DayBaseKm`)*`DayFarePerKm`) ) AS `Charge`, `fare`.`ServiceID` AS `SID` FROM `fare`, `service`, `city`  
		WHERE `DayBaseKm` < 6
		AND (`fare`.`ServiceID` = `service`.`ServiceID`)
		AND (`service`.`CityID` = `city`.`CityID`)
		AND (`city`.`Name` = 'Delhi')	
	)) AS `ttabble`
), `provider`, `cartype`,`service` 
	WHERE `SID` = `service`.`ServiceID`
	AND `service`.`ProviderID` = `provider`.`ProviderID`
	AND `service`.`CarTypeID` = `cartype`.`CarTypeID`
	ORDER BY `Charge` ASC