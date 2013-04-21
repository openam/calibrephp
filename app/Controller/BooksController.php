<?php
App::uses('AppController', 'Controller');
/**
 * Books Controller
 *
 * @property Book $Book
 */
class BooksController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Book->recursive = 1;
		$this->set('books', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Book->exists($id)) {
			throw new NotFoundException(__('Invalid book'));
		}
		$options = array('conditions' => array('Book.' . $this->Book->primaryKey => $id));
		$this->set('book', $this->Book->find('first', $options));
	}

/**
 * opds method
 *
 * @return void
 */
	public function opds() {
		$info = $this->Book->getSummaryInfo();
		$this->set(compact('info'));
	}

/**
 * newest method
 *
 * @return void
 */
	public function newest() {
		throw new NotImplementedException(__('BooksController::newest not yet implemented'));
	}

/**
 * random method
 *
 * @return void
 */
	public function random() {
		throw new NotImplementedException(__('BooksController::random not yet implemented'));
	}

}