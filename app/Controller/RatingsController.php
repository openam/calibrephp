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
		$ratings = $this->paginate();
		$info    = $this->Rating->getInfo();
		$this->set(compact('ratings', 'info'));
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

		$rating = $this->Rating->find('first', $options);
		$info   = $this->Rating->getInfo();
		$this->set(compact('rating', 'info'));
	}

}