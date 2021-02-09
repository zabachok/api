<?php

namespace zabachok\api\components\transaction;

interface ITransaction
{
    /**
     * begin transaction
     */
    public function begin();

    /**
     * commit transaction
     * @throws TransactionNotCreateException
     */
    public function commit();

    /**
     * rollback transaction
     * @throws TransactionNotCreateException
     */
    public function rollback();
}
