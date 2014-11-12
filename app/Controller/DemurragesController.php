<?php
App::uses('AppController', 'Controller');
App::uses("Paar", "Model");
App::uses('CakeEvent', 'Event');
App::uses('FormM', 'Model');

/**
 * Description of DemurrageController
 *
 * @author perfectmak
 */
class DemurragesController extends AppController
{
    public $uses = array("Trade", "FormM", "Seller", "Country", "Good", "Shipping", "ShippingLine", "Port", "Courier");
    
    public $helpers = array('Form', 'Html', 'Js', 'Time', 'MyDate', 'MyUI');
    
    
    public $components = array('Paginator');

        public function beforeFilter() {
            parent::beforeFilter();
            $this->navInfo['Nav.Demurrage'] = "active";
        }
    
    public function dashboard_index($status = null)
    {
        $this->_index($status, false);
    }
    
    private function _index($status, $isAdmin)
    {
        if(is_null($status))
        {
            $status = "progress";
        }
        $this->navInfo["Nav.Demurrage.".$status] = "active";
        
        
        $sevenDays = date("Y-m-d", time() + 3600*24*7);
        $defaultDays = "0000-00-00 00:00:00";
        
        $conditions = array(
                "Trade.customer_id" => $this->Auth->user("id"),
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
    
    public function admin_index($status = null)
    {
        $this->_index($status, true);
    }
}

?>
