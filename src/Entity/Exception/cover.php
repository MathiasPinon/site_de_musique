<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;

try {
    if($_GET['coverId'] !== int($_GET['coverId'])){
        throw new \mysql_xdevapi\Exception('ParameterException');
    };
}
catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}