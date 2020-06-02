<?php 



	if(isset($_POST['get_csv_details'])) {


		$statements = ["In order to grow / you require a minimum * of % and maximum of # ", "You need to have a * within the range of % and # in order to grow and farm /", "If * is between % and #  then you can farm and grow /", "The Ideal scenario to grow / is when the * is generally in the range of % and #"];

		$max_statements = 4;

		$type = strtolower($_POST['type']);
		$condition = strtolower($_POST['condition']);

		$tempData = array();
		$humData = array();
		$pHData = array();
		$rainData = array();
		$file = fopen('cpdata.csv', 'r');
		$i = 0;
		$j = 0;
		while (($line = fgetcsv($file)) !== FALSE) {
			//$line is an array of the csv elements

			//$lines = explode(",", $line);

			if($j != 0 && $line[4] == $type){
				$tempData[$i] = round(number_format($line[0], 2, '.', ''));
				$humData[$i] = round(number_format($line[1], 2, '.', ''));
				$pHData[$i] = round(number_format($line[2], 2, '.', ''));
				$rainData[$i++] = round(number_format($line[3], 2, '.', ''));
			}

			$j++;
		}
		fclose($file);

		$statement = $statements[rand(0,$max_statements-1)];
		$tempResultType = str_replace("/", $type, $statement);
		$tempResultCond = str_replace("*", $condition, $tempResultType);
		//$humResult = "The min Humidity for " . $type . " is " . min($humData) . " and max is " . max($humData);
		//$pHResult = "The min Acidity for " . $type . " is " . min($pHData) . " and max is " . max($pHData);
		//$rainResult = "The min Rainfall for " . $type . " is " . min($rainData) . " and max is " . max($rainData);


		//print_r($tempData);

		switch ($condition){
			case 'temperature':{

				$tempResultMin = str_replace("%", min($tempData) . " degree Celcius", $tempResultCond);
				$tempResult = str_replace("#", max($tempData) . " degree Celcius", $tempResultMin);
				echo $tempResult;
				break;
			}
				
			case 'humidity':{
				$tempResultMin = str_replace("%", min($humData) . "", $tempResultCond);
				$tempResult = str_replace("#", max($humData) . "", $tempResultMin);
				echo $tempResult;
				break;
			}
				
			case 'acidity': {
				$tempResultMin = str_replace("%", min($pHData) . "", $tempResultCond);
				$tempResult = str_replace("#", max($pHData) . "", $tempResultMin);
				echo $tempResult;
				break;
			}
			case 'rainfall':{
				$tempResultMin = str_replace("%", min($rainData) . "", $tempResultCond);
				$tempResult = str_replace("#", max($rainData) . "", $tempResultMin);
				echo $tempResult;
				break;
			}
				
			default:
				echo "In order to farm " . strtoupper($type) . " You must have a temperature of ";
				break;
		}
		
		//echo "<br>The min humidity for " . $type . " is " . min($humData);
		



	}

	
?>