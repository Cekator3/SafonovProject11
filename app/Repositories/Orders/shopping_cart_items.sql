SELECT
    om.id               AS ordered_model_id,
    m.name              AS name,
    m.preview_image     AS thumbnail,
    om.amount           AS amount,

    -- Price for one item
    CASE
        WHEN om.is_parted AND om.is_holed THEN
            price + m.price_parted + m.price_holed
        WHEN om.is_parted AND NOT om.is_holed THEN
            price + m.price_parted + m.price_solid
        WHEN NOT om.is_parted AND om.is_holed THEN
            price + m.price_not_parted + m.price_holed
        ELSE
            price + m.price_not_parted + m.price_solid
    END AS price

FROM
    ordered_models AS om

    JOIN models AS m
        ON m.id = om.model_id

    -- Calculating printing prices
    CROSS JOIN LATERAL (
        SELECT
            SUM(price) AS price
        FROM
        (
            -- model size price
            (SELECT
                price
            FROM
                models_sizes AS ms
            WHERE
                ms.id = om.model_size_Id
            LIMIT 1)

            UNION ALL

            -- printing technology price
            (SELECT
                price
            FROM
                printing_technologies_prices AS ptp
            WHERE
                ptp.printing_technology_id = om.printing_technology_id AND
                ptp.model_id = om.model_id
            LIMIT 1)

            UNION ALL

            -- Filament type price
            (SELECT
                price
            FROM
                filament_types_prices AS ftp
            WHERE
                ftp.filament_type_id = om.filament_type_id AND
                ftp.model_id = om.model_id
            LIMIT 1)

            UNION ALL

            -- Color price
            (SELECT
                price
            FROM
                colors_prices AS cp
            WHERE
                cp.color_id = om.color_id AND
                cp.model_id = om.model_id
            LIMIT 1)

            UNION ALL

            -- Additional services prices
            (SELECT
                SUM(asp.price) AS price

            FROM
                additional_services_of_ordered_models AS asom
                JOIN
                    additional_services_prices AS asp
                ON
                    asp.additional_service_id = asom.additional_service_id

            WHERE
                asom.ordered_model_id = om.id AND
                asp.model_id = om.model_id)
        )
    )

WHERE
    om.order_id = 1;


-- (1) List of orders in admin's panel
SELECT
    o.id                AS order_id,
    u.email             AS user_email,
    o.status            AS order_status,
    o.payed_at          AS order_payed_at,
    o.completed_at      AS order_completed_at
FROM
    orders AS o

    JOIN users AS u
        ON u.id = o.customer_id;


-- (2) Order's models list for administrator
-- Предпологаю, что order_id будет известен до запроса
SELECT
    u.email             AS user_email,
    o.status            AS order_status,
    o.payed_at          AS order_payed_at,
    o.completed_at      AS order_completed_at,
    m.id                AS model_id,
    m.name              AS model_name,
    m.preview_image     AS model_thumbnail,
    pt.id               AS printing_technology_id,
    pt.name             AS printing_technology_name,
    ft.id               AS filament_type_id,
    ft.name             AS filament_type_name,
    c.code              AS color_code,
    ms.size_multiplier  AS model_size_multiplier,
    ms.length           AS model_length,
    ms.width            AS model_width,
    ms.height           AS model_height

FROM
    ordered_models AS om

    JOIN orders AS o
        ON o.id = om.order_id

    JOIN users AS u
        ON u.id = o.customer_id

    JOIN models AS m
        ON m.id = om.model_id

    JOIN printing_technologies AS pt
        ON pt.id = om.printing_technology_id

    JOIN filament_types AS ft
        ON ft.id = om.filament_type_id

    JOIN colors AS c
        on c.id = om.color_id

    JOIN models_sizes AS ms
        on ms.id = om.model_size_Id

WHERE
    om.order_id = 1;
