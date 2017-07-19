<?php

namespace backend\modules\printers\models;

use Yii;
use \backend\modules\printers\models\base\Printer as BasePrinter;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector as WP;
use Mike42\Escpos\Printer as P;
use backend\modules\business\models\Business;
use Mike42\Escpos\EscposImage;
use backend\modules\sales\models\Sale;

/**
 * This is the model class for table "printers".
 */
class Printer extends BasePrinter
{
    
    /**
     * @inheritdoc
     */
    const TYPE_NORMAL = 1;
    const TYPE_POS = 2;
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    const STATUS_DELETED = 0;
    public function rules()
    {
        return [
            [['name', 'type', 'footer'], 'required'],
            [['type', 'created_by', 'updated_by', 'status'], 'integer'],
            [['created_at', 'updated_at', 'is_default'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
        ];
    }
	
    public static function TypeOptions()
    {
        return [
            self::TYPE_NORMAL => "Normal Printer",
            self::TYPE_POS => "POS Printer",
        ];
    }

    public static function StatusOptions()
    {
        return [
             self::STATUS_ACTIVE => "Active",
             self::STATUS_INACTIVE => "In-Active",
             self::STATUS_DELETED => "Deleted",
        ];
    }


    public function testPrint()
    {
        $pos = self::findOne(['type' => self::TYPE_POS, 'status' => 1, 'is_default' => 1]);
        if(! $pos) {
            throw new \Exception("No printer installed");
            
        }
        $connect = new WP($pos->name);
        $printer = new P($connect);

        # slip type
        // $printer -> setColor(P::COLOR_1);
        $printer -> setJustification(P::JUSTIFY_CENTER);
        $printer -> text("Purchase Slip \n");
        $printer -> feed();
        $printer -> selectPrintMode(P::MODE_FONT_B);
        $printer -> setTextSize(2, 2);
        // $printer -> setLineSpacing(1);
        // $printer -> selectPrintMode();
        $printer -> text($this->business->name . "\n");
        $printer -> setTextSize(1,1);
        $printer -> text($this->business->address . "\n");
        $printer -> text($this->business->phone_number . "\n");
        $printer -> selectPrintMode(P::FONT_B);
        $printer -> setEmphasis(true);
        $printer -> text(new item('Article(s)', "QTY", 'RS'));
        $printer -> setEmphasis(false);
        $printer -> cut();
        $printer -> close();
    }

    /**
     * Prints sale pritns
     * @param  Object $model A model of sale
     * @return void
     */
    public function printSaleReceipt($model=null)
    {
        if ($model == null ) {
            $model = Sale::find()->one();
        }

        $pos = self::findOne(['type' => self::TYPE_POS, 'status' => 1, 'is_default' => 1]);
        if(! $pos) {
           return false;
            
        }
        $connect = new WP($pos->name);
        
        $items = array(
            new item("Example item #1", '1', "4.00"),
            // new item("Another thing", '2', "3.50"),
            // new item("Something else", '12', "1.00"),
            // new item("A final item", '11', "4.45"),
        );
        $subtotal = new item('Subtotal', '', '12.95');
        $tax = new item('A local tax', '', '1.30');
        $total = new item('Total', '', '14.25', true);
        /* Date is kept the same for testing */
        // $date = date('l jS \of F Y h:i:s A');
        $date = date('Y-m-d H:i:s');


        /* Start the printer */
        // $logo = EscposImage::load("img/logo.jpg", false);
        $printer = new P($connect);
        // $printer = new Printer($connector);
        /* Print top logo */
        $printer -> setJustification(P::JUSTIFY_CENTER);
        // $printer -> graphics($logo);
        /* Name of shop */
        $printer -> selectPrintMode(P::MODE_DOUBLE_WIDTH);
        $printer -> text($this->business->name. ".\n");
        $printer -> selectPrintMode();
        $printer -> text($this->business->address. "\n");
        $printer -> text($this->business->phone_number. "\n");
        $printer -> feed();
        /* Title of receipt */
        $printer -> setEmphasis(true);
        $printer -> text("SALES INVOICE # " . $model->id . "\n");
        $printer -> setEmphasis(false);
        /* Items */
        $printer -> setJustification(P::JUSTIFY_LEFT);
        // $printer -> setEmphasis(fal);
        // $printer -> text(new item('Article(s)', 'QTY',  'RS', true));
        $printer -> text("..............................................\n");
        foreach ($this->spaceSettings as $attr => $space) {
            $printer -> text(str_pad(ucwords($attr), $space, ' ', $space == 'total' ? STR_PAD_LEFT : STR_PAD_RIGHT));   
        }
        $printer -> feed();
        $printer -> text("..............................................\n");
        // $printer -> setEmphasis(false);
        $s = $this->spaceSettings;
        foreach ($model->items as $item) {

            $printer -> text($this->getPad($item->product->name, 'article'));
            $printer -> text($this->getPad($item->product->price->selling_price, 'price'));
            $printer -> text($this->getPad($item->quantity, 'qty'));
            $printer -> text($this->getPad($item->total, 'total') . "\n");
        }

        $printer -> text("..............................................\n");
        $printer -> feed();
        $printer -> setEmphasis(true);
        $printer -> text($this->getPad("Subtotal:", 'article'));
        $printer -> text($this->getPad('', 'price'));
        $printer -> text($this->getPad('', 'qty'));
        $printer -> text($this->getPad($model->itemsTotal, 'total') . "\n");
        $printer -> setEmphasis(false);
        // $printer -> text($subtotal);
        
        $printer -> text("..............................................\n");
        $printer -> feed();
        
        
        /* Tax and total */
        // $printer -> text($tax);
        // $printer -> selectPrintMode(P::MODE_DOUBLE_WIDTH);
        // $printer -> text($total);
        // $printer -> selectPrintMode();
        /* Footer */
        // $printer -> feed(2);
        $printer -> setJustification(P::JUSTIFY_CENTER);
        $printer -> text($pos->footer . "\n");
        $printer -> text($date . "\n");
        $printer -> feed();
        // $printer -> setJustification(P::JUSTIFY_LEFT);
        $printer -> selectPrintMode(P::MODE_UNDERLINE);
        $printer -> setTextSize(1, 1);
        $printer -> text("Software By: uConnect Gilgit (03445146925) \n");
        // $printer -> setJustification(P::JUSTIFY_RIGHT);
        // $printer -> text("");
        $printer -> feed();
        /* Cut the receipt and open the cash drawer */
        $printer -> cut();
        $printer -> pulse();
        $printer -> close();
    }
    public function getBusiness()
    {
        return Business::find()->one();
    }

    public function getSpaceSettings()
    {
        return [
            'article' => 20,
            'price' => 10,
            'qty' => 6,
            'total' => 6
        ];
    }

    public function getPad($str, $attr)
    {
        return str_pad($str, $this->spaceSettings[$attr], ' ', $attr == 'total' ? STR_PAD_LEFT : STR_PAD_RIGHT);
    }
}
