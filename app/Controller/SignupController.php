<?php
App::uses("AppController", "Controller");
App::uses('CakeEvent', 'Event');

/**
 * Description of SignupController
 *null
 * @author perfectmak
 */
class SignupController extends AppController{
    
    public $uses = array("Customer");
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow("index");
    }
    
    public function index()
    {
        $this->layout = "plain";
        
        if($this->Auth->loggedIn())
        {
            $this->redirect($this->Auth->redirectUrl());
        }
        
        if($this->request->is("post"))
        {
            $this->Customer->create();
            
            if($this->Customer->save($this->request->data))
            {
                //save was successful
                if($this->Auth->login())
                {
                    // send mail to user
                    $event = new CakeEvent("Customer.onSignup", $this, array('email' => $this->Auth->user('email')));
                    $this->getEventManager()->dispatch($event);
                    
                    $this->redirect($this->Auth->redirectUrl());
                }
                else
                {                    
                    $this->Session->setFlash(__("Unable to login"));
                }
            }
            else
            {
                //save was not successful
                if(isset($this->Customer->validationErrors['email']))
                {
                    $this->Session->setFlash(__($this->Customer->validationErrors['email'][0]));
                }
                else if(isset($this->Customer->validationErrors['phone']))
                {
                    $this->Session->setFlash(__($this->Customer->validationErrors['phone'][0]));
                }
                else
                {
                    $this->Session->setFlash(__("Error signing you up"));
                }
            }
        }
    }
}

?>
