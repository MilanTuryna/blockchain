<?php declare(strict_types=1);

namespace App\Core;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
		$router->addRoute('list', 'Main:list');
        $router->addRoute('transaction', 'Main:transaction');
        $router->addRoute('mine', 'Main:mine');
        $router->addRoute('validate', 'Main:validate');
		return $router;
	}
}
