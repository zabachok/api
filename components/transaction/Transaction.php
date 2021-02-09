<?php

namespace zabachok\api\components\transaction;

use Exception;
use Yii;
use yii\db\Transaction as YiiTransaction;

class Transaction implements ITransaction
{
    /**
     * @var YiiTransaction
     */
    private $transaction;

    /**
     * @inheritdoc
     */
    public function begin()
    {
        $this->transaction = Yii::$app->db->beginTransaction();
    }

    /**
     * @inheritdoc
     */
    public function commit()
    {
        if (!$this->transaction) {
            throw new TransactionNotCreateException();
        }
        try {
            $this->transaction->commit();
        } catch (Exception $exception) {
            throw new TransactionNotCreateException();
        }
    }

    /**
     * @inheritdoc
     */
    public function rollback()
    {
        if (!$this->transaction) {
            throw new TransactionNotCreateException();
        }
        try {
            $this->transaction->rollBack();
        } catch (Exception $exception) {
            throw new TransactionNotCreateException();
        }
    }
}
