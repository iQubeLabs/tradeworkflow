<?php
App::uses("CakeEmail", "Network/Email");

/**
 * Description of ShippingShell
 *
 * @author perfectmak
 * @property Shipping $Shipping Shipping Model
 */
class ShippingShell extends AppShell
{
    public $uses = array("FormM", "Customer", "Trade", "Shipping");
    
    public function main()
    {
        $this->notifyCustomerOfShippingDate();
    }
    
    private function notifyCustomerOfShippingDate()
    {
        $allCustomers = $this->Customer->find("all");
        
        foreach($allCustomers as $customer)
        {
            $shippings = $this->Shipping->getUpcomingShippingFor($customer['Customer']['id']);
            
//            echo json_encode($shippings);            
            
            //Send email to all users
            if(count($shippings['month'])||count($shippings['threeWeeks'])||count($shippings['twoWeeks'])||count($shippings['oneWeek']))            {
                $cakeEmail = new CakeEmail("gmail");
                $cakeEmail->domain(Configure::read("App.fullBaseUrl"))
                        ->subject("Upcoming Shipping Date")
                        ->template("shippingstartstoday")
                        ->emailFormat("text")
                        ->viewVars(array(
                            "shippings" => $shippings,
                            "renewBaseUrl"=> Router::url(array("controller"=>"shippings", "action"=>"view", "dashboard"=>true), true)
                        ))
                        ->to($customer['Customer']['email'])
                        ->send();
            }
        }
    }
}

?>
