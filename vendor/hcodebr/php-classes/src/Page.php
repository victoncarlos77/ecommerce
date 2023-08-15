<?php

namespace Hcode;

use Rain\Tpl;


class Page{ // criação para pagina page


		private $tpl;
		private $options = [];
		private $defaults = [
			"data"=>[]
		];

		public function __construct($opts=array()){    // metódo mágico construtor, vai ser chamado automático

				$this->options = array_merge($this->defaults, $opts); //comando array para unir arrays

				$config = array(
					"tpl_dir"       =>$_SERVER["DOCUMENT_ROOT"]."/views/", //indicando caminho para pasta tpl_dir
					"cache_dir"     =>$_SERVER["DOCUMENT_ROOT"]."/views-cache/",//indicando caminho para pasta cache_dir
					"debug"         => false // não precisa, mas vamos deixar como false
				   );

		Tpl::configure( $config );
		
		$this->tpl = new Tpl; // chamando a clase Tpl, que está vindo do use Rain\Tpl;

		$this->setData($this->options["data"]);				
		
		$this->tpl->draw("header");
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

		$this->tpl->draw("footer");

	}

	
	
}

?>