<?php
/**
 * Description of LoginController
 *null
 * @author perfectmak
 */
class LoginController extends AppController{
    
    public $uses = array("Customer");
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = "plain";
        $this->Auth->allow("index", "admin_index");
    }
    
    public function index()
    {        
        if($this->Auth->loggedIn())
        {
//            if($this->Auth->user("phone"))
//            {
//                $this->redirect($this->Auth->redirectUrl());
//            }
//            else
//            {
                $this->redirect($this->Auth->logout());
//            }
        }
        
        if($this->request->is("post"))
        {
            if($this->Auth->login())
            {
                $this->redirect($this->Auth->redirectUrl());
            }
            else
            {
                $this->Session->setFlash(__("Incorrect username or password"));
            }
        }
    }
    
    public function admin_index()
    {
        if($this->Auth->loggedIn())
        {
            $this->redirect($this->Auth->logout());
        }
        
        if($this->request->is("post"))
        {
            if($this->Auth->login())
            {
                $this->redirect($this->Auth->redirectUrl());
            }
            else
            {
                $this->Session->setFlash(__("Incorrect username or password"));
            }
        }
    }
}

?>
