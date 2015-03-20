<?php
App::uses('AppController', 'Controller');

/**
 * Settings Controller
 *
 * @property Setting $Setting
 */
class SettingsController extends AppController
{

    /**
     * Default action.
     *
     * @access public
     * @return void
     */
    public function index()
    {
        $this->Setting->recursive = 0;
        $this->set('settings', $this->paginate());
    }

    /**
     * @inheritdoc
     */
    public function isAuthorized($user = null, CakeRequest $request = null)
    {
        return (!(bool)Configure::read('General.auth') || (isset($user['role']) && $user['role'] === 'admin'));
    }

    /**
     * Action edit setting.
     *
     * @param string|int $id Setting id
     * @access public
     * @return bool
     */
    public function edit($id = null)
    {
        $this->Setting->id = $id;
        if (!$this->Setting->exists()) {
            throw new NotFoundException(__('Invalid setting'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Setting->save($this->request->data)) {
                $this->Session->setFlash(__('The settings has been saved'));
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('The setting could not be saved, try again'));
        }

        $this->request->data = $this->Setting->findById($id);
        return (false);
    }
}