<?php
require_once './App/Bootstrap.php';

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet(\App\Application::getEntityManager());
