<?php 

namespace Classes;

use Rain\Tpl;

class Page {

	private $tpl;
	private $options  = [];
	private $defaults = [ "data"   => [],
						  "header" => true,
						  "footer" => true
						];

	public function __construct($opts = array(), $tpl_dir = "/views/" ){

		$this->options = array_merge($this->defaults, $opts);

		$config = array(
			"tpl_dir"   => $_SERVER["DOCUMENT_ROOT"].$tpl_dir,
			"cache_dir" => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
			"debug"     => false
		);

		Tpl::configure( $config );
		$this->tpl = New Tpl;

		$this->setData($this->options['data']);		

		if ($this->options["header"]) $this->tpl->draw("header");
	}

	public function setTpl($nameTemplate, $data = [], $returnHTML = false){
		$this->setData($data);
		return $this->tpl->draw($nameTemplate, $returnHTML);
	}

	private function setData($data = array()){
		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
		}
	}

	public function __destruct(){
		if ($this->options["footer"]) $this->tpl->draw("footer");
	}

}


?>