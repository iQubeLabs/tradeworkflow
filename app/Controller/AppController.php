<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::uses('NotificationEventListener', 'Event');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    //setup for dashboard users
    public $components = array(
        'Session', 'Auth'
    );
    
    public $uses = array(
      'Notification'  
    );
    
    //for various navigations in Layouts/dashboard.ctp
    public $navInfo = array(
        "Nav.FormM"  => "",
        "Nav.Shipping"  => "",
        "Nav.Document" => "",
        "Nav.Paar" => "",
        "Nav.Clearing" => "",
        "Nav.Demurrage" => ""
    );
 
    public function __construct($request = null, $response = null) {
        parent::__construct($request, $response);
   
        /**
        * Attach event handlers here
        */
        //attaching notification event handler
        $this->getEventManager()->attach(new NotificationEventListener());
    }
    
    public function beforeFilter() {
        parent::beforeFilter();
        $notifications = array();
        
        $notificationId = $this->request->query("notifId");
        $token = $this->request->query("token");        
        if($notificationId && $token)
        {            
            $this->Notification->markAsRead($notificationId, $token);
        }
        
        
        $actionType = substr($this->request->params['action'], 0, 6);
        //change auth to admin auth if an admin action is requested
        if($actionType === "admin_")
        {
            $this->Auth->authenticate = array(
                "Form" => array (
                    "userModel" => "Admin",
                    "fields" => array(
                        "username" => "username",
                        "password" => "password"
                        )
                    )
            );
            $this->Auth->loginAction = array(
              "controller" => "login",
                "action" => "index",
                "admin" => true
            );
            $this->Auth->loginRedirect =  array(
              "controller" => "admin",
                "action" => "index",
                "admin" => false
            );
            
            $this->Auth->logoutRedirect =  array(
              "controller" => "login",
                "action" => "index",
                "admin" => true
            );      
            
            //and also change the default layout
            $this->layout = "admin";
            
            //load notifications
            $notifications = $this->Notification->find("all", array(
                "conditions" => array(
                    "Notification.customer_id" => NULL,
                    "Notification.seen" => 0,
                    "Notification.type >=" => 500 //customer notifications
                    ),
                "order" => array("Notification.created DESC")
            ));
        }
        else if($actionType === "popup_") //for popup views
        {
            $this->layout = "popup";
        }
        else //normal user dashboard request
        {
            $this->Auth->authenticate =  array("Custom");
            
            $this->Auth->loginAction = array(
                'controller' => 'login',
                'action' => 'index',
                'dashboard' => false
            );

            $this->Auth->loginRedirect =  array(
                'controller' => 'dashboard',
                'action' => 'index'
            );

            $this->Auth->logoutRedirect =  array(
                'controller' => 'login',
                'action' => 'index',
                "dashboard" => false
            );

            $this->layout = "dashboard";
            
            //load notifications
            $notifications = $this->Notification->find("all", array(
                "conditions" => array(
                    "Notification.customer_id" => $this->Auth->user("id"),
                    "Notification.seen" => 0,
                    "Notification.type <" => 500 //customer notifications
                    ),
                "order" => array("Notification.created DESC")
            ));
            
            //TODO: verify that the user is actually logged in as dashboard user
        }
        
        //make notification available to dashboard.ctp or admin.ctp
        $this->set("Notification.count", count($notifications));
        $this->set("Notification", $notifications);
        
        //make userinfo available to dashboard.ctp
        $this->set("User.email", $this->Auth->user("email"));
        $this->set("User.phone", $this->Auth->user("phone"));
    }
    
    public function beforeRender() {
        parent::beforeRender();
        
        //set navigation info before rendering view
        foreach($this->navInfo as $key => $value)
        {
            $this->set($key, $value);
        }        
    }
}