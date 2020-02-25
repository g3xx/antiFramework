<?php declare(strict_types = 1);

namespace Framework\Controller;

use Framework\Render;
use Framework\Models\Hero;


class HeroCtrl {

	private $view;
	private $hero;

	function __construct(Render $view){

		$this->view = $view;
		$this->hero = new Hero;
	}

	public function heroIndex() {
		$data = $this->hero->getAll()->toArray();
		$this->view->send_html('base.twig', array('result' => $data) );
	}

	public function heroById($param) {
		$data = $this->hero->findId($param['id']);
		$this->view->send_json($data->toArray());
	}

	public function heroByName($param) {
		$this->view->send_json($param['name']);
	}
}
