<?php
/**
 * SettingFixture
 *
 */
class SettingFixture extends CakeTestFixture {

    /**
     * Fields
     *
     * @var array
     */
    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'key' => 'primary'),
        'key' => array('type' => 'text', 'null' => false),
        'value' => array('type' => 'text', 'null' => true),
        'indexes' => array(
            'PRIMARY' => array('column' => 'key', 'unique' => 1)
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
            'key' => 'language',
            'value' => 'en'
        ),
        array(
            'id' => 2,
            'key' => 'metadata',
            'value' => '../metadata.db'
        ),
        array(
            'id' => 3,
            'key' => 'auth',
            'value' => '0'
        )
    );

}
