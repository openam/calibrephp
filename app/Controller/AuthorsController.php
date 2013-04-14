<?php
App::uses('AppController', 'Controller');
/**
 * Authors Controller
 *
 * @property Author $Author
 */
class AuthorsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Author->recursive = 0;
		$this->set('authors', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Author->exists($id)) {
			throw new NotFoundException(__('Invalid author'));
		}
		$options = array('conditions' => array('Author.' . $this->Author->primaryKey => $id));
		$this->set('author', $this->Author->find('first', $options));
	}

}