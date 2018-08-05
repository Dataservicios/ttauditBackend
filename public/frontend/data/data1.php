<?php

	$data = array(
					array(
							"tipo" => "Auditadas",
	 						"cantidad" => 120,
	 						"color" => "#009B3A"
						),
					array(
							"tipo" => "No auditadas",
	 						"cantidad" => 20,
	 						"color" => "#FF8000"
						)
					
				);

		header('Content-Type: application/json');
		echo json_encode($data);
?>