<?php declare(strict_types = 1);

namespace Framework;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment as Twig;


class Render{

	public $view;
	public $respone;
	public $request;

	function __construct(Twig $view, Response $response, Request $request){

	   $this->view = $view;
         $this->request = $request;
         $this->response = $response;
         $this->init_filter();
 
	}

	public function send_html($tpl, $var = array() ){
		$html = $this->view->load($tpl)->display($var);
		$this->response->setContent($html);
    	}

    	public function send_json($obj = array() ){
		$this->response->headers->set('Content-Type', 'application/json ');
		$this->response->setContent( json_encode($obj));
		$this->response->prepare($this->request);
		$this->response->send();
    	}

    	public function init_filter(){
    		$filter = new \Twig\TwigFilter('encrypt',[$this, 'encrypt']);
    		$this->view->addFilter($filter);
    	}

    	public function encrypt($str){
        	return base64_encode(base64_encode($str));
    	}

}