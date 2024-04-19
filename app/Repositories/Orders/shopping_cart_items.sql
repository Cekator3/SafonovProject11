SELECT
    om.id               AS ordered_model_id,
    m.name              AS name,
    m.preview_image     AS thumbnail,
    om.amount           AS amount,

    CASE
        WHEN om.is_parted AND om.is_holed THEN
            om.amount * (price + m.price_parted + m.price_holed)
        WHEN om.is_parted AND NOT om.is_holed THEN
            om.amount * (price + m.price_parted + m.price_solid)
        WHEN NOT om.is_parted AND om.is_holed THEN
            om.amount * (price + m.price_not_parted + m.price_holed)
        ELSE
            om.amount * (price + m.price_not_parted + m.price_solid)
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

SELECT
    om.id                  AS ordered_model_id,
    om.model_id            AS model_id,
    m.name                 AS model_name,
    om.amount              AS amount,
    om.is_holed            AS is_holed,
    om.is_parted           AS is_parted,
    m.price_holed          AS price_holed,
    m.price_solid          AS price_solid,
    m.price_parted         AS price_parted,
    m.price_not_parted     AS price_not_parted

FROM
    ordered_models AS om
    JOIN
        models AS m
    ON
        m.id = om.model_id

WHERE
    om.id = 1

LIMIT 1;

SELECT
    additional_service_id
FROM
    additional_services_of_ordered_models
WHERE
    ordered_model_id = 1;
