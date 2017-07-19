<?php

use yii\db\Migration;

/**
 * Handles adding voucher_no_cheque_number_bank_name to table `supplier_payments`.
 */
class m160712_102045_add_voucher_no_cheque_number_bank_name_to_supplier_payments extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('supplier_payments', 'voucher_no', $this->string(20) . " DEFAULT NULL");
        $this->addColumn('supplier_payments', 'bank_name', $this->string(20) . " DEFAULT NULL");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('supplier_payments', 'voucher_no');
        $this->dropColumn('supplier_payments', 'bank_name');
    }
}
