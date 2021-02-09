<?php

namespace zabachok\api\components\transaction;

use Exception;

class TransactionNotCreateException extends Exception
{
    protected $message = 'Transaction is not create';
}
