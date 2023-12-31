<?php

namespace Fckin\core\exceptions;

use Exception;

class NotFoundException extends Exception
{
    protected $message = 'The fck I can\'t find your page.';
    protected $code = 404;
}