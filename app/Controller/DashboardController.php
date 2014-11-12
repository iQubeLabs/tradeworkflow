<?php
App::uses("CakeEmail", "Network/Email");

/**
 * Description of DashboardController
 *
 * @author perfectmak
 */
class DashboardController extends AppController{
    
    public $uses = array("Trade", "FormM", "Seller", "Country", "Shipping");
    
    public $helpers = array("MyDate", "Html");


    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = "dashboard";
        
        $this->Auth->allow("dashboard_mailtest");
    }
    
    public function index()
    {
        $this->redirect(array(
            "action"=>"index", "dashboard" => true
            ));
        
    }
    
    public function dashboard_index()
    {
        //load all top 5 trades
        $trades = $this->Trade->find("all", array(
            "order" => "FormM.expiration_date DESC",
            "conditions" => array("Trade.customer_id" => $this->Auth->user("id")),
            "limit" => 5,
            "fields" => array("Trade.*", "Seller.*", "FormM.*"),
            'joins' => array(
                    array(
                        'table' => 'form_m',
                        'alias' => 'FormMJoin',
                        'type' => 'INNER',
                        'conditions' => array(
                            'FormMJoin.id = Trade.form_m_id'
                        )
                    ),
                    array(
                        'table' => 'sellers',
                        'alias' => 'Seller',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Seller.id = FormMJoin.seller_id'
                        )
                    ),
//                    array(
//                        'table' => 'shippings',
//                        'alias' => 'Shipping',
//                        'type' => 'LEFT',
//                        'conditions' => array()
//                    )
                )));
        
        debug($trades);
        
        if(count($trades) == 0)
        {
            //there are no trades created
            $this->redirect(array(
                "controller" => "formMs",
                "action" => "index"
            ));
        }
        
        
        //load top 5 shippings in progress
        $shippings = $this->Shipping->find("all", array(
            "conditions" => array(
                "NOT" => array(
                    "Shipping.shipping_date" => "0000-00-00 00:00:00"
                    ),
                "Trade.customer_id" => $this->Auth->user("id")
                ),
            "fields" => array("Shipping.*", "Trade.*", "FormM.*", "ShippingLine.*", "LoadingPort.*", "DischargePort.*"),
            "limits" => 5,
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
        
        //load top 5 pending clearings
        $sevenDays = date("Y-m-d H:i:s", time() + 3600*24*7);
        $clearings = $this->Shipping->find("all", array(
            "conditions" => array(
                "Trade.customer_id" => $this->Auth->user("id"),
                "Shipping.expected_arrival_date <=" => $sevenDays,
                "Shipping.is_cleared" => 1
                ),
            "limit" => 5,
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
        
        $this->set(compact("trades", "shippings", "clearings"));
    }
    
    public function dashboard_signout()
    {
        $this->redirect($this->Auth->logout());
    }
    
    public function dashboard_mailtest()
    {
        $this->autoRender = false;
        
        if(isset($this->request->query['email']))
        {
            $email = $this->request->query['email'];
        }
        else
        {
            $email = "damiperfect@gmail.com";
        }
        
        $cakeEmail = new CakeEmail("gmail");
        $cakeEmail->template("customerregistered")
                ->subject("Welcome to Trade Workflow")
                ->emailFormat("text")
                ->viewVars(array(
                    "createTradeLink" => Router::url(array("controller" => "trades", "action" => "add", "dashboard" => true), true)
                ))
                ->to($email)
                ->send();
        
        echo "Mail sent";
    }
}

?>
