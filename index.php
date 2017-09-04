<?php
require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use App\Application;

$container = new ContainerBuilder();
$configurationDirectory = new FileLocator(__DIR__ . '/config');
$loader = new YamlFileLoader($container, $configurationDirectory);
$loader->load('services.yaml');

$application = new Application('cli', '1.0', $container);
$application->run();
