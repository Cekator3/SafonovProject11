SELECT
    m.id                AS id,
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
            -- model sizes prices
            SELECT
                price
            FROM
                models_sizes AS ms
            WHERE
                ms.id = om.model_size_Id

            UNION ALL

            -- printing technologies prices
            SELECT
                price
            FROM
                printing_technologies_prices AS ptp
            WHERE
                ptp.printing_technology_id = om.printing_technology_id AND
                ptp.model_id = om.model_id

            UNION ALL

            -- Filament types prices
            SELECT
                price
            FROM
                filament_types_prices AS ftp
            WHERE
                ftp.filament_type_id = om.filament_type_id AND
                ftp.model_id = om.model_id

            UNION ALL

            -- Color prices
            SELECT
                price
            FROM
                colors_prices AS cp
            WHERE
                cp.color_id = om.color_id AND
                cp.model_id = om.model_id
        )
    )

WHERE
    om.order_id = 1;
