<?php
App::uses('AppModel', 'Model');

class Setting extends AppModel
{

    /**
     * Use database SQLite.
     *
     * @var string
     * @access public
     */
    public $useDbConfig = 'database';

    /**
     * Key configure.
     *
     * @var string
     * @access public
     */
    public $key = 'General';

    /**
     * @inheritdoc
     */
    public $validate = array(
        'key'   => array(
            'rule' => 'checkSettingKey'
        ),
        'value' => array(
            'checkSettingValue' => array(
                'rule' => 'checkSettingValue'
            )
        )
    );

    /**
     * Lock key change settings.
     *
     * @param array $check Change value
     * @throw NotImplementedException Change the key settings are not supported
     * @access public
     * @return void
     */
    public function checkSettingKey($check)
    {
        throw new NotImplementedException(__('Change the key settings are not supported'));
    }

    /**
     * Check metadata file exists.
     *
     * @param array $check Change value
     * @access public
     * @return bool
     */
    public function checkSettingValue($check) {
        return ( $this->field('key') !== 'metadata' || ( empty( $check[ 'value' ] ) || is_readable( $check[ 'value' ] ) && is_file( $check[ 'value' ] ) ) );
    }

    /**
     * Load of options in the database.
     *
     * @access public
     * @return void
     */
    public function load()
    {
        $settings = $this->find('all', array('fields' => array('id', 'key', 'value')));
        if (!empty($settings)) {
            foreach ($settings as $setting) {
                Configure::write($this->key . '.' . $setting['Setting']['key'], $setting['Setting']['value']);
            }
        }
    }
}
