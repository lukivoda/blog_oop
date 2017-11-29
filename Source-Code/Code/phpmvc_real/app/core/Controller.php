<?php

class Controller
{
	public function view($viewName, $data)
	{
		$view = new View($viewName, $data);

		echo $view;
	}

	public function model($modelName)
	{
		require '../app/models/' . ucfirst($modelName) . '.php';

		return new $modelName();
	}
}