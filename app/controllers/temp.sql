CREATE DEFINER=`dataser_admin`@`%` PROCEDURE `sp_bayert_visibilidad`(IN _company_id INT,IN _visit_id INT, IN _tipo INT, IN _pag INT, IN _desde INT, IN _hasta INT,IN _user_id INT)
  BEGIN
    IF EXISTS (SELECT id FROM tempory_processes ) THEN

      SET @status_ =(SELECT `status` FROM tempory_processes) ;

      IF  @status_ = 0 THEN

        UPDATE `tempory_processes` SET `status` = 1 , `processes` = 'sp_bayert_visibilidad';

        /*inicio */



        /*fin*/

        INSERT INTO `log_processes`(`processes`,`status`,`company_id`,`user_id`,`created_at`,`updated_at`) VALUES ('sp_bayert_visibilidad',1, _company_id , _user_id,now(),now() );
        UPDATE `tempory_processes` SET `status` = 0,  `processes` = 'sp_bayert_visibilidad';

        INSERT INTO `log_processes`(`processes`,`status`,`company_id`,`user_id`,`created_at`,`updated_at`) VALUES ('sp_bayert_visibilidad',1, _company_id , _user_id,now(),now() );
        UPDATE `tempory_processes` SET `status` = 0,  `processes` = 'sp_bayert_visibilidad';

      END IF;
    ELSE
      INSERT INTO `tempory_processes`(`processes`,`status`,`company_id`,`user_id`,`created_at`,`updated_at`) VALUES ('sp_bayert_visibilidad',0, _company_id , 0,now(),now() );
    END IF;

    IF _tipo <> 1 THEN
      DROP TEMPORARY TABLE IF EXISTS tmp_comercios_pop;
      CREATE TEMPORARY TABLE IF NOT EXISTS tmp_comercios_pop ( INDEX(store_id) ) AS
        (
          SELECT * FROM (
                          SELECT
                            `pd`.`company_id` AS `company_id`,
                            `s`.`id` AS `store_id`,
                            `s`.`chanel` AS `chanel`,
                            `s`.`zone` AS `zone`,
                            `s`.`fullname` AS `fullname`,
                            `s`.`address` AS `address`,
                            `s`.`region` AS `region`,
                            `s`.`owner` AS `owner`,
                            `s`.`ubigeo` AS `ubigeo`,
                            `s`.`district` AS `district`,
                            `s`.`ejecutivo` AS `ejecutivo`,
                            `s`.`latitude` AS `latitude`,
                            `s`.`longitude` AS `longitude`,
                            DATE_FORMAT(`pd`.`updated_at`, '%d/%m/%Y') AS `fecha`,
                            MIN(DATE_FORMAT(`pd`.`updated_at`, '%H:%i:%s')) AS `hora`,
                            `u`.`fullname` AS `Auditor`,
                            `vs`.`visit_id` AS `visit_id`,
                            `s`.`cabecera` AS `cabecera`
                          FROM
                            `poll_details` `pd`
                            LEFT JOIN `visit_stores` `vs` ON (`vs`.`store_id` = `pd`.`store_id` AND `vs`.`company_id` = `pd`.`company_id` AND `vs`.`visit_id` = `pd`.`visit_id`)
                            LEFT JOIN `stores` `s` ON (`pd`.`store_id` = `s`.`id`)
                            LEFT JOIN `road_details` `rd` ON (`vs`.`company_id` = `rd`.`company_id` AND `vs`.`store_id` = `rd`.`store_id` AND `vs`.`road_id` = `rd`.`road_id`)
                            LEFT JOIN `roads` `r` ON (`rd`.`road_id` = `r`.`id`)
                            LEFT JOIN `users` `u` ON (`r`.`user_id` = `u`.`id`)
                          WHERE
                            `pd`.`company_id` = _company_id  AND `rd`.`audit` = 1 and `s`.`chanel_store_id`= 1 and `pd`.`visit_id` = _visit_id
                          GROUP BY `pd`.`company_id` , `s`.`id` , `s`.`type` , `s`.`zone` , `s`.`fullname` , `s`.`address` , `s`.`region` , `s`.`owner` , `s`.`ubigeo` , `s`.`district` , `s`.`ejecutivo` , `s`.`latitude` , `s`.`longitude` , DATE_FORMAT(`pd`.`updated_at`, '%d/%m/%Y') , `u`.`fullname` , `vs`.`visit_id`
                        ) XX
          GROUP BY `XX`.`store_id`
        );

    END IF;
    IF _tipo = 1 THEN
      IF _pag = 1 THEN
        DROP TEMPORARY TABLE IF EXISTS tmp_comercios_pop;
        CREATE TEMPORARY TABLE IF NOT EXISTS tmp_comercios_pop ( INDEX(store_id) ) AS
          (
            SELECT * FROM (
                            SELECT
                              `pd`.`company_id` AS `company_id`,
                              `s`.`id` AS `store_id`,
                              `s`.`chanel` AS `chanel`,
                              `s`.`zone` AS `zone`,
                              `s`.`fullname` AS `fullname`,
                              `s`.`address` AS `address`,
                              `s`.`region` AS `region`,
                              `s`.`owner` AS `owner`,
                              `s`.`ubigeo` AS `ubigeo`,
                              `s`.`district` AS `district`,
                              `s`.`ejecutivo` AS `ejecutivo`,
                              `s`.`latitude` AS `latitude`,
                              `s`.`longitude` AS `longitude`,
                              DATE_FORMAT(`pd`.`updated_at`, '%d/%m/%Y') AS `fecha`,
                              MIN(DATE_FORMAT(`pd`.`updated_at`, '%H:%i:%s')) AS `hora`,
                              `u`.`fullname` AS `Auditor`,
                              `vs`.`visit_id` AS `visit_id`,
                              `s`.`cabecera` AS `cabecera`
                            FROM
                              `poll_details` `pd`
                              LEFT JOIN `visit_stores` `vs` ON (`vs`.`store_id` = `pd`.`store_id` AND `vs`.`company_id` = `pd`.`company_id` AND `vs`.`visit_id` = `pd`.`visit_id`)
                              LEFT JOIN `stores` `s` ON (`pd`.`store_id` = `s`.`id`)
                              LEFT JOIN `road_details` `rd` ON (`vs`.`company_id` = `rd`.`company_id` AND `vs`.`store_id` = `rd`.`store_id` AND `vs`.`road_id` = `rd`.`road_id`)
                              LEFT JOIN `roads` `r` ON (`rd`.`road_id` = `r`.`id`)
                              LEFT JOIN `users` `u` ON (`r`.`user_id` = `u`.`id`)
                            WHERE
                              `pd`.`company_id` = _company_id and `rd`.`audit`=1   and `s`.`chanel_store_id`= 1
                            GROUP BY `pd`.`company_id` , `s`.`id` , `s`.`type` , `s`.`zone` , `s`.`fullname` , `s`.`address` , `s`.`region` , `s`.`owner` , `s`.`ubigeo` , `s`.`district` , `s`.`ejecutivo` , `s`.`latitude` , `s`.`longitude` , DATE_FORMAT(`pd`.`updated_at`, '%d/%m/%Y') , `u`.`fullname` , `vs`.`visit_id`
                            LIMIT _desde,_hasta
                          ) XX
            GROUP BY `XX`.`store_id`,`XX`.`visit_id`
          );
      END IF;
      IF _pag = 2 THEN
        DROP TEMPORARY TABLE IF EXISTS tmp_comercios_pop;
        CREATE TEMPORARY TABLE IF NOT EXISTS tmp_comercios_pop ( INDEX(store_id) ) AS
          (
            SELECT * FROM (
                            SELECT
                              `pd`.`company_id` AS `company_id`,
                              `s`.`id` AS `store_id`,
                              `s`.`chanel` AS `chanel`,
                              `s`.`zone` AS `zone`,
                              `s`.`fullname` AS `fullname`,
                              `s`.`address` AS `address`,
                              `s`.`region` AS `region`,
                              `s`.`owner` AS `owner`,
                              `s`.`ubigeo` AS `ubigeo`,
                              `s`.`district` AS `district`,
                              `s`.`ejecutivo` AS `ejecutivo`,
                              `s`.`latitude` AS `latitude`,
                              `s`.`longitude` AS `longitude`,
                              DATE_FORMAT(`pd`.`updated_at`, '%d/%m/%Y') AS `fecha`,
                              MIN(DATE_FORMAT(`pd`.`updated_at`, '%H:%i:%s')) AS `hora`,
                              `u`.`fullname` AS `Auditor`,
                              `vs`.`visit_id` AS `visit_id`,
                              `s`.`cabecera` AS `cabecera`
                            FROM
                              `poll_details` `pd`
                              LEFT JOIN `visit_stores` `vs` ON (`vs`.`store_id` = `pd`.`store_id` AND `vs`.`company_id` = `pd`.`company_id` AND `vs`.`visit_id` = `pd`.`visit_id`)
                              LEFT JOIN `stores` `s` ON (`pd`.`store_id` = `s`.`id`)
                              LEFT JOIN `road_details` `rd` ON (`vs`.`company_id` = `rd`.`company_id` AND `vs`.`store_id` = `rd`.`store_id` AND `vs`.`road_id` = `rd`.`road_id`)
                              LEFT JOIN `roads` `r` ON (`rd`.`road_id` = `r`.`id`)
                              LEFT JOIN `users` `u` ON (`r`.`user_id` = `u`.`id`)
                            WHERE
                              `pd`.`company_id` = _company_id  AND `rd`.`audit` = 1 and `s`.`chanel_store_id`= 2
                            GROUP BY `pd`.`company_id` , `s`.`id` , `s`.`type` , `s`.`zone` , `s`.`fullname` , `s`.`address` , `s`.`region` , `s`.`owner` , `s`.`ubigeo` , `s`.`district` , `s`.`ejecutivo` , `s`.`latitude` , `s`.`longitude` , DATE_FORMAT(`pd`.`updated_at`, '%d/%m/%Y') , `u`.`fullname` , `vs`.`visit_id`
                            LIMIT _desde,_hasta
                          ) XX
            GROUP BY `XX`.`store_id`,`XX`.`visit_id`
          );
      END IF;
    END IF;

    IF _tipo = 1 THEN
      DROP TEMPORARY TABLE IF EXISTS tmp_sino_pop;
      CREATE TEMPORARY TABLE IF NOT EXISTS tmp_sino_pop ( INDEX(company_id, store_id, poll_id) ) AS
        (
          SELECT * FROM
            (
              SELECT
                c.company_id AS company_id,
                a.store_id AS store_id,
                a.product_id AS product_id,
                a.category_product_id AS category_product_id,
                a.poll_id AS poll_id,
                a.result AS Respuesta,
                a.visit_id AS visit_id,
                a.comentario AS comentario,
                a.laboratory_id AS laboratory_id,
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
                               x.visit_id AS visit_id,
                               x.archivo AS archivo,
                               x.created_at AS created_at,
                               x.updated_at AS updated_at
                             FROM
                               ttaudit_auditors.medias x
                             WHERE
                               (x.poll_id ,
                                x.store_id,
                                x.publicities_id,
                                x.id,x.visit_id) IN (SELECT
                                                       ttaudit_auditors.medias.poll_id AS poll_id,
                                                       ttaudit_auditors.medias.store_id AS store_id,
                                                       ttaudit_auditors.medias.publicities_id AS publicities_id,
                                                       max(ttaudit_auditors.medias.id) AS id,
                                                       ttaudit_auditors.medias.visit_id AS visit_id
                                                     FROM
                                                       ttaudit_auditors.medias
                                                     GROUP BY ttaudit_auditors.medias.poll_id , ttaudit_auditors.medias.store_id , ttaudit_auditors.medias.publicities_id, ttaudit_auditors.medias.visit_id)) h ON
                                                                                                                                                                                                                  (((a.poll_id = h.poll_id)
                                                                                                                                                                                                                    AND (a.store_id = h.store_id)
                                                                                                                                                                                                                    AND (a.publicity_id = h.publicities_id)
                                                                                                                                                                                                                    AND (a.visit_id = h.visit_id))))
              WHERE
                (c.company_id = _company_id)
            ) yy
          WHERE store_id in (select store_id from tmp_comercios_pop)
        );
    END IF;
    IF _tipo <> 1 THEN
      DROP TEMPORARY TABLE IF EXISTS tmp_sino_pop;
      CREATE TEMPORARY TABLE IF NOT EXISTS tmp_sino_pop ( INDEX(company_id, store_id, poll_id) ) AS
        (
          SELECT * FROM
            (
              SELECT
                c.company_id AS company_id,
                a.store_id AS store_id,
                a.product_id AS product_id,
                a.category_product_id AS category_product_id,
                a.poll_id AS poll_id,
                a.result AS Respuesta,
                a.visit_id AS visit_id,
                a.comentario AS comentario,
                a.laboratory_id AS laboratory_id,
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
                               x.visit_id AS visit_id,
                               x.archivo AS archivo,
                               x.created_at AS created_at,
                               x.updated_at AS updated_at
                             FROM
                               ttaudit_auditors.medias x
                             WHERE
                               (x.poll_id ,
                                x.store_id,
                                x.publicities_id,
                                x.id,x.visit_id) IN (SELECT
                                                       ttaudit_auditors.medias.poll_id AS poll_id,
                                                       ttaudit_auditors.medias.store_id AS store_id,
                                                       ttaudit_auditors.medias.publicities_id AS publicities_id,
                                                       max(ttaudit_auditors.medias.id) AS id,
                                                       ttaudit_auditors.medias.visit_id AS visit_id
                                                     FROM
                                                       ttaudit_auditors.medias
                                                     GROUP BY ttaudit_auditors.medias.poll_id , ttaudit_auditors.medias.store_id , ttaudit_auditors.medias.publicities_id, ttaudit_auditors.medias.visit_id)) h ON
                                                                                                                                                                                                                  (((a.poll_id = h.poll_id)
                                                                                                                                                                                                                    AND (a.store_id = h.store_id)
                                                                                                                                                                                                                    AND (a.publicity_id = h.publicities_id)
                                                                                                                                                                                                                    AND (a.visit_id = h.visit_id))))
              WHERE
                (c.company_id = _company_id) and (a.visit_id=_visit_id)
            ) yy
          WHERE store_id in (select store_id from tmp_comercios_pop)
        );
    END IF;


    IF _tipo <> 2 THEN
      IF _tipo = 1 THEN
        DROP TEMPORARY TABLE IF EXISTS tmp_opciones_pop;
        CREATE TEMPORARY TABLE IF NOT EXISTS tmp_opciones_pop ( INDEX(store_id, poll_id ) ) AS
          (
            SELECT * FROM
              (
                SELECT DISTINCT
                  c.company_id AS company_id,
                  a.poll_id AS poll_id,
                  a.store_id AS store_id,
                  f.result AS result,
                  a.result AS Respuesta,
                  f.otro AS otro,
                  a.limite AS limite,
                  e.codigo AS options,
                  f.product_id AS product_id,
                  f.publicity_id AS publicity_id,
                  f.priority AS priority,
                  e.options AS desc_option,
                  a.comentario AS Comentario,
                  CONCAT('http://ttaudit.com/media/fotos/',  h.archivo) AS Foto,
                  f.visit_id
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
                                 x.tipo AS tipo,
                                 x.visit_id AS visit_id,
                                 x.archivo AS archivo,
                                 x.created_at AS created_at,
                                 x.updated_at AS updated_at
                               FROM
                                 ttaudit_auditors.medias x
                               WHERE
                                 (x.poll_id ,
                                  x.store_id,
                                  x.publicities_id,
                                  x.id,x.visit_id) IN
                                 (SELECT  ttaudit_auditors.medias.poll_id AS poll_id,
                                          ttaudit_auditors.medias.store_id AS store_id,
                                          ttaudit_auditors.medias.publicities_id AS publicities_id,
                                          max(ttaudit_auditors.medias.id) AS id,
                                          ttaudit_auditors.medias.visit_id AS visit_id
                                  FROM ttaudit_auditors.medias
                                  GROUP BY ttaudit_auditors.medias.poll_id , ttaudit_auditors.medias.store_id , ttaudit_auditors.medias.publicities_id, ttaudit_auditors.medias.visit_id)
                              ) h
                      ON (((a.poll_id = h.poll_id)
                           AND (a.store_id = h.store_id)
                           AND (a.publicity_id = h.publicities_id)
                           AND (a.visit_id = h.visit_id))))
                WHERE
                  (c.company_id = _company_id)
                group by store_id,publicity_id,options
              ) yy
            WHERE store_id in (SELECT store_id FROM tmp_comercios_pop)
          );
      END IF;
      IF _tipo <> 1 THEN
        DROP TEMPORARY TABLE IF EXISTS tmp_opciones_pop;
        CREATE TEMPORARY TABLE IF NOT EXISTS tmp_opciones_pop ( INDEX(store_id, poll_id ) ) AS
          (
            SELECT * FROM
              (
                SELECT DISTINCT
                  c.company_id AS company_id,
                  a.poll_id AS poll_id,
                  a.store_id AS store_id,
                  f.result AS result,
                  a.result AS Respuesta,
                  f.otro AS otro,
                  a.limite AS limite,
                  e.codigo AS options,
                  f.product_id AS product_id,
                  f.publicity_id AS publicity_id,
                  f.priority AS priority,
                  e.options AS desc_option,
                  a.comentario AS Comentario,
                  CONCAT('http://ttaudit.com/media/fotos/',  h.archivo) AS Foto,
                  f.visit_id
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
                                 x.tipo AS tipo,
                                 x.visit_id AS visit_id,
                                 x.archivo AS archivo,
                                 x.created_at AS created_at,
                                 x.updated_at AS updated_at
                               FROM
                                 ttaudit_auditors.medias x
                               WHERE
                                 (x.poll_id ,
                                  x.store_id,
                                  x.publicities_id,
                                  x.id,x.visit_id) IN
                                 (SELECT  ttaudit_auditors.medias.poll_id AS poll_id,
                                          ttaudit_auditors.medias.store_id AS store_id,
                                          ttaudit_auditors.medias.publicities_id AS publicities_id,
                                          max(ttaudit_auditors.medias.id) AS id,
                                          ttaudit_auditors.medias.visit_id AS visit_id
                                  FROM ttaudit_auditors.medias
                                  GROUP BY ttaudit_auditors.medias.poll_id , ttaudit_auditors.medias.store_id , ttaudit_auditors.medias.publicities_id, ttaudit_auditors.medias.visit_id)
                              ) h
                      ON (((a.poll_id = h.poll_id)
                           AND (a.store_id = h.store_id)
                           AND (a.publicity_id = h.publicities_id)
                           AND (a.visit_id = h.visit_id))))
                WHERE
                  (c.company_id = _company_id) and (f.visit_id=_visit_id)
                group by store_id,publicity_id,options
              ) yy
            WHERE store_id in (SELECT store_id FROM tmp_comercios_pop)
          );
      END IF;

    END IF;
    IF _tipo = 1 THEN
      IF _pag = 2 THEN
        DROP TEMPORARY TABLE IF EXISTS tmp_amounts;
        CREATE TEMPORARY TABLE IF NOT EXISTS tmp_amounts ( INDEX(store_id ) ) AS
          (
            SELECT * FROM
              (
                SELECT
                  `order_details`.`order_id`,
                  `orders`.`code`,
                  `orders`.`store_id` as store_id,
                  `orders`.`visit_id`,
                  `orders`.`company_id`,
                  sum(`order_details`.`amount`) as amount
                FROM
                  `order_details`
                  INNER JOIN `orders` ON (`order_details`.`order_id` = `orders`.`id`)
                WHERE
                  `orders`.`company_id` = _company_id group by `orders`.`store_id`,`orders`.`visit_id` order by order_id asc
              ) yy
            WHERE store_id in (SELECT store_id FROM tmp_comercios_pop)
          );
      END IF;
    END IF;

    SET @poll__id_1 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 1);/*¿ Se encuentra abierto el punto ? 1367*/
    SET @poll__id_3 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 23);/*  Existe Material POP 1370*/
    SET @poll__id_4 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 26);/* Es visible material POP 1373*/
    SET @poll__id_5 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 27);/*Cual es el estado del material POP 1374*/
    SET @poll__id_6 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 212);/* ¿Realizo cambios en material? 1442*/
    SET @poll__id_7 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 24);/*¿Tiene stock de producto? 1371*/
    SET @poll__id_8 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 28);/*Tiene espacio adicional para elementos gratuitos (Ficticios) 1375*/
    SET @poll__id_10 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 25);/*Funciona Luz Led 1372*/
    SET @poll__id_11 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 214);/*Cumple layout*/
    SET @poll__id_12 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 2);/*¿Cuántas personas trabajan por turno Mañana? */
    SET @poll__id_13 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 3);/*¿Cuántas personas trabajan por turno Tarde? */
    SET @poll__id_14 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 4);/*¿Cuántas personas trabajan por turno Noche? */
    SET @poll__id_15 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 5);/*Nombre de la persona a quien se comunicó*/
    SET @poll__id_16 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 6);/*Puesto*/
    SET @poll__id_17 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 7);/*Cliente realizó pedido*/
    SET @poll__id_18 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 12);/*Razon de no pedido*/
    SET @poll__id_19 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 13);/*Nombre de la persona con quien se comunico / o quien  solicito el pedido*/
    SET @poll__id_20 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 14);/*Ingrese el Teléfono*/
    SET @poll__id_21 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 10);/*¿Qué actividades realiza la competencia? */
    SET @poll__id_22 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 11);/*¿De qué laboratorio es la actividad? */



    IF _tipo = 0 THEN
      IF _pag = 1  THEN
        /* Se encuentra abierto local? 1367  */
        DROP TEMPORARY TABLE IF EXISTS preg_si_no_1;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_1 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_1 and product_id=0
            group by store_id, product_id
          );



        /*561  Corporeos*/

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_3_561;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_3_561 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_3 and publicity_id=561
          );

        /*Especial Base Bayer*/
        DROP TEMPORARY TABLE IF EXISTS preg_Base_561;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_Base_561 ( INDEX(store_id ) ) AS
          (
            SELECT count(publicity_id) as total, store_id FROM publicity_store p where  company_id=_company_id and visit_id=0 and publicity_id=561 group by publicity_id,store_id
          );
        /*Fin especial Base Bayer*/

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_10_561;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_10_561 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_10 and publicity_id=561
          );


        DROP TEMPORARY TABLE IF EXISTS preg_si_no_4_561;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_4_561 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_4 and publicity_id=561
          );


        DROP TEMPORARY TABLE IF EXISTS preg_4_561;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_4_561 ( INDEX(store_id ) ) AS
          (
            select store_id,publicity_id, respuesta,
              sum(case when options = CONVERT(CONCAT(@poll__id_4 ,'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
              sum(case when options = CONVERT(CONCAT(@poll__id_4 ,'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
              otro
            from tmp_opciones_pop
            where  poll_id = @poll__id_4 and publicity_id=561
            group by store_id, respuesta, otro,publicity_id
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_5_561;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_5_561 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_5 and publicity_id=561
          );
        DROP TEMPORARY TABLE IF EXISTS preg_5_561;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_5_561 ( INDEX(store_id ) ) AS
          (
            select store_id,publicity_id, respuesta,
              sum(case when options = CONVERT(CONCAT(@poll__id_5 ,'d') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
              sum(case when options = CONVERT(CONCAT(@poll__id_5 ,'e') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
              otro
            from tmp_opciones_pop
            where  poll_id = @poll__id_5 and publicity_id=561
            group by store_id, respuesta,product_id, otro,publicity_id
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_6_561;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_6_561 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_6 and publicity_id=561
          );
        DROP TEMPORARY TABLE IF EXISTS preg_6_561;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_6_561 ( INDEX(store_id ) ) AS
          (
            select store_id,publicity_id, respuesta,
              sum(case when options = CONVERT(CONCAT(@poll__id_6 ,'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
              sum(case when options = CONVERT(CONCAT(@poll__id_6 ,'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
              sum(case when options = CONVERT(CONCAT(@poll__id_6 ,'c') using utf8) collate utf8_spanish_ci then 1 else 0 end) as c,
              foto,
              otro
            from tmp_opciones_pop
            where  poll_id = @poll__id_6 and publicity_id=561
            group by store_id, respuesta,product_id,foto, otro,publicity_id
          );
        --
        -- /*563  Bidoneras*/
        --
        DROP TEMPORARY TABLE IF EXISTS preg_si_no_3_563;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_3_563 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_3 and publicity_id=563
          );

        /*Especial Base Bayer*/
        DROP TEMPORARY TABLE IF EXISTS preg_Base_563;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_Base_563 ( INDEX(store_id ) ) AS
          (
            SELECT count(publicity_id) as total, store_id FROM publicity_store p where  company_id=_company_id and visit_id=0 and publicity_id=563 group by publicity_id,store_id
          );
        /*Fin especial Base Bayer*/

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_4_563;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_4_563 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_4 and publicity_id=563
          );
        DROP TEMPORARY TABLE IF EXISTS preg_4_563;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_4_563 ( INDEX(store_id ) ) AS
          (
            select store_id,publicity_id, respuesta,
              sum(case when options = CONVERT(CONCAT(@poll__id_4 ,'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
              sum(case when options = CONVERT(CONCAT(@poll__id_4 ,'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
              otro
            from tmp_opciones_pop
            where  poll_id = @poll__id_4 and publicity_id=563
            group by store_id, respuesta, otro,publicity_id
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_5_563;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_5_563 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_5 and publicity_id=563
          );
        DROP TEMPORARY TABLE IF EXISTS preg_5_563;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_5_563 ( INDEX(store_id ) ) AS
          (
            select store_id,publicity_id, respuesta,
              sum(case when options = CONVERT(CONCAT(@poll__id_5 ,'d') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
              otro
            from tmp_opciones_pop
            where  poll_id = @poll__id_5 and publicity_id=563
            group by store_id, respuesta,product_id, otro,publicity_id
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_6_563;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_6_563 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_6 and publicity_id=563
          );

        DROP TEMPORARY TABLE IF EXISTS preg_6_563;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_6_563 ( INDEX(store_id ) ) AS
          (
            select store_id,publicity_id, respuesta,
              sum(case when options = CONVERT(CONCAT(@poll__id_6 ,'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
              sum(case when options = CONVERT(CONCAT(@poll__id_6 ,'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
              sum(case when options = CONVERT(CONCAT(@poll__id_6 ,'c') using utf8) collate utf8_spanish_ci then 1 else 0 end) as c,
              foto,
              otro
            from tmp_opciones_pop
            where  poll_id = @poll__id_6 and publicity_id=563
            group by store_id, respuesta,product_id,foto, otro,publicity_id
          );
        --
        -- /*565  --------------------------------------------  Paneles*/
        --
        DROP TEMPORARY TABLE IF EXISTS preg_si_no_3_565;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_3_565 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_3 and publicity_id=565
          );

        /*Especial Base Bayer*/
        DROP TEMPORARY TABLE IF EXISTS preg_Base_565;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_Base_565 ( INDEX(store_id ) ) AS
          (
            SELECT count(publicity_id) as total, store_id FROM publicity_store p where  company_id=_company_id and visit_id=0 and publicity_id=565 group by publicity_id,store_id
          );
        /*Fin especial Base Bayer*/

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_10_565;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_10_565 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_10 and publicity_id=565
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_4_565;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_4_565 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_4 and publicity_id=565
          );
        DROP TEMPORARY TABLE IF EXISTS preg_4_565;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_4_565 ( INDEX(store_id ) ) AS
          (
            select store_id,publicity_id, respuesta,
              sum(case when options = CONVERT(CONCAT(@poll__id_4 ,'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
              sum(case when options = CONVERT(CONCAT(@poll__id_4 ,'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
              otro
            from tmp_opciones_pop
            where  poll_id = @poll__id_4 and publicity_id=565
            group by store_id, respuesta, otro,publicity_id
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_5_565;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_5_565 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_5 and publicity_id=565
          );
        DROP TEMPORARY TABLE IF EXISTS preg_5_565;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_5_565 ( INDEX(store_id ) ) AS
          (
            select store_id,publicity_id, respuesta,
              sum(case when options = CONVERT(CONCAT(@poll__id_5 ,'d') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
              otro
            from tmp_opciones_pop
            where  poll_id = @poll__id_5 and publicity_id=565
            group by store_id, respuesta,product_id, otro,publicity_id
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_6_565;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_6_565 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_6 and publicity_id=565
          );
        DROP TEMPORARY TABLE IF EXISTS preg_6_565;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_6_565 ( INDEX(store_id ) ) AS
          (
            select store_id,publicity_id, respuesta,
              sum(case when options = CONVERT(CONCAT(@poll__id_6 ,'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
              sum(case when options = CONVERT(CONCAT(@poll__id_6 ,'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
              sum(case when options = CONVERT(CONCAT(@poll__id_6 ,'c') using utf8) collate utf8_spanish_ci then 1 else 0 end) as c,
              foto,
              otro
            from tmp_opciones_pop
            where  poll_id = @poll__id_6 and publicity_id=565
            group by store_id, respuesta,product_id,foto, otro,publicity_id
          );




        select
          tmp_comercios_pop.store_id,
          tmp_comercios_pop.chanel,
          tmp_comercios_pop.zone,
          tmp_comercios_pop.fullname,
          tmp_comercios_pop.address,
          tmp_comercios_pop.district,
          tmp_comercios_pop.region,
          tmp_comercios_pop.ejecutivo,
          tmp_comercios_pop.ubigeo,
          tmp_comercios_pop.Auditor,
          tmp_comercios_pop.fecha,
          tmp_comercios_pop.hora,
          tmp_comercios_pop.visit_id,

          -- ****************************** PREGUNTAS GENERALES ********************************************
          (case when preg_si_no_1.Respuesta > 0 then 2 else '0' end) as '1_Respuesta',
          preg_si_no_1.Foto as '1_Foto',

          --  -------------------- 561 -------------------
          -- (case when preg_si_no_3_561.Respuesta > 0 then 2 else '0' end) as '3_561_Respuesta',
          if(preg_si_no_3_561.Respuesta is null , '' , if (preg_si_no_3_561.Respuesta > 0, 2 , 0)) as '3_561_Respuesta',
          preg_si_no_3_561.Foto as '3_561_Foto',

          (case when preg_Base_561.total  is null then 0 else preg_Base_561.total end) as  'Base_561_total',

          -- (case when preg_si_no_10_561.Respuesta > 0 then 2 else '0' end) as '10_561_Respuesta',
          if(preg_si_no_10_561.Respuesta is null , '' , if (preg_si_no_10_561.Respuesta > 0, 2 , 0)) as '10_561_Respuesta',

          -- (case when preg_si_no_4_561.Respuesta > 0 then 2 else '0' end) as '4_561_Respuesta',
          if(preg_si_no_4_561.Respuesta is null , '' , if (preg_si_no_4_561.Respuesta > 0, 2 , 0)) as '4_561_Respuesta',
          (case when preg_4_561.a > 0 then 2 else preg_4_561.a end) as '4_561_a',
          (case when preg_4_561.b > 0 then 2 else preg_4_561.b end) as '4_561_b',
          preg_4_561.otro as '4_561_Comentario',

          -- (case when preg_si_no_5_561.Respuesta > 0 then 2 else '0' end) as '5_561_Respuesta',
          if(preg_si_no_5_561.Respuesta is null , '' , if (preg_si_no_5_561.Respuesta > 0, 2 , 0)) as '5_561_Respuesta',
          (case when preg_5_561.a > 0 then 2 else preg_5_561.a end) as '5_561_a',
          (case when preg_5_561.b > 0 then 2 else preg_5_561.b end) as '5_561_b',
          preg_5_561.otro as '5_561_Comentario',

          -- (case when preg_si_no_6_561.Respuesta > 0 then 2 else '0' end) as '6_561_Respuesta',
          if(preg_si_no_6_561.Respuesta is null , '' , if (preg_si_no_6_561.Respuesta > 0, 2 , 0)) as '6_561_Respuesta',
          (case when preg_6_561.a > 0 then 2 else preg_6_561.a end) as '6_561_a',
          (case when preg_6_561.b > 0 then 2 else preg_6_561.b end) as '6_561_b',
          (case when preg_6_561.c > 0 then 2 else preg_6_561.c end) as '6_561_c',
          preg_si_no_6_561.comentario as '6_561_Comentario',
          preg_si_no_6_561.Foto as '6_561_Foto',
          --
          -- -- --  -------------------- 563 -------------------
          -- --
          -- (case when preg_si_no_3_563.Respuesta > 0 then 2 else '0' end) as '3_563_Respuesta',
          if(preg_si_no_3_563.Respuesta is null , '' , if (preg_si_no_3_563.Respuesta > 0, 2 , 0)) as '3_563_Respuesta',
          preg_si_no_3_563.Foto as '3_563_Foto',

          (case when preg_Base_563.total  is null then 0 else preg_Base_563.total end) as  'Base_563_total',

          -- (case when preg_si_no_4_563.Respuesta > 0 then 2 else '0' end) as '4_563_Respuesta',
          if(preg_si_no_4_563.Respuesta is null , '' , if (preg_si_no_4_563.Respuesta > 0, 2 , 0)) as '4_563_Respuesta',
          (case when preg_4_563.a > 0 then 2 else preg_4_563.a end) as '4_563_a',
          (case when preg_4_563.b > 0 then 2 else preg_4_563.b end) as '4_563_b',
          preg_4_563.otro as '4_563_Comentario',

          -- (case when preg_si_no_5_563.Respuesta > 0 then 2 else '0' end) as '5_563_Respuesta',
          if(preg_si_no_5_563.Respuesta is null , '' , if (preg_si_no_5_563.Respuesta > 0, 2 , 0)) as '5_563_Respuesta',
          (case when preg_5_563.a > 0 then 2 else preg_5_563.a end) as '5_563_a',
          preg_5_563.otro as '5_563_Comentario',

          -- (case when preg_si_no_6_563.Respuesta > 0 then 2 else '0' end) as '6_563_Respuesta',
          if(preg_si_no_6_563.Respuesta is null , '' , if (preg_si_no_6_563.Respuesta > 0, 2 , 0)) as '6_563_Respuesta',
          (case when preg_6_563.a > 0 then 2 else preg_6_563.a end) as '6_563_a',
          (case when preg_6_563.b > 0 then 2 else preg_6_563.b end) as '6_563_b',
          (case when preg_6_563.c > 0 then 2 else preg_6_563.c end) as '6_563_c',
          preg_si_no_6_563.comentario as '6_563_Comentario',
          preg_si_no_6_563.Foto as '6_563_Foto',
          -- --
          -- -- --  -------------------- 565 -------------------
          -- --
          -- (case when preg_si_no_3_565.Respuesta > 0 then 2 else '0' end) as '3_565_Respuesta',
          if(preg_si_no_3_565.Respuesta is null , '' , if (preg_si_no_3_565.Respuesta > 0, 2 , 0)) as '3_565_Respuesta',
          preg_si_no_3_565.Foto as '3_565_Foto',
          (case when preg_Base_565.total  is null then 0 else preg_Base_565.total end) as  'Base_565_total',
          -- (case when preg_si_no_10_565.Respuesta > 0 then 2 else '0' end) as '10_565_Respuesta',
          if(preg_si_no_10_565.Respuesta is null , '' , if (preg_si_no_10_565.Respuesta > 0, 2 , 0)) as '10_565_Respuesta',
          -- (case when preg_si_no_4_565.Respuesta > 0 then 2 else '0' end) as '4_565_Respuesta',
          if(preg_si_no_4_565.Respuesta is null , '' , if (preg_si_no_4_565.Respuesta > 0, 2 , 0)) as '4_565_Respuesta',
          (case when preg_4_565.a > 0 then 2 else preg_4_565.a end) as '4_565_a',
          (case when preg_4_565.b > 0 then 2 else preg_4_565.b end) as '4_565_b',
          preg_4_565.otro as '4_565_Comentario',

          -- (case when preg_si_no_5_565.Respuesta > 0 then 2 else '0' end) as '5_565_Respuesta',
          if(preg_si_no_5_565.Respuesta is null , '' , if (preg_si_no_5_565.Respuesta > 0, 2 , 0)) as '5_565_Respuesta',
          (case when preg_5_565.a > 0 then 2 else preg_5_565.a end) as '5_565_a',
          preg_5_565.otro as '5_565_Comentario',

          -- (case when preg_si_no_6_565.Respuesta > 0 then 2 else '0' end) as '6_565_Respuesta',
          if(preg_si_no_6_565.Respuesta is null , '' , if (preg_si_no_6_565.Respuesta > 0, 2 , 0)) as '6_565_Respuesta',
          (case when preg_6_565.a > 0 then 2 else preg_6_565.a end) as '6_565_a',
          (case when preg_6_565.b > 0 then 2 else preg_6_565.b end) as '6_565_b',
          (case when preg_6_565.c > 0 then 2 else preg_6_565.c end) as '6_565_c',
          preg_si_no_6_565.comentario as '6_565_Comentario',
          preg_si_no_6_565.Foto as '6_565_Foto'

        --
        from tmp_comercios_pop

          left outer join preg_si_no_1 on (tmp_comercios_pop.store_id = preg_si_no_1.store_id )
          --
          --
          -- /*561*/
          --
          left outer join preg_si_no_3_561 on (tmp_comercios_pop.store_id = preg_si_no_3_561.store_id )

          left outer join preg_Base_561 on (tmp_comercios_pop.store_id = preg_Base_561.store_id )

          left outer join preg_si_no_10_561 on (tmp_comercios_pop.store_id = preg_si_no_10_561.store_id )

          left outer join preg_si_no_4_561 on (tmp_comercios_pop.store_id = preg_si_no_4_561.store_id )
          left outer join preg_4_561 on (tmp_comercios_pop.store_id = preg_4_561.store_id )

          left outer join preg_si_no_5_561 on (tmp_comercios_pop.store_id = preg_si_no_5_561.store_id )
          left outer join preg_5_561 on (tmp_comercios_pop.store_id = preg_5_561.store_id )

          left outer join preg_si_no_6_561 on (tmp_comercios_pop.store_id = preg_si_no_6_561.store_id )
          left outer join preg_6_561 on (tmp_comercios_pop.store_id = preg_6_561.store_id )
          -- --
          -- -- /*563*/
          -- --
          left outer join preg_si_no_3_563 on (tmp_comercios_pop.store_id = preg_si_no_3_563.store_id )

          left outer join preg_Base_563 on (tmp_comercios_pop.store_id = preg_Base_563.store_id )

          left outer join preg_si_no_4_563 on (tmp_comercios_pop.store_id = preg_si_no_4_563.store_id )
          left outer join preg_4_563 on (tmp_comercios_pop.store_id = preg_4_563.store_id )

          left outer join preg_si_no_5_563 on (tmp_comercios_pop.store_id = preg_si_no_5_563.store_id )
          left outer join preg_5_563 on (tmp_comercios_pop.store_id = preg_5_563.store_id )

          left outer join preg_si_no_6_563 on (tmp_comercios_pop.store_id = preg_si_no_6_563.store_id )
          left outer join preg_6_563 on (tmp_comercios_pop.store_id = preg_6_563.store_id )
          -- --
          -- -- /*565*/
          -- --
          left outer join preg_si_no_3_565 on (tmp_comercios_pop.store_id = preg_si_no_3_565.store_id )

          left outer join preg_Base_565 on (tmp_comercios_pop.store_id = preg_Base_565.store_id )

          left outer join preg_si_no_10_565 on (tmp_comercios_pop.store_id = preg_si_no_10_565.store_id )

          left outer join preg_si_no_4_565 on (tmp_comercios_pop.store_id = preg_si_no_4_565.store_id )
          left outer join preg_4_565 on (tmp_comercios_pop.store_id = preg_4_565.store_id )

          left outer join preg_si_no_5_565 on (tmp_comercios_pop.store_id = preg_si_no_5_565.store_id )
          left outer join preg_5_565 on (tmp_comercios_pop.store_id = preg_5_565.store_id )

          left outer join preg_si_no_6_565 on (tmp_comercios_pop.store_id = preg_si_no_6_565.store_id )
          left outer join preg_6_565 on (tmp_comercios_pop.store_id = preg_6_565.store_id );


      ELSEIF _pag = 2 THEN


        /* Se encuentra abierto local? 1367  */
        DROP TEMPORARY TABLE IF EXISTS preg_si_no_1;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_1 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_1 and product_id=0
            group by store_id, product_id
          );


        /*566  ------------------------------ Vitrinas*/

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_3_566;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_3_566 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_3 and publicity_id=566
          );

        /*Especial Base Bayer*/
        DROP TEMPORARY TABLE IF EXISTS preg_Base_566;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_Base_566 ( INDEX(store_id ) ) AS
          (
            SELECT count(publicity_id) as total, store_id FROM publicity_store p where  company_id=_company_id and visit_id=0 and publicity_id=566 group by publicity_id,store_id
          );
        /*Fin especial Base Bayer*/

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_4_566;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_4_566 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_4 and publicity_id=566
          );
        DROP TEMPORARY TABLE IF EXISTS preg_4_566;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_4_566 ( INDEX(store_id ) ) AS
          (
            select store_id,publicity_id, respuesta,
              sum(case when options = CONVERT(CONCAT(@poll__id_4 ,'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
              sum(case when options = CONVERT(CONCAT(@poll__id_4 ,'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
              otro
            from tmp_opciones_pop
            where  poll_id = @poll__id_4 and publicity_id=566
            group by store_id, respuesta, otro,publicity_id
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_5_566;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_5_566 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_5 and publicity_id=566
          );
        DROP TEMPORARY TABLE IF EXISTS preg_5_566;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_5_566 ( INDEX(store_id ) ) AS
          (
            select store_id,publicity_id, respuesta,
              sum(case when options = CONVERT(CONCAT(@poll__id_5 ,'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
              sum(case when options = CONVERT(CONCAT(@poll__id_5 ,'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
              sum(case when options = CONVERT(CONCAT(@poll__id_5 ,'c') using utf8) collate utf8_spanish_ci then 1 else 0 end) as c,
              otro
            from tmp_opciones_pop
            where  poll_id = @poll__id_5 and publicity_id=566
            group by store_id, respuesta,product_id, otro,publicity_id
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_6_566;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_6_566 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_6 and publicity_id=566
          );
        DROP TEMPORARY TABLE IF EXISTS preg_6_566;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_6_566 ( INDEX(store_id ) ) AS
          (
            select store_id,publicity_id, respuesta,
              sum(case when options = CONVERT(CONCAT(@poll__id_6 ,'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
              sum(case when options = CONVERT(CONCAT(@poll__id_6 ,'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
              sum(case when options = CONVERT(CONCAT(@poll__id_6 ,'c') using utf8) collate utf8_spanish_ci then 1 else 0 end) as c,
              foto,
              otro
            from tmp_opciones_pop
            where  poll_id = @poll__id_6 and publicity_id=566
            group by store_id, respuesta,product_id,foto, otro,publicity_id
          );
        --
        -- /*567  -------------------------- Viniles de Meson*/
        --
        DROP TEMPORARY TABLE IF EXISTS preg_si_no_3_567;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_3_567 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_3 and publicity_id=567
          );

        /*Especial Base Bayer*/
        DROP TEMPORARY TABLE IF EXISTS preg_Base_567;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_Base_567 ( INDEX(store_id ) ) AS
          (
            SELECT count(publicity_id) as total, store_id FROM publicity_store p where  company_id=_company_id and visit_id=0 and publicity_id=567 group by publicity_id,store_id
          );
        /*Fin especial Base Bayer*/


        DROP TEMPORARY TABLE IF EXISTS preg_si_no_4_567;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_4_567 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_4 and publicity_id=567
          );
        DROP TEMPORARY TABLE IF EXISTS preg_4_567;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_4_567 ( INDEX(store_id ) ) AS
          (
            select store_id,publicity_id, respuesta,
              sum(case when options = CONVERT(CONCAT(@poll__id_4 ,'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
              sum(case when options = CONVERT(CONCAT(@poll__id_4 ,'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
              otro
            from tmp_opciones_pop
            where  poll_id = @poll__id_4 and publicity_id=567
            group by store_id, respuesta, otro,publicity_id
          );
        --
        DROP TEMPORARY TABLE IF EXISTS preg_si_no_5_567;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_5_567 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_5 and publicity_id=567
          );
        DROP TEMPORARY TABLE IF EXISTS preg_5_567;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_5_567 ( INDEX(store_id ) ) AS
          (
            select store_id,publicity_id, respuesta,
              sum(case when options = CONVERT(CONCAT(@poll__id_5 ,'d') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
              otro
            from tmp_opciones_pop
            where  poll_id = @poll__id_5 and publicity_id=567
            group by store_id, respuesta,product_id, otro,publicity_id
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_6_567;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_6_567 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_6 and publicity_id=567
          );
        DROP TEMPORARY TABLE IF EXISTS preg_6_567;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_6_567 ( INDEX(store_id ) ) AS
          (
            select store_id,publicity_id, respuesta,
              sum(case when options = CONVERT(CONCAT(@poll__id_6 ,'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
              sum(case when options = CONVERT(CONCAT(@poll__id_6 ,'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
              sum(case when options = CONVERT(CONCAT(@poll__id_6 ,'c') using utf8) collate utf8_spanish_ci then 1 else 0 end) as c,
              foto,
              otro
            from tmp_opciones_pop
            where  poll_id = @poll__id_6 and publicity_id=567
            group by store_id, respuesta,product_id,foto, otro,publicity_id
          );
        --
        /*562 Ficticios-------------------------------- Producto*/

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_3_562;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_3_562 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_3 and publicity_id=562
          );

        /*Especial Base Bayer*/
        DROP TEMPORARY TABLE IF EXISTS preg_Base_562;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_Base_562 ( INDEX(store_id ) ) AS
          (
            SELECT count(publicity_id) as total, store_id FROM publicity_store p where  company_id=_company_id and visit_id=0 and publicity_id=562 group by publicity_id,store_id
          );
        /*Fin especial Base Bayer*/


        DROP TEMPORARY TABLE IF EXISTS preg_si_no_4_562;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_4_562 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_4 and publicity_id=562
          );
        DROP TEMPORARY TABLE IF EXISTS preg_4_562;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_4_562 ( INDEX(store_id ) ) AS
          (
            select store_id,publicity_id, respuesta,
              sum(case when options = CONVERT(CONCAT(@poll__id_4 ,'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
              sum(case when options = CONVERT(CONCAT(@poll__id_4 ,'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
              otro
            from tmp_opciones_pop
            where  poll_id = @poll__id_4 and publicity_id=562
            group by store_id, respuesta, otro,publicity_id
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_5_562;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_5_562 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_5 and publicity_id=562
          );
        DROP TEMPORARY TABLE IF EXISTS preg_5_562;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_5_562 ( INDEX(store_id ) ) AS
          (
            select store_id,publicity_id, respuesta,
              sum(case when options = CONVERT(CONCAT(@poll__id_5 ,'d') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
              otro
            from tmp_opciones_pop
            where  poll_id = @poll__id_5 and publicity_id=562
            group by store_id, respuesta,product_id, otro,publicity_id
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_6_562;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_6_562 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_6 and publicity_id=562
          );
        DROP TEMPORARY TABLE IF EXISTS preg_6_562;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_6_562 ( INDEX(store_id ) ) AS
          (
            select store_id,publicity_id, respuesta,
              sum(case when options = CONVERT(CONCAT(@poll__id_6 ,'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
              sum(case when options = CONVERT(CONCAT(@poll__id_6 ,'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
              sum(case when options = CONVERT(CONCAT(@poll__id_6 ,'c') using utf8) collate utf8_spanish_ci then 1 else 0 end) as c,
              foto,
              otro
            from tmp_opciones_pop
            where  poll_id = @poll__id_6 and publicity_id=562
            group by store_id, respuesta,product_id,foto, otro,publicity_id
          );


        select
          tmp_comercios_pop.store_id,
          tmp_comercios_pop.chanel,
          tmp_comercios_pop.zone,
          tmp_comercios_pop.fullname,
          tmp_comercios_pop.address,
          tmp_comercios_pop.district,
          tmp_comercios_pop.region,
          tmp_comercios_pop.ejecutivo,
          tmp_comercios_pop.ubigeo,
          tmp_comercios_pop.Auditor,
          tmp_comercios_pop.fecha,
          tmp_comercios_pop.hora,
          tmp_comercios_pop.visit_id,

          -- ****************************** PREGUNTAS GENERALES ********************************************
          (case when preg_si_no_1.Respuesta > 0 then 2 else '0' end) as '1_Respuesta',
          preg_si_no_1.Foto as '1_Foto',

          --
          -- --  -------------------- 566 -------------------
          --
          -- (case when preg_si_no_3_566.Respuesta > 0 then 2 else '0' end) as '3_566_Respuesta',
          if(preg_si_no_3_566.Respuesta is null , '' , if (preg_si_no_3_566.Respuesta > 0, 2 , 0)) as '3_566_Respuesta',
          preg_si_no_3_566.Foto as '3_566_Foto',
          (case when preg_Base_566.total  is null then 0 else preg_Base_566.total end) as  'Base_566_total',
          -- (case when preg_si_no_4_566.Respuesta > 0 then 2 else '0' end) as '4_566_Respuesta',
          if(preg_si_no_4_566.Respuesta is null , '' , if (preg_si_no_4_566.Respuesta > 0, 2 , 0)) as '4_566_Respuesta',
          (case when preg_4_566.a > 0 then 2 else preg_4_566.a end) as '4_566_a',
          (case when preg_4_566.b > 0 then 2 else preg_4_566.b end) as '4_566_b',
          preg_4_566.otro as '4_566_Comentario',

          -- (case when preg_si_no_5_566.Respuesta > 0 then 2 else '0' end) as '5_566_Respuesta',
          if(preg_si_no_5_566.Respuesta is null , '' , if (preg_si_no_5_566.Respuesta > 0, 2 , 0)) as '5_566_Respuesta',
          (case when preg_5_566.a > 0 then 2 else preg_5_566.a end) as '5_566_a',
          (case when preg_5_566.b > 0 then 2 else preg_5_566.b end) as '5_566_b',
          (case when preg_5_566.c > 0 then 2 else preg_5_566.c end) as '5_566_c',
          preg_5_566.otro as '5_566_Comentario',

          -- (case when preg_si_no_6_566.Respuesta > 0 then 2 else '0' end) as '6_566_Respuesta',
          if(preg_si_no_6_566.Respuesta is null , '' , if (preg_si_no_6_566.Respuesta > 0, 2 , 0)) as '6_566_Respuesta',
          (case when preg_6_566.a > 0 then 2 else preg_6_566.a end) as '6_566_a',
          (case when preg_6_566.b > 0 then 2 else preg_6_566.b end) as '6_566_b',
          (case when preg_6_566.c > 0 then 2 else preg_6_566.c end) as '6_566_c',
          preg_si_no_6_566.comentario as '6_566_Comentario',
          preg_si_no_6_566.Foto as '6_566_Foto',
          --
          -- --  -------------------- 562 -------------------
          --
          -- (case when preg_si_no_3_562.Respuesta > 0 then 2 else '0' end) as '3_562_Respuesta',
          if(preg_si_no_3_562.Respuesta is null , '' , if (preg_si_no_3_562.Respuesta > 0, 2 , 0)) as '3_562_Respuesta',
          preg_si_no_3_562.Foto as '3_562_Foto',
          (case when preg_Base_562.total  is null then 0 else preg_Base_562.total end) as  'Base_562_total',
          -- (case when preg_si_no_4_562.Respuesta > 0 then 2 else '0' end) as '4_562_Respuesta',
          if(preg_si_no_4_562.Respuesta is null , '' , if (preg_si_no_4_562.Respuesta > 0, 2 , 0)) as '4_562_Respuesta',
          (case when preg_4_562.a > 0 then 2 else preg_4_562.a end) as '4_562_a',
          (case when preg_4_562.b > 0 then 2 else preg_4_562.b end) as '4_562_b',
          preg_4_562.otro as '4_562_Comentario',

          -- (case when preg_si_no_5_562.Respuesta > 0 then 2 else '0' end) as '5_562_Respuesta',
          if(preg_si_no_5_562.Respuesta is null , '' , if (preg_si_no_5_562.Respuesta > 0, 2 , 0)) as '5_562_Respuesta',
          (case when preg_5_562.a > 0 then 2 else preg_5_562.a end) as '5_562_a',
          preg_5_562.otro as '5_562_Comentario',

          -- (case when preg_si_no_6_562.Respuesta > 0 then 2 else '0' end) as '6_562_Respuesta',
          if(preg_si_no_6_562.Respuesta is null , '' , if (preg_si_no_6_562.Respuesta > 0, 2 , 0)) as '6_562_Respuesta',
          (case when preg_6_562.a > 0 then 2 else preg_6_562.a end) as '6_562_a',
          (case when preg_6_562.b > 0 then 2 else preg_6_562.b end) as '6_562_b',
          (case when preg_6_562.c > 0 then 2 else preg_6_562.c end) as '6_562_c',
          preg_si_no_6_562.comentario as '6_562_Comentario',
          preg_si_no_6_562.Foto as '6_562_Foto',
          --
          -- --  -------------------- 567 -------------------
          --
          -- (case when preg_si_no_3_567.Respuesta > 0 then 2 else '0' end) as '3_567_Respuesta',
          if(preg_si_no_3_567.Respuesta is null , '' , if (preg_si_no_3_567.Respuesta > 0, 2 , 0)) as '3_567_Respuesta',
          preg_si_no_3_567.Foto as '3_567_Foto',
          (case when preg_Base_567.total  is null then 0 else preg_Base_567.total end) as  'Base_567_total',
          -- (case when preg_si_no_4_567.Respuesta > 0 then 2 else '0' end) as '4_567_Respuesta',
          if(preg_si_no_4_567.Respuesta is null , '' , if (preg_si_no_4_567.Respuesta > 0, 2 , 0)) as '4_567_Respuesta',
          (case when preg_4_567.a > 0 then 2 else preg_4_567.a end) as '4_567_a',
          (case when preg_4_567.b > 0 then 2 else preg_4_567.b end) as '4_567_b',
          preg_4_567.otro as '4_567_Comentario',

          -- (case when preg_si_no_5_567.Respuesta > 0 then 2 else '0' end) as '5_567_Respuesta',
          if(preg_si_no_5_567.Respuesta is null , '' , if (preg_si_no_5_567.Respuesta > 0, 2 , 0)) as '5_567_Respuesta',
          (case when preg_5_567.a > 0 then 2 else preg_5_567.a end) as '5_567_a',
          preg_5_567.otro as '5_567_Comentario',

          -- (case when preg_si_no_6_567.Respuesta > 0 then 2 else '0' end) as '6_567_Respuesta',
          if(preg_si_no_6_567.Respuesta is null , '' , if (preg_si_no_6_567.Respuesta > 0, 2 , 0)) as '6_567_Respuesta',
          (case when preg_6_567.a > 0 then 2 else preg_6_567.a end) as '6_567_a',
          (case when preg_6_567.b > 0 then 2 else preg_6_567.b end) as '6_567_b',
          (case when preg_6_567.c > 0 then 2 else preg_6_567.c end) as '6_567_c',
          preg_si_no_6_567.comentario as '6_567_Comentario',
          preg_si_no_6_567.Foto as '6_567_Foto'
        --
        from tmp_comercios_pop

          left outer join preg_si_no_1 on (tmp_comercios_pop.store_id = preg_si_no_1.store_id )
          --
          --

          -- -- /*566*/
          -- --
          left outer join preg_si_no_3_566 on (tmp_comercios_pop.store_id = preg_si_no_3_566.store_id )

          left outer join preg_Base_566 on (tmp_comercios_pop.store_id = preg_Base_566.store_id )

          left outer join preg_si_no_4_566 on (tmp_comercios_pop.store_id = preg_si_no_4_566.store_id )
          left outer join preg_4_566 on (tmp_comercios_pop.store_id = preg_4_566.store_id )

          left outer join preg_si_no_5_566 on (tmp_comercios_pop.store_id = preg_si_no_5_566.store_id )
          left outer join preg_5_566 on (tmp_comercios_pop.store_id = preg_5_566.store_id )

          left outer join preg_si_no_6_566 on (tmp_comercios_pop.store_id = preg_si_no_6_566.store_id )
          left outer join preg_6_566 on (tmp_comercios_pop.store_id = preg_6_566.store_id )
          --
          -- /*562*/
          --
          left outer join preg_si_no_3_562 on (tmp_comercios_pop.store_id = preg_si_no_3_562.store_id )

          left outer join preg_Base_562 on (tmp_comercios_pop.store_id = preg_Base_562.store_id )

          left outer join preg_si_no_4_562 on (tmp_comercios_pop.store_id = preg_si_no_4_562.store_id )
          left outer join preg_4_562 on (tmp_comercios_pop.store_id = preg_4_562.store_id )

          left outer join preg_si_no_5_562 on (tmp_comercios_pop.store_id = preg_si_no_5_562.store_id )
          left outer join preg_5_562 on (tmp_comercios_pop.store_id = preg_5_562.store_id )

          left outer join preg_si_no_6_562 on (tmp_comercios_pop.store_id = preg_si_no_6_562.store_id )
          left outer join preg_6_562 on (tmp_comercios_pop.store_id = preg_6_562.store_id )
          --
          -- /*567*/
          --
          left outer join preg_si_no_3_567 on (tmp_comercios_pop.store_id = preg_si_no_3_567.store_id )

          left outer join preg_Base_567 on (tmp_comercios_pop.store_id = preg_Base_567.store_id )

          left outer join preg_si_no_4_567 on (tmp_comercios_pop.store_id = preg_si_no_4_567.store_id )
          left outer join preg_4_567 on (tmp_comercios_pop.store_id = preg_4_567.store_id )

          left outer join preg_si_no_5_567 on (tmp_comercios_pop.store_id = preg_si_no_5_567.store_id )
          left outer join preg_5_567 on (tmp_comercios_pop.store_id = preg_5_567.store_id )

          left outer join preg_si_no_6_567 on (tmp_comercios_pop.store_id = preg_si_no_6_567.store_id )
          left outer join preg_6_567 on (tmp_comercios_pop.store_id = preg_6_567.store_id );


      END IF;
    END IF;

    IF _tipo = 1 THEN
      IF _pag = 1 THEN
        DROP TEMPORARY TABLE IF EXISTS preg_si_no_1;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_1 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_1 and product_id=0
            group by store_id, visit_id
          );
        DROP TEMPORARY TABLE IF EXISTS preg_si_no_12;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_12 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_12
            group by store_id,visit_id
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_13;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_13 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_13
            group by store_id,visit_id
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_14;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_14 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_14
            group by store_id,visit_id
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_15;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_15 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_15
            group by store_id,visit_id
          );
        DROP TEMPORARY TABLE IF EXISTS preg_16;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_16 ( INDEX(store_id ) ) AS
          (
            select store_id, respuesta,
              sum(case when options = CONVERT(CONCAT(@poll__id_16 ,'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
              sum(case when options = CONVERT(CONCAT(@poll__id_16 ,'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b
            from tmp_opciones_pop
            where  poll_id = @poll__id_16 and visit_id=_visit_id
            group by store_id, respuesta,visit_id
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_20;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_20 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_20
            group by store_id,visit_id
          );

        select
          tmp_comercios_pop.store_id,
          tmp_comercios_pop.chanel,
          tmp_comercios_pop.zone,
          tmp_comercios_pop.fullname,
          tmp_comercios_pop.address,
          tmp_comercios_pop.district,
          tmp_comercios_pop.region,
          tmp_comercios_pop.ubigeo,
          tmp_comercios_pop.Auditor,
          tmp_comercios_pop.fecha,
          tmp_comercios_pop.hora,
          tmp_comercios_pop.visit_id,

          -- ****************************** PREGUNTAS GENERALES ********************************************
          (case when preg_si_no_1.Respuesta > 0 then 2 else '0' end) as '1_Respuesta',
          preg_si_no_1.Foto as '1_Foto',
          preg_si_no_12.comentario as '12_Comentario',
          preg_si_no_13.comentario as '13_Comentario',
          preg_si_no_14.comentario as '14_Comentario',
          preg_si_no_15.comentario as '15_Comentario',
          (case when preg_16.a > 0 then 2 else preg_16.a end) as '16_a',
          (case when preg_16.b > 0 then 2 else preg_16.b end) as '16_b',
          preg_si_no_20.comentario as '20_Comentario'
        from tmp_comercios_pop

          left outer join preg_si_no_1 on (tmp_comercios_pop.store_id = preg_si_no_1.store_id and  tmp_comercios_pop.visit_id = preg_si_no_1.visit_id)
          left outer join preg_si_no_12 on (tmp_comercios_pop.store_id = preg_si_no_12.store_id and tmp_comercios_pop.visit_id = preg_si_no_12.visit_id )
          left outer join preg_si_no_13 on (tmp_comercios_pop.store_id = preg_si_no_13.store_id and  tmp_comercios_pop.visit_id = preg_si_no_13.visit_id)
          left outer join preg_si_no_14 on (tmp_comercios_pop.store_id = preg_si_no_14.store_id and tmp_comercios_pop.visit_id = preg_si_no_14.visit_id)
          left outer join preg_si_no_15 on (tmp_comercios_pop.store_id = preg_si_no_15.store_id  and tmp_comercios_pop.visit_id = preg_si_no_15.visit_id)
          left outer join preg_16 on (tmp_comercios_pop.store_id = preg_16.store_id )
          left outer join preg_si_no_20 on (tmp_comercios_pop.store_id = preg_si_no_20.store_id and  tmp_comercios_pop.visit_id = preg_si_no_20.visit_id);

      END IF;
      IF _pag = 2 THEN
        DROP TEMPORARY TABLE IF EXISTS preg_si_no_1;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_1 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_1 and product_id=0
            group by store_id, visit_id
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_17;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_17 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_17
            group by store_id,visit_id
          );

        DROP TEMPORARY TABLE IF EXISTS preg_18;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_18 ( INDEX(store_id ) ) AS
          (
            select store_id, respuesta,
              sum(case when options = CONVERT(CONCAT(@poll__id_18 ,'a') using utf8) collate utf8_spanish_ci then 1 else 0 end) as a,
              sum(case when options = CONVERT(CONCAT(@poll__id_18 ,'b') using utf8) collate utf8_spanish_ci then 1 else 0 end) as b,
              sum(case when options = CONVERT(CONCAT(@poll__id_18 ,'c') using utf8) collate utf8_spanish_ci then 1 else 0 end) as c,
              sum(case when options = CONVERT(CONCAT(@poll__id_18 ,'d') using utf8) collate utf8_spanish_ci then 1 else 0 end) as d,
              sum(case when options = CONVERT(CONCAT(@poll__id_18 ,'e') using utf8) collate utf8_spanish_ci then 1 else 0 end) as e,
              otro
            from tmp_opciones_pop
            where  poll_id = @poll__id_18 and visit_id=_visit_id
            group by store_id, respuesta,visit_id
          );
        DROP TEMPORARY TABLE IF EXISTS preg_si_no_19;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_19 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_19
            group by store_id,visit_id
          );
        DROP TEMPORARY TABLE IF EXISTS preg_si_no_20;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_20 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_20
            group by store_id,visit_id
          );


        select
          tmp_comercios_pop.store_id,
          tmp_comercios_pop.chanel,
          tmp_comercios_pop.zone,
          tmp_comercios_pop.fullname,
          tmp_comercios_pop.address,
          tmp_comercios_pop.district,
          tmp_comercios_pop.region,
          tmp_comercios_pop.ubigeo,
          tmp_comercios_pop.Auditor,
          tmp_comercios_pop.fecha,
          tmp_comercios_pop.hora,
          tmp_comercios_pop.visit_id,

          -- ****************************** PREGUNTAS GENERALES ********************************************
          (case when preg_si_no_1.Respuesta > 0 then 2 else '0' end) as '1_Respuesta',
          preg_si_no_1.Foto as '1_Foto',
          (case when preg_si_no_17.Respuesta > 0 then 2 else '0' end) as '17_Respuesta',
          tmp_amounts.amount  as 'Monto',
          (case when preg_18.a > 0 then 2 else preg_18.a end) as '18_a',
          (case when preg_18.b > 0 then 2 else preg_18.b end) as '18_b',
          (case when preg_18.c > 0 then 2 else preg_18.c end) as '18_c',
          (case when preg_18.d > 0 then 2 else preg_18.d end) as '18_d',
          (case when preg_18.e > 0 then 2 else preg_18.e end) as '18_e',
          preg_18.otro as '18_Comentario',
          preg_si_no_19.comentario as '19_Comentario',
          preg_si_no_20.comentario as '20_Comentario'
        from tmp_comercios_pop

          left outer join preg_si_no_1 on (tmp_comercios_pop.store_id = preg_si_no_1.store_id  and tmp_comercios_pop.visit_id = preg_si_no_1.visit_id)
          left outer join preg_si_no_17 on (tmp_comercios_pop.store_id = preg_si_no_17.store_id and  tmp_comercios_pop.visit_id = preg_si_no_17.visit_id)
          left outer join tmp_amounts on (tmp_comercios_pop.store_id = tmp_amounts.store_id  and  tmp_comercios_pop.visit_id = tmp_amounts.visit_id)
          left outer join preg_18 on (tmp_comercios_pop.store_id = preg_18.store_id  )
          left outer join preg_si_no_19 on (tmp_comercios_pop.store_id = preg_si_no_19.store_id and  tmp_comercios_pop.visit_id = preg_si_no_19.visit_id)
          left outer join preg_si_no_20 on (tmp_comercios_pop.store_id = preg_si_no_20.store_id  and tmp_comercios_pop.visit_id = preg_si_no_20.visit_id);
      END IF;

    END IF;

    IF _tipo = 2 THEN
      IF _pag = 1  THEN
        DROP TEMPORARY TABLE IF EXISTS preg_si_no_21_788;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_21_788 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_21 and publicity_id=788
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_21_789;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_21_789 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_21 and publicity_id=789
          );

        /*788*/
        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_788_468;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_788_468 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=788 and laboratory_id=468
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_788_469;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_788_469 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=788 and laboratory_id=469
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_788_470;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_788_470 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=788 and laboratory_id=470
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_788_471;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_788_471 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=788 and laboratory_id=471
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_788_472;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_788_472 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=788 and laboratory_id=472
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_788_473;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_788_473 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=788 and laboratory_id=473
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_788_474;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_788_474 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=788 and laboratory_id=474
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_788_475;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_788_475 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=788 and laboratory_id=475
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_788_476;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_788_476 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=788 and laboratory_id=476
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_788_477;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_788_477 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=788 and laboratory_id=477
          );

        /*789*/
        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_789_468;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_789_468 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=789 and laboratory_id=468
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_789_469;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_789_469 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=789 and laboratory_id=469
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_789_470;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_789_470 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=789 and laboratory_id=470
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_789_471;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_789_471 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=789 and laboratory_id=471
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_789_472;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_789_472 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=789 and laboratory_id=472
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_789_473;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_789_473 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=789 and laboratory_id=473
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_789_474;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_789_474 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=789 and laboratory_id=474
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_789_475;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_789_475 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=789 and laboratory_id=475
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_789_476;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_789_476 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=789 and laboratory_id=476
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_789_477;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_789_477 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=789 and laboratory_id=477
          );


        /*Consulta*/

        select
          tmp_comercios_pop.store_id,
          tmp_comercios_pop.chanel,
          tmp_comercios_pop.zone,
          tmp_comercios_pop.fullname,
          tmp_comercios_pop.address,
          tmp_comercios_pop.district,
          tmp_comercios_pop.region,
          tmp_comercios_pop.owner,
          tmp_comercios_pop.ubigeo,
          tmp_comercios_pop.Auditor,
          tmp_comercios_pop.fecha,
          tmp_comercios_pop.hora,
          tmp_comercios_pop.visit_id,

          -- ****************************** PREGUNTAS GENERALES ********************************************
          (case when preg_si_no_21_788.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_21_788',
          preg_si_no_21_788.Foto as '21_788_Foto',
          (case when preg_si_no_22_788_468.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_788_468',
          (case when preg_si_no_22_788_469.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_788_469',
          (case when preg_si_no_22_788_470.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_788_470',

          (case when preg_si_no_22_788_471.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_788_471',
          (case when preg_si_no_22_788_472.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_788_472',
          (case when preg_si_no_22_788_473.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_788_473',
          (case when preg_si_no_22_788_474.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_788_474',
          (case when preg_si_no_22_788_475.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_788_475',
          (case when preg_si_no_22_788_476.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_788_476',
          (case when preg_si_no_22_788_477.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_788_477',
          preg_si_no_22_788_477.comentario as '22_788_477_Comentario',

          (case when preg_si_no_21_789.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_21_789',
          preg_si_no_21_789.Foto as '21_789_Foto',
          (case when preg_si_no_22_789_468.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_789_468',
          (case when preg_si_no_22_789_469.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_789_469',
          (case when preg_si_no_22_789_470.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_789_470',

          (case when preg_si_no_22_789_471.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_789_471',
          (case when preg_si_no_22_789_472.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_789_472',
          (case when preg_si_no_22_789_473.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_789_473',
          (case when preg_si_no_22_789_474.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_789_474',
          (case when preg_si_no_22_789_475.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_789_475',
          (case when preg_si_no_22_789_476.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_789_476',
          (case when preg_si_no_22_789_477.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_789_477',
          preg_si_no_22_789_477.comentario as '22_789_477_Comentario'

        from tmp_comercios_pop

          left outer join preg_si_no_21_788 on (tmp_comercios_pop.store_id = preg_si_no_21_788.store_id )
          left outer join preg_si_no_21_789 on (tmp_comercios_pop.store_id = preg_si_no_21_789.store_id )
          left outer join preg_si_no_22_788_468 on (tmp_comercios_pop.store_id = preg_si_no_22_788_468.store_id )
          left outer join preg_si_no_22_788_469 on (tmp_comercios_pop.store_id = preg_si_no_22_788_469.store_id )
          left outer join preg_si_no_22_788_470 on (tmp_comercios_pop.store_id = preg_si_no_22_788_470.store_id )
          left outer join preg_si_no_22_788_471 on (tmp_comercios_pop.store_id = preg_si_no_22_788_471.store_id )
          left outer join preg_si_no_22_788_472 on (tmp_comercios_pop.store_id = preg_si_no_22_788_472.store_id )
          left outer join preg_si_no_22_788_473 on (tmp_comercios_pop.store_id = preg_si_no_22_788_473.store_id )
          left outer join preg_si_no_22_788_474 on (tmp_comercios_pop.store_id = preg_si_no_22_788_474.store_id )
          left outer join preg_si_no_22_788_475 on (tmp_comercios_pop.store_id = preg_si_no_22_788_475.store_id )
          left outer join preg_si_no_22_788_476 on (tmp_comercios_pop.store_id = preg_si_no_22_788_476.store_id )
          left outer join preg_si_no_22_788_477 on (tmp_comercios_pop.store_id = preg_si_no_22_788_477.store_id )

          left outer join preg_si_no_22_789_468 on (tmp_comercios_pop.store_id = preg_si_no_22_789_468.store_id )
          left outer join preg_si_no_22_789_469 on (tmp_comercios_pop.store_id = preg_si_no_22_789_469.store_id )
          left outer join preg_si_no_22_789_470 on (tmp_comercios_pop.store_id = preg_si_no_22_789_470.store_id )
          left outer join preg_si_no_22_789_471 on (tmp_comercios_pop.store_id = preg_si_no_22_789_471.store_id )
          left outer join preg_si_no_22_789_472 on (tmp_comercios_pop.store_id = preg_si_no_22_789_472.store_id )
          left outer join preg_si_no_22_789_473 on (tmp_comercios_pop.store_id = preg_si_no_22_789_473.store_id )
          left outer join preg_si_no_22_789_474 on (tmp_comercios_pop.store_id = preg_si_no_22_789_474.store_id )
          left outer join preg_si_no_22_789_475 on (tmp_comercios_pop.store_id = preg_si_no_22_789_475.store_id )
          left outer join preg_si_no_22_789_476 on (tmp_comercios_pop.store_id = preg_si_no_22_789_476.store_id )
          left outer join preg_si_no_22_789_477 on (tmp_comercios_pop.store_id = preg_si_no_22_789_477.store_id );

      END IF;
      IF _pag = 2  THEN

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_21_790;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_21_790 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_21 and publicity_id=790
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_21_791;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_21_791 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_21 and publicity_id=791
          );

        /*790*/
        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_790_468;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_790_468 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=790 and laboratory_id=468
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_790_469;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_790_469 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=790 and laboratory_id=469
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_790_470;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_790_470 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=790 and laboratory_id=470
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_790_471;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_790_471 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=790 and laboratory_id=471
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_790_472;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_790_472 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=790 and laboratory_id=472
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_790_473;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_790_473 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=790 and laboratory_id=473
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_790_474;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_790_474 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=790 and laboratory_id=474
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_790_475;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_790_475 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=790 and laboratory_id=475
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_790_476;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_790_476 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=790 and laboratory_id=476
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_790_477;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_790_477 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=790 and laboratory_id=477
          );

        /*791*/
        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_791_468;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_791_468 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=791 and laboratory_id=468
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_791_469;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_791_469 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=791 and laboratory_id=469
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_791_470;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_791_470 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=791 and laboratory_id=470
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_791_471;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_791_471 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=791 and laboratory_id=471
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_791_472;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_791_472 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=791 and laboratory_id=472
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_791_473;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_791_473 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=791 and laboratory_id=473
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_791_474;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_791_474 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=791 and laboratory_id=474
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_791_475;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_791_475 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=791 and laboratory_id=475
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_791_476;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_791_476 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=791 and laboratory_id=476
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_791_477;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_791_477 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=791 and laboratory_id=477
          );


        /*Consulta*/

        select
          tmp_comercios_pop.store_id,
          tmp_comercios_pop.chanel,
          tmp_comercios_pop.zone,
          tmp_comercios_pop.fullname,
          tmp_comercios_pop.address,
          tmp_comercios_pop.district,
          tmp_comercios_pop.region,
          tmp_comercios_pop.owner,
          tmp_comercios_pop.ubigeo,
          tmp_comercios_pop.Auditor,
          tmp_comercios_pop.fecha,
          tmp_comercios_pop.hora,
          tmp_comercios_pop.visit_id,

          -- ****************************** PREGUNTAS GENERALES ********************************************
          (case when preg_si_no_21_790.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_21_790',
          preg_si_no_21_790.Foto as '21_790_Foto',
          (case when preg_si_no_22_790_468.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_790_468',
          (case when preg_si_no_22_790_469.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_790_469',
          (case when preg_si_no_22_790_470.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_790_470',

          (case when preg_si_no_22_790_471.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_790_471',
          (case when preg_si_no_22_790_472.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_790_472',
          (case when preg_si_no_22_790_473.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_790_473',
          (case when preg_si_no_22_790_474.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_790_474',
          (case when preg_si_no_22_790_475.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_790_475',
          (case when preg_si_no_22_790_476.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_790_476',
          (case when preg_si_no_22_790_477.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_790_477',
          preg_si_no_22_790_477.comentario as '22_790_477_Comentario',

          (case when preg_si_no_21_791.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_21_791',
          preg_si_no_21_791.Foto as '21_791_Foto',
          (case when preg_si_no_22_791_468.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_791_468',
          (case when preg_si_no_22_791_469.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_791_469',
          (case when preg_si_no_22_791_470.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_791_470',

          (case when preg_si_no_22_791_471.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_791_471',
          (case when preg_si_no_22_791_472.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_791_472',
          (case when preg_si_no_22_791_473.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_791_473',
          (case when preg_si_no_22_791_474.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_791_474',
          (case when preg_si_no_22_791_475.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_791_475',
          (case when preg_si_no_22_791_476.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_791_476',
          (case when preg_si_no_22_791_477.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_791_477',
          preg_si_no_22_791_477.comentario as '22_791_477_Comentario'

        from tmp_comercios_pop

          left outer join preg_si_no_21_790 on (tmp_comercios_pop.store_id = preg_si_no_21_790.store_id )
          left outer join preg_si_no_21_791 on (tmp_comercios_pop.store_id = preg_si_no_21_791.store_id )
          left outer join preg_si_no_22_790_468 on (tmp_comercios_pop.store_id = preg_si_no_22_790_468.store_id )
          left outer join preg_si_no_22_790_469 on (tmp_comercios_pop.store_id = preg_si_no_22_790_469.store_id )
          left outer join preg_si_no_22_790_470 on (tmp_comercios_pop.store_id = preg_si_no_22_790_470.store_id )
          left outer join preg_si_no_22_790_471 on (tmp_comercios_pop.store_id = preg_si_no_22_790_471.store_id )
          left outer join preg_si_no_22_790_472 on (tmp_comercios_pop.store_id = preg_si_no_22_790_472.store_id )
          left outer join preg_si_no_22_790_473 on (tmp_comercios_pop.store_id = preg_si_no_22_790_473.store_id )
          left outer join preg_si_no_22_790_474 on (tmp_comercios_pop.store_id = preg_si_no_22_790_474.store_id )
          left outer join preg_si_no_22_790_475 on (tmp_comercios_pop.store_id = preg_si_no_22_790_475.store_id )
          left outer join preg_si_no_22_790_476 on (tmp_comercios_pop.store_id = preg_si_no_22_790_476.store_id )
          left outer join preg_si_no_22_790_477 on (tmp_comercios_pop.store_id = preg_si_no_22_790_477.store_id )

          left outer join preg_si_no_22_791_468 on (tmp_comercios_pop.store_id = preg_si_no_22_791_468.store_id )
          left outer join preg_si_no_22_791_469 on (tmp_comercios_pop.store_id = preg_si_no_22_791_469.store_id )
          left outer join preg_si_no_22_791_470 on (tmp_comercios_pop.store_id = preg_si_no_22_791_470.store_id )
          left outer join preg_si_no_22_791_471 on (tmp_comercios_pop.store_id = preg_si_no_22_791_471.store_id )
          left outer join preg_si_no_22_791_472 on (tmp_comercios_pop.store_id = preg_si_no_22_791_472.store_id )
          left outer join preg_si_no_22_791_473 on (tmp_comercios_pop.store_id = preg_si_no_22_791_473.store_id )
          left outer join preg_si_no_22_791_474 on (tmp_comercios_pop.store_id = preg_si_no_22_791_474.store_id )
          left outer join preg_si_no_22_791_475 on (tmp_comercios_pop.store_id = preg_si_no_22_791_475.store_id )
          left outer join preg_si_no_22_791_476 on (tmp_comercios_pop.store_id = preg_si_no_22_791_476.store_id )
          left outer join preg_si_no_22_791_477 on (tmp_comercios_pop.store_id = preg_si_no_22_791_477.store_id );


      END IF;

      IF _pag = 3 THEN
        DROP TEMPORARY TABLE IF EXISTS preg_si_no_21_792;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_21_792 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_21 and publicity_id=792
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_21_793;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_21_793 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_21 and publicity_id=793
          );

        /*792*/
        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_792_468;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_792_468 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=792 and laboratory_id=468
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_792_469;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_792_469 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=792 and laboratory_id=469
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_792_470;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_792_470 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=792 and laboratory_id=470
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_792_471;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_792_471 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=792 and laboratory_id=471
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_792_472;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_792_472 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=792 and laboratory_id=472
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_792_473;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_792_473 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=792 and laboratory_id=473
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_792_474;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_792_474 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=792 and laboratory_id=474
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_792_475;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_792_475 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=792 and laboratory_id=475
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_792_476;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_792_476 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=792 and laboratory_id=476
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_792_477;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_792_477 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=792 and laboratory_id=477
          );

        /*793*/
        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_793_468;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_793_468 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=793 and laboratory_id=468
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_793_469;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_793_469 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=793 and laboratory_id=469
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_793_470;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_793_470 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=793 and laboratory_id=470
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_793_471;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_793_471 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=793 and laboratory_id=471
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_793_472;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_793_472 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=793 and laboratory_id=472
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_793_473;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_793_473 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=793 and laboratory_id=473
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_793_474;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_793_474 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=793 and laboratory_id=474
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_793_475;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_793_475 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=793 and laboratory_id=475
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_793_476;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_793_476 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=793 and laboratory_id=476
          );

        DROP TEMPORARY TABLE IF EXISTS preg_si_no_22_793_477;
        CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_22_793_477 ( INDEX(store_id ) ) AS
          (
            select * from tmp_sino_pop where poll_id = @poll__id_22 and publicity_id=793 and laboratory_id=477
          );


        /*Consulta*/

        select
          tmp_comercios_pop.store_id,
          tmp_comercios_pop.chanel,
          tmp_comercios_pop.zone,
          tmp_comercios_pop.fullname,
          tmp_comercios_pop.address,
          tmp_comercios_pop.district,
          tmp_comercios_pop.region,
          tmp_comercios_pop.owner,
          tmp_comercios_pop.ubigeo,
          tmp_comercios_pop.Auditor,
          tmp_comercios_pop.fecha,
          tmp_comercios_pop.hora,
          tmp_comercios_pop.visit_id,

          -- ****************************** PREGUNTAS GENERALES ********************************************
          (case when preg_si_no_21_792.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_21_792',
          preg_si_no_21_792.Foto as '21_792_Foto',
          (case when preg_si_no_22_792_468.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_792_468',
          (case when preg_si_no_22_792_469.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_792_469',
          (case when preg_si_no_22_792_470.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_792_470',

          (case when preg_si_no_22_792_471.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_792_471',
          (case when preg_si_no_22_792_472.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_792_472',
          (case when preg_si_no_22_792_473.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_792_473',
          (case when preg_si_no_22_792_474.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_792_474',
          (case when preg_si_no_22_792_475.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_792_475',
          (case when preg_si_no_22_792_476.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_792_476',
          (case when preg_si_no_22_792_477.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_792_477',
          preg_si_no_22_792_477.comentario as '22_792_477_Comentario',

          (case when preg_si_no_21_793.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_21_793',
          preg_si_no_21_793.Foto as '21_793_Foto',
          (case when preg_si_no_22_793_468.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_793_468',
          preg_si_no_22_793_468.comentario as '22_793_468_Comentario',
          (case when preg_si_no_22_793_469.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_793_469',
          preg_si_no_22_793_469.comentario as '22_793_469_Comentario',
          (case when preg_si_no_22_793_470.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_793_470',
          preg_si_no_22_793_470.comentario as '22_793_470_Comentario',

          (case when preg_si_no_22_793_471.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_793_471',
          preg_si_no_22_793_471.comentario as '22_793_471_Comentario',
          (case when preg_si_no_22_793_472.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_793_472',
          preg_si_no_22_793_472.comentario as '22_793_472_Comentario',
          (case when preg_si_no_22_793_473.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_793_473',
          preg_si_no_22_793_473.comentario as '22_793_473_Comentario',
          (case when preg_si_no_22_793_474.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_793_474',
          preg_si_no_22_793_474.comentario as '22_793_474_Comentario',
          (case when preg_si_no_22_793_475.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_793_475',
          preg_si_no_22_793_475.comentario as '22_793_475_Comentario',
          (case when preg_si_no_22_793_476.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_793_476',
          preg_si_no_22_793_476.comentario as '22_793_476_Comentario',
          (case when preg_si_no_22_793_477.Respuesta > 0 then 2 else '0' end) as 'preg_si_no_22_793_477',
          preg_si_no_22_793_477.comentario as '22_793_477_Comentario'

        from tmp_comercios_pop

          left outer join preg_si_no_21_792 on (tmp_comercios_pop.store_id = preg_si_no_21_792.store_id )
          left outer join preg_si_no_21_793 on (tmp_comercios_pop.store_id = preg_si_no_21_793.store_id )
          left outer join preg_si_no_22_792_468 on (tmp_comercios_pop.store_id = preg_si_no_22_792_468.store_id )
          left outer join preg_si_no_22_792_469 on (tmp_comercios_pop.store_id = preg_si_no_22_792_469.store_id )
          left outer join preg_si_no_22_792_470 on (tmp_comercios_pop.store_id = preg_si_no_22_792_470.store_id )
          left outer join preg_si_no_22_792_471 on (tmp_comercios_pop.store_id = preg_si_no_22_792_471.store_id )
          left outer join preg_si_no_22_792_472 on (tmp_comercios_pop.store_id = preg_si_no_22_792_472.store_id )
          left outer join preg_si_no_22_792_473 on (tmp_comercios_pop.store_id = preg_si_no_22_792_473.store_id )
          left outer join preg_si_no_22_792_474 on (tmp_comercios_pop.store_id = preg_si_no_22_792_474.store_id )
          left outer join preg_si_no_22_792_475 on (tmp_comercios_pop.store_id = preg_si_no_22_792_475.store_id )
          left outer join preg_si_no_22_792_476 on (tmp_comercios_pop.store_id = preg_si_no_22_792_476.store_id )
          left outer join preg_si_no_22_792_477 on (tmp_comercios_pop.store_id = preg_si_no_22_792_477.store_id )

          left outer join preg_si_no_22_793_468 on (tmp_comercios_pop.store_id = preg_si_no_22_793_468.store_id )
          left outer join preg_si_no_22_793_469 on (tmp_comercios_pop.store_id = preg_si_no_22_793_469.store_id )
          left outer join preg_si_no_22_793_470 on (tmp_comercios_pop.store_id = preg_si_no_22_793_470.store_id )
          left outer join preg_si_no_22_793_471 on (tmp_comercios_pop.store_id = preg_si_no_22_793_471.store_id )
          left outer join preg_si_no_22_793_472 on (tmp_comercios_pop.store_id = preg_si_no_22_793_472.store_id )
          left outer join preg_si_no_22_793_473 on (tmp_comercios_pop.store_id = preg_si_no_22_793_473.store_id )
          left outer join preg_si_no_22_793_474 on (tmp_comercios_pop.store_id = preg_si_no_22_793_474.store_id )
          left outer join preg_si_no_22_793_475 on (tmp_comercios_pop.store_id = preg_si_no_22_793_475.store_id )
          left outer join preg_si_no_22_793_476 on (tmp_comercios_pop.store_id = preg_si_no_22_793_476.store_id )
          left outer join preg_si_no_22_793_477 on (tmp_comercios_pop.store_id = preg_si_no_22_793_477.store_id );

      END IF;

    END IF;
  END