<?php

	function formatedShipment($shipment, $counter, $link) {
		echo $counter.")\r\n Arrival Date: ".date('j M Y', strtotime($shipment['Trade']['expected_arrival_time']))."\r\n";
		echo "View Details: ".$link."/".$shipment['Trade']['id']."\r\n";
	}

?>

Hello,

This is an update the arrival of your shipments.

<?php

	if(count($shipments['month'])) {
		echo "Arriving in a month's time\r\n";
		$counter = 1;
		foreach ($shipments['month'] as $shipment) {
			formatedShipment($shipment, $counter, $link);
			$counter++
		}
		echo "\r\n";
	}

	if(count($shipment['threeWeeks'])) {
		echo "Arriving in 3 weeks' time\r\n";
		$counter = 1;
		foreach ($shipments['threeWeeks'] as $shipment) {
			formatedShipment($shipment, $counter, $link);
			$counter++
		}
		echo "\r\n";
	}

	if(count($shipments['twoWeeks'])) {
		echo "Arriving in 2 weeks' time\r\n";
		$counter = 1;
		foreach ($shipments['twoWeeks'] as $shipment) {
			formatedShipment($shipment, $counter, $link);
			$counter++
		}
		echo "\r\n";
	}

	if(count($shipments['oneWeek'])) {
		echo "Arriving within a week\r\n";
		$counter = 1;
		foreach ($shipments['oneWeek'] as $shipment) {
			formatedShipment($shipment, $counter, $link);
			$counter++
		}
		echo "\r\n";
	}

?>

Regards,
The Trade Workflow Team.