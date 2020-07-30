<?php

use App\Http\Controllers\ConsultaController;

/** @var \App\Providers\SlimProvider $router */

$router->get('/', ConsultaController::class .':index');
