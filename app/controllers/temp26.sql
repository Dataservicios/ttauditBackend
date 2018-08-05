CREATE DEFINER=`dataser_admin`@`%` PROCEDURE `sp_create_campagne_b_transf`(IN _previous_company_id INT, IN _active INT)
BEGIN
SET @previous_company_id = _previous_company_id;
SET @active = _active;
SET @created_at = (select DATE_SUB(NOW(),INTERVAL 5 HOUR));
-- Creando nuevava ampaña en base a la anterior
-- --------------------------------------------------
INSERT INTO `companies`
(
    `fullname`,
    `nameMin`,
    `active`,
    `customer_id`,
    `visible`,
    `auditoria`,
    `logo`,
    `markerPoint`,
    `marker_point_web`,
    `app_id`,
    `estudio`,
    `study_id`,
    `visits`,
    `created_at`,
    `updated_at`)

(
    SELECT
        `fullname`,
        `nameMin`,
         @active AS `active`,
        `customer_id`,
        `visible`,
        `auditoria`,
        `logo`,
        `markerPoint`,
        `marker_point_web`,
        `app_id`,
        `estudio`,
        `study_id`,
        `visits`,
        @created_at AS `created_at`,
        @created_at AS `updated_at`
    FROM `companies`
    WHERE id= @previous_company_id
);

-- Obteniendo el nuevo company_id insertado
-- -----------------------------------------
SET @company_id =(SELECT LAST_INSERT_ID());

-- Desactivando la anterior campaña
-- ----------------------------------------

IF @active = 1 THEN
    UPDATE `companies`  SET  `active` = 0, `app_id` = ''  WHERE `id` =  @previous_company_id ;
END IF;

-- Insertando el nuecvo company_audits
-- ---------------------------------------
INSERT INTO company_audits (
  `company_audits`.`audit_id`,
  `company_audits`.`company_id`,
  `company_audits`.`audit`,
`company_audits`.`orden`,
  `company_audits`.`created_at`,
  `company_audits`.`updated_at`)
(
SELECT
  `company_audits`.`audit_id`,
 CASE company_id
   when @previous_company_id  then @company_id
  END AS company_id,
  `company_audits`.`audit`,
`company_audits`.`orden`,
  now() AS  `created_at`,
  now() AS  `updated_at`
FROM `company_audits` where `company_audits`.`company_id`=@previous_company_id
);


-- ------------------------------------------------
-- INSERT IN TABLE POLL
-- Modificar el company_audit_id
-- -------------------------------------------------
INSERT INTO polls (
    `company_audit_id`,
    `question`,
    `orden`,
    `sino`,
    `options`,
    `option_type`,
    `media`,
    `comment`,
    `comment_requiered`,
    `comentType`,
    `comentTag`,
    `publicity`,
    `categoryProduct`,
    `product`,
    `stockProductPop`,
    `laboratory`,
    `web`,
    `identificador`,
    `created_at`,
    `updated_at`
    )
(
    SELECT
        (SELECT id FROM company_audits  where audit_id = (SELECT audit_id FROM company_audits c where id=`polls`.`company_audit_id`) and company_id=@company_id) as company_audit_id,
            `polls`.`question`,
            `polls`.`orden`,
            `polls`.`sino`,
            `polls`.`options`,
            `polls`.`option_type`,
            `polls`.`media`,
            `polls`.`comment`,
            `polls`.`comment_requiered`,
            `polls`.`comentType`,
            `polls`.`comentTag`,
            `polls`.`publicity`,
            `polls`.`categoryProduct`,
            `polls`.`product`,
            `polls`.`stockProductPop`,
            `polls`.`laboratory`,
            `polls`.`web`,
            `polls`.`identificador`,
            @created_at AS  `created_at`,
            @created_at AS  `updated_at`
    FROM
      `polls`
      LEFT OUTER JOIN `company_audits` ON (`polls`.`company_audit_id` = `company_audits`.`id`)
      LEFT OUTER JOIN `audits` ON (`company_audits`.`audit_id` = `audits`.`id`)
    WHERE
      `company_audits`.`company_id` = @previous_company_id
  );
SET @previou_pol_id_1 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 1);
SET @previou_pol_id_2 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 2);
SET @previou_pol_id_3 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 3);
SET @previou_pol_id_4 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 4);
SET @previou_pol_id_5 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 5);
SET @previou_pol_id_6 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 6);
SET @previou_pol_id_7 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 7);
SET @previou_pol_id_8 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 12);
SET @previou_pol_id_9 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 13);
SET @previou_pol_id_10 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 14);
SET @previou_pol_id_11 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 15);
SET @previou_pol_id_12 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 16);
SET @previou_pol_id_13 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 10);
SET @previou_pol_id_14 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 11);
SET @previou_pol_id_15 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 23);
SET @previou_pol_id_16 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 24);
SET @previou_pol_id_17 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 25);
SET @previou_pol_id_18 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 26);
SET @previou_pol_id_19 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 27);
SET @previou_pol_id_20 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 28);
SET @previou_pol_id_21 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 212);
SET @previou_pol_id_22 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 213);
SET @previou_pol_id_23 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @previous_company_id AND `polls`.`orden` = 214);

SET @pol_id_1 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 1);
SET @pol_id_2 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 2);
SET @pol_id_3 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 3);
SET @pol_id_4 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 4);
SET @pol_id_5 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 5);
SET @pol_id_6 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 6);
SET @pol_id_7 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 7);
SET @pol_id_8 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 12);
SET @pol_id_9 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 13);
SET @pol_id_10 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 14);
SET @pol_id_11 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 15);
SET @pol_id_12 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 16);
SET @pol_id_13 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 10);
SET @pol_id_14 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 11);
SET @pol_id_15 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 23);
SET @pol_id_16 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 24);
SET @pol_id_17 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 25);
SET @pol_id_18 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 26);
SET @pol_id_19 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 27);
SET @pol_id_20 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 28);
SET @pol_id_21 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 212);
SET @pol_id_22 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 213);
SET @pol_id_23 = (SELECT `polls`.`id` FROM `company_audits` INNER JOIN `polls` ON (`company_audits`.`id` = `polls`.`company_audit_id`) WHERE `company_audits`.`company_id` = @company_id AND `polls`.`orden` = 214);

-- ------------------------------------------------
-- INSERT IN TABLE POLL OPTIONS
-- Modificar el poll_id de la tabla poll_option
-- Modificar`polls`.`id` NOT IN (942) No inserta las opciones de este poll_id
-- -------------------------------------------------
INSERT INTO poll_options (
`poll_options`.`poll_id`,
`poll_options`.`options`,
`poll_options`.`options_abreviado`,
`poll_options`.`codigo`,
`poll_options`.`product_id`,
`poll_options`.`region`,
`poll_options`.`option_yes_no`,
`poll_options`.`comment`,
`poll_options`.`created_at`,
`poll_options`.`updated_at`
)
(SELECT
  CASE `poll_options`.poll_id
   when @previou_pol_id_1  then @pol_id_1
   when @previou_pol_id_2  then @pol_id_2
   when @previou_pol_id_3  then @pol_id_3
   when @previou_pol_id_4  then @pol_id_4
   when @previou_pol_id_5  then @pol_id_5
   when @previou_pol_id_6  then @pol_id_6
   when @previou_pol_id_7  then @pol_id_7
   when @previou_pol_id_8  then @pol_id_8
   when @previou_pol_id_9  then @pol_id_9
   when @previou_pol_id_10  then @pol_id_10
   when @previou_pol_id_11  then @pol_id_11
   when @previou_pol_id_12  then @pol_id_12
   when @previou_pol_id_13  then @pol_id_13
   when @previou_pol_id_14  then @pol_id_14
   when @previou_pol_id_15  then @pol_id_15
   when @previou_pol_id_16  then @pol_id_16
   when @previou_pol_id_17  then @pol_id_17
   when @previou_pol_id_18  then @pol_id_18
   when @previou_pol_id_19  then @pol_id_19
   when @previou_pol_id_20  then @pol_id_20
   when @previou_pol_id_21  then @pol_id_21
   when @previou_pol_id_22  then @pol_id_22
   when @previou_pol_id_23  then @pol_id_23
  END AS poll_id,
  `poll_options`.`options`,
  `poll_options`.`options_abreviado`,
  CASE poll_id
   when @previou_pol_id_1  then  CONCAT(@pol_id_1, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_2  then  CONCAT(@pol_id_2, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_3  then  CONCAT(@pol_id_3, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_4  then  CONCAT(@pol_id_4, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_5  then  CONCAT(@pol_id_5, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_6  then  CONCAT(@pol_id_6, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_7  then  CONCAT(@pol_id_7, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_8  then  CONCAT(@pol_id_8, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_9  then  CONCAT(@pol_id_9, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_10  then  CONCAT(@pol_id_10, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_11 then  CONCAT(@pol_id_11, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_12  then  CONCAT(@pol_id_12, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_13  then  CONCAT(@pol_id_13, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_14 then  CONCAT(@pol_id_14, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_15  then  CONCAT(@pol_id_15, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_16  then  CONCAT(@pol_id_16, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_17  then  CONCAT(@pol_id_17, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_18  then  CONCAT(@pol_id_18, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_19  then  CONCAT(@pol_id_19, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_20  then  CONCAT(@pol_id_20, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_21  then  CONCAT(@pol_id_21, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_22  then  CONCAT(@pol_id_22, SUBSTRING(`poll_options`.codigo, 5, 2))
   when @previou_pol_id_23  then  CONCAT(@pol_id_23, SUBSTRING(`poll_options`.codigo, 5, 2))

  END AS codigo,
  `poll_options`.`product_id`,
  `poll_options`.`region`,
  `poll_options`.`option_yes_no`,
  `poll_options`.`comment`,
  @created_at AS  `created_at`,
  @created_at AS  `updated_at`
FROM
  `poll_options`
  LEFT OUTER JOIN `polls` ON (`poll_options`.`poll_id` = `polls`.`id`)
  LEFT OUTER JOIN `company_audits` ON (`polls`.`company_audit_id` = `company_audits`.`id`)
WHERE
  `company_audits`.`company_id` = @previous_company_id
);

-- ------------------------------------------------
-- INSERT IN TABLE MARKROUTES
-- Modificar el poll_id de la tabla poll_option
-- Modificar`polls`.`id` NOT IN (942) No inserta las opciones de este poll_id
-- -------------------------------------------------

INSERT INTO markroutes (
  `markroutes`.`company_id`,
  `markroutes`.`visit_id`,
  `markroutes`.`chanel_store_id`,
`markroutes`.`mark_point`,
  `markroutes`.`created_at`,
  `markroutes`.`updated_at`)
(
SELECT
 CASE company_id
   when @previous_company_id then @company_id
  END AS company_id,
  `markroutes`.`visit_id`,
  `markroutes`.`chanel_store_id`,
`markroutes`.`mark_point`,
  @created_at AS  `created_at`,
  @created_at AS  `updated_at`
FROM
  `markroutes`
WHERE
  `markroutes`.`company_id` = @previous_company_id
);

END