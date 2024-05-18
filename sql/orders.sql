SELECT
    o.date,
    t.name,
    o.cost,
    o.description,
    m.distanse,
    o.used_at,
    o.capacity
FROM orders AS o
LEFT JOIN order_types AS t ON o.type_id = t.id
LEFT JOIN mileages AS m ON o.mileage_id = m.id
ORDER BY o.date;
