<?php

class View
{
	protected $file;

	protected $data;

	protected $twig;

	public function __construct($file, $data = null)
	{
		$this->file = $file;
		$this->data = $data;

		$twigLoader = new Twig_Loader_Filesystem(INC_ROOT . '/app/views', '__main__');
		$this->twig = new Twig_Environment($twigLoader);
		$this->twig->addGlobal('ASSET_ROOT', ASSET_ROOT);
	}

	public function __toString()
	{
		return $this->parseView();
	}

	public function parseView()
	{
		$file = $this->file . '.php';

		if(is_null($this->data)) {
			return $this->twig->render($file);
		}

		return $this->twig->render($file, $this->data);
	}
}