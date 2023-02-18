<?php
	namespace Src\Engine;


	use Twig\Environment;
	use Twig\Loader\FilesystemLoader;

	class View{

		/**
		 * @param string $view
		 * @param array $data
		 * @return string
		 * @throws \Twig\Error\LoaderError
		 * @throws \Twig\Error\RuntimeError
		 * @throws \Twig\Error\SyntaxError
		 */
		public static function render(string $view = '', array $data = [])
		{
			$loader = new FilesystemLoader(VIEW_PATH);
			$twig = new Environment($loader);

			$view =  str_replace('.','/',$view) . '.twig';

			if (!file_exists(VIEW_PATH . $view)){
				throw new \Exception('Twig not found : ' . $view);
			}

			return $twig->render($view,$data);
		}

	}