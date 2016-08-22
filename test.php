<?php

require_once __DIR__ . "/vendor/autoload.php";

use Pimple\Container;
use G\Yaml2Pimple\ContainerBuilder;
use G\Yaml2Pimple\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

$container = new Container();
interface API {

    function getData();
}
class TrueAPI implements API {

    public function getData() {
        return "True";
    }

}
class FakeAPI implements API {

    public function getData() {
        return "Fake";
    }

}
class APIAdapter {

    public function __construct(API $oAPI) {
        
    }

}
/* コードにすると下記
 * 
  // define some services
  $container['apiAdapter'] = function ($c) {
  return new APIAdapter();
  };

  $container['api'] = function ($c) {
  return new TrueAPI($c['apiAdapter']);
  };

  var_export($container['api']);
 */

$container = new Container();

$builder = new ContainerBuilder($container);
$locator = new FileLocator(__DIR__);
$loader = new YamlFileLoader($builder, $locator);
$loader->load(__DIR__ . '/services.yml');

var_export($container['apiAdapter']);
