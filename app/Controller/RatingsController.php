<?php
App::uses('AppController', 'Controller');
/**
 * Ratings Controller
 *
 * @property Rating $Rating
 */
class RatingsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Rating->recursive = 0;
		$this->set('ratings', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Rating->exists($id)) {
			throw new NotFoundException(__('Invalid rating'));
		}
		$options = array(
			'conditions' => array(
				'Rating.' . $this->Rating->primaryKey => $id
			),
			'recursive' => 2
		);
		$this->set('rating', $this->Rating->find('first', $options));
	}

}