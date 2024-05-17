SELECT
    f.date,
    f.value,
    azs.name AS station,
    f.cost,
    c.model_name AS car
FROM fuels AS f
INNER JOIN filling_stations AS azs ON f.station_id = azs.id
INNER JOIN cars AS c ON f.car_id = c.id
ORDER BY f.id;
