<?php
App::uses("CakeEmail", "Network/Email");
App::uses("Router", "Routing");

/**
 * Description of PaarShell
 *
 * @author perfectmak
 */
class PaarShell extends AppShell
{
    public $uses = array("FormM", "Customer", "Trade", "Paar");
    
    public function main()
    {
        $this->notifyCustomerOfPendingPaar();
    }
    
    private function notifyCustomerOfPendingPaar()
    {
        $allCustomers = $this->Customer->find("all");
        
        foreach($allCustomers as $customer)
        {
            $paars = $this->Paar->getPendingFor($customer['Customer']['id']);
            
//            echo json_encode($paars);            
            
            //Send email to all users
            if(!empty($paars)){
                $cakeEmail = new CakeEmail("gmail");
                $cakeEmail->domain(Configure::read("App.fullBaseUrl"))
                        ->subject("Paar Tracking is pending")
                        ->template("paarpending")
                        ->emailFormat("text")
                        ->viewVars(array(
                            "paars" => $paars,
                            "viewLink"=> Router::url(array("controller"=>"paars", "action"=>"view", "dashboard"=>true), true)
                        ))
                        ->to($customer['Customer']['email'])
                        ->send();
            }
        }
    }
}

?>
