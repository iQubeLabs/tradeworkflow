<?php
App::uses("CakeEmail", "Network/Email");

/**
 * Description of DocumentShell
 *
 * @author perfectmak
 */
class DocumentShell extends AppShell
{
    public $uses = array("Document", "Customer", "Trade", "Shipping", "FormM");
    
    public function main()
    {
        $this->notifyCustomersToStartDocumentTracking();
        $this->notifyCustomersDocumentArrived();
    }
    
    private function notifyCustomersToStartDocumentTracking()
    {
        $shippingsPendingTracking = $this->Shipping->getDocumentTrackingsPending();
        
        foreach($shippingsPendingTracking as $shipping)
        {
            if($shipping['Document']['id'] != null)
                continue;
//            echo json_encode($shipping);
            $link = Router::url(array("controller" => "documents", "action" => "init", "full_base"  => true,
                "dashboard" => true, $shipping['Shipping']['id']), true);
            echo $link;
            continue;
            $cakeEmail = new CakeEmail("gmail");
            $cakeEmail->domain(Configure::read("App.fullBaseUrl"))
                    ->template("startdocumenttracking")
                    ->emailFormat("text")
                    ->viewVars(array(
                        "shippings" => $shipping,
                        "link" => $link
                    ))
                    ->to($shipping['Customer']['email'])
                    ->send();
        }
    }

    private function notifyCustomersDocumentArrived()
    {
        $documentsArrived = $this->Docyment->getDocumentsArrived();

        
    }
}

?>
