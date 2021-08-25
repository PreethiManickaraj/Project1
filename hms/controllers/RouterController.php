<?php

/*
* RouterController class is used to call appropriate
* controllers according to users URL.
*/

class RouterController extends Controller
{
	/**
	 * @var controller Inner controller instance
	 */
	protected $controller;

	/**
	 *  @param string $url for passing url address
	 *  @return array url parameters
	 */

	private function parseUrl($url)
	{
		//parses url into associative arrays
		$parsedUrl = parse_url($url);
		//removes slashes from url
		$parsedUrl["path"] = ltrim($parsedUrl["path"], "/");
		//removes whitespaces
		$parsedUrl["path"] = trim($parsedUrl["path"]);
		//splits the address by slashes
		$explodedUrl = explode("/", $parsedUrl["path"]);

		return $explodedUrl;
	}

	/**
	 *  This function is used for converting first letter of word to uppercase
	 *  @param string controller name is passed
	 *  @return string returns controller class name's first letter as uppercase
	 */

	private function dashesToCamel($text)
	{
		$text = str_replace('-', ' ', $text);
		$text = ucwords($text);
		$text = str_replace(' ', '', $text);
		return $text;
	}

	/**
	 *  Parses url address and creates appropriate controller
	 *  @param array $params url address in array 
	 */
	public function process($params)
	{
		$parsedUrl = $this->parseUrl($params[0]);
		//print_r($parsedUrl);

		if (empty($parsedUrl[0])){
			$controllerClass = 'IndexController';
		} else {
		// controller name is the first parameter of the url	
		$controllerClass = $this->dashesToCamel(array_shift($parsedUrl)) . 'Controller';
		}

		if (file_exists('controllers/' . $controllerClass . '.php'))
			$this->controller = new $controllerClass;
		else
			$this->redirect('error');

		// Calls the controller
		$this->controller->process($parsedUrl);

		// Setting main template
		$this->view = 'layout';
		$this->head  = $this->controller->head;
	}
}