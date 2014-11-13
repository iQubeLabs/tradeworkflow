<?php
App::uses("CakeEmail", "Network/Email");
App::uses("Router", "Routing");

/**
 * Description of ClearingShell
 *
 * @author perfectmak
 */
class ClearingShell extends AppShell 
{
    public $uses = array("Shipping", "Customer", "Trade", "Paar");
    
    public function main(){
        $this->out('Hello World!');
        //$this->notifyCustomerOfClearing();
    }
    
    private function notifyCustomerOfClearing()
    {
        $allCustomers = $this->Customer->find("all");
        
        foreach($allCustomers as $customer)
        {
            $clears = $this->Shipping->getGoodsToBeClearedSoon($customer['Customer']['id']);
            
            echo json_encode($clears);            
            
            //Send email to all users
            if(!empty($clears)){
                $cakeEmail = new CakeEmail("gmail");
                $cakeEmail->domain(Configure::read("App.fullBaseUrl"))
                        ->subject("Clearing Tracking is active")
                        ->template("clearingtracking")
                        ->emailFormat("text")
                        ->viewVars(array(
                            "clears" => $clears,
                            "viewLink"=> Router::url(array("controller"=>"clearings", "action"=>"index", "dashboard"=>true), true)
                        ))
                        ->to($customer['Customer']['email'])
                        ->send();
            }
        }
    }
}

?>
