<?php
App::uses("CakeEmail", "Network/Email");
App::uses("Router", "Routing");

/**
 * Description of ShipmentArrival
 *
 * @author oluwasegun
 * 
 *
 */
class ShipmentArrivalShell extends AppShell {
	public $uses = array();

	public function main()
	{
		$this->notifyCustomerOfShipmentArrival();
	}

	private function notifyCustomerOfShipmentArrival()
	{
		$allCustomers = $this->Customer->find("all");

		foreach ($allCustomers as $customer)
		{
			$shipments = $this->Trade->getNearlyArrivedShipments($customer['Customer']['id']);

			echo json_encode($shipments);

			// Send email to all users

			$cakeEmail = new CakeEmail("gmail");
			$cakeEmail->domain(Configure::read("App.fullBaseUrl"))
					->template("shipmentsarrival")
					->subject("Shipments Arrival")
					->emailFormat("text")
					->viewVars(array(
						"shipments" => $shipments,
						$link => Router::url(array("controller" => "trades", "action" => "index", "dashboard" => true), true)
					));
		}
	}
}