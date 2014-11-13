<?php
App::uses('AppModel', 'Model');
/**
 * Document Model
 *
 * @property Courier $Courier
 * @property Trade $Trade
 */
class Document extends AppModel {

    const STATUS_UNKNOWN = 0;
    const IN_TRANSIT = 1;
    const ARRIVED = 2;
    
    public static $ENUM_STATUS = array(
        self::STATUS_UNKNOWN => "Courier Status Unknown (Waiting for confirmation)",
        self::IN_TRANSIT => "Document in transit",
        self::ARRIVED => "Document has arrived"
    );
    
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'courier_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'trade_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
//		'tracking_number' => array(
//			'notEmpty' => array(
//				'rule' => array('notEmpty'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'shipping_date' => array(
//			'datetime' => array(
//				'rule' => array('datetime'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'expected_arrival_date' => array(
//			'datetime' => array(
//				'rule' => array('datetime'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Courier' => array(
			'className' => 'Courier',
			'foreignKey' => 'courier_id',
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
		),
                /*'Shipping' => array(
			'className' => 'Shipping',
			'foreignKey' => 'shipping_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)*/
	);

	public function getDocumentsArrived($id = null){

		$conditions = array(
			'OR' => array(
					'Document.status' => array(1, 2)
			)
		);

		if (!is_null($id)) {
			$conditions = array_merge($conditions, array('Document.id' => $id));
		}

		$arrivedDocuments = $this->find('all', array(
				'conditions' => $conditions,
				'fields' => array('Document.*', 'Trade.*', 'Customer.*', 'Courier.*'),
				'joins' => array(
					array(
						'table' => 'trades',
						'alias' => 'TradeJoin',
						'type' => 'INNER',
						'conditions' => array(
							'Document.trade_id = TradeJoin.id'
						)
					),
					array(
						'table' => 'customers',
						'alias' => 'Customer',
						'type' => 'INNER',
						'conditions' => array(
							'TradeJoin.customer_id = Customer.id'
						)
					)
				)
			)
		);

		return $arrivedDocuments;
	}
}
