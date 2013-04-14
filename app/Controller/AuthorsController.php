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
		$options = array(
			'conditions' => array(
				'Author.' . $this->Author->primaryKey => $id
			),
			'recursive' => 2
		);

		$author = $this->Author->find('first', $options);

		$relatedSeries = array();
		foreach ($author['Book'] as $key => $book) {
			foreach ($book['Series'] as $key => $series) {
				$relatedSeries[$series['sort']] = $series['id'];
			}
		}
		ksort($relatedSeries);
		$series = $relatedSeries;

		$this->set(compact('author', 'series'));
	}

}