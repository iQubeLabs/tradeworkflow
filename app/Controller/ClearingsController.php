<?php

App::uses("AppController", "Controller");
/**
 * Description of ClearingsController
 *
 * @author perfectmak
 */
class ClearingsController extends AppController
{
    public $uses = array("FormM", "Trade", "Shipping");
    
    public $helpers = array('Form', 'Html', 'Js', 'Time', 'MyDate');
    
    public function beforeFilter() 
    {
        parent::beforeFilter();
        $this->navInfo['Nav.Clearing'] = "active";
    }
    
    public function dashboard_index($status = null)
    {
        $this->_index($status, false);
    }
    
    public function admin_index($status = null)
    {
        $this->_index($status, true);
    }
    
    public function dashboard_clear($shippingId = null)
    {
        $this->Shipping->id = $shippingId;
        
        if($this->Shipping->exists())
        {
            $conditions = array(
                "Trade.customer_id" => $this->Auth->user("id"),
                "Shipping.is_cleared" => "0"
            );
            
            $shipping = $this->Shipping->find("first", array(
                "conditions" => $conditions,
                "fields" => array("Shipping.*", "Trade.*", "FormM.*", "ShippingLine.*", "DischargePort.*"),
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
            
            $confirmed = $this->request->query("confirm");
            $thisUrl = array("action"=>"clear", $shippingId);
            if($confirmed)
            {
                if($confirmed == md5($shipping["Shipping"]["id"]) && $shipping["Shipping"]["is_cleared"] == 0)
                {
                    //mark clear confirmed
                    $this->Shipping->set(array(
                        "is_cleared" => 1,
                        "date_cleared" => date("Y-m-d H:i:s")
                    ));
                            
                    if($this->Shipping->save())
                    {
                        $this->Session->setFlash("Shipping ".$shipping['Shipping']['id']." has been marked cleared");
                        $this->redirect(array("action" => "index"));
                    }
                    else
                    {
                        $this->Session->setFlash("Unable to mark cleared. Try again.");
                        $this->redirect($thisUrl);
                    }
                }
                else
                {
                    $this->Session->setFlash("Unable to mark cleared. Try again.");
                    $this->redirect($thisUrl);
                }
                
            }
            else
            {
                
            }
        }
        else 
        {
            $this->Session->setFlash("This Shipping is invalid. Can't perform clearing on this Shipping");
            $this->render("dashboard_clear_null");
        }
        
        $this->set(compact("shipping"));
    }
    
    
    private function _index($status, $isAdmin)
    {
        if(is_null($status))
        {
            $status = "progress";
        }
        $this->navInfo["Nav.Clearing.".$status] = "active";
        
        
        $sevenDays = date("Y-m-d", time() + 3600*24*7);
        $defaultDays = "0000-00-00 00:00:00";
        
        $conditions = array(
                "DATE(Shipping.expected_arrival_date) <=" => $sevenDays,
                "DATE(Shipping.expected_arrival_date) >" => date("Y-m-d"),
                "NOT" => array(
                    "Shipping.expected_arrival_date" => $defaultDays
                )
        );
        $extraConditions = array();
        switch ($status) 
        {
            case "progress":
                
                $extraConditions["Shipping.is_cleared"] = 0;
                $title = "Not Cleared";
                break;
            case "done":
                $extraConditions["Shipping.is_cleared"] = 1;
                $title = "Already Cleared";
                break;
        }
        
        $conditions = array_merge($extraConditions, $conditions);
        
        if(!$isAdmin)
        {
            $conditions = array_merge($extraConditions, array("Trade.customer_id" => $this->Auth->user("id")));
        }
        
        $clearings = $this->Shipping->find("all", array(
            "conditions" => $conditions,
            "fields" => array("Shipping.*", "Trade.*", "FormM.*", "ShippingLine.*"),
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
        
        $this->set(compact("clearings", "title"));   
    }
    
    public function admin_view($shippingId)
    {
//        $this->Shipping->id = $shippingId;
        
        if(!$this->Shipping->exists($shippingId))
        {
            throw new NotFoundException(__("This Shipping doesn't exist."));
        }
        
        
        if($this->request->is("post"))
        {
            if($this->Shipping->save($this->request->data))
            {
                $this->Session->setFlash("Details updated");
            }
            else
            {
                $this->Session->setFlash("Unable to updates details");
            }
        }
        
        $conditions = array(
            "Shipping.id"=>$shippingId
        );
        
        $shipping = $this->Shipping->find("first", array(
            "conditions" => $conditions,
            "fields" => array("Shipping.*", "Trade.*", "FormM.*", "ShippingLine.*", "DischargePort.*", "LoadingPort.*"),
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
        
        $this->request->data['Shipping'] = $shipping['Shipping'];
        
        $this->set(compact("shipping"));
    }
}

?>
