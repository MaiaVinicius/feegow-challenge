<?php
use Doctrine\ORM\Tools\Setup;

require_once "vendor/autoload.php";

$isDevMode = true;
$isSimpleMode = FALSE;
$proxyDir = null;
$cache = null;
$config = Setup::createXMLMetadataConfiguration(array(__DIR__ . '/src/App/Mapping'), $isDevMode, $proxyDir, $cache, $isSimpleMode);

$conn = [
    'driver' => 'pdo_mysql',
    'host' => 'db',
    'dbname' => 'test_db',
    'user' => 'devuser',
    'password' => 'devpass'
];

try {
    $entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);
} catch (\Doctrine\ORM\ORMException $e) {
    var_dump($e->getMessage());
    exit;
}