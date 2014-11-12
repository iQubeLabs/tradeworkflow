<?php
App::uses('AppModel', 'Model');
/**
 * Paar Model
 *
 * @property Account $Account
 */
class Paar extends AppModel {

    const ACTION_UNINITIALIZED = 0; //paar has not started
    const ACTION_PENDING = 1; //paar is in progress
    const ACTION_COMPLETED = 2; //paar has been completed
    const ACTION_CANCELLED = 3; //paar was cancelled
    
    public static $ENUM_ACTION = array(
        self::ACTION_UNINITIALIZED => "Uninitialized",
        self::ACTION_PENDING => "In Progress",
        self::ACTION_COMPLETED => "Completed",
        self::ACTION_CANCELLED => "Cancelled"
    );
    
    public static $ENUM_DESC = array(
        self::ACTION_UNINITIALIZED => "Uninitialized",
        self::ACTION_PENDING => "Paar Tracking is in progress",
        self::ACTION_COMPLETED => "Paar Tracking was completed",
        self::ACTION_CANCELLED => "Paar Tracking was cancelled"
    );

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
		),
                'Trade' => array(
			'className' => 'Trade',
			'foreignKey' => 'trade_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        public function getPendingFor($customerId)
        {
            $threeDays = date("Y-m-d", strtotime("-3 day"));
            $result = $this->find("all", array(
                "conditions"=> array(
                    "Paar.action" => Paar::ACTION_PENDING,
                    "DATE(Paar.created) <=" => $threeDays,
                    "Paar.customer_id"=>$customerId
                )
            ));
            
            return $result;
        }
}
