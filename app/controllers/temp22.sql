CREATE DEFINER=`dataser_admin`@`%` PROCEDURE `sp_alicorp_regular_sod_v6`(IN _company_id INT, IN _desde INT, IN _hasta INT,IN _user_id INT)
BEGIN
    SET @created_at = (select DATE_SUB(NOW(),INTERVAL 5 HOUR));
    IF EXISTS (SELECT id FROM tempory_processes ) THEN

        SET @status_ =(SELECT `status` FROM tempory_processes) ;

        IF  @status_ = 0 THEN


UPDATE `tempory_processes` SET `status` = 1 ,`processes` = 'sp_alicorp_regular_sod_v5';

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

            -- ****************************** Ventana Salsas ********************************************


            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_1_797;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_1_797 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_1 and product_id=797 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_1_821;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_1_821 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_1 and product_id=821 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_1_793;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_1_793 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_1 and product_id=793 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_1_3734;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_1_3734 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_1 and product_id=3734 group by store_id, poll_id , publicity_id, product_id
                );


            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_1_3802;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_1_3802 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_1 and product_id=3802 group by store_id, poll_id , publicity_id, product_id
                );


            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_1_3803;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_1_3803 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_1 and product_id=3803 group by store_id, poll_id , publicity_id, product_id
                );


            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_1_3830;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_1_3830 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_1 and product_id=3830 group by store_id, poll_id , publicity_id, product_id
                );


            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_1_3831;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_1_3831 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_1 and product_id=3831 group by store_id, poll_id , publicity_id, product_id
                );

            -- ******************************  Ventana Pastas ********************************************
            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_2_790;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_2_790 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_2 and product_id=790 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_2_791;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_2_791 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_2 and product_id=791 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_2_792;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_2_792 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_2 and product_id=792 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_2_793;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_2_793 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_2 and product_id=793 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_2_821;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_2_821 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_2 and product_id=821 group by store_id, poll_id , publicity_id,product_id
                );


            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_2_3832;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_2_3832 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_2 and product_id=3832 group by store_id, poll_id , publicity_id,product_id
                );


            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_2_3833;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_2_3833 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_2 and product_id=3833 group by store_id, poll_id , publicity_id,product_id
                );




            -- ******************************  Ventana Aceites ********************************************

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_3_787;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_3_787 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_3 and product_id=787 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_3_788;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_3_788 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_3 and product_id=788 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_3_789;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_3_789 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_3 and product_id=789 group by store_id, poll_id , publicity_id,product_id
                );


            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_3_793;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_3_793 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_3 and product_id=793 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_3_821;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_3_821 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_3 and product_id=821 group by store_id, poll_id , publicity_id,product_id
                );


            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_3_3834;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_3_3834 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_3 and product_id=3834 group by store_id, poll_id , publicity_id,product_id
                );


            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_3_3835;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_3_3835 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_3 and product_id=3835 group by store_id, poll_id , publicity_id,product_id
                );




            -- ******************************  Ventana Galletas ********************************************

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_4_793;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_4_793 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_4 and product_id=793 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_4_804;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_4_804 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_4 and product_id=804 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_4_821;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_4_821 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_4 and product_id=821 group by store_id, poll_id , publicity_id, product_id
                );

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

            -- ******************************  Ventana Refrescos ********************************************

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_5_807;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_5_807 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_5 and product_id=807 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_5_808;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_5_808 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_5 and product_id=808 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_5_809;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_5_809 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_5 and product_id=809 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_5_793;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_5_793 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_5 and product_id=793 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_5_821;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_5_821 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_5 and product_id=821 group by store_id, poll_id , publicity_id,product_id
                );


            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_5_3836;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_5_3836 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_5 and product_id=3836 group by store_id, poll_id , publicity_id,product_id
                );


            -- ******************************  Ventana Detergentes ********************************************

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_6_799;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_6_799 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_6 and product_id=799 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_6_800;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_6_800 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_6 and product_id=800 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_6_801;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_6_801 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_6 and product_id=801 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_6_793;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_6_793 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_6 and product_id=793 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_6_821;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_6_821 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_6 and product_id=821 group by store_id, poll_id , publicity_id, product_id
                );


            -- ******************************    Ventana Suavizantes Bolivar ********************************************

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_8_817;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_8_817 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_8 and product_id=817 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_8_793;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_8_793 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_8 and product_id=793 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_8_821;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_8_821 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_8 and product_id=821 group by store_id, poll_id , publicity_id,product_id
                );

            -- ******************************  Ventana Quitamanchas Opal ********************************************

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_9_819;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_9_819 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_9 and product_id=819 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_9_793;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_9_793 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_9 and product_id=793 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_9_821;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_9_821 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_9 and product_id=821 group by store_id, poll_id , publicity_id,product_id
                );

            -- ******************************  Ventana Margarinas (Manty y Sello de Oro) ********************************************

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_10_811;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_10_811 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_10 and product_id=811 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_10_812;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_10_812 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_10 and product_id=812 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_10_793;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_10_793 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_10 and product_id=793 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_10_821;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_10_821 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_10 and product_id=821 group by store_id, poll_id , publicity_id,product_id
                );


            -- ******************************  Ventana Marsella (Mercados Lava vajillas) ********************************************

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_11_793;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_11_793 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_11 and product_id=793 group by store_id, poll_id , publicity_id, product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_11_2315;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_11_2315 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_11 and product_id=2315 group by store_id, poll_id , publicity_id,product_id
                );

            DROP TEMPORARY TABLE IF EXISTS preg_3_publicity_11_3452;
            CREATE TEMPORARY TABLE IF NOT EXISTS preg_3_publicity_11_3452 ( INDEX(store_id ) ) AS
                (
                    select * from tmp_sino where poll_id = @poll__id_3 and publicity_id=@publicit__id_11 and product_id=3452 group by store_id, poll_id , publicity_id,product_id
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
        preg_3_publicity_1_797.Comentario  as  '3_1_797_Comentario',
        preg_3_publicity_1_793.Comentario  as  '3_1_793_Comentario',
        preg_3_publicity_1_821.Comentario  as  '3_1_821_Comentario',
        preg_3_publicity_1_3734.Comentario  as '3_1_3734_Comentario',
        preg_3_publicity_1_3802.Comentario  as '3_1_3802_Comentario',
        preg_3_publicity_1_3803.Comentario  as '3_1_3803_Comentario',

        preg_3_publicity_2_790.Comentario  as '3_2_790_Comentario',
        preg_3_publicity_2_791.Comentario  as '3_2_791_Comentario',
        preg_3_publicity_2_792.Comentario  as '3_2_792_Comentario',
        preg_3_publicity_2_793.Comentario  as '3_2_793_Comentario',
        preg_3_publicity_2_821.Comentario  as '3_2_821_Comentario',


        preg_3_publicity_3_787.Comentario  as '3_3_787_Comentario',
        preg_3_publicity_3_788.Comentario  as '3_3_788_Comentario',
        preg_3_publicity_3_789.Comentario  as '3_3_789_Comentario',
        preg_3_publicity_3_793.Comentario  as '3_3_793_Comentario',
        preg_3_publicity_3_821.Comentario  as '3_3_821_Comentario',

        preg_3_publicity_4_804.Comentario  as '3_4_804_Comentario',
        preg_3_publicity_4_793.Comentario  as '3_4_793_Comentario',
        preg_3_publicity_4_821.Comentario  as '3_4_821_Comentario',


        preg_3_publicity_5_807.Comentario  as '3_5_807_Comentario',
        preg_3_publicity_5_808.Comentario  as '3_5_808_Comentario',
        preg_3_publicity_5_809.Comentario  as '3_5_809_Comentario',
        preg_3_publicity_5_793.Comentario  as '3_5_793_Comentario',
        preg_3_publicity_5_821.Comentario  as '3_5_821_Comentario',

        preg_3_publicity_6_799.Comentario  as '3_6_799_Comentario',
        preg_3_publicity_6_800.Comentario  as '3_6_800_Comentario',
        preg_3_publicity_6_801.Comentario  as '3_6_801_Comentario',
        preg_3_publicity_6_793.Comentario  as '3_6_793_Comentario',
        preg_3_publicity_6_821.Comentario  as '3_6_821_Comentario',



        preg_3_publicity_8_817.Comentario  as '3_8_817_Comentario',
        preg_3_publicity_8_793.Comentario  as '3_8_793_Comentario',
        preg_3_publicity_8_821.Comentario  as '3_8_821_Comentario',

        preg_3_publicity_9_819.Comentario  as '3_9_819_Comentario',
        preg_3_publicity_9_793.Comentario  as '3_9_793_Comentario',
        preg_3_publicity_9_821.Comentario  as '3_9_821_Comentario',

        preg_3_publicity_10_811.Comentario  as '3_10_811_Comentario',
        preg_3_publicity_10_812.Comentario  as '3_10_812_Comentario',
        preg_3_publicity_10_793.Comentario  as '3_10_793_Comentario',
        preg_3_publicity_10_821.Comentario  as '3_10_821_Comentario',



        preg_3_publicity_11_793.Comentario   as '3_11_793_Comentario',
        preg_3_publicity_11_2315.Comentario  as '3_11_2315_Comentario',
        preg_3_publicity_11_3452.Comentario  as '3_11_3452_Comentario',




        preg_3_publicity_1_3830.Comentario  as '3_1_3830_Comentario',
        preg_3_publicity_1_3831.Comentario  as '3_1_3831_Comentario',

        preg_3_publicity_2_3832.Comentario  as '3_2_3832_Comentario',
        preg_3_publicity_2_3833.Comentario  as '3_2_3833_Comentario',

        preg_3_publicity_3_3834.Comentario  as '3_3_3834_Comentario',
        preg_3_publicity_3_3835.Comentario  as '3_3_3835_Comentario',

        preg_3_publicity_5_3836.Comentario  as '3_5_3836_Comentario'



FROM tmp_comercios

         left outer join preg_si_no_1 on (tmp_comercios.store_id = preg_si_no_1.store_id )
         left outer join preg_1 on (tmp_comercios.store_id = preg_1.store_id )


         left outer join preg_si_no_2 on (tmp_comercios.store_id = preg_si_no_2.store_id )
         left outer join preg_2 on (tmp_comercios.store_id = preg_2.store_id )

    -- ****************************** Ventanas ********************************************
         left outer join preg_3_publicity_1_793 on (tmp_comercios.store_id = preg_3_publicity_1_793.store_id )
         left outer join preg_3_publicity_1_821 on (tmp_comercios.store_id = preg_3_publicity_1_821.store_id )
         left outer join preg_3_publicity_1_797 on (tmp_comercios.store_id = preg_3_publicity_1_797.store_id )
         left outer join preg_3_publicity_1_3734 on (tmp_comercios.store_id = preg_3_publicity_1_3734.store_id )
         left outer join preg_3_publicity_1_3802 on (tmp_comercios.store_id = preg_3_publicity_1_3802.store_id )
         left outer join preg_3_publicity_1_3803 on (tmp_comercios.store_id = preg_3_publicity_1_3803.store_id )
         left outer join preg_3_publicity_1_3830 on (tmp_comercios.store_id = preg_3_publicity_1_3830.store_id )
         left outer join preg_3_publicity_1_3831 on (tmp_comercios.store_id = preg_3_publicity_1_3831.store_id )

         left outer join preg_3_publicity_2_791 on (tmp_comercios.store_id = preg_3_publicity_2_791.store_id )
         left outer join preg_3_publicity_2_793 on (tmp_comercios.store_id = preg_3_publicity_2_793.store_id )
         left outer join preg_3_publicity_2_792 on (tmp_comercios.store_id = preg_3_publicity_2_792.store_id )
         left outer join preg_3_publicity_2_790 on (tmp_comercios.store_id = preg_3_publicity_2_790.store_id )
         left outer join preg_3_publicity_2_821 on (tmp_comercios.store_id = preg_3_publicity_2_821.store_id )
         left outer join preg_3_publicity_2_3832 on (tmp_comercios.store_id = preg_3_publicity_2_3832.store_id )
         left outer join preg_3_publicity_2_3833 on (tmp_comercios.store_id = preg_3_publicity_2_3833.store_id )

         left outer join preg_3_publicity_3_787 on (tmp_comercios.store_id = preg_3_publicity_3_787.store_id )
         left outer join preg_3_publicity_3_788 on (tmp_comercios.store_id = preg_3_publicity_3_788.store_id )
         left outer join preg_3_publicity_3_789 on (tmp_comercios.store_id = preg_3_publicity_3_789.store_id )
         left outer join preg_3_publicity_3_793 on (tmp_comercios.store_id = preg_3_publicity_3_793.store_id )
         left outer join preg_3_publicity_3_821 on (tmp_comercios.store_id = preg_3_publicity_3_821.store_id )
         left outer join preg_3_publicity_3_3834 on (tmp_comercios.store_id = preg_3_publicity_3_3834.store_id )
         left outer join preg_3_publicity_3_3835 on (tmp_comercios.store_id = preg_3_publicity_3_3835.store_id )

         left outer join preg_3_publicity_4_793 on (tmp_comercios.store_id = preg_3_publicity_4_793.store_id )
         left outer join preg_3_publicity_4_821 on (tmp_comercios.store_id = preg_3_publicity_4_821.store_id )
         left outer join preg_3_publicity_4_804 on (tmp_comercios.store_id = preg_3_publicity_4_804.store_id )



         left outer join preg_3_publicity_5_807 on (tmp_comercios.store_id = preg_3_publicity_5_807.store_id )
         left outer join preg_3_publicity_5_809 on (tmp_comercios.store_id = preg_3_publicity_5_809.store_id )
         left outer join preg_3_publicity_5_808 on (tmp_comercios.store_id = preg_3_publicity_5_808.store_id )
         left outer join preg_3_publicity_5_793 on (tmp_comercios.store_id = preg_3_publicity_5_793.store_id )
         left outer join preg_3_publicity_5_821 on (tmp_comercios.store_id = preg_3_publicity_5_821.store_id )
         left outer join preg_3_publicity_5_3836 on (tmp_comercios.store_id = preg_3_publicity_5_3836.store_id )


         left outer join preg_3_publicity_6_799 on (tmp_comercios.store_id = preg_3_publicity_6_799.store_id )
         left outer join preg_3_publicity_6_800 on (tmp_comercios.store_id = preg_3_publicity_6_800.store_id )
         left outer join preg_3_publicity_6_801 on (tmp_comercios.store_id = preg_3_publicity_6_801.store_id )
         left outer join preg_3_publicity_6_793 on (tmp_comercios.store_id = preg_3_publicity_6_793.store_id )
         left outer join preg_3_publicity_6_821 on (tmp_comercios.store_id = preg_3_publicity_6_821.store_id )



         left outer join preg_3_publicity_8_817 on (tmp_comercios.store_id = preg_3_publicity_8_817.store_id )
         left outer join preg_3_publicity_8_793 on (tmp_comercios.store_id = preg_3_publicity_8_793.store_id )
         left outer join preg_3_publicity_8_821 on (tmp_comercios.store_id = preg_3_publicity_8_821.store_id )

         left outer join preg_3_publicity_9_819 on (tmp_comercios.store_id = preg_3_publicity_9_819.store_id )
         left outer join preg_3_publicity_9_793 on (tmp_comercios.store_id = preg_3_publicity_9_793.store_id )
         left outer join preg_3_publicity_9_821 on (tmp_comercios.store_id = preg_3_publicity_9_821.store_id )

         left outer join preg_3_publicity_10_811 on (tmp_comercios.store_id = preg_3_publicity_10_811.store_id )
         left outer join preg_3_publicity_10_812 on (tmp_comercios.store_id = preg_3_publicity_10_812.store_id )
         left outer join preg_3_publicity_10_793 on (tmp_comercios.store_id = preg_3_publicity_10_793.store_id )
         left outer join preg_3_publicity_10_821 on (tmp_comercios.store_id = preg_3_publicity_10_821.store_id )

         left outer join preg_3_publicity_11_2315 on (tmp_comercios.store_id = preg_3_publicity_11_2315.store_id )
         left outer join preg_3_publicity_11_793 on (tmp_comercios.store_id = preg_3_publicity_11_793.store_id )
         left outer join preg_3_publicity_11_3452 on (tmp_comercios.store_id = preg_3_publicity_11_3452.store_id )

ORDER BY tmp_comercios.fecha Desc, tmp_comercios.hora DESC;


SET @updated_at = (select DATE_SUB(NOW(),INTERVAL 5 HOUR));
INSERT INTO `log_processes`(`processes`,`status`,`company_id`,`user_id`,`created_at`,`updated_at`) VALUES ('sp_alicorp_regular_sod_v5',1, _company_id , _user_id,@created_at,@updated_at);
UPDATE `tempory_processes` SET `status` = 0 , `processes` = 'sp_alicorp_regular_sod_v5';
END IF;
ELSE
        SET @updated_at = (select DATE_SUB(NOW(),INTERVAL 5 HOUR));
INSERT INTO `tempory_processes`(`processes`,`status`,`company_id`,`user_id`,`created_at`,`updated_at`) VALUES ('sp_alicorp_regular_sod_v5',0, _company_id , 0,now(),@updated_at);
END IF;

END