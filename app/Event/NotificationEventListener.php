<?php
App::uses('CakeEventListener', 'Event');
App::uses('ClassRegistry', 'Utility');
App::uses("Notification", "Model");
App::uses("CakeEmail", "Network/Email");
App::uses("Router", "Routing");
/**
 * Description of CustomerEventListener
 *
 * @author perfectmak
 */
class NotificationEventListener implements CakeEventListener{
    
    /**
     *
     * @var Notification 
     */
    private $Notification;
    
    public function __construct() {
        $this->Notification = ClassRegistry::init("Notification");
    }
    
    public function implementedEvents() 
    {
        return array(
            "Customer.onSignup" => "sendCustomerRegisteredEmail",
            "Customer.onShippingUpdated" => "sendCustomerShippingUpdatedEmail",
            "Customer.onDocumentUpdated" => "sendCustomerDocumentStatusUpdated",
            "Customer.onFormMExpired" => "sendCustomerFormMExpired",
            "Admin.onFormMCreated" => "sendAdminFormMCreated",
            "Admin.onShippingCreated" => "sendAdminShippingCreated",
            "Admin.onDocumentCreated" => "sendAdminDocumentCreated"
        );
    }
    
    public function sendCustomerRegisteredEmail(CakeEvent $cakeEvent)
    {
        $toEmail = $cakeEvent->data['email'];
        
        $cakeEmail = new CakeEmail("gmail");
        $cakeEmail->template("customerregistered")
                ->subject("Welcome to Trade Workflow")
                ->emailFormat("text")
                ->viewVars(array(
                    "createTradeLink" => Router::url(array("controller" => "trades", "action" => "add", "dashboard" => true), true)
                ))
                ->to($toEmail)
                ->send();
    }
    
    public function sendCustomerShippingUpdatedEmail(CakeEvent $cakeEvent)
    {
        $shippingId = $cakeEvent->data['shippingId'];        
        $Shipping = ClassRegistry::init("Shipping");
        
        $shipping = $Shipping->find("first", array(
            "conditions" => array("Shipping.id" => $shippingId)));
        
        $info = "A date has been gotten for your shipping.";// Check it out";
        $link = Router::url(array("controller" => "shippings", "action" => "view", "dashboard" => true, $shippingId), true);
        $type = Notification::$ENUM_TYPE[Notification::TYPE_SHIPPING_UPDATE];
        
        $this->Notification->create();        
        $this->Notification->saveNotification($shipping["Trade"]['customer_id'], $info, $link, $type);
        
        //TODO: sendUpdate Email too
        $cakeEmail = new CakeEmail("gmail");
        $cakeEmail->template("shippingstatusupdated")
                ->subject("Shipping Status Updated")
                ->emailFormat("text")
                ->viewVars(array(
                    "shippingLink" => $link
                ))
                ->to(Configure::read("Admin.email"))
                ->send();
    }
    
    public function sendCustomerDocumentStatusUpdated(CakeEvent $cakeEvent)
    {
        $documentId = $cakeEvent->data['documentId'];
        $toEmail = $cakeEvent->data['email'];
        $Document = ClassRegistry::init("Document");
        
        $document = $Document->findById($documentId);

        $info = "Courier status has been updated";
        $link = Router::url(array("controller" => "documents", "action" => "view", "dashboard" => true, $documentId), true);
        $type = Notification::$ENUM_TYPE[Notification::TYPE_DOCUMENT_UPDATE];
        $trackingNumber = $document['Document']['tracking_number'];
        $status = $document['Document']['status'];
        $statusMessage = ($status == 1) ? "is in transit" : "has arrived" ;
        $additionalInfo = ($status == 1) ? "We advise you to start the processing of your PAAR immediately." : "You will be notified once we confirm that your document has arrived.";
        $courier = $document['Courier']['name'];
        
        $this->Notification->create();
        $this->Notification->saveNotification($document["Trade"]['customer_id'], $info, $link, $type);

        //TODO: Notify Customer via Email.
        $cakeEmail = new CakeEmail("gmail");
        $cakeEmail->template("documentstatusupdated")
                ->subject("Document Status Updated")
                ->emailFormat("text")
                ->viewVars(array(
                    "documentLink" => $link,
                    "documentStatus" => $statusMessage,
                    "trackingNumber" => $trackingNumber,
                    "courierName" => $courier,
                    "additionalInfo" => $additionalInfo
                ))
                ->to($toEmail)
                ->send();
    }
    
    public function sendCustomerFormMExpired(CakeEvent $cakeEvent)
    {
        $when = $cakeEvent->data['when'];
        $Customer= $cakeEvent->data['Customer'];
        
        $FormM = ClassRegistry::init("FormM");
        
        $format = "Y-m-d";
        $today = time();
        
        $monthsTime = date($format, strtotime("-30 day", $today));
        
        $weeksTime = date($format, time()+(3600*24*7));
        
        $lateForms = $FormM->find("all", array(
            "conditions" => array(
                "FormM.expiration_date <=" => $monthsTime
            ),
            "order" => array(
              "FormM.expiration_date"  => "ASC"
            )
        ));
        
        foreach ($lateForms as $lateForm)
        {
            
        }
        
        if(isset($cakeEvent->data['customerId']))
        {
            
        }
        
        //Notifiy Customer via sms
        
        //Notify Customer via Email
        $cakeEmail = new CakeEmail("gmail");
        $cakeEmail->template("formmexpiring")
                ->emailFormat("text")
                ->viewVars(array(
                    "when" => $when
                ))
                ->to($customer['Customer']['email'])
                ->send();
    }
    
    public function sendAdminFormMCreated(CakeEvent $cakeEvent)
    {
        $formMId = $cakeEvent->data['formMId'];
        
        /**
         * @property FormM $FormM FormM
         */
        $FormM = ClassRegistry::init("FormM");
        $formM = $FormM->find("first", array(
            "conditions" => array(
                "FormM.id" => $formMId
            )
        ));
        
        //Notifiy Admin via Email
        $cakeEmail = new CakeEmail("gmail");
        $cakeEmail->template("admin_formmcreated")
                ->emailFormat("text")
                ->viewVars(array(
                    "formM" => $formM
                ))
                ->to(Configure::read("Admin.email"))
                ->send();
    }
    
    public function sendAdminShippingCreated(CakeEvent $cakeEvent)
    {
        $shippingId = $cakeEvent->data['shippingId'];
        
        $info = "A new shipping has been created.";// Update shipping details";
        $link = Router::url(array("controller" => "shippings", "action" => "view", "admin" => true, $shippingId), true);
        $type = Notification::$ENUM_TYPE[Notification::TYPE_SHIPPING_CREATED];
        
        //create notification for admin
        $this->Notification->create();        
        $this->Notification->saveNotification(null, $info, $link, $type);
        
        //send email to admin
        $cakeEmail = new CakeEmail("gmail");
        $cakeEmail->template("admin_shippingcreated")
                ->emailFormat("text")
                ->viewVars(array(
                    "shippingLink" => $link
                ))
                ->to(Configure::read("Admin.email"))
                ->send();
    }
    
    public function sendAdminDocumentCreated(CakeEvent $cakeEvent)
    {
        $documentId = $cakeEvent->data['documentId'];
        
        $info = "Document Tracking initiated.";
        $link = Router::url(array("controller" => "documents", "action" => "view", "admin" => true, $documentId), true);
        $type = Notification::$ENUM_TYPE[Notification::TYPE_DOCUMENT_CREATED];
        
        //create notification for admin
        $this->Notification->create();        
        $this->Notification->saveNotification(null, $info, $link, $type);
        
        //send email to admin
        $cakeEmail = new CakeEmail("gmail");
        $cakeEmail->template("admin_documentcreated")
                ->emailFormat("text")
                ->viewVars(array(
                    "documentLink" => $link
                ))
                ->to(Configure::read("Admin.email"))
                ->send();
    }
    
}

?>
