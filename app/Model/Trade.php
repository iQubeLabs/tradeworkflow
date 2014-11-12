<?php
App::uses('AppModel', 'Model');
/**
 * Trade Model
 *
 * @property Customer $Customer
 * @property FormM $FormM
 * @property Document $Document
 * @property Shipping $Shipping
 */
class Trade extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */

	public $name = 'Trade';
	public $validate = array(
		'date_of_shipment' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'expected_arrival_time' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'quantity' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			)
		),
		'unit_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			)
		),
		'amount' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			)
		),
		'shipping_line' => array(
			'Not Empty' => array(
				'rule' => array('notEmpty'),
			)
		),
		'vassel_name' => array(
			'Not Empty' => array(
				'rule' => array('notEmpty'),
			)
		),
		'customer_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'form_m_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
		'FormM' => array(
			'className' => 'FormM',
			'foreignKey' => 'form_m_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Unit' => array(
			'className' => 'Unit',
			'foreignKey' => 'unit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Document' => array(
			'className' => 'Document',
			'foreignKey' => 'trade_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Shipping' => array(
			'className' => 'Shipping',
			'foreignKey' => 'trade_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public function getNearlyArrivedShipments($customerId)
	{
		$result = array();
		$format = "Y-m-d";
		$today = time();

		$orderBy = array(
				"Trade.expected_arrival_time"
			);

		$monthsTime = date($format, strtotime("+30 days", $today));
		$threeWeeksTime = date($format, strtotime("+21 days", $today));
		$twoWeeksTime = date($format, strtotime("+14 days", $today));
		$oneWeeksTime = date($format, strtotime("+7 days", $today));

		$r = $this->find("all",array(
			"conditions" => array(
				"DATE(Trade.expected_arrival_time) =" => $monthsTime,
				"Trade.customer_id" => $customerId
				),
			"order" => $orderBy
			)
		);

		// if (count($r)) {
			$result['month'] = $r;
		// }

		$r = $this->find("all",array(
			"conditions" => array(
				"DATE(Trade.expected_arrival_time) =" => $threeWeeksTime,
				"Trade.customer_id" => $customerId
				),
			"order" => $orderBy
			)
		);

		// if (count($r)) {
			$result['threeWeeks'] = $r;
		// }

		$r = $this->find("all",array(
			"conditions" => array(
				"DATE(Trade.expected_arrival_time) =" => $twoWeeksTime,
				"Trade.customer_id" => $customerId
				),
			"order" => $orderBy
			)
		);

		// if (count($r)) {
			$result['twoWeeks'] = $r;
		// }

		$r = $this->find("all",array(
			"conditions" => array(
				"DATE(Trade.expected_arrival_time) <=" => $oneWeeksTime,
				"DATE(Trade.expected_arrival_time) >" => date($format),
				"Trade.customer_id" => $customerId
				),
			"order" => $orderBy
			)
		);

		// if (count($r)) {
			$result['oneWeek'] = $r;
		// }

		return $result;
	}

    public static function getDefaultName()
    {
        return "Trade - ".date("Y-m-d H:i");
    }
}
