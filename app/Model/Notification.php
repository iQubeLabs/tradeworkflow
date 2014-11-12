<?php
App::uses('AppModel', 'Model');
App::uses('Router', '');
/**
 * Notification Model
 *
 * @property Customer $Customer
 */
class Notification extends AppModel {
    
    const TYPE_SHIPPING_UPDATE = "shipping_update";
    const TYPE_DOCUMENT_UPDATE = "document_update";    
    const TYPE_SHIPPING_CREATED = "shipping_created";
    const TYPE_DOCUMENT_CREATED = "document_created";
    
    public static $ENUM_TYPE = array(
        self::TYPE_SHIPPING_UPDATE => 0,
        self::TYPE_DOCUMENT_UPDATE => 1,
        self::TYPE_SHIPPING_CREATED => 500,
        self::TYPE_DOCUMENT_CREATED => 501
    );
    
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'created';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'customer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        public function saveNotification($customerId, $info, $link, $type)
        {            
            $data = array(
              "customer_id" => $customerId,
                "info" => $info,
                "link" => $link,
                "type" => $type
            );            
            
            $this->save($data);
            
        }
        
        public function markAsRead($id, $token)
        {
            $this->id = $id;
            
            if(!$this->exists())
            {
                return false;
            }
            
            $notification = $this->findById($id);
            
            if(md5($notification['Notification']['customer_id']) !== $token && $notification['Notification']['customer_id'] !== null)
                return false;
            
            //all correct so mark as read
            $this->set(array(
               "seen" => 1
            ));
            
            return $this->save();
        }
        
        public static function appendParam($url, $id, $customerId)
        {
            return $url."?notifId=".$id."&token=".md5($customerId);
        }
}
