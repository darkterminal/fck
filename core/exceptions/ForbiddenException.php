<?php

namespace Fckin\core\exceptions;

use Exception;

class ForbiddenException extends Exception
{
    protected $message = 'The fck are you doing?! You don\'t have permission for this page';
    protected $code = 403;
}