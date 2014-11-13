<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses("AppController", "Controller");
App::uses('CakeEvent', 'Event');

App::uses("FormM", "Model");
App::uses("Paar", "Model");
App::uses("Document", "Model");

/**
 * Description of DocumentsController
 *
 * @author perfectmak
 */
class DocumentsController extends AppController
{
    public $uses = array( "Document", "FormM", "Trade", "Courier", "Paar");
 
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->navInfo['Nav.Document'] = "active";
    }

    /*public function dashboard_test() 
    {
        $document = $this->Document->getDocumentsArrived();
        debug($document);
        die();
    }*/
    
    public function dashboard_index($status = null)
    {
        $this->_index($status, false);
    }
    
    public function dashboard_view($id = null)
    {
        $this->_view($id, false);
    }
    
    public function dashboard_init($tradeId = null)
    {        
        if($tradeId != null)
        {
            if($this->request->is("post"))
            {
                
                if($this->Courier->save($this->request->data))
                {
                    $this->request->data['Document']['courier_id'] = $this->Courier->id;
//                    var_dump($this->request->data);
//                    die();
                    $this->Document->create();
                    if($this->Document->save($this->request->data))
                    {
                        $this->getEventManager()->dispatch(new CakeEvent("Admin.onDocumentCreated", $this, array(
                            "documentId" => $this->Document->id
                        )));
                        
                        $this->Session->setFlash("Your Document Tracking will be initiated. You will be notified when courier status is gotten.");
                        $this->render("dashboard_init_success");
//                        return;
                    }                    
                }
                else
                {
                    $this->Session->setFlash("We are unable to initialize the Document Tracking. Try again.");
                }
            }
            
            //load shipping Info
            $trade = $this->Trade->find("first", array(
                "conditions" => array("Trade.id" => $tradeId,
                    "Trade.customer_id" => $this->Auth->user("id"))
            ));

            if(count($trade) == 0)
            {
                $this->Session->setFlash("This Shipping doesn't exist");
                $this->set("error", true);
            }
            else
            {
                //$tradeId = $shipping['Trade']['id'];
                
                //Also check if document has been initialized for this trade
                $document = $this->Document->find("first", array(
                    "conditions" => array("Document.trade_id" => $tradeId)
                ));
                
                if(count($document) > 0)
                {
                    if(strtotime($shipping["Shipping"]["shipping_date"]) < 0)
                    {
                        $this->Session->setFlash("Your Shipping is being processed. You will be notified when a Shipping date has been confirmed.");
                    }
                    else
                    {
                        $this->Session->setFlash("Document Tracking for this trade is already in progress.");
                    }                
                    $this->render("dashboard_init_success");
//                    return;
                }
                else
                {                
                    //TODO: also check if it has expired
                    $this->set("error", false);
                    $this->set("trade", $trade);

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
    
    public function admin_index($status = null)
    {
        $this->_index($status, true);
    }
    
    public function admin_view($id= null)
    {
        $this->_view($id, true);
    }
    
    private function _view($id, $isAdmin)
    {
        $this->Document->id = $id;
        
        if(!$this->Document->exists())
        {
            $this->redirect(array("action" => "index"));
        }
        
        if($this->request->is("post"))
        {
           /* $email = (!is_null($this->Auth->user('email'))) ? 'Null' : 'Not Null';
            echo $email;
            die('ends here');*/
            if($this->Document->save($this->request->data))
            {
                $cakeEvent = new CakeEvent("Customer.onDocumentUpdated", $this, array("documentId" => $id));
                $this->getEventManager()->dispatch($cakeEvent);
                $this->Session->setFlash("Courier status has been updated. The trader will be notified.");
            }
            else
            {
                //error could not update Document
                $this->Session->setFlash("Error Updating. Try again.");
            }
        }
        $conditions = array("Document.id" => $id);
        
        if(!$isAdmin)
        {
            $conditions = array_merge($conditions, array("Trade.customer_id" => $this->Auth->user("id")));
        }
        
        $document = $this->Document->find("first", array(
            "conditions" => $conditions,
            "fields" => array("Document.*", "Courier.*", "Trade.*", "FormM.*", "Paar.*"),
            "joins" => array(
                    array(
                        'table' => 'trades',
                        'alias' => 'TradeJoin',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Document.trade_id = TradeJoin.id'
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
                        'table' => 'paars',
                        'alias' => 'Paar',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Paar.trade_id = TradeJoin.id'
                        )
                    )
                )
        ));

        //debug($document);
        
        $this->set("document", $document);
    }
    
    private function _index($status, $isAdmin)
    {
        if(is_null($status))
        {
            $status = "all";
        }
        
        $this->navInfo['Nav.Document.'.$status] = "active";
        
        switch ($status) {
            case "progress":
                $conditions = array(
                  "Document.status" => Document::IN_TRANSIT
                );
                break;
            case "done":
                $conditions = array(
                  "Document.status" => Document::ARRIVED
                );
                break;
            case "all":                
            default:
                $conditions = array();
                break;
        }
        
        if(!$isAdmin)
        {
            $conditions = array_merge($conditions, array("Trade.customer_id" => $this->Auth->user("id")));
        }
        
        $documents = $this->Document->find("all", array(
            "conditions" => $conditions,
            "fields" => array("Document.*", "Courier.*", "Trade.*", "FormM.*", "Paar.*"),
            "joins" => array(
                    array(
                        'table' => 'trades',
                        'alias' => 'TradeJoin',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Document.trade_id = TradeJoin.id'
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
                        'table' => 'paars',
                        'alias' => 'Paar',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Paar.trade_id = TradeJoin.id'
                        )
                    )
                )
        ));

        debug($documents);
        
        $this->set("documents", $documents);
    }
}