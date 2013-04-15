<?php
App::uses('AppController', 'Controller');
/**
 * Publishers Controller
 *
 * @property Publisher $Publisher
 */
class PublishersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Publisher->recursive = 0;
		$this->set('publishers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Publisher->exists($id)) {
			throw new NotFoundException(__('Invalid publisher'));
		}
		$options = array(
			'conditions' => array(
				'Publisher.' . $this->Publisher->primaryKey => $id
			),
			'recursive' => 2
		);
		$this->set('publisher', $this->Publisher->find('first', $options));
	}
}