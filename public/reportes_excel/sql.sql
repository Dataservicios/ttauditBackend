DELIMITER $$

DROP PROCEDURE IF EXISTS `sp_consulta_reporte_company_13` $$
CREATE DEFINER=`ttaudit_admin`@`%` PROCEDURE `sp_consulta_reporte_company_13`()
BEGIN

/* Temporal que contiene el detalle de los comercios */
	DROP TEMPORARY TABLE IF EXISTS tmp_comercios;
	CREATE TEMPORARY TABLE IF NOT EXISTS tmp_comercios ( INDEX(store_id) ) AS
	(
		select * FROM comercio_excel_company_13
	);

	/* Temporal que contiene el detalle de las respuestas tipo si/no */
	DROP TEMPORARY TABLE IF EXISTS tmp_sino;
	CREATE TEMPORARY TABLE IF NOT EXISTS tmp_sino ( INDEX(company_id, store_id, poll_id) ) AS
	(
		select * FROM respuestas_sino_company_13
        where store_id in (select store_id from tmp_comercios)
	);

/* Temporal de pregunta con opciones*/
	DROP TEMPORARY TABLE IF EXISTS tmp_opciones;
	CREATE TEMPORARY TABLE IF NOT EXISTS tmp_opciones ( INDEX(store_id, poll_id ) ) AS
	(
		select a.poll_id, a.store_id, a.respuesta, a.Foto, b.options, b.limite, b.otro, a.product_id, a.comentario,b.priority
		from tmp_sino a
		left outer join respuestas_opciones_company_13 b
		on (a.poll_id = b.poll_id and a.store_id = b.store_id)
        where a.store_id in (select store_id from tmp_comercios)
	);


    /* Temporal que contiene detalle de la pregunta 142 se encuentra abierto el establecimiento */
	DROP TEMPORARY TABLE IF EXISTS preg_142;
	CREATE TEMPORARY TABLE IF NOT EXISTS preg_142 ( INDEX(store_id ) ) AS
	(
		select * from tmp_sino where poll_id = 142 and product_id=0

	);

 /* Temporal que contiene detalle de la pregunta 107 Tiene exhibicion bayer
	DROP TEMPORARY TABLE IF EXISTS preg_107;
	CREATE TEMPORARY TABLE IF NOT EXISTS preg_107 ( INDEX(store_id ) ) AS
	(
		select * from tmp_sino where poll_id = 107 and product_id=0

	);
 */
 /* Temporal que contiene detalle de la pregunta 143 con opciones "Tiene exhibicion Bayer" */

	DROP TEMPORARY TABLE IF EXISTS preg_143;
	CREATE TEMPORARY TABLE IF NOT EXISTS preg_143 ( INDEX(store_id ) ) AS
	(
		select store_id,product_id,
		respuesta,
		sum(case when options = '143a' then 1 else 0 end) as a,
		sum(case when options = '143b' then 1 else 0 end) as b,
		sum(case when options = '143c' then 1 else 0 end) as c,
		sum(case when options = '143d' then 1 else 0 end) as d,
		sum(case when options = '143e' then 1 else 0 end) as e,
		sum(case when options = '143f' then 1 else 0 end) as f,
		sum(case when options = '143g' then 1 else 0 end) as g,
		sum(case when options = '143h' then 1 else 0 end) as h,
		sum(case when options = '143i' then 1 else 0 end) as i,
		sum(case when options = '143j' then 1 else 0 end) as j,
		sum(case when options = '143k' then 1 else 0 end) as k,
		foto,
        comentario
		from tmp_opciones
		where poll_id = 143 and product_id=0
		group by store_id, respuesta, foto,product_id, comentario
	);


 /* Temporal que contiene detalle de la pregunta 147 recibió premio */
	DROP TEMPORARY TABLE IF EXISTS preg_147;
	CREATE TEMPORARY TABLE IF NOT EXISTS preg_147 ( INDEX(store_id ) ) AS
	(
		select * from tmp_sino where poll_id = 147 and product_id=0

	);

/*------------------------------------------------*/
/* Producto apronax*/
/*------------------------------------------------*/

  /* Temporal que contiene detalle de la pregunta 144 "recomendo el producto" */
	DROP TEMPORARY TABLE IF EXISTS preg_144_534;
	CREATE TEMPORARY TABLE IF NOT EXISTS preg_144_534 ( INDEX(store_id ) ) AS
	(
		select * from tmp_sino where poll_id = 144 and  product_id=534

	);

    /* Temporal que contiene detalle de la pregunta 146 "Tiene stok"*/
	DROP TEMPORARY TABLE IF EXISTS preg_146_534;
	CREATE TEMPORARY TABLE IF NOT EXISTS preg_146_534 ( INDEX(store_id ) ) AS
	(
		select * from tmp_sino where poll_id = 146 and  product_id=534

	);


/* Temporal que contiene detalle de la pregunta 145 con opciones para Apronax producto id=534 "¿Que producto Recomendó?" para ApronaX*/
	DROP TEMPORARY TABLE IF EXISTS preg_145_534;
	CREATE TEMPORARY TABLE IF NOT EXISTS preg_145_534 ( INDEX(store_id ) ) AS
	(
		select store_id,product_id,
		respuesta,
		sum(case when options = '145a' then 1 else 0 end) as a,
		sum(case when options = '145b' then 1 else 0 end) as b,
		sum(case when options = '145c' then 1 else 0 end) as c,
		sum(case when options = '145d' then 1 else 0 end) as d,
		sum(case when options = '145e' then 1 else 0 end) as e,
		sum(case when options = '145f' then 1 else 0 end) as f,
		sum(case when options = '145g' then 1 else 0 end) as g,
		sum(case when options = '145h' then 1 else 0 end) as h,
		sum(case when options = '145i' then 1 else 0 end) as i,
		sum(case when options = '145j' then 1 else 0 end) as j,
		sum(case when options = '145k' then 1 else 0 end) as k,
		sum(case when options = '145l' then 1 else 0 end) as l,
		sum(case when options = '145m' then 1 else 0 end) as m,
		sum(case when options = '145n' then 1 else 0 end) as n,
		sum(case when options = '145o' then 1 else 0 end) as o,
		sum(case when options = '145p' then 1 else 0 end) as p,
		sum(case when options = '145q' then 1 else 0 end) as q,
		sum(case when options = '145r' then 1 else 0 end) as r,
		sum(case when options = '145s' then 1 else 0 end) as s,
		sum(case when options = '145t' then 1 else 0 end) as t,
		sum(case when options = '145u' then 1 else 0 end) as u,
		sum(case when options = '145w' then 1 else 0 end) as w,
		sum(case when options = '145x' then 1 else 0 end) as x,
		sum(case when options = '145y' then 1 else 0 end) as y,
		sum(case when options = '145z' then 1 else 0 end) as z,
		sum(case when options = '145aa' then 1 else 0 end) as aa,
		sum(case when options = '145ab' then 1 else 0 end) as ab,
		sum(case when options = '145ac' then 1 else 0 end) as ac,
		sum(case when options = '145ad' then 1 else 0 end) as ad,
		sum(case when options = '145ae' then 1 else 0 end) as ae,
		sum(case when options = '145af' then 1 else 0 end) as af,
    sum(case when options = '145ag' then 1 else 0 end) as ag,
		foto,priority
		from tmp_opciones
		where poll_id = 145 and product_id=534
		group by store_id, respuesta, foto,product_id
	);

/*------------------------------------------------*/
/* Aspirina 500*/
/*------------------------------------------------*/

  /* Temporal que contiene detalle de la pregunta id=144 para Aspirina 500 producto id=535  "recomendo el producto" */
	DROP TEMPORARY TABLE IF EXISTS preg_144_535;
	CREATE TEMPORARY TABLE IF NOT EXISTS preg_144_535 ( INDEX(store_id ) ) AS
	(
		select * from tmp_sino where poll_id = 144 and  product_id=535

	);

    /* Temporal que contiene detalle de la pregunta id=146 para  Aspirina 500 producto id=535  "Tiene stok"*/
	DROP TEMPORARY TABLE IF EXISTS preg_146_535;
	CREATE TEMPORARY TABLE IF NOT EXISTS preg_146_535 ( INDEX(store_id ) ) AS
	(
		select * from tmp_sino where poll_id = 146 and  product_id=535

	);


/* Temporal que contiene detalle de la pregunta id=145 con opciones para Aspirina 500 producto id=535 "¿Que producto Recomendó?" para ApronaX*/
	DROP TEMPORARY TABLE IF EXISTS preg_145_535;
	CREATE TEMPORARY TABLE IF NOT EXISTS preg_145_535 ( INDEX(store_id ) ) AS
	(
		select store_id,product_id,
		respuesta,
		sum(case when options = '145a' then 1 else 0 end) as a,
		sum(case when options = '145b' then 1 else 0 end) as b,
		sum(case when options = '145c' then 1 else 0 end) as c,
		sum(case when options = '145d' then 1 else 0 end) as d,
		sum(case when options = '145e' then 1 else 0 end) as e,
		sum(case when options = '145f' then 1 else 0 end) as f,
		sum(case when options = '145g' then 1 else 0 end) as g,
		sum(case when options = '145h' then 1 else 0 end) as h,
		sum(case when options = '145i' then 1 else 0 end) as i,
		sum(case when options = '145j' then 1 else 0 end) as j,
		sum(case when options = '145k' then 1 else 0 end) as k,
		sum(case when options = '145l' then 1 else 0 end) as l,
		sum(case when options = '145m' then 1 else 0 end) as m,
		sum(case when options = '145n' then 1 else 0 end) as n,
		sum(case when options = '145o' then 1 else 0 end) as o,
		sum(case when options = '145p' then 1 else 0 end) as p,
		sum(case when options = '145q' then 1 else 0 end) as q,
		sum(case when options = '145r' then 1 else 0 end) as r,
		sum(case when options = '145s' then 1 else 0 end) as s,
		sum(case when options = '145t' then 1 else 0 end) as t,
		sum(case when options = '145u' then 1 else 0 end) as u,
		sum(case when options = '145w' then 1 else 0 end) as w,
		sum(case when options = '145x' then 1 else 0 end) as x,
		sum(case when options = '145y' then 1 else 0 end) as y,
		sum(case when options = '145z' then 1 else 0 end) as z,
		sum(case when options = '145aa' then 1 else 0 end) as aa,
		sum(case when options = '145ab' then 1 else 0 end) as ab,
		sum(case when options = '145ac' then 1 else 0 end) as ac,
		sum(case when options = '145ad' then 1 else 0 end) as ad,
		sum(case when options = '145ae' then 1 else 0 end) as ae,
		sum(case when options = '145af' then 1 else 0 end) as af,
    sum(case when options = '145ag' then 1 else 0 end) as ag,
		foto,priority
		from tmp_opciones
		where poll_id = 145 and product_id=535
		group by store_id, respuesta, foto,product_id
	);



/*------------------------------------------------*/
/* Supradyn*/
/*------------------------------------------------*/

  /* Temporal que contiene detalle de la pregunta id=144 para Supradyn producto id=536  "recomendo el producto" */
	DROP TEMPORARY TABLE IF EXISTS preg_144_536;
	CREATE TEMPORARY TABLE IF NOT EXISTS preg_144_536 ( INDEX(store_id ) ) AS
	(
		select * from tmp_sino where poll_id = 144 and  product_id=536

	);

    /* Temporal que contiene detalle de la pregunta id=146 para  Supradyn producto id=536  "Tiene stok"*/
	DROP TEMPORARY TABLE IF EXISTS preg_146_536;
	CREATE TEMPORARY TABLE IF NOT EXISTS preg_146_536 ( INDEX(store_id ) ) AS
	(
		select * from tmp_sino where poll_id = 146 and  product_id=536

	);


/* Temporal que contiene detalle de la pregunta id=145 con opciones para Supradyn producto id=536 "¿Que producto Recomendó?" para ApronaX*/
	DROP TEMPORARY TABLE IF EXISTS preg_145_536;
	CREATE TEMPORARY TABLE IF NOT EXISTS preg_145_536 ( INDEX(store_id ) ) AS
	(
		select store_id,product_id,
		respuesta,
		sum(case when options = '145a' then 1 else 0 end) as a,
		sum(case when options = '145b' then 1 else 0 end) as b,
		sum(case when options = '145c' then 1 else 0 end) as c,
		sum(case when options = '145d' then 1 else 0 end) as d,
		sum(case when options = '145e' then 1 else 0 end) as e,
		sum(case when options = '145f' then 1 else 0 end) as f,
		sum(case when options = '145g' then 1 else 0 end) as g,
		sum(case when options = '145h' then 1 else 0 end) as h,
		sum(case when options = '145i' then 1 else 0 end) as i,
		sum(case when options = '145j' then 1 else 0 end) as j,
		sum(case when options = '145k' then 1 else 0 end) as k,
		sum(case when options = '145l' then 1 else 0 end) as l,
		sum(case when options = '145m' then 1 else 0 end) as m,
		sum(case when options = '145n' then 1 else 0 end) as n,
		sum(case when options = '145o' then 1 else 0 end) as o,
		sum(case when options = '145p' then 1 else 0 end) as p,
		sum(case when options = '145q' then 1 else 0 end) as q,
		sum(case when options = '145r' then 1 else 0 end) as r,
		sum(case when options = '145s' then 1 else 0 end) as s,
		sum(case when options = '145t' then 1 else 0 end) as t,
		sum(case when options = '145u' then 1 else 0 end) as u,
		sum(case when options = '145w' then 1 else 0 end) as w,
		sum(case when options = '145x' then 1 else 0 end) as x,
		sum(case when options = '145y' then 1 else 0 end) as y,
		sum(case when options = '145z' then 1 else 0 end) as z,
		sum(case when options = '145aa' then 1 else 0 end) as aa,
		sum(case when options = '145ab' then 1 else 0 end) as ab,
		sum(case when options = '145ac' then 1 else 0 end) as ac,
		sum(case when options = '145ad' then 1 else 0 end) as ad,
		sum(case when options = '145ae' then 1 else 0 end) as ae,
		sum(case when options = '145af' then 1 else 0 end) as af,
    sum(case when options = '145ag' then 1 else 0 end) as ag,
		foto,priority
		from tmp_opciones
		where poll_id = 145 and product_id=536
		group by store_id, respuesta, foto,product_id
	);


/*------------------------------------------------*/
/* Gynocanesten*/
/*------------------------------------------------*/

  /* Temporal que contiene detalle de la pregunta id=144 para Gynocanesten producto id=537  "recomendo el producto" */
	DROP TEMPORARY TABLE IF EXISTS preg_144_537;
	CREATE TEMPORARY TABLE IF NOT EXISTS preg_144_537 ( INDEX(store_id ) ) AS
	(
		select * from tmp_sino where poll_id = 144 and  product_id=537

	);

   /* Temporal que contiene detalle de la pregunta id=146 para  Gynocanesten producto id=537  "Tiene stok"*/
	DROP TEMPORARY TABLE IF EXISTS preg_146_537;
	CREATE TEMPORARY TABLE IF NOT EXISTS preg_146_537 ( INDEX(store_id ) ) AS
	(
		select * from tmp_sino where poll_id = 146 and  product_id=537

	);


/* Temporal que contiene detalle de la pregunta id=145 con opciones para Gynocanesten producto id=537 "¿Que producto Recomendó?" para ApronaX*/
	DROP TEMPORARY TABLE IF EXISTS preg_145_537;
	CREATE TEMPORARY TABLE IF NOT EXISTS preg_145_537 ( INDEX(store_id ) ) AS
	(
		select store_id,product_id,
		respuesta,
		sum(case when options = '145a' then 1 else 0 end) as a,
		sum(case when options = '145b' then 1 else 0 end) as b,
		sum(case when options = '145c' then 1 else 0 end) as c,
		sum(case when options = '145d' then 1 else 0 end) as d,
		sum(case when options = '145e' then 1 else 0 end) as e,
		sum(case when options = '145f' then 1 else 0 end) as f,
		sum(case when options = '145g' then 1 else 0 end) as g,
		sum(case when options = '145h' then 1 else 0 end) as h,
		sum(case when options = '145i' then 1 else 0 end) as i,
		sum(case when options = '145j' then 1 else 0 end) as j,
		sum(case when options = '145k' then 1 else 0 end) as k,
		sum(case when options = '145l' then 1 else 0 end) as l,
		sum(case when options = '145m' then 1 else 0 end) as m,
		sum(case when options = '145n' then 1 else 0 end) as n,
		sum(case when options = '145o' then 1 else 0 end) as o,
		sum(case when options = '145p' then 1 else 0 end) as p,
		sum(case when options = '145q' then 1 else 0 end) as q,
		sum(case when options = '145r' then 1 else 0 end) as r,
		sum(case when options = '145s' then 1 else 0 end) as s,
		sum(case when options = '145t' then 1 else 0 end) as t,
		sum(case when options = '145u' then 1 else 0 end) as u,
		sum(case when options = '145w' then 1 else 0 end) as w,
		sum(case when options = '145x' then 1 else 0 end) as x,
		sum(case when options = '145y' then 1 else 0 end) as y,
		sum(case when options = '145z' then 1 else 0 end) as z,
		sum(case when options = '145aa' then 1 else 0 end) as aa,
		sum(case when options = '145ab' then 1 else 0 end) as ab,
		sum(case when options = '145ac' then 1 else 0 end) as ac,
		sum(case when options = '145ad' then 1 else 0 end) as ad,
		sum(case when options = '145ae' then 1 else 0 end) as ae,
		sum(case when options = '145af' then 1 else 0 end) as af,
    sum(case when options = '145ag' then 1 else 0 end) as ag,
		foto,priority
		from tmp_opciones
		where poll_id = 145 and product_id=537
		group by store_id, respuesta, foto,product_id
	);





/*------------------------------------------------*/
/* Tienda Premiada*/
/*------------------------------------------------*/

	DROP TEMPORARY TABLE IF EXISTS store_premiado;
	CREATE TEMPORARY TABLE IF NOT EXISTS store_premiado ( INDEX(store_id ) ) AS
	(
		SELECT  `s`.`store_id`,  count(`s`.`store_id`) AS `Premiado` 
        FROM  `scores` `s` 
        WHERE  `s`.`company_id` = 13
        GROUP BY `s`.`store_id`

	);


/* Tienda Premiada Foto*/
/*------------------------------------------------*/

	DROP TEMPORARY TABLE IF EXISTS store_premiado_foto;
	CREATE TEMPORARY TABLE IF NOT EXISTS store_premiado_foto ( INDEX(store_id ) ) AS
	(
		SELECT  `s`.`store_id`,
        max(concat('http://ttaudit.com/media/fotos/', `m`.`archivo`)) AS `Foto`
		FROM  `medias` `m`
		RIGHT OUTER JOIN `scores` `s` ON (`m`.`store_id` = `s`.`store_id` and m.company_id = s.company_id)
		WHERE
		  `s`.`company_id` = 13 AND
		  `m`.`poll_id` = 147 AND
		  `m`.`product_id` = 0
		GROUP BY
		s.store_id
	);

/*-----------------------------------------------------------*/
/*------------- End creation table temprary-----------------*/
/*-----------------------------------------------------------*/

  select
	tmp_comercios.store_id,
	tmp_comercios.type,
	tmp_comercios.cadenaRuc,
	tmp_comercios.fullname,
	tmp_comercios.address,
	tmp_comercios.district,
	tmp_comercios.region,
	tmp_comercios.ubigeo,
	tmp_comercios.latitude,
	tmp_comercios.longitude,
	tmp_comercios.Auditor,
	tmp_comercios.fecha,
	tmp_comercios.hora,
	(case when preg_142.Respuesta > 0 then 2 else preg_142.Respuesta end) as '142_Respuesta',
	preg_142.Comentario as '142_Comentario',
	preg_142.Foto as '142_Foto',

	(case when preg_147.Respuesta > 0 then 2 else preg_147.Respuesta end) as '147_Respuesta',

	(case when preg_143.respuesta > 0 then 2 else preg_143.respuesta end) as '143_Respuesta',
    preg_143.comentario as '143_Comentario',
	(case when preg_143.a > 0 then 2 else preg_143.a end) as '143_a',
	(case when preg_143.b > 0 then 2 else preg_143.b end) as '143_b',
	(case when preg_143.c > 0 then 2 else preg_143.c end) as '143_c',
	(case when preg_143.d > 0 then 2 else preg_143.d end) as '143_d',
	(case when preg_143.e > 0 then 2 else preg_143.e end) as '143_e',
	(case when preg_143.f > 0 then 2 else preg_143.f end) as '143_f',
	(case when preg_143.g > 0 then 2 else preg_143.g end) as '143_g',
	(case when preg_143.h > 0 then 2 else preg_143.h end) as '143_h',
	(case when preg_143.i > 0 then 2 else preg_143.i end) as '143_i',
	(case when preg_143.j > 0 then 2 else preg_143.j end) as '143_j',
	(case when preg_143.k > 0 then 2 else preg_143.k end) as '143_k',
	preg_143.Foto as '143_Foto',

/*------------------------------------------------*/
/* Apronax id=534*/
/*------------------------------------------------*/

	(case when preg_144_534.Respuesta > 0 then 2 else preg_144_534.Respuesta end) as '144_534_Respuesta',
	preg_144_534.comentario as '144_534_comentario',
    (case when preg_146_534.Respuesta > 0 then 2 else preg_146_534.Respuesta end) as '146_534_Respuesta',
	preg_146_534.comentario as '146_534_comentario',
    (case when preg_145_534.respuesta > 0 then 2 else preg_145_534.respuesta end) as '145_534_Respuesta',
	(case when preg_145_534.a > 0 then 2 else preg_145_534.a end) as '145_534_a',
	(case when preg_145_534.b > 0 then 2 else preg_145_534.b end) as '145_534_b',
	(case when preg_145_534.c > 0 then 2 else preg_145_534.c end) as '145_534_c',
	(case when preg_145_534.d > 0 then 2 else preg_145_534.d end) as '145_534_d',
	(case when preg_145_534.e > 0 then 2 else preg_145_534.e end) as '145_534_e',
	(case when preg_145_534.f > 0 then 2 else preg_145_534.f end) as '145_534_f',
	(case when preg_145_534.g > 0 then 2 else preg_145_534.g end) as '145_534_g',
	(case when preg_145_534.h > 0 then 2 else preg_145_534.h end) as '145_534_h',
	(case when preg_145_534.i > 0 then 2 else preg_145_534.i end) as '145_534_i',
	(case when preg_145_534.j > 0 then 2 else preg_145_534.j end) as '145_534_j',
	(case when preg_145_534.k > 0 then 2 else preg_145_534.k end) as '145_534_k',
	(case when preg_145_534.l > 0 then 2 else preg_145_534.l end) as '145_534_l',
	(case when preg_145_534.m > 0 then 2 else preg_145_534.m end) as '145_534_m',
	(case when preg_145_534.n > 0 then 2 else preg_145_534.n end) as '145_534_n',
	(case when preg_145_534.o > 0 then 2 else preg_145_534.o end) as '145_534_o',
	(case when preg_145_534.p > 0 then 2 else preg_145_534.p end) as '145_534_p',
	(case when preg_145_534.q > 0 then 2 else preg_145_534.q end) as '145_534_q',
	(case when preg_145_534.r > 0 then 2 else preg_145_534.r end) as '145_534_r',
	(case when preg_145_534.s > 0 then 2 else preg_145_534.s end) as '145_534_s',
	(case when preg_145_534.t > 0 then 2 else preg_145_534.t end) as '145_534_t',
	(case when preg_145_534.u > 0 then 2 else preg_145_534.u end) as '145_534_u',
	(case when preg_145_534.w > 0 then 2 else preg_145_534.w end) as '145_534_w',
	(case when preg_145_534.x > 0 then 2 else preg_145_534.x end) as '145_534_x',
	(case when preg_145_534.y > 0 then 2 else preg_145_534.y end) as '145_534_y',
	(case when preg_145_534.z > 0 then 2 else preg_145_534.z end) as '145_534_z',
	(case when preg_145_534.aa > 0 then 2 else preg_145_534.aa end) as '145_534_aa',
	(case when preg_145_534.ab > 0 then 2 else preg_145_534.ab end) as '145_534_ab',
	(case when preg_145_534.ac > 0 then 2 else preg_145_534.ac end) as '145_534_ac',
	(case when preg_145_534.ad > 0 then 2 else preg_145_534.ad end) as '145_534_ad',
	(case when preg_145_534.ae > 0 then 2 else preg_145_534.ae end) as '145_534_ae',
	(case when preg_145_534.af > 0 then 2 else preg_145_534.af end) as '145_534_af',
  (case when preg_145_534.ag > 0 then 2 else preg_145_534.ag end) as '145_534_ag',
	preg_145_534.Foto as '145_534_Foto',
  preg_145_534.priority as '145_534_priority',

/*------------------------------------------------*/
/* Aspirina 500 id=535*/
/*------------------------------------------------*/

	(case when preg_144_535.Respuesta > 0 then 2 else preg_144_535.Respuesta end) as '144_535_Respuesta',
preg_144_535.comentario as '144_535_comentario',
(case when preg_146_535.Respuesta > 0 then 2 else preg_146_535.Respuesta end) as '146_535_Respuesta',
preg_146_535.comentario as '146_535_comentario',
(case when preg_145_535.respuesta > 0 then 2 else preg_145_535.respuesta end) as '145_535_Respuesta',
(case when preg_145_535.a > 0 then 2 else preg_145_535.a end) as '145_535_a',
(case when preg_145_535.b > 0 then 2 else preg_145_535.b end) as '145_535_b',
(case when preg_145_535.c > 0 then 2 else preg_145_535.c end) as '145_535_c',
(case when preg_145_535.d > 0 then 2 else preg_145_535.d end) as '145_535_d',
(case when preg_145_535.e > 0 then 2 else preg_145_535.e end) as '145_535_e',
(case when preg_145_535.f > 0 then 2 else preg_145_535.f end) as '145_535_f',
(case when preg_145_535.g > 0 then 2 else preg_145_535.g end) as '145_535_g',
(case when preg_145_535.h > 0 then 2 else preg_145_535.h end) as '145_535_h',
(case when preg_145_535.i > 0 then 2 else preg_145_535.i end) as '145_535_i',
(case when preg_145_535.j > 0 then 2 else preg_145_535.j end) as '145_535_j',
(case when preg_145_535.k > 0 then 2 else preg_145_535.k end) as '145_535_k',
(case when preg_145_535.l > 0 then 2 else preg_145_535.l end) as '145_535_l',
(case when preg_145_535.m > 0 then 2 else preg_145_535.m end) as '145_535_m',
(case when preg_145_535.n > 0 then 2 else preg_145_535.n end) as '145_535_n',
(case when preg_145_535.o > 0 then 2 else preg_145_535.o end) as '145_535_o',
(case when preg_145_535.p > 0 then 2 else preg_145_535.p end) as '145_535_p',
(case when preg_145_535.q > 0 then 2 else preg_145_535.q end) as '145_535_q',
(case when preg_145_535.r > 0 then 2 else preg_145_535.r end) as '145_535_r',
(case when preg_145_535.s > 0 then 2 else preg_145_535.s end) as '145_535_s',
(case when preg_145_535.t > 0 then 2 else preg_145_535.t end) as '145_535_t',
(case when preg_145_535.u > 0 then 2 else preg_145_535.u end) as '145_535_u',
(case when preg_145_535.w > 0 then 2 else preg_145_535.w end) as '145_535_w',
(case when preg_145_535.x > 0 then 2 else preg_145_535.x end) as '145_535_x',
(case when preg_145_535.y > 0 then 2 else preg_145_535.y end) as '145_535_y',
(case when preg_145_535.z > 0 then 2 else preg_145_535.z end) as '145_535_z',
(case when preg_145_535.aa > 0 then 2 else preg_145_535.aa end) as '145_535_aa',
(case when preg_145_535.ab > 0 then 2 else preg_145_535.ab end) as '145_535_ab',
(case when preg_145_535.ac > 0 then 2 else preg_145_535.ac end) as '145_535_ac',
(case when preg_145_535.ad > 0 then 2 else preg_145_535.ad end) as '145_535_ad',
(case when preg_145_535.ae > 0 then 2 else preg_145_535.ae end) as '145_535_ae',
(case when preg_145_535.af > 0 then 2 else preg_145_535.af end) as '145_535_af',
(case when preg_145_535.ag > 0 then 2 else preg_145_535.ag end) as '145_535_ag',
preg_145_535.Foto as '145_535_Foto',
preg_145_535.priority as '145_535_priority',

/*------------------------------------------------*/
/* Supradyn id=536*/
/*------------------------------------------------*/

	(case when preg_144_536.Respuesta > 0 then 2 else preg_144_536.Respuesta end) as '144_536_Respuesta',
preg_144_536.comentario as '144_536_comentario',
(case when preg_146_536.Respuesta > 0 then 2 else preg_146_536.Respuesta end) as '146_536_Respuesta',
preg_146_536.comentario as '146_539_comentario',
(case when preg_145_536.respuesta > 0 then 2 else preg_145_536.respuesta end) as '145_536_Respuesta',
(case when preg_145_536.a > 0 then 2 else preg_145_536.a end) as '145_536_a',
(case when preg_145_536.b > 0 then 2 else preg_145_536.b end) as '145_536_b',
(case when preg_145_536.c > 0 then 2 else preg_145_536.c end) as '145_536_c',
(case when preg_145_536.d > 0 then 2 else preg_145_536.d end) as '145_536_d',
(case when preg_145_536.e > 0 then 2 else preg_145_536.e end) as '145_536_e',
(case when preg_145_536.f > 0 then 2 else preg_145_536.f end) as '145_536_f',
(case when preg_145_536.g > 0 then 2 else preg_145_536.g end) as '145_536_g',
(case when preg_145_536.h > 0 then 2 else preg_145_536.h end) as '145_536_h',
(case when preg_145_536.i > 0 then 2 else preg_145_536.i end) as '145_536_i',
(case when preg_145_536.j > 0 then 2 else preg_145_536.j end) as '145_536_j',
(case when preg_145_536.k > 0 then 2 else preg_145_536.k end) as '145_536_k',
(case when preg_145_536.l > 0 then 2 else preg_145_536.l end) as '145_536_l',
(case when preg_145_536.m > 0 then 2 else preg_145_536.m end) as '145_536_m',
(case when preg_145_536.n > 0 then 2 else preg_145_536.n end) as '145_536_n',
(case when preg_145_536.o > 0 then 2 else preg_145_536.o end) as '145_536_o',
(case when preg_145_536.p > 0 then 2 else preg_145_536.p end) as '145_536_p',
(case when preg_145_536.q > 0 then 2 else preg_145_536.q end) as '145_536_q',
(case when preg_145_536.r > 0 then 2 else preg_145_536.r end) as '145_536_r',
(case when preg_145_536.s > 0 then 2 else preg_145_536.s end) as '145_536_s',
(case when preg_145_536.t > 0 then 2 else preg_145_536.t end) as '145_536_t',
(case when preg_145_536.u > 0 then 2 else preg_145_536.u end) as '145_536_u',
(case when preg_145_536.w > 0 then 2 else preg_145_536.w end) as '145_536_w',
(case when preg_145_536.x > 0 then 2 else preg_145_536.x end) as '145_536_x',
(case when preg_145_536.y > 0 then 2 else preg_145_536.y end) as '145_536_y',
(case when preg_145_536.z > 0 then 2 else preg_145_536.z end) as '145_536_z',
(case when preg_145_536.aa > 0 then 2 else preg_145_536.aa end) as '145_536_aa',
(case when preg_145_536.ab > 0 then 2 else preg_145_536.ab end) as '145_536_ab',
(case when preg_145_536.ac > 0 then 2 else preg_145_536.ac end) as '145_536_ac',
(case when preg_145_536.ad > 0 then 2 else preg_145_536.ad end) as '145_536_ad',
(case when preg_145_536.ae > 0 then 2 else preg_145_536.ae end) as '145_536_ae',
(case when preg_145_536.af > 0 then 2 else preg_145_536.af end) as '145_536_af',
(case when preg_145_536.ag > 0 then 2 else preg_145_536.ag end) as '145_536_ag',
preg_145_536.Foto as '145_536_Foto',
preg_145_536.priority as '145_536_priority',

/*------------------------------------------------*/
/* Gynocanesten id=537*/
/*------------------------------------------------*/
	(case when preg_144_537.Respuesta > 0 then 2 else preg_144_537.Respuesta end) as '144_537_Respuesta',
	preg_144_537.comentario as '144_537_comentario',
	(case when preg_146_537.Respuesta > 0 then 2 else preg_146_537.Respuesta end) as '146_537_Respuesta',
	preg_146_537.comentario as '146_537_comentario',
	(case when preg_145_537.respuesta > 0 then 2 else preg_145_537.respuesta end) as '145_537_Respuesta',
(case when preg_145_537.a > 0 then 2 else preg_145_537.a end) as '145_537_a',
(case when preg_145_537.b > 0 then 2 else preg_145_537.b end) as '145_537_b',
(case when preg_145_537.c > 0 then 2 else preg_145_537.c end) as '145_537_c',
(case when preg_145_537.d > 0 then 2 else preg_145_537.d end) as '145_537_d',
(case when preg_145_537.e > 0 then 2 else preg_145_537.e end) as '145_537_e',
(case when preg_145_537.f > 0 then 2 else preg_145_537.f end) as '145_537_f',
(case when preg_145_537.g > 0 then 2 else preg_145_537.g end) as '145_537_g',
(case when preg_145_537.h > 0 then 2 else preg_145_537.h end) as '145_537_h',
(case when preg_145_537.i > 0 then 2 else preg_145_537.i end) as '145_537_i',
(case when preg_145_537.j > 0 then 2 else preg_145_537.j end) as '145_537_j',
(case when preg_145_537.k > 0 then 2 else preg_145_537.k end) as '145_537_k',
(case when preg_145_537.l > 0 then 2 else preg_145_537.l end) as '145_537_l',
(case when preg_145_537.m > 0 then 2 else preg_145_537.m end) as '145_537_m',
(case when preg_145_537.n > 0 then 2 else preg_145_537.n end) as '145_537_n',
(case when preg_145_537.o > 0 then 2 else preg_145_537.o end) as '145_537_o',
(case when preg_145_537.p > 0 then 2 else preg_145_537.p end) as '145_537_p',
(case when preg_145_537.q > 0 then 2 else preg_145_537.q end) as '145_537_q',
(case when preg_145_537.r > 0 then 2 else preg_145_537.r end) as '145_537_r',
(case when preg_145_537.s > 0 then 2 else preg_145_537.s end) as '145_537_s',
(case when preg_145_537.t > 0 then 2 else preg_145_537.t end) as '145_537_t',
(case when preg_145_537.u > 0 then 2 else preg_145_537.u end) as '145_537_u',
(case when preg_145_537.w > 0 then 2 else preg_145_537.w end) as '145_537_w',
(case when preg_145_537.x > 0 then 2 else preg_145_537.x end) as '145_537_x',
(case when preg_145_537.y > 0 then 2 else preg_145_537.y end) as '145_537_y',
(case when preg_145_537.z > 0 then 2 else preg_145_537.z end) as '145_537_z',
(case when preg_145_537.aa > 0 then 2 else preg_145_537.aa end) as '145_537_aa',
(case when preg_145_537.ab > 0 then 2 else preg_145_537.ab end) as '145_537_ab',
(case when preg_145_537.ac > 0 then 2 else preg_145_537.ac end) as '145_537_ac',
(case when preg_145_537.ad > 0 then 2 else preg_145_537.ad end) as '145_537_ad',
(case when preg_145_537.ae > 0 then 2 else preg_145_537.ae end) as '145_537_ae',
(case when preg_145_537.af > 0 then 2 else preg_145_537.af end) as '145_537_af',
(case when preg_145_537.ag > 0 then 2 else preg_145_537.ag end) as '145_537_ag',
preg_145_537.Foto as '145_537_Foto',preg_145_537.priority as '145_537_priority',
	(case when store_premiado.Premiado > 0 then 2 else 0 end) as 'store_premiado',
	store_premiado_foto.Foto as 'Foto_premiado'
	from tmp_comercios
	left outer join preg_142 on (tmp_comercios.store_id = preg_142.store_id )
	left outer join preg_143 on (tmp_comercios.store_id = preg_143.store_id )
	left outer join preg_147 on (tmp_comercios.store_id = preg_147.store_id )
	left outer join preg_144_534 on (tmp_comercios.store_id = preg_144_534.store_id )
	left outer join preg_146_534 on (tmp_comercios.store_id = preg_146_534.store_id )
	left outer join preg_145_534 on (tmp_comercios.store_id = preg_145_534.store_id )
	left outer join preg_144_535 on (tmp_comercios.store_id = preg_144_535.store_id )
	left outer join preg_146_535 on (tmp_comercios.store_id = preg_146_535.store_id )
	left outer join preg_145_535 on (tmp_comercios.store_id = preg_145_535.store_id )
	left outer join preg_144_536 on (tmp_comercios.store_id = preg_144_536.store_id )
	left outer join preg_146_536 on (tmp_comercios.store_id = preg_146_536.store_id )
	left outer join preg_145_536 on (tmp_comercios.store_id = preg_145_536.store_id )
	left outer join preg_144_537 on (tmp_comercios.store_id = preg_144_537.store_id )
	left outer join preg_146_537 on (tmp_comercios.store_id = preg_146_537.store_id )
	left outer join preg_145_537 on (tmp_comercios.store_id = preg_145_537.store_id )
	left outer join store_premiado on (tmp_comercios.store_id = store_premiado.store_id )
	left outer join store_premiado_foto on (tmp_comercios.store_id = store_premiado_foto.store_id )
	ORDER BY tmp_comercios.fecha Desc, tmp_comercios.hora DESC;

END $$

DELIMITER ;