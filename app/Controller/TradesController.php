<?php
App::uses('AppController', 'Controller');
App::uses("Paar", "Model");
App::uses("Trade", "Model");
/**
 * Trades Controller
 *
 * @property Trade $Trade
 * @property PaginatorComponent $Paginator
 */
class TradesController extends AppController {

    public $uses = array( "Trade", "Customer", "FormM", "Seller", "Country", "Good", "Shipping", "ShippingLine", "Unit", "Port", "Courier");
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
        
        public function beforeFilter() {
            parent::beforeFilter();
            $this->navInfo['Nav.Trade'] = "active";            
        }

    /*public function dashboard_test() {

        $customers = $this->Customer->find('all', array("fields" => array('Customer.id')));
        foreach ($customers as $customer) {
            $shipments[] = $this->Trade->getNearlyArrivedShipments($customer['Customer']['id']);
        }
        // debug($shipments);
        // die();
    }*/

/**
 * dashboard_index method
 *
 * @return void
 */
	public function dashboard_index() {                
            $this->_index(false);
    }

        public function admin_index()
        {
            $this->_index(true);
        }
        
        private function _index($isAdmin)
        {
            $conditions = array();
            
            if(!$isAdmin)
            {
                $conditions = array($conditions, array("Trade.customer_id" => $this->Auth->user("id")));
            }
            //count all trades
            $formMsCount = $this->Trade->find("count", array("conditions" => $conditions));
            $this->set("formMsCount", $formMsCount);

            debug($formMsCount);
            
            //select all Trades available
//            $trades = $this->Trade->find("all", array(
//                "order" => "Trade.date_added DESC",
//                "conditions" => $conditions,
//                "fields" => array("Trade.*", "Seller.*", "FormM.*"),
//                'joins' => array(
//                        array(
//                            'table' => 'form_m',
//                            'alias' => 'FormMJoin',
//                            'type' => 'INNER',
//                            'conditions' => array(
//                                'FormMJoin.id = Trade.form_m_id'
//                            )
//                        ),
//                        array(
//                            'table' => 'sellers',
//                            'alias' => 'Seller',
//                            'type' => 'LEFT',
//                            'conditions' => array(
//                                'Seller.id = FormMJoin.seller_id'
//                            )
//                        )
//                    )));
            
                    $this->Paginator->settings = array(
                        "order" => "Trade.created DESC",
                        //"limit" => 2,
                        //'recursive' => -1,
                        "conditions"=> $conditions,
                        "order" => 'Trade.form_m_id DESC',
                        'fields'=> array('Unit.*','FormM.name', 'Trade.*'),
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
                            'table' => 'units',
                            'alias' => 'Unitn',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Trade.unit_id = Unitn.id'
                            )
                        ),
                        /*array(
                            'table' => 'sellers',
                            'alias' => 'Seller',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Seller.id = FormMJoin.seller_id'
                            )
                        )*/
                    ));
            $trades = $this->Paginator->paginate();

            debug($trades);
            
            $this->set('formMs', $trades);
                
        }
/**
 * dashboard_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function dashboard_view($id = null) {
            $this->_view($id, false);
	}

        public function admin_view($id = null) {
            $this->_view($id, true);
        }
        
        private function _view($id, $isAdmin) 
        {
            if (!$this->Trade->exists($id)) 
            {
                    throw new NotFoundException(__('Invalid form m'));
            }

            $conditions = array('Trade.' . $this->FormM->primaryKey => $id);

            if(!$isAdmin)
            {
                $conditions = array_merge($conditions, array('Trade.customer_id' => $this->Auth->user("id")));
            }

            $options = array('conditions' => $conditions,
                "fields" => array("Trade.*", "Unit.name", "Shipping.*", "FormM.*", "Seller.name", "Document.*", "Paar.*", "ShippingLine.*", "LoadingPort.*", "DischargePort.*", "Courier.*"),
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
                            'type' => 'INNER',
                            'conditions' => array(
                                'Seller.id = FormMJoin.seller_id'
                            )
                        ),
                        array(
                            'table' => 'units',
                            'alias' => 'UnitJoin',
                            'type' => 'INNER',
                            'conditions' => array(
                                'UnitJoin.id = Trade.unit_id'
                            )
                        ),
                        array(
                            'table' => 'shippings',
                            'alias' => 'Shipping',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Shipping.trade_id = Trade.id'
                            )
                        ),
                        array(
                            'table' => 'documents',
                            'alias' => 'Document',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Document.trade_id = Trade.id'
                            )
                        ),
                        array(
                            'table' => 'paars',
                            'alias' => 'Paar',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Paar.trade_id = Trade.id'
                            )
                        ),
                        array(
                            'table' => 'shipping_lines',
                            'alias' => 'ShippingLine',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'ShippingLine.id = Shipping.shipping_line_id'
                            )
                        ),
                        array(
                            'table' => 'ports',
                            'alias' => 'LoadingPort',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'LoadingPort.id = Shipping.loading_port_id'
                            )
                        ),
                        array(
                            'table' => 'ports',
                            'alias' => 'DischargePort',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'DischargePort.id = Shipping.discharge_port_id'
                            )
                        ),
                        array(
                            'table' => 'couriers',
                            'alias' => 'Courier',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Courier.id = Document.courier_id'
                            )
                        )
                    ));

            $formM = $this->Trade->find('first', $options);
            debug($formM);
            $this->set('formM', $formM);
        }
        
/**
 * dashboard_add method
 *
 * @return void
 */
	public function dashboard_add() {
		if ($this->request->is('post')) {

            $form_m_id = $this->request->data['Trade']['form_m_id'];

            $amount = $this->request->data['Trade']['amount'];
            $formM = $this->FormM->find('first', array(
                            'conditions' => array('FormM.id' => $form_m_id),
                            'fields' => 'FormM.total_cfr'
                        )
                    );
            $total_cfr = $formM['FormM']['total_cfr'];
            $maxVal = 1.10 * $total_cfr;
            $formMsCount = $this->Trade->find('count', array('conditions' => array('Trade.form_m_id' => $form_m_id)));
            
            if ($formMsCount > 0) {
                //echo "found";
                $sum = $this->Trade->query(
                        "SELECT SUM(amount) as sum FROM trades WHERE form_m_id = $form_m_id"
                    );
                $sum = $sum[0][0]['sum'];
                $amountLeft = $maxVal - $sum;
                
                if ($amount <= $amountLeft) {

                    if(strtotime($this->request->data['Trade']['expected_arrival_time']) > time()) {
                        $this->Trade->create();
                        //insert other default values
                        $this->Trade->set(array(
                            //"date_added" => date("Y-m-d H:i:s"),
                            "customer_id" => $this->Auth->user("id")
                        ));

                        /*if(!($this->request->data['Trade']['name']))
                        {
                            $this->request->data['Trade']['name'] = Trade::getDefaultName();
                        }*/
                        
                        if ($this->Trade->save($this->request->data)) {
                                $this->Session->setFlash(__('The trade has been saved.'));
                                return $this->redirect(array('action' => 'index'));
                        } else {
                                $this->Session->setFlash(__('The trade could not be saved. Please, try again.'));
                        }
                    } else {
                        $this->Session->setFlash("Expiry must be after today");
                    }
                } else {
                    echo $this->Session->setFlash("The shipment has exceeded the limit.<br>Make sure the shipment value is not more than N".number_format((float)$amountLeft, 2, '.', ''));
                }
            } else {

                if($amount <= $maxVal) {
                    if(strtotime($this->request->data['Trade']['expected_arrival_time']) > time()) {
                        $this->Trade->create();
                        //insert other default values
                        $this->Trade->set(array(
                            //"date_added" => date("Y-m-d H:i:s"),
                            "customer_id" => $this->Auth->user("id")
                        ));

                        /*if(!($this->request->data['Trade']['name']))
                        {
                            $this->request->data['Trade']['name'] = Trade::getDefaultName();
                        }*/
                        
                        if ($this->Trade->save($this->request->data)) {
                                $this->Session->setFlash(__('The trade has been saved.'));
                                return $this->redirect(array('action' => 'index'));
                        } else {
                                $this->Session->setFlash(__('The trade could not be saved. Please, try again.'));
                        }
                    } else {
                        $this->Session->setFlash("Expiry must be after today");
                    }
                } else {
                    echo $this->Session->setFlash("The shipment value has exceeded the limit.<br>Make sure the shipment value is not more than N".number_format((float)$maxVal, 2, '.', ''));
                }
            }   

        }
                
		$customers = $this->Trade->Customer->find('list');
                
                $params = array(
                "order" => "FormM.expiration_date DESC",
                "conditions" => array(
                    "FormM.customer_id" => $this->Auth->user("id"),
                    "FormM.expiration_date >" => date("Y-m-d H:i:s")
                    ),
                "fields" => array("FormM.id", "FormM.name"),
                /*'joins' => array(
                        array(
                            'table' => 'trades',
                            'alias' => 'Trade',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'FormM.id = Trade.form_m_id'
                            )
                        )
                    )*/
                );
		$formMs = $this->FormM->find('all', $params);
        $fields = array('fields' => array('Unit.*'));
        //$unit = $this->Unit->find('list', $fields);
        //$this->loadModel('Unit');
        $units = $this->Unit->find('all', $fields);
		$this->set(compact('customers', 'formMs', 'units'));
	}
        
        public function admin_add()
        {
            
        }

    /*public function ajax_get($countryId = null)
        {
            $this->layout = "ajax";
            
            if(($countryId != null))
            {
                $result = $this->Port->find("all", array(
                    "conditions" => "Port.country_id = ".$countryId,
                    "fields" => array("Port.id", "Port.name")));
                
                echo json_encode($result);
            }
        }*/

        // displays brief information of the selcted form M
        public function ajax_form($id)
        {

            $this->layout = 'ajax';
            //$this->view = 'ajax_response';
            /*if (!$this->FormM->exists($id)) 
            {
                    throw new NotFoundException(__('Invalid form m'));
            }*/
            
            $conditions = array('FormM.' . $this->FormM->primaryKey => $id);
            
            /*if(!$isAdmin)
            {
                $conditions = array_merge($conditions, array("FormM.customer_id" => $this->Auth->user("id")));

                array_merge($conditions, array("OR" => array(
                    "Trade.customer_id" => $this->Auth->user("id"), //for backward compatibility for when customer_id was not specified for FormM
                    "FormM.customer_id" => $this->Auth->user("id")
                        )));
                
            }*/

            $options = array('conditions' => $conditions,
                "fields" => array("FormM.*", "Seller.*", "Good.*", "LoadingPort.*", "DischargePort.*"),
                'joins' => array(
                        array(
                            'table' => 'ports',
                            'alias' => 'LoadingPort',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'LoadingPort.id = FormM.loading_port_id'
                            )
                        ),
                        array(
                            'table' => 'ports',
                            'alias' => 'DischargePort',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'DischargePort.id = FormM.discharge_port_id'
                            )
                        ),
                        /*array(
                            'table' => 'trades',
                            'alias' => 'Trade',
                            'type' => 'INNER',
                            'conditions' => array(
                                'Trade.form_m_id = FormM.id'
                            )
                        ),*/
                    ));
            
            $formM = $this->FormM->find('first', $options);
            //$total_cfr = $formM['FormM']['total_cfr'];
            $insured_value = $formM['FormM']['insurance_value']; // insured value is 110% of Total CFR
            $formMsCount = $this->Trade->find('count', array('conditions' => array('Trade.form_m_id' => $id)));
            
            if ($formMsCount > 0) { //Checks if form M has been used or not.
                $sum = $this->Trade->query(
                        "SELECT SUM(amount) as sum FROM trades WHERE form_m_id = $id"
                    );
                $sum = $sum[0][0]['sum'];
                $amountLeft = $insured_value - $sum;
            } else {
                $amountLeft = $insured_value;
            }
            
            debug($formM);
            $countries = $this->Country->find('all');
            echo '<pre>';
            echo $formM = json_encode($formM);
            echo $amountLeft = json_encode($amountLeft);
            $this->set(compact("formM", "countries", "amountLeft"));
        }

/**
 * dashboard_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function dashboard_edit($id = null) {
		if (!$this->Trade->exists($id)) {
			throw new NotFoundException(__('Invalid trade'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Trade->save($this->request->data)) {
				$this->Session->setFlash(__('The trade has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The trade could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Trade.' . $this->Trade->primaryKey => $id));
			$this->request->data = $this->Trade->find('first', $options);
		}
		$customers = $this->Trade->Customer->find('list');
		$formMs = $this->Trade->FormM->find('list');
		$this->set(compact('customers', 'formMs'));
	}

/**
 * dashboard_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function dashboard_delete($id = null) {
		$this->Trade->id = $id;
		if (!$this->Trade->exists()) {
			throw new NotFoundException(__('Invalid trade'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Trade->delete()) {
			$this->Session->setFlash(__('The trade has been deleted.'));
		} else {
			$this->Session->setFlash(__('The trade could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}       
}