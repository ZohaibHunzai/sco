<?php

namespace backend\modules\accounts\models;

use Yii;
use \backend\modules\accounts\models\base\AccGroup as BaseAccGroup;

/**
 * This is the model class for table "acc_groups".
 */
class AccGroup extends BaseAccGroup
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'code', 'status'], 'required'],
            [['code', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 20]
        ];
    }
	

    /**
     * Get accounts of this group.
     * @return array
     */
    public function getAccounts()
    {
        return $this->hasMany(GroupAccount::className(), ['group_id' => 'id']);
    }

    /**
     * Get real accounts
     * @return array
     */

    public function getMainAccounts()
    {
        return $this->hasMany(Account::className(), ['id' => 'account_id'])->viaTable(GroupAccount::tableName(), ['group_id' => 'id']);
    }

    /**
     * Count accounts in this group.
     * @return integer
     */

    public function getAccountsCount()
    {
        return $this->getAccounts()->count();
    }
}
