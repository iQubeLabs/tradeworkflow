<?php
App::uses('AppController', 'Controller');
App::uses("Paar", "Model");
App::uses('CakeEvent', 'Event');
App::uses('FormM', 'Model');
/**
 * FormMs Controller
 *
 * @property FormM $FormM
 * @property PaginatorComponent $Paginator
 */
class FormMsController extends AppController {

    public $uses = array("Trade", "FormM", "Seller", "Country", "Good", "Shipping", "ShippingLine", "Port", "Courier");
    
    public $helpers = array('Form', 'Html', 'Js', 'Time', 'MyDate', 'MyUI');
    
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

        public function beforeFilter() {
            parent::beforeFilter();
            $this->navInfo['Nav.FormM'] = "active";            
        }

    public function dashboard_test() {
        $id = $this->Auth->user('id');
        $formMs = $this->FormM->getExpiringSoon($id);
        $formMs = $this->FormM->find('all');
        debug($formMs);
        die('ends here');
    }
        
/**
 * dashboard_index method
 * 
 * //it basically performs view without id
 *
 * //PS: Note that i'm making a query on Trade and storing it in formMs
 * @return void
 */
	public function dashboard_index() 
        {
            $this->_index(false);
	}
        
        public function admin_index()
        {
            $this->_index(true);
        }
        
        private function _index($isAdmin)
        {
            if($this->request->is("post"))
            {

            }

            $this->FormM->recursive = 0;
            
            $condition = array();
            
            if(!$isAdmin)
            {
                $condition = array('FormM.customer_id' => $this->Auth->user("id"));
                /*array_merge($condition, array("OR" => array(
                    "Trade.customer_id" => $this->Auth->user("id"), //for backward compatibility for when customer_id was not specified for FormM
                    "FormM.customer_id" => $this->Auth->user("id")
                        )))*/
            }

            debug($condition);
            
            $params = array(
                "order" => "FormM.expiration_date DESC",
                "conditions" => $condition,
                //"fields" => array("Trade.*", "Seller.*", "FormM.*"),
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
            
            debug($params);
            //count all Trades created
            $this->set("formMsCount", $this->FormM->find("count", $params));
            
            //select all Trades available
            $trades = $this->FormM->find("all", $params);
            debug($trades);
            $this->set('formMs', $trades);
            
            //$this->set('formMs', $this->Paginator->paginate());
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
        
        public function admin_view($id = null)
        {
            $this->_view($id, true);
        }
        
        private function _view($id, $isAdmin)
        {
            if (!$this->FormM->exists($id)) 
            {
                    throw new NotFoundException(__('Invalid form m'));
            }
            
            $conditions = array('FormM.' . $this->FormM->primaryKey => $id);
            
            if(!$isAdmin)
            {
                $conditions = array_merge($conditions, array("FormM.customer_id" => $this->Auth->user("id")));

                /*array_merge($conditions, array("OR" => array(
                    "Trade.customer_id" => $this->Auth->user("id"), //for backward compatibility for when customer_id was not specified for FormM
                    "FormM.customer_id" => $this->Auth->user("id")
                        )));*/
                
            }

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
            $this->set(compact("formM", "countries", "amountLeft"));
        }

/**
 * dashboard_add method
 *
 * @return void
 */
	public function dashboard_add() {
            $this->_add(false);
	}
        
        public function popup_add()
        {
            $this->_add(true);
        }
        
        private function _add($isPopup)
        {
            if ($this->request->is('post'))
                {
                    debug($this->request->data);
                    //die();

                    $registrationDate = $this->request->data['FormM']['registration_date'];
                    $expirationDate = $this->request->data['FormM']['expiration_date'];
                    
                    $loadingPortId = $this->request->data['FormM']['loading_port_id'];
                    $dischargePortId = $this->request->data['FormM']['discharge_port_id'];
                    
                    if(strtotime($registrationDate) < strtotime($expirationDate))
                    {
                        //registrationDate is before expiration date                    
                        
                        $this->Seller->create();
                        $this->Good->create();

                        //save seller and good information
                        if($this->Seller->save($this->request->data) && $this->Good->save($this->request->data))
                        {
                            $this->FormM->create();

                            //make formM reference seller and goods
                            $this->FormM->set(array(
                                "seller_id" => $this->Seller->id,
                                "good_id" => $this->Good->id,
                                "customer_id" => $this->Auth->user("id")
                            ));

                            //set default FormM name if empty
                            if(!($this->request->data['FormM']['name']))
                            {
                                $this->request->data['FormM']['name'] = FormM::getDefaultName();
                            }
                            
                            //save formM
                            if($this->FormM->save($this->request->data))
                            {                            
                                //create and save trade with reference to formM
//                                $this->Trade->create();
//
//                                //more trading data
//                                $tradingData = array(
//                                    "form_m_id" => $this->FormM->id,
//                                    "customer_id" => $this->Auth->user("id"),
//                                    "date_added" => date("Y-m-d H:i"),
//                                    "expiry_date" => $this->request->data['FormM']['expiration_date']
//                                );

                                //everything went well

                                //dispatch notification to admin
//                                $cakeEvent = new CakeEvent("Admin.onFormMCreated", $this, array("formMId" => $this->FormM->id));
//                                $this->getEventManager()->dispatch($cakeEvent);

                                //redirect back
                                $this->Session->setFlash(__('Your FormM has been created.'));
                                if($isPopup)
                                {
                                    $formMId = $this->FormM->id;
                                    $formMName = $this->FormM->field("name");
                                    $this->set(compact("formMId", "formMName"));
                                    $this->render("popup_add_success");
                                }
                                else
                                {
                                    return $this->redirect(array('action' => 'index'));
                                }
                            }
                            else
                            {
                                //unable to create form
                                $this->Session->setFlash(__('The FormM could not be saved. Please, try again.1'));
                            }

                        }
                        else
                        {
                            //error saving seller and good information
                            $this->Session->setFlash(__('The FormM could not be saved. Please, try again.2'));
//                            var_dump($this->Seller->validationErrors);
//                            var_dump($this->Good->validationErrors);
//                            die();
                        }
                    }
                    else
                    {
                        //Inappropriate expiration date /this should be moved to the front end
                        $this->Session->setFlash(__("Expiration Date must be after Registration Date"));
                    }
		}
		
                $sellers = $this->FormM->Seller->find('all');
		$goods = $this->FormM->Good->find('all');
                $countries = $this->Country->find("all");
		$this->set(compact('sellers', 'goods', 'countries'));
        }

/**
 * dashboard_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function dashboard_edit($id = null) {
            $this->_edit($id, false);
//            $this->redirect(array("action"=>"index"));
	}
        
        public function admin_edit($id = null)
        {
            $this->_edit($id, true);
        }
        
        private function _edit($id, $isAdmin)
        {
            if (!$this->FormM->exists($id)) {
			throw new NotFoundException(__('Invalid form m'));
		}
                
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FormM->save($this->request->data)) {
				$this->Session->setFlash(__('Form M has been updated successfully.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The form m could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FormM.' . $this->FormM->primaryKey => $id));
			$this->request->data = $this->FormM->find('first', $options);
		}
                
                $conditions = array('FormM.' . $this->FormM->primaryKey => $id);
            
                if(!$isAdmin)
                {
                    $conditions = array_merge($conditions, array("OR" => array(
                        "Trade.customer_id" => $this->Auth->user("id"), //for backward compatibility for when customer_id was not specified for FormM
                        "FormM.customer_id" => $this->Auth->user("id")
                            )));

                }
                
                $options = array('conditions' => $conditions,
                "fields" => array("FormM.*", "Seller.*", "Good.*", "LoadingPort.*", "DischargePort.*", "Trade.*"),
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
                        array(
                            'table' => 'trades',
                            'alias' => 'Trade',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Trade.form_m_id = FormM.id'
                            )
                        ),
                    ));
                
                $formM = $this->FormM->find("first", $options);
                
		$this->set("formM", $formM);
        }

/**
 * dashboard_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function dashboard_delete($id = null) {
            $this->_delete($id, false);
	}
        
        private function _delete($id, $isAdmin)
        {
            $this->FormM->id = $id;
                
            $conditions = array('FormM.' . $this->FormM->primaryKey => $id);
            
            if(!$isAdmin)
            {
                $conditions = array_merge($conditions, array('Trade.customer_id' => $this->Auth->user("id")));
            }
            
            $count = $this->Trade->find("count", array(
                "conditions" => $conditions
            ));
            if ($count == 0) {
                    throw new NotFoundException(__('Invalid Form m'));
            }
            
//            $this->request->onlyAllow('post', 'delete');
//            if ($this->FormM->delete()) {
//                    $this->Session->setFlash(__('The form m has been deleted.'));
//            } else {
                    $this->Session->setFlash(__('The form m could not be deleted. Please, try again.'));
//            }
            return $this->redirect(array('action' => 'index'));
        }
        
        public function dashboard_renew($id = null)
        {
            $this->FormM->id = $id;
            
            if(!$this->FormM->exists())
            {
                throw new NotFoundException(__('Invalid Form M'));
            }
            
            $formM = $this->FormM->find("first", array(
               "conditions"  => array(
                   "FormM.id" => $id,
                   'FormM.customer_id' => $this->Auth->user("id")
               )
            ));

            debug($formM);
            
            if($this->request->is("post"))
            {
                $newExpiryDate = strtotime($this->request->data['FormM']['expiration_date']);
                $oldExpiryDate = strtotime($formM['FormM']['expiration_date']);
                $registrationDate = strtotime($formM['Form']['registration_date']);
                $oldValidityPeriod = $oldExpiryDate - $registrationDate;
                $newValidityPeriod = $newExpiryDate - $oldExpiryDate;
                $renewalCount = $formM['FormM']['renewal_count'];
                $renewalCount++;

               // echo $oldExpiryDate."<br/>".$newExpiryDate;
                
                if($newExpiryDate > $oldExpiryDate and $newValidityPeriod <= $oldValidityPeriod and $renewalCount < 2)
                {
                    if($this->FormM->save($this->request->data))
                    {
                        $this->Session->setFlash(__("'".$formM['FormM']['name']."' has been successfully renewed."));
                        $this->redirect(array('action' => 'index'));
                    }
                    else
                    {
                        $this->Session->setFlash(__('Unable to renew Form M. Try again'));
                    }
                }
                else
                {
                    $this->Session->setFlash(__('New Expiry date must be after current Expiry date'));
                }
            }
            
            $this->set(compact("formM"));
        }
}