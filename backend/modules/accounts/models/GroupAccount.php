<?php

namespace backend\modules\accounts\models;

use Yii;
use \backend\modules\accounts\models\base\GroupAccount as BaseGroupAccount;

/**
 * This is the model class for table "group_accounts".
 */
class GroupAccount extends BaseGroupAccount
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'group_id', 'status'], 'integer']
        ];
    }

    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
	
}
