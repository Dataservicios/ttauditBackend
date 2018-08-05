<?php

	$data = array(
					array(
							"respuesta" => "Si",
	 						"cantidad" => 19
						),
					array(
							"respuesta" => "No",
	 						"cantidad" => 0
						),
					array(
							"respuesta" => "Otro",
	 						"cantidad" => 7
						)
					
				);

		header('Content-Type: application/json');
		echo json_encode($data);
?>