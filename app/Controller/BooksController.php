<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Books Controller
 *
 * @property Book $Book
 */
class BooksController extends AppController {

/**
 * CakeDC Search
 */
	public $components = array('Search.Prg');
	public $presetVars = true;

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
		$this->response->header(array(
			"Content-type: " . $ebookMimeTypes[$extension]
		));
		$this->response->file(
			$this->Book->getCalibrePath() . $book['Book']['path'] . DS . $fileName . '.' . $extension,
			array(
				'download' => true,
				'name' => "$fileName.$extension",
			)

		);
		// Return response object to prevent controller from trying to render a view
		return $this->response;
	}

    /**
     * Read book method.
     *
     * @throws NotFoundException
     * @param string $id
     * @param string $extension
     * @return void
     */
    public function read($id = null, $extension = null) {
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

        $book['File'] = array(
            'file_name' => $fileName,
            'file_path' => $book['Book']['path'] . DS . $fileName . '.' . $extension,
            'extension' => $extension
        );

        $bookReader = new BookReader\Reader($this->Book->getCalibrePath() . $book['File']['file_path']);

        $this->autoRender = false;
        $this->layout = false;
        $this->set(array(
            'book' => $book,
            'reader' => $bookReader->read($this->request)
        ));

        $this->render('/Books/read');
    }

/**
 * search method
 *
 * @return void
 */
	public function search() {
		$this->Prg->commonProcess();
		$this->paginate['conditions'] = $this->Book->parseCriteria($this->Prg->parsedParams());
		$this->set('books', $this->paginate());
	}

/**
 * Share by e-mail method
 *
 * @param string $id
 * @param string $email
 * @param string $extension
 */
	public function share($id, $email, $extension) {
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

		// We got the file, so send it by e-mail to $email
		$mail = new CakeEmail();
		$mail->config('default');
		$mail->to($email);
		$mail->subject($book['Book']['title']);
		$mail->attachments($this->Book->getCalibrePath() . $book['Book']['path'] . DS . $fileName . '.' . $extension);
		$mail->send();

		$this->autoRender = false;
		return json_encode(array(
			"result" => true,
		));
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
