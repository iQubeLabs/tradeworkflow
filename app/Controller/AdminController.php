<?php

App::uses("AppController", "Controller");
/**
 * Description of DashboardController
 *
 * @author perfectmak
 */
class AdminController extends AppController{
    
    public $uses = array();
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = "dashboard";
        
        $this->Auth->allow("index");
    }
    
    public function index()
    {                    
        $this->redirect(array("controller"=>"shippings",
            "action"=>"index", "admin" => true));
    }
    
    public function admin_signout()
    {
        $this->redirect($this->Auth->logout());
    }
}

?>
