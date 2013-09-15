<?php
App::uses('AppController', 'Controller');
/**
 * Tags Controller
 *
 * @property Tag $Tag
 */
class TagsController extends AppController {

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
		$this->Tag->recursive = 0;
		$tags = $this->paginate();
		$info = $this->Tag->getInfo();
		$this->set(compact('tags', 'info'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tag->exists($id)) {
			throw new NotFoundException(__('Invalid tag'));
		}
		$options = array(
			'conditions' => array(
				'Tag.' . $this->Tag->primaryKey => $id
			),
			'recursive' => 2
		);

		$tag  = $this->Tag->find('first', $options);
		$info = $this->Tag->getInfo();
		$this->set(compact('tag', 'info'));
	}

/**
 * search method
 *
 * @return void
 */
	public function search() {
		$this->Prg->commonProcess();
		$this->paginate['conditions'] = $this->Tag->parseCriteria($this->Prg->parsedParams());
		$tags                         = $this->paginate();
		$info                         = $this->Tag->getInfo();
		$this->set(compact('tags', 'info'));
	}

}
