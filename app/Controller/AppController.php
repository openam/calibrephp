<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 * @property Setting $Setting
 */
class AppController extends Controller {

	public $paginate = array();

	public $components = array(
		'DebugKit.Toolbar',
		'RequestHandler',
		'Session',
        'Cookie',
        'Auth' => array(
            'unauthorizedRedirect' => array(
                'controller' => '',
                'action' => 'index'
            ),
            'authorize' => array('Controller')
        )
	);

	public $helpers = array(
		'Html'      => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form'      => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);

    /**
     * @inheritdoc
     */
    public $uses = array('Setting');

    /**
     * @inheritdoc
     */
    public function beforeFilter() {
		$this->Auth->flash['element'] = 'Flash/error';
        $this->Setting->load();

        $this->_applyMetadata();
        $this->_setLanguage();

        $locale = $this->Session->read('Config.language');
        if ($locale
            && file_exists(APP . 'View' . DS . $locale . DS . $this->viewPath . DS . $this->view . $this->ext)) {
            $this->viewPath = $locale . DS . $this->viewPath;
        }

        $this->Auth->authError = __('You must be logged in to view this page.');
        $this->set('loggedIn', $this->Auth->loggedIn());
    }

    /**
     * Check if the provided user is authorized for the request.
     *
     * Uses the configured Authorization adapters to check whether or not a user is authorized.
     * Each adapter will be checked in sequence, if any of them return true, then the user will
     * be authorized for the request.
     *
     * @param array $user The user to check the authorization of. If empty the user in the session will be used.
     * @param CakeRequest $request The request to authenticate for. If empty, the current request will be used.
     * @return boolean True if $user is authorized, otherwise false
     */
    public function isAuthorized($user = null, CakeRequest $request = null) {
        return (true);
    }

    /**
     * Change language for user interface.
     *
     * @access public
     * @return void
     */
    public function _setLanguage() {
        $usedLanguage = $this->Session->check('Auth.User.language')
            ? $this->Session->read('Auth.User.language') : $this->Cookie->read('language');

        if (empty($usedLanguage) || !in_array($usedLanguage, array('en', 'ru'))) {
            $usedLanguage = Configure::read('General.language');
        }

        if ($usedLanguage !== $this->Cookie->read('language')) {
            $this->Cookie->write('language', $usedLanguage, false, '120 days');
        }
        $this->Session->write('Config.language', $usedLanguage);
    }

    /**
     * Change path metadata database.
     *
     * @access public
     * @return void
     */
    public function _applyMetadata() {
        $dbConfig = ConnectionManager::getDataSource('default')->config;
        $userMetadata = Configure::read('General.metadata');

        if (!empty($userMetadata) && $dbConfig['database'] !== $userMetadata) {
            $dbConfig['database'] = $userMetadata;
            ConnectionManager::drop('default');
            ConnectionManager::create('default', $dbConfig);
        }
    }
}
