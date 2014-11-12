<?php

App::uses('AppModel', 'Model');

/**
 * FormM Model
 *
 * @property Seller $Seller
 * @property LoadingPort $LoadingPort
 * @property DischargePort $DischargePort
 * @property Good $Good
 * @property Trade $Trade
 */
class FormM extends AppModel {

    /**
     * Use table
     *
     * @var mixed False or table name
     */
    public $useTable = 'form_m';

    /**
     * Enum for mode_of_payment
     */
    public static $ENUM_MODE_OF_PAYMENT = array(
        1 => "Letter of credit",
        2 => "Bill for collection",
        3 => "Advance payment/Non Valid",
        4 => "Bank Payment Obligation"
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Seller' => array(
            'className' => 'Seller',
            'foreignKey' => 'seller_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Good' => array(
            'className' => 'Good',
            'foreignKey' => 'good_id',
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
        'Trade' => array(
            'className' => 'Trade',
            'foreignKey' => 'form_m_id',
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

    public function getExpiringSoon($customerId) {
        $result = array();
        $format = "Y-m-d";
        $today = time();

        $orderBy = array(
                "FormM.expiration_date" => "ASC"
            );
        
        $monthsTime = date($format, strtotime("+30 day", $today));
        $threeWeeksTime = date($format, strtotime("+21 day", $today));
        $twoWeeksTime = date($format, strtotime("+14 day", $today));
        $oneweeksTime = date($format, strtotime("+7 day", $today));
        
        $result['month'] = $this->find("all", array(
            "conditions" => array(
                "DATE(FormM.expiration_date) =" => $monthsTime,
                "Trade.customer_id" => $customerId
            ),
            "joins" => array(
                    array(
                        'table' => 'trades',
                        'alias' => 'Trade',
                        'type' => 'INNER',
                        'conditions' => array(
                            'FormM.id = Trade.form_m_id'
                        )
                    )),
            "order" => $orderBy)
        );
        
        $result['threeWeeks'] = $this->find("all", array(
            "conditions" => array(
                "DATE(FormM.expiration_date) =" => $threeWeeksTime,
                "Trade.customer_id" => $customerId
            ),
            "joins" => array(
                    array(
                        'table' => 'trades',
                        'alias' => 'Trade',
                        'type' => 'INNER',
                        'conditions' => array(
                            'FormM.id = Trade.form_m_id'
                        )
                    )),
            "order" => $orderBy)
        );
        
        $result['twoWeeks'] = $this->find("all", array(
            "conditions" => array(
                "DATE(FormM.expiration_date) =" => $twoWeeksTime,
                "Trade.customer_id" => $customerId
            ),
            "joins" => array(
                    array(
                        'table' => 'trades',
                        'alias' => 'Trade',
                        'type' => 'INNER',
                        'conditions' => array(
                            'FormM.id = Trade.form_m_id'
                        )
                    )),
            "order" => $orderBy)
        );
//        echo $oneweeksTime;
        $result['oneWeek'] = $this->find("all", array(
            "conditions" => array(
                "DATE(FormM.expiration_date) <=" => $oneweeksTime,
                "DATE(FormM.expiration_date) >" => date($format),
                "Trade.customer_id" => $customerId
            ),
            "joins" => array(
                    array(
                        'table' => 'trades',
                        'alias' => 'Trade',
                        'type' => 'INNER',
                        'conditions' => array(
                            'FormM.id = Trade.form_m_id'
                        )
                    )
            ),
            "order" => $orderBy)
        );
        
        return $result;
    }

    public function getAllExpiringThisMonth()
    {
        $format = "Y-m-d";
        $today = date($format);        
        //only runs if it is the first day of the month
        if(date("Y-m-01") == $today)
        {
            $monthsTime = date($format, strtotime("+30 day"));
            $orderBy = array(
                "FormM.expiration_date" => "ASC"
            );
            $expiringFormMs = $this->find("all", array(
                "conditions" => array(
                    "DATE(FormM.expiration_date) <=" => $monthsTime,
                    "DATE(FormM.expiration_date) >" => $today
                ),
                "order" => $orderBy)
            );
            
            return $expiringFormMs;
        }
        
        return array();
    }
    
    public function getAllExpiringToday()
    {
        $today = date("Y-m-d");
        $expiringFormMs = $this->find("all", array(
                "conditions" => array(
                    "DATE(FormM.expiration_date) =" => $today
                )
            )
        );
        return $expiringFormMs;
    }
    
    public static function getDefaultName()
    {
        return "Form M - ".date("j M Y");
    }
}