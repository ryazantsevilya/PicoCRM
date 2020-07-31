<?php
declare(strict_types=1);

require_once dirname(__DIR__).'/App/Bootstrap.php';

use App\Application;

try{
    $application = new Application($rootPath);
    $application->run();
}catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
    
    
    

