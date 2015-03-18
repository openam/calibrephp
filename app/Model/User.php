<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishAuthenticate', 'Controller/Component/Auth');

class User extends AppModel {

    /**
     * Use database SQLite.
     *
     * @var string
     * @access public
     */
    public $useDbConfig = 'database';

    /**
     * @inheritdoc
     */
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'user')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        ),
        'language' => array(
            'valid' => array(
                'rule' => array('inList', array('ru', 'en')),
                'message' => 'Please enter a valid language',
                'allowEmpty' => false
            )
        )
    );

    /**
     * Use hashing user password.
     *
     * @inheritdoc
     */
    public function beforeSave($options = array()) {
        $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        $this->data[$this->alias]['token'] = Security::generateAuthKey();
        return (true);
    }
}