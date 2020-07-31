<?php
declare(strict_types=1);

namespace App;

use SleekDB;
use Relay\Relay;
use function DI\get;
use function DI\create;
use DI\ContainerBuilder;
use Middlewares\FastRoute;
use FastRoute\RouteCollector;
use Middlewares\RequestHandler;
use App\Repository\ClientRepository;
use App\Controllers\ClientController;
use App\Repository\IClientRepository;
use function FastRoute\simpleDispatcher;
use Narrowspark\HttpEmitter\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;
use Laminas\Diactoros\Response\JsonResponse;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Application {
    /**
     * Project root path
     *
     * @var string
     */
    protected $rootPath;
    protected $middlewareQueue;

    public function __construct($rootPath)
    {
        $this->rootPath = $rootPath;

        $clientsRepository = new ClientRepository(self::getEntityManager());

        $containerBuilder = new ContainerBuilder();

        $containerBuilder->useAnnotations(false);
        $containerBuilder->addDefinitions([
            IClientRepository::class => $clientsRepository
        ]);
        
        $container = $containerBuilder->build();
        
        $filename = $this->rootPath . '/App/Config/Router.php';
        if (!file_exists($filename) || !is_readable($filename)) {
            throw new Exception('File Router.php does not exist or is not readable.');
        }

        $routeList = include_once $filename;
        
        $dispatcher = simpleDispatcher(
            function (RouteCollector $r) use ($routeList) {
                foreach ($routeList as $routeDef) {
                    $r->addRoute($routeDef[0], $routeDef[1], $routeDef[2]);
                }
            }
        );

        $this->middlewareQueue[] = new FastRoute($dispatcher);
        $this->middlewareQueue[] = new RequestHandler($container);
    }

    public function run() : void
    {
        $requestHandler = new Relay($this->middlewareQueue);
        $response = $requestHandler->handle(ServerRequestFactory::fromGlobals());

        $emitter = new SapiEmitter();

        $emitter->emit($response);
    }


    public static function getEntityManager(){
        if (empty($_ENV['DB_PATH'])){
            throw new Exception("DB Not found");
        }
        
        $isDevMode = true;
        $proxyDir = null;
        $cache = null;
        $useSimpleAnnotationReader = false;

        $paths = array(__DIR__."/Models");
        $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

        $connectionParams = array(
            'driver' => 'pdo_sqlite',
            'path'   => $_ENV['DB_PATH'],
        );

        $entityManager = \Doctrine\ORM\EntityManager::create($connectionParams, $config);

        return $entityManager;
    }
}