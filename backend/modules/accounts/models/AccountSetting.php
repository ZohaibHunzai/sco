<?php

namespace backend\modules\accounts\models;

use Yii;
use \backend\modules\accounts\models\base\AccountSetting as BaseAccountSetting;
use common\components\keyStorage\FormModel as FM;

/**
 * This is the model class for table "account_settings".
 */
class AccountSetting extends BaseAccountSetting
{
    
    /**
     * @inheritdoc
     */
    const TYPE_ACCOUNTS = 1;
    /**
     * Keys to be used on settings
     */

    // const KEY_CIH;
    // const KEY_CREDITORS;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value', 'name'], 'required'],
            [['key', 'value', 'type', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            ['type', 'default', 'value' => self::TYPE_ACCOUNTS]
        ];
    }

    public function getKeys()
    {
        return [
            self::KEY_CIH => 'Cash In Hand Account',
            self::KEY_CREDITORS => 'Credtiros Account'
        ];
    }

    /**
     * Form model
     */

    public function getFormModel()
    {
        $model = new FM([
            'keys' => [

            ]
        ]);
    }

    /**
     * Get value
     */

    public static function getAccount($key)
    {
        return self::findOne(['key' => $key])->value;
    }
	
   

    
}
