<?php
App::uses('AppController', 'Controller');
/**
 * Series Controller
 *
 * @property Series $Series
 */
class SeriesController extends AppController {

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
		$this->Series->recursive = 0;
		$series = $this->paginate();
		$info   = $this->Series->getInfo();
		$this->set(compact('series', 'info'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Series->exists($id)) {
			throw new NotFoundException(__('Invalid series'));
		}

		$options = array(
			'conditions' => array(
				'Series.' . $this->Series->primaryKey => $id
			),
			'recursive' => 2
		);

		$series = $this->Series->find('first', $options);
		$info   = $this->Series->getInfo();
		$this->set(compact('series', 'info'));
	}

/**
 * search method
 *
 * @return void
 */
	public function search() {
		$this->Prg->commonProcess();
		$this->paginate['conditions'] = $this->Series->parseCriteria($this->Prg->parsedParams());
		$series                       = $this->paginate();
		$info                         = $this->Series->getInfo();
		$this->set(compact('series', 'info'));
	}

}
