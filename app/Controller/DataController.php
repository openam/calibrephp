<?php
App::uses('AppController', 'Controller');
/**
 * Data Controller
 *
 * @property Datum $Datum
 */
class DataController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$datum = Set::extract("/Datum/format", $this->Datum->find('all', array(
			'recursive' => -1,
			'fields'    => "DISTINCT Datum.format",
			'order'     => "format ASC"
		)));

		$this->set(compact('datum'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $type
 * @return void
 */
	public function view($type = null) {
		if (empty($type)) {
			throw new NotFoundException(__('Invalid datum'));
		}

		$this->paginate = array(
			'recursive' => 2,
			'conditions' => array(
				'Datum.format' => strtoupper($type)
			),
			'order' => array(
				'Book.title' => 'ASC',
			),
		);

		$tempDatum = $this->paginate();

		$datum = array(
			'Datum' => array(
				'name' => $tempDatum[0]['Datum']['format']
			),
			'Book' => array()
		);

		foreach ($tempDatum as $key => $value) {
			array_push($datum['Book'], $value['Book']);
		}

		$this->set(compact('datum'));
	}

}
