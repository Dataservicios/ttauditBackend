CREATE DEFINER=`dataser_admin`@`%` PROCEDURE `sp_orders_new`(IN _company_id INT, IN _tipo INT,
                                                             IN _date_init  VARCHAR(255), IN _date_end VARCHAR(255),IN _user_id INT)
BEGIN
SET @created_at = (select DATE_SUB(NOW(),INTERVAL 5 HOUR));
IF EXISTS (SELECT id FROM tempory_processes ) THEN

   SET @status_ =(SELECT `status` FROM tempory_processes) ;

   IF  @status_ = 0 THEN
		SET @updated_at = (select DATE_SUB(NOW(),INTERVAL 5 HOUR));
		UPDATE `tempory_processes` SET `status` = 1 , `processes` = 'sp_orders_new',`updated_at` = @updated_at;

        /*inicio*/
        SET @poll__id_1 = (SELECT   `p`.`id` FROM  `polls` p  LEFT OUTER JOIN `company_audits` ca ON (`p`.`company_audit_id` = `ca`.`id`)WHERE  `ca`.`company_id` = _company_id AND `p`.`orden` = 13);

    /*IF _tipo = 0
    THEN
      DROP TEMPORARY TABLE IF EXISTS tmp_comercios_pop;
      CREATE TEMPORARY TABLE IF NOT EXISTS tmp_comercios_pop (
        INDEX (store_id)
      ) AS
        (
          SELECT *
          FROM (
                 SELECT
                   `pd`.`company_id`                               AS `company_id`,
                   `s`.`id`                                        AS `store_id`,
                   `s`.`cadenaRuc`                                 AS `cadenaRuc`,
                   `s`.`chanel`                                    AS `chanel`,
                   `s`.`zone`                                      AS `zone`,
                   `s`.`fullname`                                  AS `fullname`,
                   `s`.`address`                                   AS `address`,
                   `s`.`region`                                    AS `region`,
                   `s`.`owner`                                     AS `owner`,
                   `s`.`ubigeo`                                    AS `ubigeo`,
                   `s`.`district`                                  AS `district`,
                   `s`.`ejecutivo`                                 AS `ejecutivo`,
                   `s`.`latitude`                                  AS `latitude`,
                   `s`.`longitude`                                 AS `longitude`,
                   DATE_FORMAT(`pd`.`updated_at`, '%d/%m/%Y')      AS `fecha`,
                   MIN(DATE_FORMAT(`pd`.`updated_at`, '%H:%i:%s')) AS `hora`,
                   `u`.`id`                                        AS `Auditor_id`,
                   `u`.`fullname`                                  AS `Auditor`,
                   `vs`.`visit_id`                                 AS `visit_id`,
                   `s`.`cabecera`                                  AS `cabecera`,
                   `s`.`gerzonal`                                  as ZONA_TT,
                   `s`.`gzonal`                                    as ZONA_SUP
                 FROM
                   `poll_details` `pd`
                   LEFT JOIN `visit_stores` `vs`
                     ON (`vs`.`store_id` = `pd`.`store_id` AND `vs`.`company_id` = `pd`.`company_id` AND
                         `vs`.`visit_id` = `pd`.`visit_id`)
                   LEFT JOIN `stores` `s` ON (`pd`.`store_id` = `s`.`id`)
                   LEFT JOIN `road_details` `rd`
                     ON (`vs`.`company_id` = `rd`.`company_id` AND `vs`.`store_id` = `rd`.`store_id` AND
                         `vs`.`road_id` = `rd`.`road_id`)
                   LEFT JOIN `roads` `r` ON (`rd`.`road_id` = `r`.`id`)
                   LEFT JOIN `users` `u` ON (`r`.`user_id` = `u`.`id`)
                 WHERE
                   `pd`.`company_id` = _company_id and `s`.`chanel_store_id` = 2
                 GROUP BY `pd`.`company_id`, `s`.`id`, `s`.`type`, `s`.`zone`, `s`.`fullname`, `s`.`address`,
                   `s`.`region`, `s`.`owner`, `s`.`ubigeo`, `s`.`district`, `s`.`ejecutivo`, `s`.`latitude`,
                   `s`.`longitude`, DATE_FORMAT(`pd`.`updated_at`, '%d/%m/%Y'), `u`.`fullname`, `vs`.`visit_id`
               ) XX
          GROUP BY `XX`.`store_id`, `XX`.`visit_id`
        );
    END IF;*/
    IF _tipo = 1
    THEN
      DROP TEMPORARY TABLE IF EXISTS tmp_comercios_pop;
      CREATE TEMPORARY TABLE IF NOT EXISTS tmp_comercios_pop (
        INDEX (store_id)
      ) AS
        (
          SELECT
            `f`.`company_id`                               AS `company_id`,
            `a`.`store_id`                                 AS `store_id`,
            `b`.`type`                                     AS `type`,
            `b`.`cadenaRuc`                                AS `cadenaRuc`,
            `b`.`fullname`                                 AS `fullname`,
            `b`.`telephone`                                AS `telephone`,
            `b`.`address`                                  AS `address`,
            `b`.`region`                                   AS `region`,
            `b`.`ubigeo`                                   AS `ubigeo`,
            `b`.`district`                                 AS `district`,
            `b`.`latitude`                                 AS `latitude`,
            `b`.`longitude`                                AS `longitude`,
            `b`.`tipo_bodega`                              AS `tipo_bodega`,
            DATE_FORMAT(`a`.`created_at`, '%d/%m/%Y')      AS `fecha`,
            MIN(DATE_FORMAT(`a`.`created_at`, '%H:%i:%s')) AS `hora`,
            `e`.`id`                                       AS `auditor_id`,
            `e`.`fullname`                                 AS `Auditor`
          FROM
            `orders` `a`
            LEFT JOIN `stores` `b` ON (`a`.`store_id` = `b`.`id`)
            LEFT JOIN `company_stores` `f` ON (`a`.`store_id` = `f`.`store_id`)
            LEFT JOIN `users` `e` ON (`a`.`auditor_id` = `e`.`id`)
          WHERE
            `a`.`company_id` = _company_id
            AND DATE_FORMAT(`a`.`created_at`, '%Y-%m-%d') BETWEEN _date_init AND _date_end
          GROUP BY `a`.`store_id`);
    END IF;

    IF _tipo = 1
    THEN
      DROP TEMPORARY TABLE IF EXISTS tmp_orders;
      CREATE TEMPORARY TABLE IF NOT EXISTS tmp_orders (
        INDEX (store_id)
      ) AS
        (
          SELECT *
          FROM
            (SELECT
               `orders`.`id`,
               `orders`.`code`,
               `orders`.`store_id`,
               `orders`.`provider_id`,
               `users`.`fullname`                                  AS `distributor`,
               `orders`.`auditor_id`,
               `orders`.`company_id`,
               `orders`.`visit_id`,
               `orders`.`type_payment`,
               DATE_FORMAT(`orders`.`created_at`, '%d/%m/%Y')      AS `fecha`,
               MIN(DATE_FORMAT(`orders`.`created_at`, '%H:%i:%s')) AS `hora`,
               `orders`.`updated_at`
             FROM
               `orders`
               INNER JOIN `users` ON (`orders`.`provider_id` = `users`.`id`)
             WHERE
               `orders`.`company_id` = _company_id
             group by `orders`.`code`
             order by `orders`.`id` asc
            ) yy
          WHERE store_id in (SELECT store_id
                             FROM tmp_comercios_pop)
        );
    END IF;

    IF _tipo = 0
    THEN
      DROP TEMPORARY TABLE IF EXISTS tmp_orders;
      CREATE TEMPORARY TABLE IF NOT EXISTS tmp_orders (
        INDEX (store_id)
      ) AS
        (
          SELECT
            `orders`.`id`,
            `orders`.`code`,
            `orders`.`store_id`,
            `orders`.`provider_id`,
            `users`.`fullname`                                  AS `distributor`,
            `orders`.`company_id`,
            `orders`.`visit_id`,
            `orders`.`type_payment`,
            DATE_FORMAT(`orders`.`created_at`, '%d/%m/%Y')      AS `fecha`,
            MIN(DATE_FORMAT(`orders`.`created_at`, '%H:%i:%s')) AS `hora`,
            `orders`.`updated_at`,
            `s`.`cadenaRuc`                                     AS `cadenaRuc`,
            `s`.`chanel`                                        AS `chanel`,
            `s`.`zone`                                          AS `zone`,
            `s`.`fullname`                                      AS `fullname`,
            `s`.`address`                                       AS `address`,
            `s`.`region`                                        AS `region`,
            `s`.`owner`                                         AS `owner`,
            `s`.`ubigeo`                                        AS `ubigeo`,
            `s`.`district`                                      AS `district`,
            `s`.`ejecutivo`                                     AS `ejecutivo`,
            `s`.`latitude`                                      AS `latitude`,
            `s`.`longitude`                                     AS `longitude`,
            `s`.`cabecera`                                      AS `cabecera`,
            `s`.`owner`                                         as ZONA_TT,
            `s`.`gzonal`                                        as ZONA_SUP,
            `u`.`id`                                            AS `Auditor_id`,
            `u`.`fullname`                                      AS `Auditor`
          FROM
            `orders`
            INNER JOIN `users` ON (`orders`.`provider_id` = `users`.`id`)
            INNER JOIN `stores` `s` ON (`orders`.`store_id` = `s`.`id`)
            LEFT JOIN `users` `u` ON (`orders`.`auditor_id` = `u`.`id`)
          WHERE
            `orders`.`company_id` = _company_id
          group by `orders`.`code`
          order by `orders`.`id` asc
        );
    END IF;

    IF _tipo = 0
    THEN
      DROP TEMPORARY TABLE IF EXISTS tmp_sino_pop;
      CREATE TEMPORARY TABLE IF NOT EXISTS tmp_sino_pop (
        INDEX (company_id, store_id, poll_id)
      ) AS
        (
          SELECT *
          FROM
            (
              SELECT
                c.company_id          AS company_id,
                a.store_id            AS store_id,
                a.product_id          AS product_id,
                a.category_product_id AS category_product_id,
                a.poll_id             AS poll_id,
                a.result              AS Respuesta,
                a.visit_id            AS visit_id,
                a.comentario          AS comentario,
                a.laboratory_id       AS laboratory_id
              FROM
                (((((ttaudit_auditors.poll_details a)
                  LEFT JOIN ttaudit_auditors.polls b ON ((a.poll_id = b.id))
                  LEFT JOIN ttaudit_auditors.company_audits c ON ((c.id = b.company_audit_id)))))
                )
              WHERE
                (c.company_id = _company_id)
            ) yy
          WHERE store_id in (select store_id
                             from tmp_orders)
        );
    END IF;


    DROP TEMPORARY TABLE IF EXISTS tmp_order_details;
    CREATE TEMPORARY TABLE IF NOT EXISTS tmp_order_details (
      INDEX (order_id)
    ) AS
      (
        SELECT
          `order_details`.`id`,
          `order_details`.`order_id`,
          `order_details`.`product_id`,
          `products`.`fullname` as product,
          `products`.`brand`,
          `products`.`eam`,
          `order_details`.`quantity`,
          `order_details`.`price`,
          `order_details`.`amount`,
          `order_details`.`created_at`,
          `order_details`.`updated_at`
        FROM
          `order_details`
          INNER JOIN `products` ON (`order_details`.`product_id` = `products`.`id`)
        group by `order_details`.`order_id`, `order_details`.`product_id`
        order by `order_details`.`created_at` asc
      );


    IF _tipo = 0
    THEN
      DROP TEMPORARY TABLE IF EXISTS preg_si_no_1;
      CREATE TEMPORARY TABLE IF NOT EXISTS preg_si_no_1 (
        INDEX (store_id)
      ) AS
        (
          select *
          from tmp_sino_pop
          where poll_id = @poll__id_1 and product_id = 0
          group by store_id, visit_id
        );

      select
        tmp_orders.id           as order_id,
        tmp_orders.code,
        tmp_orders.provider_id,
        tmp_orders.distributor,
        tmp_orders.store_id,
        tmp_orders.fullname,
        tmp_orders.cadenaRuc,
        tmp_orders.chanel,
        tmp_orders.address,
        tmp_orders.district,
        tmp_orders.region,
        tmp_orders.ubigeo,
        tmp_orders.latitude,
        tmp_orders.longitude,
        tmp_orders.zone,
        tmp_orders.Auditor_id,
        tmp_orders.Auditor,
        tmp_orders.company_id,
        tmp_orders.visit_id,
        tmp_orders.fecha,
        tmp_orders.hora,
        tmp_order_details.product_id,
        tmp_order_details.eam,
        tmp_order_details.brand,
        tmp_order_details.product,
        tmp_order_details.quantity,
        tmp_order_details.price,
        tmp_order_details.amount,
        preg_si_no_1.comentario as 'atendio',
        tmp_orders.ZONA_TT,
        tmp_orders.ZONA_SUP

      from tmp_orders
        left outer join preg_si_no_1
          on (tmp_orders.store_id = preg_si_no_1.store_id and tmp_orders.visit_id = preg_si_no_1.visit_id)
        left outer join tmp_order_details on (tmp_orders.id = tmp_order_details.order_id);
    END IF;
    IF _tipo = 1
    THEN
      select
        tmp_orders.id        as order_id,
        tmp_orders.code,
        tmp_orders.provider_id,
        tmp_orders.distributor,
        tmp_comercios_pop.store_id,
        tmp_comercios_pop.cadenaRuc,
        tmp_comercios_pop.fullname,
        tmp_comercios_pop.address,
        tmp_comercios_pop.district,
        tmp_comercios_pop.region,
        tmp_comercios_pop.ubigeo,
        tmp_comercios_pop.telephone,
        tmp_comercios_pop.latitude,
        tmp_comercios_pop.longitude,
        tmp_comercios_pop.Auditor,
        tmp_orders.fecha,
        tmp_orders.hora,
        tmp_order_details.product_id,
        tmp_order_details.eam,
        tmp_order_details.brand,
        tmp_order_details.product,
        tmp_order_details.quantity,
        tmp_order_details.price,
        tmp_order_details.amount,
        (case when tmp_orders.type_payment = 1
          then 'Contado'
         else 'Crédito' end) as 'Tipo_Pago'

      from tmp_comercios_pop

        left outer join tmp_orders on (tmp_comercios_pop.store_id = tmp_orders.store_id)
        left outer join tmp_order_details on (tmp_orders.id = tmp_order_details.order_id);
    END IF;
        /*fin*/
        SET @updated_at = (select DATE_SUB(NOW(),INTERVAL 5 HOUR));
        INSERT INTO `log_processes`(`processes`,`status`,`company_id`,`user_id`,`created_at`,`updated_at`) VALUES ('sp_orders_new',1, _company_id , _user_id,@created_at,@updated_at );
		UPDATE `tempory_processes` SET `status` = 0,  `processes` = 'sp_orders_new',`updated_at` = @updated_at;
	END IF;
  ELSE
	SET @updated_at = (select DATE_SUB(NOW(),INTERVAL 5 HOUR));
    INSERT INTO `tempory_processes`(`processes`,`status`,`company_id`,`user_id`,`created_at`,`updated_at`) VALUES ('sp_orders_new',0, _company_id , 0,@created_at,@updated_at );
END IF;
END