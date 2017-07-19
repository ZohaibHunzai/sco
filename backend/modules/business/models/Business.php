<?php

namespace backend\modules\business\models;

use Yii;
use \backend\modules\business\models\base\Business as BaseBusiness;

/**
 * This is the model class for table "businesses".
 */
class Business extends BaseBusiness
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_header', 'invoice_footer', 'phone_number' ], 'required'],
            [[ 'photo_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['address'], 'string', 'max' => 200],
            [['invoice_header', 'invoice_footer'], 'string', 'max' => 1000],
            // [['lock'], 'default', 'value' => '0'],
            // [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    
    /**
     * Converts invoice 
     * @param  string $invoice_title 
     * @param  string $value         
     * @return string
     */
    public function format($invoice_title, $value)
    {
        return str_replace("{{title}}", $value, $invoice_title);
    }
	

    public function getDate($date = null)
    {
        return Yii::$app->formatter->format($date ?  strtotime($date) : time() , 'date');
    }
}
