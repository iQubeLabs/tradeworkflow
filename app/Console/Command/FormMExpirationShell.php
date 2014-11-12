<?php
App::uses("CakeEmail", "Network/Email");
App::uses("Router", "Routing");

/**
 * Description of FormMExpiration
 *
 * @author perfectmak
 * @property FormM $FormM FormM
 * @property Customer $Customer Model Customer
 */
class FormMExpirationShell extends AppShell {
    public $uses = array("FormM", "Customer", "Trade");
    
    public function main()
    {
        $this->notifyCustomers();
        echo "\r\n\r\n";
//        $this->notifyAdmin();
    }
    
    private function notifyCustomers()
    {
        $allCustomers = $this->Customer->find("all");
        
        foreach($allCustomers as $customer)
        {
            $expiringFormMs = $this->FormM->getExpiringSoon($customer['Customer']['id']);
            
//            echo json_encode($expiringFormMs);
            if(count($expiringFormMs['month'])||count($expiringFormMs['threeWeeks'])||count($expiringFormMs['twoWeeks'])||count($expiringFormMs['oneWeek']))
            {
            
                $cakeEmail = new CakeEmail("gmail");
                $cakeEmail->domain(Configure::read("App.fullBaseUrl"))
                        ->template("formmexpiring")
                        ->subject("Renew Expiring Form M's")
                        ->emailFormat("text")
                        ->viewVars(array(
                            "expiringFormMs" => $expiringFormMs,
                            "renewBaseUrl"=> Router::url(array("controller"=>"formMs", "action"=>"renew", "dashboard"=>true), true)
                        ))
                        ->to($customer['Customer']['email'])
                        ->send();
            }
        }
    }
    
    private function notifyAdmin()
    {
        $formMExpiringThisMonth = $this->FormM->getAllExpiringThisMonth();
        echo json_encode($formMExpiringThisMonth);        
        if(count($formMExpiringThisMonth) > 0)
        {
            $cakeEmail = new CakeEmail("gmail");
            $cakeEmail->domain(Configure::read("App.fullBaseUrl"))
                    ->template("admin_formmexpiringthismonth")
                    ->emailFormat("text")
                    ->viewVars(array(
                        "formM" => $formMExpiringThisMonth
                    ))
                    ->to(Configure::read("Admin.email"))
                    ->send();
        }
        
//        echo "\r\n\r\n";
        $formMExpiringToday = $this->FormM->getAllExpiringToday();
//        echo json_encode($formMExpiringToday);
        if(count($formMExpiringToday) > 0)
        {
            $cakeEmail->domain(Configure::read("App.fullBaseUrl"))
                    ->template("admin_formmexpiringtoday")
                    ->emailFormat("text")
                    ->viewVars(array(
                        "formM" => $formMExpiringToday
                    ))
                    ->to(Configure::read("Admin.email"))
                    ->send();
        }
    }
}
?>
