<?php
App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController
{

    /**
     * @inheritdoc
     */
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('logout');
    }

    /**
     * Default action.
     *
     * @access public
     * @return void
     */
    public function index()
    {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    /**
     * Action user login.
     *
     * @access public
     * @return bool
     */
    public function login()
    {
        if ($this->Auth->login()) {
            return ($this->redirect($this->Auth->redirectUrl()));
        } else {
            if ($this->request->is('post')) {
                $this->Auth->flash(__('Invalid username or password, try again'));
                return (false);
            }
        }

        // auth guest account
        if (!(bool)Configure::read('General.auth')) {
            $this->Auth->login(array('username' => 'guest'));
            $this->Auth->flash(null);
            return ($this->redirect($this->Auth->redirectUrl()));
        }

        // auth guest account for feed reader
        if ($this->Session->read('Auth.redirect')) {
            parse_str(parse_url($this->Session->read('Auth.redirect'), PHP_URL_QUERY), $query);
            if (isset($query['key'])) {
                $options = array(
                    'conditions' => array(
                        'User.token' => $query['key']
                    )
                );

                $user = $this->User->find('first', $options);
                if (!empty($user)) {
                    $this->Auth->login(
                        array(
                            'username' => 'guest',
                            'deny'     => $user['User']['deny'],
                            'language' => $user['User']['language']
                        )
                    );
                    $this->redirect($this->Auth->redirectUrl());
                }
            }
        }

        $this->set('title_for_layout', __('Sign In'));
        return (false);
    }

    /**
     * User logout action.
     *
     * @access public
     * @return void
     */
    public function logout()
    {
        $this->redirect($this->Auth->logout());
    }

    /**
     * @inheritdoc
     */
    public function isAuthorized($user = null, CakeRequest $request = null)
    {
        return (isset($user['role']) && $user['role'] === 'admin');
    }

    /**
     * Action add user account.
     *
     * @access public
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->User->create();

            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved, try again'));
            }
        }
    }

    /**
     * Action delete user account.
     *
     * @param string|int $id User id
     * @access public
     * @return bool
     */
    public function delete($id = null)
    {
        $this->User->id = $id;
        $this->request->onlyAllow('post');
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

        $this->Session->setFlash($this->User->delete() ? __('User deleted') : __('User was not deleted'));
        $this->redirect(array('action' => 'index'));
        return (false);
    }

    /**
     * Action edit user account.
     *
     * @param string|int $id User id
     * @access public
     * @return bool
     */
    public function edit($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('The user could not be saved, try again'));
            return (true);
        }

        $this->request->data = $this->User->read(null, $id);
        unset($this->request->data['User']['password']);
        return (false);
    }
}