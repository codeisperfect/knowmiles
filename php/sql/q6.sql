select city.Name,cartype.TypeName,review.* from review left join cartype on cartype.CarTypeId=review.carId left join city on city.CityID=review.cityID where uid=?