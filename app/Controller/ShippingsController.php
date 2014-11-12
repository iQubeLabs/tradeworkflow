<?php
App::uses("AppController", "Controller");
App::uses('CakeEvent', 'Event');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ShippingsController
 *
 * @author perfectmak
 */
class ShippingsController extends AppController
{
    public $uses = array("Shipping", "Trade", "ShippingLine");
    
    public function beforeFilter() 
    {
        parent::beforeFilter();
        $this->navInfo["Nav.Shipping"] = "active";
    }
    
    public function dashboard_init($tradeId=null)
    {
        if($tradeId != null)
        {
            if($this->request->is("post"))
            {
                $this->ShippingLine->create();                
                $this->ShippingLine->save($this->request->data);
                  
                $this->Shipping->create();
                $this->request->data['Shipping']['shipping_line_id'] = $this->ShippingLine->id;
                if($this->Shipping->save($this->request->data))
                {
                    $cakeEvent = new CakeEvent("Admin.onShippingCreated", $this, array("shippingId" => $this->Shipping->id));
                    $this->getEventManager()->dispatch($cakeEvent);
                    
                    $this->Session->setFlash("Your Shipping is being processed. You will be notified when a Shipping date has been confirmed.");
                    $this->render("dashboard_init_success");
                    return;
                }
                else
                {
                    $this->Session->setFlash("We are unable to initialize the Shipping process. Try again.");
                }
            }
            
            //load trade Info
            $trade = $this->Trade->find("first", array(
                "conditions" => array("Trade.id" => $tradeId,
                    "Trade.customer_id" => $this->Auth->user("id"))
            ));

            if(count($trade) == 0)
            {
                $this->Session->setFlash("This trade doesn't exist");
                $this->set("error", true);
            }
            else
            {
                //Also check if shipping has been initialized for this trade
                $shipping = $this->Shipping->find("first", array(
                    "conditions" => array("Shipping.trade_id" => $tradeId)
                ));
                
                if(count($shipping) > 0)
                {
                    if(strtotime($shipping["Shipping"]["shipping_date"]) < 0)
                    {                        
                        $this->Session->setFlash("Your Shipping is being processed. You will be notified when a Shipping date has been confirmed.");                        
                    }
                    else
                    {
                        $this->Session->setFlash("Shipping for this trade is already in progress.");
                    }                
                    $this->render("dashboard_init_success");
                    return;
                }
                else
                {                
                    //TODO: also check if it has expired
                    $this->set("error", false);
                    $this->set("trade", $trade);

                    $shippingLines = $this->ShippingLine->find("all");
                    $this->set("shippingLines", $shippingLines);

                    $this->set("tradeId", $tradeId);
                }
            }
            
        }
        else
        {
            //change this to index
            $this->redirect(array("action"=>"index"));
        }
    }
    
    public function dashboard_index($status = null)
    {
        $this->_index($status, false);
    }
    
    public function dashboard_view($id = null)
    {
        $this->_view($id, false);
    }
    
    public function admin_index($status = null)
    {
        $this->_index($status, true);
    }
    
    public function admin_view($id = null)
    {
        $this->_view($id, true);
    }
    
    public function _view($id, $isAdmin)
    {
        $this->Shipping->id = $id;
        
        if($this->Shipping->exists())
        {
            if($this->request->is("post"))
            {
//                $this->Shipping->read(null, $id);
                if($this->request->data['Shipping']['shipping_date'])
                {
                    $this->Shipping->set("shipping_date", $this->request->data['Shipping']['shipping_date']);
                }
                if($this->request->data['Shipping']['expected_arrival_date'])
                {
                    $this->Shipping->set("expected_arrival_date", $this->request->data['Shipping']['expected_arrival_date']);
                }
                
                if($this->Shipping->save())
                {
                    // send mail to user
                    $event = new CakeEvent("Customer.onShippingUpdated", $this, array("shippingId" => $id));
                    $this->getEventManager()->dispatch($event);
                    
                    $this->Session->setFlash("Shipping updated successfully. The Trader will be notified on shipping date.");
                }
                else
                {
                    $this->Session->setFlash("Unable to update shipping date. Try again.");
                }
            }
            
            $conditions =  array("Shipping.id" => $id);
            
            if(!$isAdmin)
            {
                $conditions = array_merge($conditions, array("Trade.customer_id" => $this->Auth->user("id")));
            }
            
            $shipping = $this->Shipping->find("first", array(
                "conditions" => $conditions,
                "fields" => array("Shipping.*", "Trade.*", "FormM.*", "ShippingLine.*", "LoadingPort.*", "DischargePort.*", "Document.*"),
            "joins" => array(
                    array(
                        'table' => 'trades',
                        'alias' => 'TradeJoin',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Shipping.trade_id = TradeJoin.id'
                        )
                    ),
                    array(
                        'table' => 'form_m',
                        'alias' => 'FormM',
                        'type' => 'INNER',
                        'conditions' => array(
                            'FormM.id = TradeJoin.form_m_id'
                        )
                    ),
                    array(
                        'table' => 'documents',
                        'alias' => 'Document',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Shipping.id = Document.shipping_id'
                        )
                    )
                )
            ));
            
            $this->set("shipping", $shipping);
        }
        else
        {
           $this->redirect(array("action"=>"index", "progress"));
        }   
    }
    
    private function _index($status, $isAdmin)
    {
        if(is_null($status))
            $status = "all";
        
        //setup navigation
        $this->navInfo["Nav.Shipping.".$status] = "active";
        
        switch ($status){            
            case "pending":
                $navTitle = "Pending";
                $conditions = array("Shipping.shipping_date" => "0000-00-00 00:00:00");
                break;
            case "progress":
                $navTitle = "In Progress";
                $conditions = array("Shipping.expected_arrival_date >" => date("Y-m-d H:i:s"),
                    "AND" => array("NOT" => array("Shipping.expected_arrival_date" => "0000-00-00 00:00:00")));
                break;
            case "done":
                $navTitle = "Finished";
                $conditions = array("Shipping.expected_arrival_date <=" => date("Y-m-d H:i:s"),
                    "AND" => array("NOT" => array("Shipping.expected_arrival_date" => "0000-00-00 00:00:00")));
                break;
            case "all":
            default:
                $navTitle = "All";
                $conditions = array();
        }
        
        if(!$isAdmin)
        {
            $conditions = array_merge($conditions, array("Trade.customer_id" => $this->Auth->user("id")));
        }
        
        $shippings = $this->Shipping->find("all", array(
            "conditions" => $conditions,
            "order" => "Shipping.created DESC",
            "fields" => array("Shipping.*", "Trade.*", "FormM.*", "ShippingLine.*", "LoadingPort.*", "DischargePort.*"),
            "joins" => array(
                    array(
                        'table' => 'trades',
                        'alias' => 'TradeJoin',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Shipping.trade_id = TradeJoin.id'
                        )
                    ),
                    array(
                        'table' => 'form_m',
                        'alias' => 'FormM',
                        'type' => 'INNER',
                        'conditions' => array(
                            'FormM.id = TradeJoin.form_m_id'
                        )
                    )
                )
            ));
        
        $this->set("shippings", $shippings);
        $this->set("navTitle", $navTitle);
    }
}

?>
