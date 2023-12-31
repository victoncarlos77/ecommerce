<?php

namespace Hcode;

use Rain\Tpl;

class Page{ // criação para pagina page


		private $tpl;
		private $options = [];
		private $defaults = [
			"header"=>true,
			"footer"=>true,
			"data"=>[]
		];

		public function __construct($opts=array(), $tpl_dir = "/views/"){    // metódo mágico construtor, vai ser chamado automático

				$this->options = array_merge($this->defaults, $opts); //comando array para unir arrays

				$config = array(
					"tpl_dir"       =>$_SERVER["DOCUMENT_ROOT"].$tpl_dir, //indicando caminho para pasta tpl_dir
					"cache_dir"     =>$_SERVER["DOCUMENT_ROOT"]."/views-cache/",//indicando caminho para pasta cache_dir
					"debug"         => false // não precisa, mas vamos deixar como false
				   );

		Tpl::configure( $config );
		
		$this->tpl = new Tpl; // chamando a clase Tpl, que está vindo do use Rain\Tpl;

		$this->setData($this->options["data"]);				
		
		if ($this->options["header"]=== true ) $this->tpl->draw("header");
		}


	private function setData($data = array()){

		foreach ($data as $key => $value) {//foreach vai passar os valores dos array unidos no array_merge 
			$this->tpl->assign($key,$value);

	}
	}

	public function setTpl($name, $data = array(), $returnHTML = false){

		$this->setData($data);
		return $this->tpl->draw($name, $returnHTML);

	}


	public function __destruct(){ //ultimo metódo a ser executado

		if ($this->options["footer"] === true )$this->tpl->draw("footer");

	}

	
	
}

?>