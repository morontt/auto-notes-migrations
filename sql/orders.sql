SELECT
    o.date,
    t.name,
    o.cost,
    o.description,
    m.distance,
    o.used_at,
    o.capacity,
    o.car_id,
    c.brand_name,
    c.model_name
FROM orders AS o
LEFT JOIN order_types AS t ON o.type_id = t.id
LEFT JOIN mileages AS m ON o.mileage_id = m.id
LEFT JOIN cars AS c ON o.car_id = c.id
ORDER BY o.date;
