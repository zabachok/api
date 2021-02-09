<?php

namespace zabachok\api\tests\_support;

use yii\test\ActiveFixture as YiiActiveFixture;

class ActiveFixture extends YiiActiveFixture
{
    /**
     * @inheritdoc
     */
    public function beforeLoad()
    {
        parent::beforeLoad();
        $this->db->createCommand()->setSql('SET FOREIGN_KEY_CHECKS = 0')->execute();
    }

    /**
     * @inheritdoc
     */
    public function afterLoad()
    {
        parent::afterLoad();
        $this->db->createCommand()->setSql('SET FOREIGN_KEY_CHECKS = 1')->execute();
    }

    /**
     * @inheritdoc
     */
    protected function resetTable()
    {
        $table = $this->getTableSchema();
        $this->db->createCommand()->delete($table->fullName)->execute();
    }
}
