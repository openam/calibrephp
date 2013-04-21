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
 * download method
 *
 * @throws NotFoundException
 * @param string $id
 * @param string $extension
 * @return void
 */
	public function download($id = null, $extension = null) {
		if (!$this->Book->exists($id)) {
			throw new NotFoundException(__('Invalid book'));
		}
		if (!$extension) {
			throw new NotFoundException(__('Invalid extension'));
		}
		$extension = strtolower($extension);

		$options = array(
			'conditions' => array('Book.' . $this->Book->primaryKey => $id),
			'recursive'  => 1,
		);

		$book = $this->Book->find('first', $options);

		$fileName = '';
		foreach ($book['Datum'] as $file) {
			if ($file['format'] == strtoupper($extension)) {
				$fileName = $file['name'];
			}
		}
		if (!$fileName) {
			throw new NotFoundException(__('Invalid file name or extension'));
		}

		$ebookMimeTypes = Configure::read('Settings.ebooks.mimeTypes');

		$this->viewClass = 'Media';
		$params = array(
			'id'        => $fileName . '.' .$extension,
			'name'      => $fileName,
			'extension' => $extension,
			'download'  => true,
			'mimeType'  => array(
				$extension => $ebookMimeTypes[$extension]
			),
			'path'      => $this->Book->getCalibrePath() . $book['Book']['path'] . DS
		);
		$this->set($params);
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