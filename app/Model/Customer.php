<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * Customer Model
 *
 * @property Trade $Trade
 */
class Customer extends AppModel {
    
    const STATUS_PASSIVE = 0;
    const STATUS_ACTIVE = 1;
    
    /**
     * Enum for Customer status
     */
    public static $ENUM_STATUS = array(
        self::STATUS_PASSIVE => "Passive",
        self::STATUS_ACTIVE => "Active"
    );

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
                'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Invalid email address',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
                            
			),
                        'isUnique' => array(
                                'rule' => array('isUnique'),
                                'message' => 'A user with this email address already exists.',
                        ),
		),
		'phone' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Phone number must not be empty',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                        'isUnique' => array(
                                'rule' => array('isUnique'),
                                'message' => 'A user with this phone number already exists.',
                        ),
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Trade' => array(
			'className' => 'Trade',
			'foreignKey' => 'customer_id',
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
        
        public function beforeSave($options = array()) {
            //hashes password on signup
            if (isset($this->data[$this->alias]['password'])) {
                $passwordHasher = new SimplePasswordHasher();
                $this->data[$this->alias]['password'] = $passwordHasher->hash(
                    $this->data[$this->alias]['password']
                );
            }
            return true;
        }

}
