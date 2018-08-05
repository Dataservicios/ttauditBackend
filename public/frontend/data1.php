<?php

	$data = array(
					array(
							"tipo" => "Auditadas",
	 						"cantidad" => 120
						),
					array(
							"tipo" => "No auditadas",
	 						"cantidad" => 20
						)
					
				);

		header('Content-Type: application/json');
		echo json_encode($data);
?>