SELECT
    f.date,
    f.value,
    azs.name AS station,
    f.cost,
    c.model_name AS car,
    m.distanse
FROM fuels AS f
INNER JOIN filling_stations AS azs ON f.station_id = azs.id
INNER JOIN cars AS c ON f.car_id = c.id
LEFT JOIN mileages AS m ON f.mileage_id = m.id
ORDER BY f.id;
