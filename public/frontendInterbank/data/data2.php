<?php

	$data = array(
					array(
							"agente" => "0 Agente",
	 						"cantidad" => 20
						),
					array(
							"agente" => "2 Agente",
	 						"cantidad" => 18
						),

					array(
							"agente" => "3 Agente",
	 						"cantidad" => 10
						),

					array(
							"agente" => "3 ó más",
	 						"cantidad" => 5
						)
					
				);

		header('Content-Type: application/json');
		echo json_encode($data);
?>