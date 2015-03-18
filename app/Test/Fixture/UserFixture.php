<?php
/**
 * UserFixture
 *
 */
class TagFixture extends CakeTestFixture {

    /**
     * Fields
     *
     * @var array
     */
    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'key' => 'primary'),
        'username' => array('type' => 'text', 'null' => false),
        'password' => array('type' => 'text', 'null' => false),
        'role' => array('type' => 'text', 'null' => false),
        'created' => array('type' => 'timestamp', 'null' => true, 'default' => 'CURRENT_TIMESTAMP'),
        'modified' => array('type' => 'timestamp', 'null' => true, 'default' => 'CURRENT_TIMESTAMP'),
        'token' => array('type' => 'text', 'null' => false),
        'deny' => array('type' => 'text', 'null' => true),
        'language' => array('type' => 'text', 'null' => false),
        'indexes' => array(
            'users_idx' => array('column' => 'username', 'unique' => 1)
        ),
        'tableParameters' => array()
    );

    /**
     * Records
     *
     * @var array
     */
    public $records = array(
        array(
            'id' => 1,
            'name' => 'admin',
            'password' => '7f8d49ccf1392c8b2054623adf7cf396744edeb3',
            'role' => 'admin',
            'token' => '07cb52e8e776e69d6f99874995ca43fa04d9cfc4',
            'language' => 'en'
        ),
        array(
            'id' => 2,
            'name' => 'user',
            'password' => '7f8d49ccf1392c8b2054623adf7cf396744edeb3',
            'role' => 'user',
            'token' => '3e4978d0d684c1710b100db81cf7d8c379b9e796',
            'language' => 'en'
        ),
        array(
            'id' => 3,
            'name' => 'children',
            'password' => '7f8d49ccf1392c8b2054623adf7cf396744edeb3',
            'role' => 'user',
            'token' => '605afc591d0db1633042dcc4d5c998db7e61fbee',
            'deny' => 'Erotica, +18',
            'language' => 'en'
        )
    );

}
