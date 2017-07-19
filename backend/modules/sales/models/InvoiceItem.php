<?php

namespace backend\modules\sales\models;

use Yii;
use \backend\modules\sales\models\base\InvoiceItem as BaseInvoiceItem;

/**
 * This is the model class for table "invoice_items".
 */
class InvoiceItem extends BaseInvoiceItem
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_id', 'product_id', 'quantity', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'required'],
            [['invoice_id', 'product_id', 'quantity', 'discount_percent', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['comment'], 'string', 'max' => 128]
        ];
    }
	
}
