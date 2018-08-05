<?php
//***************************************************************
//Proyecto CoopIpemec desarrollado por Dataservicios
//Programador: Jaime Eduardo Cribillero Diaz
//Fecha: 10/08/06
//***************************************************************
//Detecta y Actualiza los Usuarios que estan en linea
//Para utilizar esta funcion debe inicalizar sesiones y tener la tabla web_cliente_online
  function func_clientes_online() {
    global $conexion_db;
   // global $idcliente;
	$wo_sesion_id = session_id();
	$wo_direccion_ip = $_SERVER['REMOTE_ADDR'];
    $wo_url_actual = $_SERVER['REQUEST_URI'];
	$wo_navegador=$_SERVER['HTTP_USER_AGENT'];
	$tiempo_transcurrido = time();
    $xx_mins_ago = ($tiempo_transcurrido - 360);//$tiempo_transcurrido= Tiempo actual , - tiempo restante en segundos 

    if ( isset($_SESSION['idcliente'])) {
		    $wo_idcliente = $_SESSION['idcliente'];
			//echo $_SESSION['idcliente']."----".$_SESSION['iddetalle'];
			//$wo_iddetalle = $_SESSION['iddetalle'];
			//corregir, no tiene inicio de sesion
			//Solo cuando inician sesion como usuarios registrados
		  	$sql_cliente="SELECT nombre, paterno, materno FROM cliente  where idcliente = '" . (int)$_SESSION['idcliente'] . "'";
		  	$cliente_query = mysql_query($sql_cliente,$conexion_db) or db_out_error($sql_cliente, mysql_errno(),mysql_error());
		  	$clientes = mysql_fetch_array($cliente_query);
		  	$wo_full_nombre = $clientes['nombre'] . ' ' . $clientes['paterno']. ' ' .$clientes['materno'];
		  
		  	$delete_cliente_online="delete from cliente_online where tiempo_accion_click < '" . $xx_mins_ago . "'";
			mysql_query($delete_cliente_online,$conexion_db) or db_out_error($delete_cliente_online, mysql_errno(),mysql_error());
		
			$sql_count="select count(*) as count from cliente_online where idsesion = '" . addslashes($wo_sesion_id) . "'";
			$stored_customer_query = mysql_query($sql_count,$conexion_db) or db_out_error($sql_count, mysql_errno(),mysql_error());
			$stored_customer = mysql_fetch_array($stored_customer_query);
		
			if ($stored_customer['count'] > 0) {
					//Actualiza los clientes en linea
					$sql_cliente_online="update cliente_online set idcliente = '" . $wo_idcliente . "', nombre_completo = '" . addslashes($wo_full_nombre) . "',  ip = '" . addslashes($wo_direccion_ip) . "', tiempo_accion_click = '" . addslashes($tiempo_transcurrido) . "', url_actual = '" . addslashes($wo_url_actual) . "', navegador = '" . addslashes($wo_navegador)  ."',  hora_salida=TIME_FORMAT(now(), '%T') where idsesion = '" . addslashes($wo_sesion_id) . "'";
					mysql_query($sql_cliente_online,$conexion_db) or db_out_error($sql_cliente_online, mysql_errno(),mysql_error());
					//Actualiza historial de invitados en linea
					//$sql_historial_invitados_online="update historico_invitados_web set nombre='invitado' ,  direccion_ip = '" . addslashes($wo_direccion_ip) . "',  url = '" . addslashes($wo_url_actual) . "', navegador = '" . addslashes($wo_navegador)  ."' , fecha_ingreso=now(), hora_ingreso = TIME_FORMAT( now() ,'%T'  ) where id_sesion = '" . addslashes($wo_sesion_id) . "'"; 
					//mysql_query($sql_historial_invitados_online,$conexion_db) or db_out_error($sql_historial_invitados_online, mysql_errno(),mysql_error());
			} else {
					//Inserta nuevo usuario en linea
					//echo $wo_iddetalle ;
					$sql_cliente_online="insert into cliente_online (idcliente, nombre_completo, idsesion, ip, tiempo_entrada, tiempo_accion_click, url_actual, navegador, fecha_ingreso, hora_ingreso, hora_salida) values ('" . $wo_idcliente . "', '" . addslashes($wo_full_nombre) . "', '" . addslashes($wo_sesion_id) . "', '" . addslashes($wo_direccion_ip) . "', '" . addslashes($tiempo_transcurrido) . "', '" . addslashes($tiempo_transcurrido) . "', '" . addslashes($wo_url_actual) . "' , '" .addslashes($wo_navegador). "',DATE_FORMAT(NOW(), '%Y-%m-%d') ,TIME_FORMAT(now(), '%T') ,TIME_FORMAT(now(), '%T'))";
					mysql_query($sql_cliente_online,$conexion_db) or db_out_error($sql_cliente_online, mysql_errno(),mysql_error());
					//Inserta nuevo registro de historial de usuarios en linea
					//mysql_query("insert into historico_invitados_web (nombre, id_sesion, direccion_ip,  url, navegador, fecha_ingreso, hora_ingreso) values ('invitado' ,  '" . addslashes($wo_sesion_id) . "', '" . addslashes($wo_direccion_ip) . "',  '" . addslashes($wo_url_actual) . "' , '" .addslashes($wo_navegador). "' , now() , TIME_FORMAT(now(), '%T') )",$conexion_db) or db_out_error('ERROR historico_invitados_web', mysql_errno(),mysql_error());
			}
    } else {
		  	//$wo_idcliente = NULL;
		  	$wo_full_nombre = 'invitado';
		  	$delete_cliente_online="delete from cliente_online where tiempo_accion_click < '" . $xx_mins_ago . "'";
			mysql_query($delete_cliente_online,$conexion_db) or db_out_error($delete_cliente_online, mysql_errno(),mysql_error());
		
			$sql_count="select count(*) as count from cliente_online where idsesion = '" . addslashes($wo_sesion_id) . "'";
			$stored_customer_query = mysql_query($sql_count,$conexion_db) or db_out_error($sql_count, mysql_errno(),mysql_error());
			$stored_customer = mysql_fetch_array($stored_customer_query);
		
			if ($stored_customer['count'] > 0) {
					//Actualiza los clientes en linea
					$sql_cliente_online="update cliente_online set idcliente = null, nombre_completo = '" . addslashes($wo_full_nombre) . "', ip = '" . addslashes($wo_direccion_ip) . "', tiempo_accion_click = '" . addslashes($tiempo_transcurrido) . "', url_actual = '" . addslashes($wo_url_actual) . "', navegador = '" . addslashes($wo_navegador)  ."',  hora_salida=TIME_FORMAT(now(), '%T') where idsesion = '" . addslashes($wo_sesion_id) . "'";
					mysql_query($sql_cliente_online,$conexion_db) or db_out_error($sql_cliente_online, mysql_errno(),mysql_error());
					//Actualiza historial de invitados en linea
					//$sql_historial_invitados_online="update historico_invitados_web set nombre='invitado' ,  direccion_ip = '" . addslashes($wo_direccion_ip) . "',  url = '" . addslashes($wo_url_actual) . "', navegador = '" . addslashes($wo_navegador)  ."' , fecha_ingreso=now(), hora_ingreso = TIME_FORMAT( now() ,'%T'  ) where id_sesion = '" . addslashes($wo_sesion_id) . "'"; 
					//mysql_query($sql_historial_invitados_online,$conexion_db) or db_out_error($sql_historial_invitados_online, mysql_errno(),mysql_error());
			} else {
					//Inserta nuevo usuario en linea
					//echo $wo_iddetalle ;
					$sql_cliente_online="insert into cliente_online (idcliente, nombre_completo, idsesion, ip, tiempo_entrada, tiempo_accion_click, url_actual, navegador, fecha_ingreso, hora_ingreso, hora_salida) values (null, '" . addslashes($wo_full_nombre) . "', '" . addslashes($wo_sesion_id) . "', '" . addslashes($wo_direccion_ip) . "', '" . addslashes($tiempo_transcurrido) . "', '" . addslashes($tiempo_transcurrido) . "', '" . addslashes($wo_url_actual) . "' , '" .addslashes($wo_navegador). "',DATE_FORMAT(NOW(), '%Y-%m-%d') ,TIME_FORMAT(now(), '%T') ,TIME_FORMAT(now(), '%T'))";
					mysql_query($sql_cliente_online,$conexion_db) or db_out_error($sql_cliente_online, mysql_errno(),mysql_error());
					//Inserta nuevo registro de historial de usuarios en linea
					//mysql_query("insert into historico_invitados_web (nombre, id_sesion, direccion_ip,  url, navegador, fecha_ingreso, hora_ingreso) values ('invitado' ,  '" . addslashes($wo_sesion_id) . "', '" . addslashes($wo_direccion_ip) . "',  '" . addslashes($wo_url_actual) . "' , '" .addslashes($wo_navegador). "' , now() , TIME_FORMAT(now(), '%T') )",$conexion_db) or db_out_error('ERROR historico_invitados_web', mysql_errno(),mysql_error());
			}
    }
    
	//se puede recoger las variables de entorno con cualquiera de las dos opciones: getenv() o $_SERVER
    

//	echo $xx_mins_ago.'<br>';
// remove entries that have expired
	/////////////////////////////////////////////////////////////7
	
	//mysql_free_result($stored_customer_query);
  }
?>
