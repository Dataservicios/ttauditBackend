CREATE DEFINER=`dataser_admin`@`%` PROCEDURE `sp_lipton_v1`(IN _company_id INT,IN _user_id INT)
BEGIN
    SET @created_at = (select DATE_SUB(NOW(), INTERVAL 5 HOUR));
    IF EXISTS(SELECT id FROM tempory_processes)  THEN SET @status_ = (SELECT `status`  FROM tempory_processes);
    IF @status_ = 0  THEN  SET @updated_at = (select DATE_SUB(NOW(), INTERVAL 5 HOUR));
    UPDATE `tempory_processes`  SET `status` = 1, `processes` = 'sp_lipton_v1', `updated_at` = @updated_at, `company_id` = _company_id, `user_id` = _user_id;
    /*inicio */

    /* Temporal que contiene el detalle de los comercios */
    DROP TEMPORARY TABLE IF EXISTS tmp_comercios;
    CREATE TEMPORARY TABLE IF NOT EXISTS tmp_comercios (
        INDEX (store_id)
    ) AS
        (
            SELECT
                `f`.`company_id`                               AS `company_id`,
                `a`.`store_id`                                 AS `store_id`,
                `b`.`codclient`                                AS `codclient`,
                `b`.`fullname`                                 AS `fullname`,
                `b`.`address`                                  AS `address`,
                `b`.`district`                                 AS `district`,
                `b`.`region`                                   AS `region`,
                `b`.`ubigeo`                                   AS `ubigeo`,
                `b`.`comment`                                  AS `comment`,
                `b`.`latitude`                                 AS `latitude`,
                `b`.`longitude`                                AS `longitude`,
                `b`.`nomb_ejecutivo`                           AS `ejecutivo`,
                `b`.`ejecutivo`                                AS `ejecutivo_email`,
                `b`.`coordinador`                              AS `coordinador_email`,
                `b`.`rubro`                              		AS `rubro`,
                `us`.`fullname`                                AS `coordinador`,
                DATE_FORMAT(`c`.`updated_at`, '%d/%m/%Y')      AS `fecha`,
                MIN(DATE_FORMAT(`c`.`updated_at`, '%H:%i')) AS `hora`,
                `e`.`fullname`                                 AS `auditor`,
                `b`.`owner`                              AS `tipo_agente`
            FROM
                `poll_details` `a`
                    LEFT JOIN `stores` `b` ON (`a`.`store_id` = `b`.`id`)
                    LEFT JOIN `road_details` `c` ON (`c`.`store_id` = `b`.`id` AND `c`.`company_id` = _company_id)
                    LEFT JOIN `roads` `d` ON (`c`.`road_id` = `d`.`id`)
                    LEFT JOIN `users` `e` ON (`d`.`user_id` = `e`.`id`)
                    LEFT JOIN `users` `us` ON (`b`.`coordinador` = `us`.`email`)
                    LEFT JOIN `company_stores` `f`
                              ON (`a`.`store_id` = `f`.`store_id` AND `a`.`company_id` = `f`.`company_id`)
            WHERE
                (`a`.`store_id` IN (
                    SELECT `road_details`.`store_id`
                    FROM
                        `road_details`
                    WHERE
                            `road_details`.`audit` = 1 AND `f`.`company_id` = _company_id
                )
                    AND `f`.`company_id` = _company_id AND `b`.`test` = 0)

            GROUP BY `f`.`company_id`, `a`.`store_id`, `b`.`codclient`, `b`.`fullname`, `b`.`address`, `b`.`district`,
                     `b`.`region`, `b`.`ubigeo`, `b`.`latitude`, `b`.`longitude`, `b`.`ejecutivo`, `b`.`coordinador`, `e`.`fullname`
        );

    /* Temporal que contiene el detalle de las respuestas tipo si/no */
    DROP TEMPORARY TABLE IF EXISTS tmp_sino;
    CREATE TEMPORARY TABLE IF NOT EXISTS tmp_sino (
        INDEX (company_id, store_id, poll_id)
    ) AS
        (
            SELECT *
            FROM
                (
                    SELECT
                        c.company_id                                                           AS company_id,
                        a.store_id                                                             AS store_id,
                        a.poll_id                                                              AS poll_id,
                        a.result                                                               AS Respuesta,
                        a.comentario                                                           AS comentario,
                        CONCAT('http://ttaudit.com/media/fotos/', h.archivo)                   AS Foto

                    FROM
                        ttaudit_auditors.poll_details a
                            LEFT JOIN ttaudit_auditors.polls b ON (a.poll_id = b.id)
                            LEFT JOIN ttaudit_auditors.company_audits c ON (c.id = b.company_audit_id)
                            LEFT JOIN ttaudit_auditors.stores d ON (a.store_id = d.id)
                            LEFT JOIN ttaudit_auditors.audits g ON (g.id = c.audit_id)
                            LEFT JOIN (SELECT
                                           x.id             AS id,
                                           x.store_id       AS store_id,
                                           x.poll_id        AS poll_id,
                                           x.invoices_id    AS invoices_id,
                                           x.tipo           AS tipo,
                                           x.archivo        AS archivo,
                                           x.created_at     AS created_at,
                                           x.updated_at     AS updated_at
                                       FROM
                                           ttaudit_auditors.medias x
                                       WHERE
                                               (x.poll_id, x.store_id,  x.id) IN (
                                               SELECT
                                                   ttaudit_auditors.medias.poll_id    AS poll_id,
                                                   ttaudit_auditors.medias.store_id   AS store_id,
                                                   MAX(ttaudit_auditors.medias.id)    AS id
                                               FROM
                                                   ttaudit_auditors.medias
                                               GROUP BY ttaudit_auditors.medias.poll_id, ttaudit_auditors.medias.store_id

                                           )
                        ) h ON (a.poll_id = h.poll_id AND a.store_id = h.store_id )
                    WHERE
                            c.company_id = _company_id
                ) yy
            WHERE
                    store_id in (select store_id
                                 from tmp_comercios)
        );


    /* Temporal de opciones de preguntas */
    DROP TEMPORARY TABLE IF EXISTS tmp_opciones;
    CREATE TEMPORARY TABLE IF NOT EXISTS tmp_opciones (
        INDEX (store_id, poll_id)
    ) AS
        (
            SELECT *
            FROM
                (
                    SELECT DISTINCT
                        c.company_id                                         AS company_id,
                        a.poll_id                                            AS poll_id,
                        a.store_id                                           AS store_id,
                        f.result                                             AS result,
                        a.result                                             AS Respuesta,
                        f.otro                                               AS otro,
                        e.codigo                                             AS options,
                        f.product_id                                         AS product_id,
                        f.publicity_id                                       AS publicity_id,
                        f.priority                                           AS priority,
                        e.options                                            AS desc_option,
                        a.comentario                                         AS Comentario,
                        CONCAT('http://ttaudit.com/media/fotos/', h.archivo) AS Foto
                    FROM
                        ttaudit_auditors.poll_details a
                            LEFT JOIN ttaudit_auditors.polls b ON (a.poll_id = b.id)
                            LEFT JOIN ttaudit_auditors.company_audits c ON (c.id = b.company_audit_id)
                            LEFT JOIN ttaudit_auditors.poll_options e ON (e.poll_id = b.id)
                            JOIN ttaudit_auditors.poll_option_details f ON (f.poll_option_id = e.id AND a.store_id = f.store_id)
                            LEFT JOIN ttaudit_auditors.audits g ON (g.id = c.audit_id)
                            LEFT JOIN (
                            SELECT
                                x.id             AS id,
                                x.store_id       AS store_id,
                                x.poll_id        AS poll_id,
                                x.tipo           AS tipo,
                                x.archivo        AS archivo,
                                x.created_at     AS created_at,
                                x.updated_at     AS updated_at

                            FROM
                                ttaudit_auditors.medias x
                            WHERE
                                    (x.poll_id,
                                     x.store_id,
                                     x.id) IN (
                                        SELECT
                                            ttaudit_auditors.medias.poll_id    AS poll_id,
                                            ttaudit_auditors.medias.store_id   AS store_id,
                                            MAX(ttaudit_auditors.medias.id)    AS id
                                        FROM
                                            ttaudit_auditors.medias
                                        GROUP BY ttaudit_auditors.medias.poll_id, ttaudit_auditors.medias.store_id

                                    )
                        ) h ON (a.poll_id = h.poll_id AND a.store_id = h.store_id )
                    WHERE
                            c.company_id = _company_id
                ) yy
            WHERE store_id in (SELECT store_id
                               FROM tmp_comercios)
        );


    SET @poll__id_1 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 1);
    SET @poll__id_2 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 2);
    SET @poll__id_3 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 3);
    SET @poll__id_4= (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 4);
    SET @poll__id_5 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 5);
    SET @poll__id_6 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 6);
    SET @poll__id_7 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 7);
    SET @poll__id_8 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 8);
    SET @poll__id_9 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 9);
    SET @poll__id_10 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 10);
    SET @poll__id_11 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 11);



-- -------------------INTRODUCCION------------------------------
    DROP TEMPORARY TABLE IF EXISTS preg_1_sino;
    CREATE TEMPORARY TABLE IF NOT EXISTS preg_1_sino (
        INDEX (store_id)
    ) AS
        (
            select *
            from tmp_sino
            where poll_id = @poll__id_1
            group by store_id
        );

    DROP TEMPORARY TABLE IF EXISTS preg_1;
    CREATE TEMPORARY TABLE IF NOT EXISTS preg_1 (
        INDEX (store_id)
    ) AS
        (
            select
                store_id,
                respuesta,
                sum(case when options = CONVERT(CONCAT(@poll__id_1, 'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
                sum(case when options = CONVERT(CONCAT(@poll__id_1, 'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
                sum(case when options = CONVERT(CONCAT(@poll__id_1, 'c') using utf8) collate utf8_spanish_ci then 1 else 0 end) as c,
                sum(case when options = CONVERT(CONCAT(@poll__id_1, 'd') using utf8) collate utf8_spanish_ci then 1 else 0 end) as d,
                otro,
                foto
            from tmp_opciones
            where poll_id = @poll__id_1
            group by store_id, respuesta, foto
        );

    DROP TEMPORARY TABLE IF EXISTS preg_2_sino;
    CREATE TEMPORARY TABLE IF NOT EXISTS preg_2_sino (
        INDEX (store_id)
    ) AS
        (
            select *
            from tmp_sino
            where poll_id = @poll__id_2
            group by store_id
        );

    DROP TEMPORARY TABLE IF EXISTS preg_2;
    CREATE TEMPORARY TABLE IF NOT EXISTS preg_2 (
        INDEX (store_id)
    ) AS
        (
            select
                store_id,
                respuesta,
                sum(case when options = CONVERT(CONCAT(@poll__id_2, 'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
                sum(case when options = CONVERT(CONCAT(@poll__id_2, 'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
                sum(case when options = CONVERT(CONCAT(@poll__id_2, 'c') using utf8) collate utf8_spanish_ci then 1 else 0 end) as c,
                otro,
                foto
            from tmp_opciones
            where poll_id = @poll__id_2
            group by store_id, respuesta, foto
        );


    DROP TEMPORARY TABLE IF EXISTS preg_3_sino;
    CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_sino (
        INDEX (store_id)
    ) AS
        (
            select *
            from tmp_sino
            where poll_id = @poll__id_3
            group by store_id
        );


    -- ----------- Uso de Interbank Agente -----------------------------
-- ----------------------------------------------------------------
    DROP TEMPORARY TABLE IF EXISTS preg_4_sino;
    CREATE TEMPORARY TABLE IF NOT EXISTS preg_4_sino (
        INDEX (store_id)
    ) AS
        (
            select *
            from tmp_sino
            where poll_id = @poll__id_4
            group by store_id
        );

    DROP TEMPORARY TABLE IF EXISTS preg_4;
    CREATE TEMPORARY TABLE IF NOT EXISTS preg_4 (
        INDEX (store_id)
    ) AS
        (
            select
                store_id,
                respuesta,
                sum(case when options = CONVERT(CONCAT(@poll__id_4, 'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
                sum(case when options = CONVERT(CONCAT(@poll__id_4, 'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
                sum(case when options = CONVERT(CONCAT(@poll__id_4, 'c') using utf8) collate utf8_spanish_ci then 1 else 0 end) as c,
                sum(case when options = CONVERT(CONCAT(@poll__id_4, 'd') using utf8) collate utf8_spanish_ci then 1 else 0 end) as d,
                sum(case when options = CONVERT(CONCAT(@poll__id_4, 'e') using utf8) collate utf8_spanish_ci then 1 else 0 end) as e,
                foto,
                otro
            from tmp_opciones
            where poll_id = @poll__id_4
            group by store_id, respuesta, foto
        );

    DROP TEMPORARY TABLE IF EXISTS preg_5_sino;
    CREATE TEMPORARY TABLE IF NOT EXISTS preg_5_sino (
        INDEX (store_id)
    ) AS
        (
            select *
            from tmp_sino
            where poll_id = @poll__id_5
            group by store_id
        );

    DROP TEMPORARY TABLE IF EXISTS preg_5;
    CREATE TEMPORARY TABLE IF NOT EXISTS preg_5 (
        INDEX (store_id)
    ) AS
        (
            select
                store_id,
                respuesta,
                sum(case when options = CONVERT(CONCAT(@poll__id_5, 'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
                sum(case when options = CONVERT(CONCAT(@poll__id_5, 'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
                sum(case when options = CONVERT(CONCAT(@poll__id_5, 'c') using utf8) collate utf8_spanish_ci then 1 else 0 end) as c,
                sum(case when options = CONVERT(CONCAT(@poll__id_5, 'd') using utf8) collate utf8_spanish_ci then 1 else 0 end) as d,
                foto,
                otro
            from tmp_opciones
            where poll_id = @poll__id_5
            group by store_id, respuesta, foto
        );


    DROP TEMPORARY TABLE IF EXISTS preg_6_sino;
    CREATE TEMPORARY TABLE IF NOT EXISTS preg_6_sino (
        INDEX (store_id)
    ) AS
        (
            select *
            from tmp_sino
            where poll_id = @poll__id_6
            group by store_id
        );

    DROP TEMPORARY TABLE IF EXISTS preg_6;
    CREATE TEMPORARY TABLE IF NOT EXISTS preg_6 (
        INDEX (store_id)
    ) AS
        (
            select
                store_id,
                respuesta,
                sum(case when options = CONVERT(CONCAT(@poll__id_6, 'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
                sum(case when options = CONVERT(CONCAT(@poll__id_6, 'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
                sum(case when options = CONVERT(CONCAT(@poll__id_6, 'c') using utf8) collate utf8_spanish_ci then 1 else 0 end) as c,
                sum(case when options = CONVERT(CONCAT(@poll__id_6, 'd') using utf8) collate utf8_spanish_ci then 1 else 0 end) as d,
                foto,
                otro
            from tmp_opciones
            where poll_id = @poll__id_6
            group by store_id, respuesta, foto
        );


    DROP TEMPORARY TABLE IF EXISTS preg_7_sino;
    CREATE TEMPORARY TABLE IF NOT EXISTS preg_7_sino (
        INDEX (store_id)
    ) AS
        (
            select *
            from tmp_sino
            where poll_id = @poll__id_7
            group by store_id
        );

    DROP TEMPORARY TABLE IF EXISTS preg_7;
    CREATE TEMPORARY TABLE IF NOT EXISTS preg_7 (
        INDEX (store_id)
    ) AS
        (
            select
                store_id,
                respuesta,
                sum(case when options = CONVERT(CONCAT(@poll__id_7, 'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
                sum(case when options = CONVERT(CONCAT(@poll__id_7, 'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
                sum(case when options = CONVERT(CONCAT(@poll__id_7, 'c') using utf8) collate utf8_spanish_ci then 1 else 0 end) as c,
                sum(case when options = CONVERT(CONCAT(@poll__id_7, 'd') using utf8) collate utf8_spanish_ci then 1 else 0 end) as d,
                foto,
                otro
            from tmp_opciones
            where poll_id = @poll__id_7
            group by store_id, respuesta, foto
        );


    DROP TEMPORARY TABLE IF EXISTS preg_8_sino;
    CREATE TEMPORARY TABLE IF NOT EXISTS preg_8_sino (
        INDEX (store_id)
    ) AS
        (
            select *
            from tmp_sino
            where poll_id = @poll__id_8
            group by store_id
        );

    DROP TEMPORARY TABLE IF EXISTS preg_8;
    CREATE TEMPORARY TABLE IF NOT EXISTS preg_8 (
        INDEX (store_id)
    ) AS
        (
            select
                store_id,
                respuesta,
                sum(case when options = CONVERT(CONCAT(@poll__id_8, 'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
                sum(case when options = CONVERT(CONCAT(@poll__id_8, 'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
                sum(case when options = CONVERT(CONCAT(@poll__id_8, 'c') using utf8) collate utf8_spanish_ci then 1 else 0 end) as c,
                sum(case when options = CONVERT(CONCAT(@poll__id_8, 'd') using utf8) collate utf8_spanish_ci then 1 else 0 end) as d,
                foto,
                otro
            from tmp_opciones
            where poll_id = @poll__id_8
            group by store_id, respuesta, foto
        );

    DROP TEMPORARY TABLE IF EXISTS preg_9_sino;
    CREATE TEMPORARY TABLE IF NOT EXISTS preg_9_sino (
        INDEX (store_id)
    ) AS
        (
            select
                store_id,
                respuesta,
                sum(case when options = CONVERT(CONCAT(@poll__id_9, 'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
                sum(case when options = CONVERT(CONCAT(@poll__id_9, 'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
                sum(case when options = CONVERT(CONCAT(@poll__id_9, 'c') using utf8) collate utf8_spanish_ci then 1 else 0 end) as c,
                sum(case when options = CONVERT(CONCAT(@poll__id_9, 'd') using utf8) collate utf8_spanish_ci then 1 else 0 end) as d,
                comentario,
                foto
            from tmp_opciones
            where poll_id = @poll__id_9
            group by store_id, respuesta, foto
        );

    DROP TEMPORARY TABLE IF EXISTS preg_9;
    CREATE TEMPORARY TABLE IF NOT EXISTS preg_9 (
        INDEX (store_id)
    ) AS
        (
            select
                store_id,
                respuesta,
                sum(case when options = CONVERT(CONCAT(@poll__id_9, 'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
                sum(case when options = CONVERT(CONCAT(@poll__id_9, 'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
                sum(case when options = CONVERT(CONCAT(@poll__id_9, 'c') using utf8) collate utf8_spanish_ci then 1 else 0 end) as c,
                sum(case when options = CONVERT(CONCAT(@poll__id_9, 'd') using utf8) collate utf8_spanish_ci then 1 else 0 end) as d,
                foto,
                otro
            from tmp_opciones
            where poll_id = @poll__id_9
            group by store_id, respuesta, foto
        );

    DROP TEMPORARY TABLE IF EXISTS preg_10_sino;
    CREATE TEMPORARY TABLE IF NOT EXISTS preg_10_sino (
        INDEX (store_id)
    ) AS
        (
            select *
            from tmp_sino
            where poll_id = @poll__id_10
            group by store_id
        );

    DROP TEMPORARY TABLE IF EXISTS preg_10;
    CREATE TEMPORARY TABLE IF NOT EXISTS preg_10 (
        INDEX (store_id)
    ) AS
        (
            select
                store_id,
                respuesta,
                sum(case when options = CONVERT(CONCAT(@poll__id_10, 'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
                sum(case when options = CONVERT(CONCAT(@poll__id_10, 'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
                sum(case when options = CONVERT(CONCAT(@poll__id_10, 'c') using utf8) collate utf8_spanish_ci then 1 else 0 end) as c,
                sum(case when options = CONVERT(CONCAT(@poll__id_10, 'd') using utf8) collate utf8_spanish_ci then 1 else 0 end) as d,
                foto,
                otro
            from tmp_opciones
            where poll_id = @poll__id_10
            group by store_id, respuesta, foto
        );

    -- -----------Evaluación de Transacción----------------
-- ----------------------------------------------------
    DROP TEMPORARY TABLE IF EXISTS preg_11_sino;
    CREATE TEMPORARY TABLE IF NOT EXISTS preg_11_sino (
        INDEX (store_id)
    ) AS
        (
            select *
            from tmp_sino
            where poll_id = @poll__id_11
            group by store_id
        );

    DROP TEMPORARY TABLE IF EXISTS preg_11;
    CREATE TEMPORARY TABLE IF NOT EXISTS preg_11 (
        INDEX (store_id)
    ) AS
        (
            select
                store_id,
                respuesta,
                sum(case when options = CONVERT(CONCAT(@poll__id_11, 'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
                sum(case when options = CONVERT(CONCAT(@poll__id_11, 'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
                sum(case when options = CONVERT(CONCAT(@poll__id_11, 'c') using utf8) collate utf8_spanish_ci then 1 else 0 end) as c,
                sum(case when options = CONVERT(CONCAT(@poll__id_11, 'd') using utf8) collate utf8_spanish_ci then 1 else 0 end) as d,
                foto,
                otro
            from tmp_opciones
            where poll_id = @poll__id_11
            group by store_id, respuesta, foto
        );


    SELECT
        tmp_comercios.store_id,
        tmp_comercios.codclient,
        tmp_comercios.fullname,
        tmp_comercios.address,
        tmp_comercios.district,
        tmp_comercios.region,
        tmp_comercios.ubigeo,
        tmp_comercios.latitude,
        tmp_comercios.longitude,
        tmp_comercios.ejecutivo,
        tmp_comercios.coordinador,
        tmp_comercios.fecha,
        tmp_comercios.hora,
        tmp_comercios.auditor,

-- --------------Introducción ------------------------
-- ----------------------------------------------------

        (case when preg_1_sino.Respuesta > 0 then 2 else preg_1_sino.Respuesta end) as '1_Respuesta',
        preg_1_sino.comentario as '1_Comentario',
        (case when preg_1.a > 0 then 2 else preg_1.a end) as '1_a',
        (case when preg_1.b > 0 then 2 else preg_1.b end) as '1_b',
        (case when preg_1.c > 0 then 2 else preg_1.c end) as '1_c',
        (case when preg_1.d > 0 then 2 else preg_1.d end) as '1_d',
        preg_1.otro as '1_Otro_Comentario',
        preg_1_sino.foto as '1_Foto',
        (case when preg_2_sino.Respuesta > 0 then 2  else preg_2_sino.Respuesta end)  as '2_Respuesta',
        preg_2_sino.comentario as '2_Comentario',
        (case when preg_2.a > 0 then 2 else preg_2.a end) as '2_a',
        (case when preg_2.b > 0 then 2 else preg_2.b end) as '2_b',
        (case when preg_2.c > 0 then 2 else preg_2.c end) as '2_c',
        preg_3_sino.comentario as '3_Comentario',

-- ----------------------------------------------------
        (case when preg_4_sino.Respuesta > 0 then 2 else preg_4_sino.Respuesta end)  as '4_Respuesta',
        preg_4_sino.comentario as '4_Comentario',
        (case when preg_4.a > 0 then 2 else preg_4.a end) as '4_a',
        (case when preg_4.b > 0 then 2 else preg_4.b end) as '4_b',
        (case when preg_4.c > 0 then 2 else preg_4.c end) as '4_c',
        (case when preg_4.d > 0 then 2 else preg_4.d end) as '4_d',
        (case when preg_4.e > 0 then 2 else preg_4.e end) as '4_e',
        preg_4.otro as '4_Otro_Comentario',
        preg_4_sino.Foto as '4_Foto',

        (case when preg_5_sino.Respuesta > 0 then 2 else preg_5_sino.Respuesta end)  as '5_Respuesta',
        preg_5_sino.comentario as '5_Comentario',
        (case when preg_5.a > 0 then 2 else preg_5.a end) as '5_a',
        (case when preg_5.b > 0 then 2 else preg_5.b end) as '5_b',
        (case when preg_5.c > 0 then 2 else preg_5.c end) as '5_c',
        (case when preg_5.d > 0 then 2 else preg_5.d end) as '5_d',
        preg_5.otro  as '5_Otro_Comentario',
        preg_5_sino.Foto  as '5_Foto',

        (case when preg_6_sino.Respuesta > 0 then 2 else preg_6_sino.Respuesta end) as '6_Respuesta',
        preg_6_sino.comentario as '6_Comentario',
        (case when preg_6.a > 0 then 2 else preg_6.a end) as '6_a',
        (case when preg_6.b > 0 then 2 else preg_6.b end) as '6_b',
        (case when preg_6.c > 0 then 2 else preg_6.c end) as '6_c',
        (case when preg_6.d > 0 then 2 else preg_6.d end) as '6_d',
        preg_6.otro  as '6_Otro_Comentario',
        preg_6_sino.Foto  as '6_Foto',

        (case when preg_7_sino.Respuesta > 0 then 2 else preg_7_sino.Respuesta end) as '7_Respuesta',
        preg_7_sino.comentario as '7_Comentario',
        (case when preg_7.a > 0 then 2 else preg_7.a end) as '7_a',
        (case when preg_7.b > 0 then 2 else preg_7.b end) as '7_b',
        (case when preg_7.c > 0 then 2 else preg_7.c end) as '7_c',
        (case when preg_7.d > 0 then 2 else preg_7.d end) as '7_d',
        preg_7.otro  as '7_Otro_Comentario',
        preg_7_sino.Foto  as '7_Foto',

        (case when preg_8_sino.Respuesta > 0 then 2 else preg_8_sino.Respuesta end) as '8_Respuesta',
        preg_8_sino.comentario as '8_Comentario',
        (case when preg_8.a > 0 then 2 else preg_8.a end) as '8_a',
        (case when preg_8.b > 0 then 2 else preg_8.b end) as '8_b',
        (case when preg_8.c > 0 then 2 else preg_8.c end) as '8_c',
        (case when preg_8.d > 0 then 2 else preg_8.d end) as '8_d',
        preg_8.otro  as '8_Otro_Comentario',
        preg_8_sino.Foto  as '8_Foto',

        (case when preg_9_sino.Respuesta > 0 then 2 else preg_9_sino.Respuesta end) as '9_Respuesta',
        preg_9_sino.comentario as '9_Comentario',
        (case when preg_9.a > 0 then 2 else preg_9.a end) as '9_a',
        (case when preg_9.b > 0 then 2 else preg_9.b end) as '9_b',
        (case when preg_9.c > 0 then 2 else preg_9.c end) as '9_c',
        (case when preg_9.d > 0 then 2 else preg_9.d end) as '9_d',
        preg_9.otro  as '9_Otro_Comentario',
        preg_9_sino.Foto  as '9_Foto',

        (case when preg_10.Respuesta > 0 then 2 else preg_10.Respuesta end) as '10_Respuesta',
        preg_10_sino.comentario as '10_Comentario',
        (case when preg_10.a > 0 then 2 else preg_10.a end) as '10_a',
        (case when preg_10.b > 0 then 2 else preg_10.b end) as '10_b',
        (case when preg_10.c > 0 then 2 else preg_10.c end) as '10_c',
        (case when preg_10.d > 0 then 2 else preg_10.d end) as '10_d',
        preg_10.otro  as '10_Otro_Comentario',
        preg_10_sino.Foto  as '10_Foto',

        (case when preg_11.Respuesta > 0 then 2 else preg_11.Respuesta end) as '11_Respuesta',
        preg_11_sino.comentario as '11_Comentario',
        (case when preg_11.a > 0 then 2 else preg_11.a end) as '11_a',
        (case when preg_11.b > 0 then 2 else preg_11.b end) as '11_b',
        (case when preg_11.c > 0 then 2 else preg_11.c end) as '11_c',
        (case when preg_11.d > 0 then 2 else preg_11.d end) as '11_d',
        preg_11.otro  as '11_Otro_Comentario',
        preg_11_sino.Foto  as '11_Foto'


    FROM tmp_comercios

             left outer join preg_1_sino on (tmp_comercios.store_id = preg_1_sino.store_id)
             left outer join preg_1 on (tmp_comercios.store_id = preg_1.store_id)
             left outer join preg_2_sino on (tmp_comercios.store_id = preg_2_sino.store_id)
             left outer join preg_2 on (tmp_comercios.store_id = preg_2.store_id)
             left outer join preg_3_sino on (tmp_comercios.store_id = preg_3_sino.store_id)
             left outer join preg_4_sino on (tmp_comercios.store_id = preg_4_sino.store_id)
             left outer join preg_4 on (tmp_comercios.store_id = preg_4.store_id)

             left outer join preg_5_sino on (tmp_comercios.store_id = preg_5_sino.store_id)
             left outer join preg_5 on (tmp_comercios.store_id = preg_5.store_id)

             left outer join preg_6_sino on (tmp_comercios.store_id = preg_6_sino.store_id)
             left outer join preg_6 on (tmp_comercios.store_id = preg_6.store_id)

             left outer join preg_7_sino on (tmp_comercios.store_id = preg_7_sino.store_id)
             left outer join preg_7 on (tmp_comercios.store_id = preg_7.store_id)

             left outer join preg_8_sino on (tmp_comercios.store_id = preg_8_sino.store_id)
             left outer join preg_8 on (tmp_comercios.store_id = preg_8.store_id)

             left outer join preg_9_sino on (tmp_comercios.store_id = preg_9_sino.store_id)
             left outer join preg_9 on (tmp_comercios.store_id = preg_9.store_id)

             left outer join preg_10_sino on (tmp_comercios.store_id = preg_10_sino.store_id)
             left outer join preg_10 on (tmp_comercios.store_id = preg_10.store_id)

             left outer join preg_11_sino on (tmp_comercios.store_id = preg_11_sino.store_id)
             left outer join preg_11 on (tmp_comercios.store_id = preg_11.store_id);



    SET @updated_at = (select DATE_SUB(NOW(), INTERVAL 5 HOUR));
    INSERT INTO `log_processes` (`processes`, `status`, `company_id`, `user_id`, `created_at`, `updated_at`)
    VALUES ('sp_lipton_v1', 1, _company_id, _user_id, @created_at, @updated_at);
    UPDATE `tempory_processes`
    SET `status` = 0, `processes` = 'sp_lipton_v1', `updated_at` = @updated_at;

    END IF;
    ELSE
        SET @updated_at = (select DATE_SUB(NOW(), INTERVAL 5 HOUR));
        INSERT INTO `tempory_processes` (`processes`, `status`, `company_id`, `user_id`, `created_at`, `updated_at`)
        VALUES ('sp_lipton_v1', 0, _company_id, 0, @created_at, @updated_at);
    END IF;
END