<?php
App::uses("AppController", "Controller");
App::uses("Notification", "Model");

/**
 * Description of NotificationsController
 *
 * @author perfectmak
 */
class NotificationsController extends AppController
{
    public $uses = array();
    
    public function dashboard_clearAll($token = null)
    {
        if(!is_null($token))
        {
            $this->Notification->updateAll(array(
                "Notification.seen" => 1
            ), array(
                "Notification.customer_id" => $this->Auth->user("id")
            ));
        }
        $this->redirect($this->referer(Router::url(array("controller"=>"dashboard","action"=>"index"), true)));
    }
    
    public function admin_clearAll($token = null)
    {
        if(!is_null($token))
        {
            $this->Notification->updateAll(array(
                "Notification.seen" => 1
            ), array(
                "Notification.type >=" => 500
            ));
        }
        $this->redirect($this->referer(Router::url(array("controller"=>"dashboard","action"=>"index"), true)));
    }
}

?>
