CREATE  PROCEDURE `sp_alicorp_regular_sod_v5_2`(IN _company_id INT, IN _desde INT, IN _hasta INT,IN _user_id INT)
BEGIN
    SET @created_at = (select DATE_SUB(NOW(),INTERVAL 5 HOUR));
    IF EXISTS (SELECT id FROM tempory_processes ) THEN

        SET @status_ =(SELECT `status` FROM tempory_processes) ;

        IF  @status_ = 0 THEN


            UPDATE `tempory_processes` SET `status` = 1 ,`processes` = 'sp_alicorp_regular_sod_v5_2';

-- Variables POLL_ID
            SET @poll__id_1   = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 1);
            SET @poll__id_2   = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 2);
            SET @poll__id_3   = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 10);
            -- Variables publicit__id_1
--				SET @publicit__id_1   = 925;
--				SET @publicit__id_2   = 926;
--				SET @publicit__id_3   = 927;
--				SET @publicit__id_4   = 928;
--				SET @publicit__id_5   = 929;
--				SET @publicit__id_6   = 930;
--				SET @publicit__id_7   = 936;
--				SET @publicit__id_8   = 939;
--				SET @publicit__id_9   = 940;
--				SET @publicit__id_10  = 941;
--				SET @publicit__id_11  = 0;

-- Este listado se obtiene de la tabla "stock_product_pop" ---------------------------
-- Todos son de la categoria 54 ---------------------------

            SET @publicit__id_1    = (SELECT   `id` FROM `publicities`  WHERE  `company_id` = _company_id AND   `category_product_id` = 54 AND   `order` = 1  );
            SET @publicit__id_2    = (SELECT   `id` FROM `publicities`  WHERE  `company_id` = _company_id AND   `category_product_id` = 54 AND   `order` = 2  );
            SET @publicit__id_3    = (SELECT   `id` FROM `publicities`  WHERE  `company_id` = _company_id AND   `category_product_id` = 54 AND   `order` = 3  );
            SET @publicit__id_4    = (SELECT   `id` FROM `publicities`  WHERE  `company_id` = _company_id AND   `category_product_id` = 54 AND   `order` = 4  );
            SET @publicit__id_5    = (SELECT   `id` FROM `publicities`  WHERE  `company_id` = _company_id AND   `category_product_id` = 54 AND   `order` = 5  );
            SET @publicit__id_6    = (SELECT   `id` FROM `publicities`  WHERE  `company_id` = _company_id AND   `category_product_id` = 54 AND   `order` = 6  );
            SET @publicit__id_7    = (SELECT   `id` FROM `publicities`  WHERE  `company_id` = _company_id AND   `category_product_id` = 54 AND   `order` = 7  );
            SET @publicit__id_8    = (SELECT   `id` FROM `publicities`  WHERE  `company_id` = _company_id AND   `category_product_id` = 54 AND   `order` = 8  );
            SET @publicit__id_9    = (SELECT   `id` FROM `publicities`  WHERE  `company_id` = _company_id AND   `category_product_id` = 54 AND   `order` = 9  );
            SET @publicit__id_10   = (SELECT   `id` FROM `publicities`  WHERE  `company_id` = _company_id AND   `category_product_id` = 54 AND   `order` = 10 );

            SET @publicit__id_11   = (SELECT   `id` FROM `publicities`  WHERE  `company_id` = _company_id AND   `category_product_id` = 54 AND   `order` = 11 );

            SET @publicit__id_19   = (SELECT   `id` FROM `publicities`  WHERE  `company_id` = _company_id AND   `category_product_id` = 54 AND   `order` = 19 );
            SET @publicit__id_20   = (SELECT   `id` FROM `publicities`  WHERE  `company_id` = _company_id AND   `category_product_id` = 54 AND   `order` = 20 );

            SET @publicit__id_21   = (SELECT   `id` FROM `publicities`  WHERE  `company_id` = _company_id AND   `category_product_id` = 54 AND   `order` = 21 );
            SET @publicit__id_22   = (SELECT   `id` FROM `publicities`  WHERE  `company_id` = _company_id AND   `category_product_id` = 54 AND   `order` = 22 );



            /* Temporal que contiene el detalle de los comercios */
            DROP TEMPORARY TABLE IF EXISTS tmp_comercios;
            CREATE TEMPORARY TABLE IF NOT EXISTS tmp_comercios ( INDEX(store_id) ) AS
                (
                    -- 		select * FROM comercio_excel_company_87 group by store_id
                    select * FROM (SELECT
                                       `f`.`company_id` AS `company_id`,
                                       `a`.`store_id` AS `store_id`,
                                       `b`.`type` AS `type`,
                                       `b`.`cadenaRuc` AS `cadenaRuc`,
                                       `b`.`fullname` AS `fullname`,
                                       `b`.`address` AS `address`,
                                       `b`.`region` AS `region`,
                                       `b`.`ubigeo` AS `ubigeo`,
                                       `b`.`codclient` AS `codclient`,
                                       `b`.`distributor` AS `distributor`,
                                       `b`.`district` AS `district`,
                                       `b`.`latitude` AS `latitude`,
                                       `b`.`longitude` AS `longitude`,
                                       `b`.`tipo_bodega` AS `tipo_bodega`,
                                       DATE_FORMAT(`a`.`created_at`, '%d/%m/%Y') AS `fecha`,
                                       MIN(DATE_FORMAT(`a`.`created_at`, '%H:%i:%s')) AS `hora`,
                                       `e`.`id` AS `auditor_id`,
                                       `e`.`fullname` AS `Auditor`
                                   FROM
                                       (((((`poll_details` `a`
                                           LEFT JOIN `stores` `b` ON ((`a`.`store_id` = `b`.`id`)))
                                           LEFT JOIN `road_details` `c` ON (((`c`.`store_id` = `b`.`id`)
                                               AND (`c`.`company_id` = _company_id))))
                                           LEFT JOIN `roads` `d` ON ((`c`.`road_id` = `d`.`id`)))
                                           LEFT JOIN `users` `e` ON ((`d`.`user_id` = `e`.`id`)))
                                           LEFT JOIN `company_stores` `f` ON (((`a`.`store_id` = `f`.`store_id`)
                                           AND (`a`.`company_id` = `f`.`company_id`))))
                                   WHERE
                                       (`a`.`store_id` IN (SELECT
                                                               `road_details`.`store_id`
                                                           FROM
                                                               `road_details`
                                                           WHERE
                                                               ((`road_details`.`audit` = 1)
                                                                   AND (`f`.`company_id` = _company_id)))
                                           AND (`f`.`company_id` = _company_id)
                                           AND (`b`.`test` = 0))
                                   GROUP BY `f`.`company_id` , `a`.`store_id` , `b`.`type` , `b`.`cadenaRuc` , `b`.`fullname` , `b`.`address` , `b`.`region` , `b`.`ubigeo` , `b`.`district` , `b`.`latitude` , `b`.`longitude` ,  `e`.`id` , `e`.`fullname`
                                   LIMIT _desde,_hasta


                                  ) AS stores  group by store_id
                );

            /* Temporal que contiene el detalle de las respuestas tipo si/no */
            DROP TEMPORARY TABLE IF EXISTS tmp_sino;
            CREATE TEMPORARY TABLE IF NOT EXISTS tmp_sino ( INDEX(company_id, store_id, poll_id) ) AS
                (

                    select * FROM
                        (
                            SELECT
                                c.company_id AS company_id,
                                a.store_id AS store_id,
                                a.product_id AS product_id,
                                a.poll_id AS poll_id,
                                a.result AS Respuesta,
                                a.comentario AS comentario,
                                RTRIM(SUBSTR(a.limite,
                                             (LOCATE('|', a.limite) + 1),
                                             LENGTH(a.limite))) AS Opcion,
                                CONCAT('http://ttaudit.com/media/fotos/',
                                       h.archivo) AS Foto,
                                a.publicity_id AS publicity_id
                            FROM
                                (((((ttaudit_auditors.poll_details a
                                    LEFT JOIN ttaudit_auditors.polls b ON ((a.poll_id = b.id)))
                                    LEFT JOIN ttaudit_auditors.company_audits c ON ((c.id = b.company_audit_id)))
                                    LEFT JOIN ttaudit_auditors.stores d ON ((a.store_id = d.id)))
                                    LEFT JOIN ttaudit_auditors.audits g ON ((g.id = c.audit_id)))
                                    LEFT JOIN (SELECT
                                                   x.id AS id,
                                                   x.store_id AS store_id,
                                                   x.poll_id AS poll_id,
                                                   x.publicities_id AS publicities_id,
                                                   x.invoices_id AS invoices_id,
                                                   x.tipo AS tipo,
                                                   x.archivo AS archivo,
                                                   x.created_at AS created_at,
                                                   x.updated_at AS updated_at,
                                                   x.product_id AS product_id
                                               FROM
                                                   ttaudit_auditors.medias x
                                               WHERE
                                                       (x.poll_id ,
                                                        x.store_id,
                                                        x.product_id,
                                                        x.id) IN (SELECT
                                                                      ttaudit_auditors.medias.poll_id AS poll_id,
                                                                      ttaudit_auditors.medias.store_id AS store_id,
                                                                      ttaudit_auditors.medias.product_id AS product_id,
                                                                      MAX(ttaudit_auditors.medias.id) AS id
                                                                  FROM
                                                                      ttaudit_auditors.medias
                                                                  WHERE  medias.company_id = _company_id
                                                                  GROUP BY ttaudit_auditors.medias.poll_id , ttaudit_auditors.medias.store_id , ttaudit_auditors.medias.product_id)) h ON (((a.poll_id = h.poll_id)
                                    AND (a.store_id = h.store_id)
                                    AND (a.product_id = h.product_id))))
                            WHERE
                                (c.company_id = _company_id)
                        ) yy
                    where store_id in (select store_id from tmp_comercios)
                );

            /* Temporal que contiene el detalle de las respuestas tipo opciones */
            DROP TEMPORARY TABLE IF EXISTS tmp_opciones;
            CREATE TEMPORARY TABLE IF NOT EXISTS tmp_opciones ( INDEX(company_id, store_id, poll_id) ) AS
                (

                    select * FROM
                        (
                            SELECT DISTINCT
                                c.company_id AS company_id,
                                a.poll_id AS poll_id,
                                a.store_id AS store_id,
                                f.result AS result,
                                a.result AS Respuesta_si_no,
                                f.otro AS otro,
                                a.limite AS limite,
                                e.codigo AS options,
                                f.product_id AS product_id,
                                f.publicity_id AS publicity_id,
                                f.priority AS priority,
                                e.options AS desc_option,
                                a.comentario AS Comentario,
                                CONCAT('http://ttaudit.com/media/fotos/',
                                       h.archivo) AS Foto
                            FROM
                                ((((((ttaudit_auditors.poll_details a
                                    LEFT JOIN ttaudit_auditors.polls b ON ((a.poll_id = b.id)))
                                    LEFT JOIN ttaudit_auditors.company_audits c ON ((c.id = b.company_audit_id)))
                                    LEFT JOIN ttaudit_auditors.poll_options e ON ((e.poll_id = b.id)))
                                    JOIN ttaudit_auditors.poll_option_details f ON (((f.poll_option_id = e.id)
                                        AND (a.store_id = f.store_id))))
                                    LEFT JOIN ttaudit_auditors.audits g ON ((g.id = c.audit_id)))
                                    LEFT JOIN (SELECT
                                                   x.id AS id,
                                                   x.store_id AS store_id,
                                                   x.poll_id AS poll_id,
                                                   x.publicities_id AS publicities_id,
                                                   x.invoices_id AS invoices_id,
                                                   x.tipo AS tipo,
                                                   x.archivo AS archivo,
                                                   x.created_at AS created_at,
                                                   x.updated_at AS updated_at,
                                                   x.product_id AS product_id
                                               FROM
                                                   ttaudit_auditors.medias x
                                               WHERE
                                                       (x.poll_id ,
                                                        x.store_id,
                                                        x.product_id,
                                                        x.id) IN (SELECT
                                                                      ttaudit_auditors.medias.poll_id AS poll_id,
                                                                      ttaudit_auditors.medias.store_id AS store_id,
                                                                      ttaudit_auditors.medias.product_id AS product_id,
                                                                      MAX(ttaudit_auditors.medias.id) AS id
                                                                  FROM
                                                                      ttaudit_auditors.medias
                                                                  WHERE  medias.company_id = _company_id
                                                                  GROUP BY ttaudit_auditors.medias.poll_id , ttaudit_auditors.medias.store_id , ttaudit_auditors.medias.product_id)) h ON (((a.poll_id = h.poll_id)
                                    AND (a.store_id = h.store_id)
                                    AND (a.product_id = h.product_id))))
                            WHERE
                                (c.company_id = _company_id)
                        ) yy
                    where store_id in (select store_id from tmp_comercios)
                );
            -- ****************************** PREGUNTAS GENERALES ********************************************


            DROP TEMPORARY TABLE IF EXISTS preg_si_no_1;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_1 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_1 and product_id=0  group by store_id , poll_id
                );

            /* Temporal que contiene detalle de la pregunta 1463  */
            DROP TEMPORARY TABLE IF EXISTS preg_1;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_1 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_opciones where poll_id = @poll__id_1 and product_id=0  group by store_id , poll_id
                );



            /* Temporal que contiene detalle de la pregunta 1464  */
            DROP TEMPORARY TABLE IF EXISTS preg_si_no_2;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_2 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_2 and product_id=0  group by store_id , poll_id
                );
            /* Temporal que contiene detalle de la pregunta 1464  */
            DROP TEMPORARY TABLE IF EXISTS preg_2;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_2 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_opciones where poll_id = @poll__id_2 and product_id=0  group by store_id , poll_id
                );






            -- ******************************  Ventana Galletas ********************************************



            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_4_3837;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_4_3837 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_4 and product_id=3837 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_4_3838;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_4_3838 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_4 and product_id=3838 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_4_3839;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_4_3839 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_4 and product_id=3839 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_4_3840;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_4_3840 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_4 and product_id=3840 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_4_3841;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_4_3841 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_4 and product_id=3841 group by store_id, poll_id , publicity_id, product_id
                );

            -- ******************************  Ventana Margarinas ********************************************
            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_10_3828;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_10_3828 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_10 and product_id=3828 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_10_3829;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_10_3829 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_10 and product_id=3829 group by store_id, poll_id , publicity_id, product_id
                );


            -- ******************************  Cuidado de la Piel ********************************************
            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_19_3914;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_19_3914 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_19 and product_id=3914 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_19_3915;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_19_3915 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_19 and product_id=3915 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_19_3916;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_19_3916 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_19 and product_id=3916 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_19_3917;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_19_3917 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_19 and product_id=3917 group by store_id, poll_id , publicity_id, product_id
                );



            -- ******************************  Pasta Dental ********************************************
            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_20_3918;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_20_3918 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_20 and product_id=3918 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_20_3919;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_20_3919 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_20 and product_id=3919 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_20_3920;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_20_3920 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_20 and product_id=3920 group by store_id, poll_id , publicity_id, product_id
                );



            -- ******************************    Ventana Conservas de Atún ********************************************

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_7_814;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_7_814 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_7 and product_id=814 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_7_793;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_7_793 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_7 and product_id=793 group by store_id, poll_id , publicity_id,product_id
                );

            --             DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_7_821;
--             CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_7_821 ( INDEX(store_id ) ) AS
--                 (
--                     select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_7 and product_id=821 group by store_id, poll_id , publicity_id, product_id
--                 );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_7_3733;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_7_3733 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_7 and product_id=3733 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_7_3735;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_7_3735 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_7 and product_id=3735 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_7_3736;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_7_3736 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_7 and product_id=3736 group by store_id, poll_id , publicity_id, product_id
                );


            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_7_3921;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_7_3921 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_7 and product_id=3921 group by store_id, poll_id , publicity_id, product_id
                );


            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_7_3922;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_7_3922 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_7 and product_id=3922 group by store_id, poll_id , publicity_id, product_id
                );


            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_7_3923;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_7_3923 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_7 and product_id=3923 group by store_id, poll_id , publicity_id, product_id
                );


            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_7_3924;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_7_3924 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_7 and product_id=3924 group by store_id, poll_id , publicity_id, product_id
                );


            -- ******************************  Ventana Mercados Lava vajillas ********************************************

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_11_793;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_11_793 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_11 and product_id=793 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_11_4166;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_11_4166 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_11 and product_id=4166 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_11_4165;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_11_4165 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_11 and product_id=4165 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_11_4164;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_11_4164 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_11 and product_id=4164 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_11_4163;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_11_4163 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_11 and product_id=4163 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_11_4162;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_11_4162 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_11 and product_id=4162 group by store_id, poll_id , publicity_id,product_id
                );


            -- ******************************  Ventana Mercados Lejias ********************************************

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_21_793;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_21_793 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_21 and product_id=793 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_21_4162;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_21_4162 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_21 and product_id=4162 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_21_4167;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_21_4167 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_21 and product_id=4167 group by store_id, poll_id , publicity_id,product_id
                );

            -- ******************************  Ventana Mercados Limpiadores Light Duty ********************************************

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_22_793;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_22_793 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_22 and product_id=793 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_22_4162;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_22_4162 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_22 and product_id=4162 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_22_4168;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_22_4168 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_22 and product_id=4168 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_22_4169;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_22_4169 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_22 and product_id=4169 group by store_id, poll_id , publicity_id,product_id
                );


            /*-----------------------------------------------------------*/
            /*------------- End creation table temprary-----------------*/
            /*-----------------------------------------------------------*/
            SELECT
                tmp_comercios.store_id,
                tmp_comercios.cadenaRuc,
                tmp_comercios.fullname,
                tmp_comercios.address,
                tmp_comercios.district,
                tmp_comercios.ubigeo,
                tmp_comercios.codclient,
                tmp_comercios.distributor,
                tmp_comercios.latitude,
                tmp_comercios.longitude,
                tmp_comercios.Auditor,
                tmp_comercios.fecha,
                tmp_comercios.hora,

                -- ****************************** PREGUNTAS GENERALES ********************************************
                (case when preg_si_no_1.Respuesta > 0 then 2  else '0' end) as '1_Respuesta',
                preg_1.desc_option as '1_Opciones',
                preg_1.Foto as '1_Foto',

                (case when preg_si_no_2.Respuesta > 0 then 2 else '0' end) as '2_Respuesta',
                preg_2.desc_option as '2_Opciones',
                preg_2.Comentario as '2_Comentario',
                preg_2.Foto as '2_Foto',
                -- ****************************** Ventana  ********************************************


                preg_3_publicity_4_3837.Comentario  as '3_4_3837_Comentario',
                preg_3_publicity_4_3838.Comentario  as '3_4_3838_Comentario',
                preg_3_publicity_4_3839.Comentario  as '3_4_3839_Comentario',
                preg_3_publicity_4_3840.Comentario  as '3_4_3840_Comentario',
                preg_3_publicity_4_3841.Comentario  as '3_4_3841_Comentario',

                preg_3_publicity_10_3828.Comentario  as '3_10_3828_Comentario',
                preg_3_publicity_10_3829.Comentario  as '3_10_3829_Comentario',


                preg_3_publicity_19_3914.Comentario  as '3_19_3914_Comentario',
                preg_3_publicity_19_3915.Comentario  as '3_19_3915_Comentario',
                preg_3_publicity_19_3916.Comentario  as '3_19_3916_Comentario',
                preg_3_publicity_19_3917.Comentario  as '3_19_3917_Comentario',

                preg_3_publicity_20_3918.Comentario  as '3_2020_3918_Comentario',
                preg_3_publicity_20_3919.Comentario  as '3_2020_3919_Comentario',
                preg_3_publicity_20_3920.Comentario  as '3_2020_3920_Comentario',




                preg_3_publicity_7_814.Comentario  as '3_7_814_Comentario',
                preg_3_publicity_7_793.Comentario  as '3_7_793_Comentario',
--     preg_3_publicity_7_821.Comentario  as '3_7_821_Comentario',
                preg_3_publicity_7_3733.Comentario  as '3_7_3733_Comentario',
                preg_3_publicity_7_3735.Comentario  as '3_7_3735_Comentario',
                preg_3_publicity_7_3736.Comentario  as '3_7_3736_Comentario',
                preg_3_publicity_7_3921.Comentario  as '3_7_3921_Comentario',
                preg_3_publicity_7_3922.Comentario  as '3_7_3922_Comentario',
                preg_3_publicity_7_3923.Comentario  as '3_7_3923_Comentario',
                preg_3_publicity_7_3924.Comentario  as '3_7_3924_Comentario',

                preg_3_publicity_11_793.Comentario   as '3_11_793_Comentario',
                preg_3_publicity_11_4166.Comentario  as '3_11_4166_Comentario',
                preg_3_publicity_11_4165.Comentario  as '3_11_4165_Comentario',
                preg_3_publicity_11_4164.Comentario  as '3_11_4164_Comentario',
                preg_3_publicity_11_4163.Comentario  as '3_11_4163_Comentario',
                preg_3_publicity_11_4162.Comentario  as '3_11_4162_Comentario',

                preg_3_publicity_21_793.Comentario   as '3_21_793_Comentario',
                preg_3_publicity_21_4162.Comentario  as '3_21_4162_Comentario',
                preg_3_publicity_21_4167.Comentario  as '3_21_4167_Comentario',

                preg_3_publicity_22_793.Comentario   as '3_22_793_Comentario',
                preg_3_publicity_22_4162.Comentario  as '3_22_4162_Comentario',
                preg_3_publicity_22_4168.Comentario  as '3_22_4168_Comentario',
                preg_3_publicity_22_4169.Comentario  as '3_22_4169_Comentario'




            FROM tmp_comercios

                     left outer join preg_si_no_1 on (tmp_comercios.store_id = preg_si_no_1.store_id )
                     left outer join preg_1 on (tmp_comercios.store_id = preg_1.store_id )


                     left outer join preg_si_no_2 on (tmp_comercios.store_id = preg_si_no_2.store_id )
                     left outer join preg_2 on (tmp_comercios.store_id = preg_2.store_id )

                -- ****************************** Ventanas ********************************************


                     left outer join preg_3_publicity_4_3837 on (tmp_comercios.store_id = preg_3_publicity_4_3837.store_id )
                     left outer join preg_3_publicity_4_3838 on (tmp_comercios.store_id = preg_3_publicity_4_3838.store_id )
                     left outer join preg_3_publicity_4_3839 on (tmp_comercios.store_id = preg_3_publicity_4_3839.store_id )
                     left outer join preg_3_publicity_4_3840 on (tmp_comercios.store_id = preg_3_publicity_4_3840.store_id )
                     left outer join preg_3_publicity_4_3841 on (tmp_comercios.store_id = preg_3_publicity_4_3841.store_id )

                     left outer join preg_3_publicity_10_3828 on (tmp_comercios.store_id = preg_3_publicity_10_3828.store_id )
                     left outer join preg_3_publicity_10_3829 on (tmp_comercios.store_id = preg_3_publicity_10_3829.store_id )

                     left outer join preg_3_publicity_19_3914 on (tmp_comercios.store_id = preg_3_publicity_19_3914.store_id )
                     left outer join preg_3_publicity_19_3915 on (tmp_comercios.store_id = preg_3_publicity_19_3915.store_id )
                     left outer join preg_3_publicity_19_3916 on (tmp_comercios.store_id = preg_3_publicity_19_3916.store_id )
                     left outer join preg_3_publicity_19_3917 on (tmp_comercios.store_id = preg_3_publicity_19_3917.store_id )

                     left outer join preg_3_publicity_20_3918 on (tmp_comercios.store_id = preg_3_publicity_20_3918.store_id )
                     left outer join preg_3_publicity_20_3919 on (tmp_comercios.store_id = preg_3_publicity_20_3919.store_id )
                     left outer join preg_3_publicity_20_3920 on (tmp_comercios.store_id = preg_3_publicity_20_3920.store_id )


                     left outer join preg_3_publicity_7_814 on (tmp_comercios.store_id = preg_3_publicity_7_814.store_id )
                     left outer join preg_3_publicity_7_793 on (tmp_comercios.store_id = preg_3_publicity_7_793.store_id )
--          left outer join preg_3_publicity_7_821 on (tmp_comercios.store_id = preg_3_publicity_7_821.store_id )
                     left outer join preg_3_publicity_7_3733 on (tmp_comercios.store_id = preg_3_publicity_7_3733.store_id )
                     left outer join preg_3_publicity_7_3735 on (tmp_comercios.store_id = preg_3_publicity_7_3735.store_id )
                     left outer join preg_3_publicity_7_3736 on (tmp_comercios.store_id = preg_3_publicity_7_3736.store_id )
                     left outer join preg_3_publicity_7_3921 on (tmp_comercios.store_id = preg_3_publicity_7_3921.store_id )
                     left outer join preg_3_publicity_7_3922 on (tmp_comercios.store_id = preg_3_publicity_7_3922.store_id )
                     left outer join preg_3_publicity_7_3923 on (tmp_comercios.store_id = preg_3_publicity_7_3923.store_id )
                     left outer join preg_3_publicity_7_3924 on (tmp_comercios.store_id = preg_3_publicity_7_3924.store_id )

                     left outer join preg_3_publicity_11_4166 on (tmp_comercios.store_id = preg_3_publicity_11_4166.store_id )
                     left outer join preg_3_publicity_11_793 on (tmp_comercios.store_id = preg_3_publicity_11_793.store_id )
                     left outer join preg_3_publicity_11_4165 on (tmp_comercios.store_id = preg_3_publicity_11_4165.store_id )

                     left outer join preg_3_publicity_11_4164 on (tmp_comercios.store_id = preg_3_publicity_11_4164.store_id )
                     left outer join preg_3_publicity_11_4163 on (tmp_comercios.store_id = preg_3_publicity_11_4163.store_id )
                     left outer join preg_3_publicity_11_4162 on (tmp_comercios.store_id = preg_3_publicity_11_4162.store_id )

                     left outer join preg_3_publicity_21_793 on (tmp_comercios.store_id = preg_3_publicity_21_793.store_id )
                     left outer join preg_3_publicity_21_4162 on (tmp_comercios.store_id = preg_3_publicity_21_4162.store_id )
                     left outer join preg_3_publicity_21_4167 on (tmp_comercios.store_id = preg_3_publicity_21_4167.store_id )

                     left outer join preg_3_publicity_22_793 on (tmp_comercios.store_id = preg_3_publicity_22_793.store_id )
                     left outer join preg_3_publicity_22_4162 on (tmp_comercios.store_id = preg_3_publicity_22_4162.store_id )
                     left outer join preg_3_publicity_22_4168 on (tmp_comercios.store_id = preg_3_publicity_22_4168.store_id )
                     left outer join preg_3_publicity_22_4169 on (tmp_comercios.store_id = preg_3_publicity_22_4169.store_id )





            ORDER BY tmp_comercios.fecha Desc, tmp_comercios.hora DESC;


            SET @updated_at = (select DATE_SUB(NOW(),INTERVAL 5 HOUR));
            INSERT INTO `log_processes`(`processes`,`status`,`company_id`,`user_id`,`created_at`,`updated_at`) VALUES ('sp_alicorp_regular_sod_v5_2',1, _company_id , _user_id,@created_at,@updated_at);
            UPDATE `tempory_processes` SET `status` = 0 , `processes` = 'sp_alicorp_regular_sod_v5_2';
        END IF;
    ELSE
        SET @updated_at = (select DATE_SUB(NOW(),INTERVAL 5 HOUR));
        INSERT INTO `tempory_processes`(`processes`,`status`,`company_id`,`user_id`,`created_at`,`updated_at`) VALUES ('sp_alicorp_regular_sod_v5_2',0, _company_id , 0,now(),@updated_at);
    END IF;

END