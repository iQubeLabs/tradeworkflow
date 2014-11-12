<?php
App::uses('AppModel', 'Model');
/**
 * Shipping Model
 *
 * @property LoadingPort $LoadingPort
 * @property DischargePort $DischargePort
 * @property Trade $Trade
 * @property ShippingLine $ShippingLine
 */
class Shipping extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'loading_port_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'discharge_port_id' => array(
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
		'shipping_line_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'shipping_date' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'expected_arrival_date' => array(
			'datetime' => array(
				'rule' => array('datetime'),
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
		'Trade' => array(
			'className' => 'Trade',
			'foreignKey' => 'trade_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
                "LoadingPort" => array(
                        'className' => 'Port',
                        'foreignKey' => 'loading_port_id',
                        'conditions' => '',
			'fields' => '',
			'order' => ''
                ),
                "DischargePort" => array(
                        'className' => 'Port',
                        'foreignKey' => 'discharge_port_id',
                        'conditions' => '',
			'fields' => '',
			'order' => ''
                ),
		'ShippingLine' => array(
			'className' => 'ShippingLine',
			'foreignKey' => 'shipping_line_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        public function getUpcomingShippingFor($customerId)
        {            
            $result = array();
            $format = "Y-m-d";
            $today = time();

            $orderBy = array(
                    "Shipping.shipping_date" => "ASC"
                );

            $monthsTime = date($format, strtotime("+30 day", $today));
            $threeWeeksTime = date($format, strtotime("+21 day", $today));
            $twoWeeksTime = date($format, strtotime("+14 day", $today));
            $oneweeksTime = date($format, strtotime("+7 day", $today));
            
            $result['month'] = $this->find("all", array(
                "conditions" => array(
                    "DATE(Shipping.shipping_date) =" => $monthsTime,
                    "Trade.customer_id" => $customerId
                ),
                "order" => $orderBy)
            );

            $result['threeWeeks'] = $this->find("all", array(
                "conditions" => array(
                    "DATE(Shipping.shipping_date) =" => $threeWeeksTime,
                    "Trade.customer_id" => $customerId
                ),
                "order" => $orderBy)
            );

            $result['twoWeeks'] = $this->find("all", array(
                "conditions" => array(
                    "DATE(Shipping.shipping_date) =" => $twoWeeksTime,
                    "Trade.customer_id" => $customerId
                ),
                "order" => $orderBy)
            );
    //        echo $oneweeksTime;
            $result['oneWeek'] = $this->find("all", array(
                "conditions" => array(
                    "DATE(Shipping.shipping_date) <=" => $oneweeksTime,
                    "DATE(Shipping.shipping_date) >" => date($format),
                    "Trade.customer_id" => $customerId
                ),
                "order" => $orderBy)
            );

            return $result;
            
//            $shippingsToday = $this->find("all", array(
//               "conditions"  => array(
//                   "Trade.customer_id" => $customerId,
//                   "DATE(Shipping.shipping_date)" => $today
//               )
//            ));
//            
//            return $shippingsToday;
        }
        
        public function getDocumentTrackingsPending()
        {
            $threeDays = date("Y-m-d", strtotime("+3 day"));
            
            $shippings = $this->find("all", array(
                "conditions" => array(
                    "DATE(Shipping.shipping_date) >=" => $threeDays
                ),
                "fields" => array("Shipping.*", "Trade.*", "FormM.*", "ShippingLine.*", "LoadingPort.*", 
                    "DischargePort.*", "Customer.*", "Document.*"),
                "joins" => array(
                    array(
                        'table' => 'trades',
                        'alias' => 'TradeJoin',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Shipping.trade_id = TradeJoin.id'
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
                        'table' => 'customers',
                        'alias' => 'Customer',
                        'type' => 'INNER',
                        'conditions' => array(
                            'TradeJoin.customer_id = Customer.id'
                        )
                    ),
                    array(
                        'table' => 'documents',
                        'alias' => 'Document',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Document.shipping_id = Shipping.id'
                        )
                    )
                )
            ));
            return $shippings;
        }
        
        public function getGoodsToBeClearedSoon($customerId)
        {
            $sevenDays = date("Y-m-d", time() + 3600*24*7);
            $defaultDays = "0000-00-00 00:00:00";
        
            $conditions = array(
                "Trade.customer_id" => $customerId,
                "DATE(Shipping.expected_arrival_date) <=" => $sevenDays,
                "DATE(Shipping.expected_arrival_date) >" => date("Y-m-d"),
                "Shipping.is_cleared" => "0",
                "NOT" => array(
                    "Shipping.expected_arrival_date" => $defaultDays
                )
            );
            
            $result = $this->find("all", array(
               "conditions" => $conditions
            ));
            
            return $result;
        }

                public static function canStartDocumentTracking($shippingDate)
        {
            if((time() - strtotime($shippingDate)) >= (3600*24*3)) //greater than/equal to three days
                return true;
            else
                return false;
        }
}
