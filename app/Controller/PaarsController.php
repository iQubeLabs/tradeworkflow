<?php
App::uses('AppController', 'Controller');
App::uses('Paar', 'Model');
/**
 * Paars Controller
 *
 * @property Paar $Paar
 * @property PaginatorComponent $Paginator
 */
class PaarsController extends AppController {

    public $uses = array("Paar", "Document");
    
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

        public function beforeFilter() {
            parent::beforeFilter();
            $this->navInfo['Nav.Paar'] = "active";
        }
        
        /**
         * Initializes paar tracking for this document and redirects to view
         * 
         * @param type $documentId Document Id
         */
        public function dashboard_init($documentId = null)
        {
            $document = $this->Document->find("first", array(
                "conditions" => array(
                    "Document.id" => $documentId,
                    "Trade.customer_id" => $this->Auth->user("id")
                )
            ));
            
            if(count($document) > 0)
            {                
                $paar = $this->Paar->findByTradeId($document['Document']['trade_id']);
                
                if(count($paar))
                {
                    //paar processing already exists for this trade
                    $this->set("paarExists", true);
                    $this->set("paarId", $paar['Paar']['id']);
                }
                else
                {
                    $this->set("paarExists", false);
                    
                    if($this->request->is("post"))
                    {
                        //attempt saving
                        $this->Paar->create();
                        $data = array(
                            "action" => Paar::ACTION_PENDING,
                            "description" => Paar::$ENUM_DESC[Paar::ACTION_PENDING],
                            "customer_id" => $this->Auth->user("id"),
                            "trade_id" => $document['Trade']['id']
                        );
                        
                        if($this->Paar->save($data))
                        {
                            $this->redirect(array("controller" => "paars", "action" => "view", $this->Paar->id));
                        }
                        else
                        {
                            $this->Session->setFlash("Unable to initialize Paar Tracking. Try again.");
                        }
                    }
                }
                
                $this->set("document", $document);
            }
            else
            {
                throw new NotFoundException(__("Invalid Document Id"));
            }
        }
        
/**
 * dashboard_index method
 *
 * @return void
 */
	public function dashboard_index($status = null) {
		$this->Paar->recursive = 0;
		$this->set('paars', $this->Paginator->paginate());
                
                $this->_index($status, false);
	}
        
        private function _index($status, $isAdmin)
        {
            if(is_null($status))
                $status = "all";
        
            //setup navigation
            $this->navInfo["Nav.Paar.".$status] = "active";
        
            switch ($status){
                case "progress":
                    $navTitle = "In Progress";
                    $conditions = array("Paar.action" => Paar::ACTION_PENDING);
                    break;
                case "done":
                    $navTitle = "Finished";
                    $conditions = array("Paar.action" => Paar::ACTION_COMPLETED);
                    break;
                case "cancelled":
                    $navTitle = "Cancelled";
                    $conditions = array("Paar.action" => Paar::ACTION_CANCELLED);
                    break;
                case "all":
                default:
                    $navTitle = "All";
                    $conditions = array();
            }
            
            if(!$isAdmin)
            {
                $conditions = array_merge($conditions, array("Paar.customer_id" => $this->Auth->user("id")));
            }
            
            $paars = $this->Paar->find("all", array(
                "conditions" => $conditions,
                "fields" => array("Paar.*", "Customer.*", "Trade.*", "FormM.*"),
                "joins" => array(
                        array(
                            'table' => 'trades',
                            'alias' => 'TradeJoin',
                            'type' => 'INNER',
                            'conditions' => array(
                                'Paar.trade_id = TradeJoin.id'
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
            
            $this->set("paars", $paars);
            $this->set("navTitle", $navTitle);
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
            $conditions = array('Paar.' . $this->Paar->primaryKey => $id);            
            if(!$isAdmin)
            {
                $conditions = array_merge($conditions, array("Paar.customer_id" => $this->Auth->user("id")));
            }
            
            $options = array(
                "conditions" => $conditions,
                "fields" => array("Paar.*", "Customer.*", "Trade.*", "FormM.*"),
                "joins" => array(
                        array(
                            'table' => 'trades',
                            'alias' => 'TradeJoin',
                            'type' => 'INNER',
                            'conditions' => array(
                                'Paar.trade_id = TradeJoin.id'
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
                );
            
            $paar = $this->Paar->find('first', $options);
            if(count($paar))
            {
                $this->set('paar', $paar);
            }
            else
            {
                //paar doesn't exist or doesn't belong to this user
                throw new NotFoundException(__('Invalid paar'));
            }
        }
        
/**
 * dashboard_add method
 *
 * @return void
 */
	public function dashboard_add() {
		if ($this->request->is('post')) {
			$this->Paar->create();
			if ($this->Paar->save($this->request->data)) {
				$this->Session->setFlash(__('The paar has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The paar could not be saved. Please, try again.'));
			}
		}
		$accounts = $this->Paar->Account->find('list');
		$this->set(compact('accounts'));
	}

/**
 * dashboard_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function dashboard_edit($id = null) {
            
            $conditions = array(
                'Paar.' . $this->Paar->primaryKey => $id,
                "Paar.customer_id" => $this->Auth->user("id")
                );
            
            $options = array(
                "conditions" => $conditions
                );
            
            $paarCount = $this->Paar->find('count', $options);
            if($paarCount > 0)
            {
//                $this->set('paar', $paar);
                $action = $this->request->query("action");
            
                if($action != false)
                {
                    //an action update was requested
                    
                    $this->Paar->id = $id;
                    if(array_key_exists($action, Paar::$ENUM_ACTION))
                    {
                        if($this->Paar->save(array("action" => $action, "description" => Paar::$ENUM_DESC[$action])))
                        {
                            $this->Session->setFlash("Status update successful");
                        }
                        else
                        {                            
                            $this->Session->setFlash("Unable to update status. Try again");
                        }
                    }
                    else
                    {
                        $this->Session->setFlash("Invalid action requested");
                    }
                    
                    $this->redirect($this->request->referer());
                }
                else
                {
                    //perform normal rendering
                }
            }
            else
            {
                //paar doesn't exist or doesn't belong to this user
                throw new NotFoundException(__('Invalid paar'));
            }
            
//		if ($this->request->is(array('post', 'put'))) {
//			if ($this->Paar->save($this->request->data)) {
//				$this->Session->setFlash(__('The paar has been saved.'));
//				return $this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The paar could not be saved. Please, try again.'));
//			}
//		} else {
//			$options = array('conditions' => array('Paar.' . $this->Paar->primaryKey => $id));
//			$this->request->data = $this->Paar->find('first', $options);
//		}
//		$accounts = $this->Paar->Account->find('list');
//		$this->set(compact('accounts'));
	}

/**
 * dashboard_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function dashboard_delete($id = null) {
		$this->Paar->id = $id;
		if (!$this->Paar->exists()) {
			throw new NotFoundException(__('Invalid paar'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Paar->delete()) {
			$this->Session->setFlash(__('The paar has been deleted.'));
		} else {
			$this->Session->setFlash(__('The paar could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function admin_index($status)
        {
            $this->_index($status, true);
        }
        
}

        