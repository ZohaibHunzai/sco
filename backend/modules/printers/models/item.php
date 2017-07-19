<?php
namespace backend\modules\printers\models;
class item
{
    private $name;
    private $price;
    private $qty;
    private $dollarSign;
    public function __construct($name = '', $price = '', $qty = '', $dollarSign = false)
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> qty = $qty;
        $this -> dollarSign = $dollarSign;
    }
    
    public function __toString()
    {
        $rightCols = 10;
        $leftCols = 20;
        $center = 10;
        if ($this -> dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> name, $leftCols) ;
        $center = str_pad($this -> qty, $center);
        $sign = ($this -> dollarSign ? 'RS ' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);

        // echo str_replace(' ', '&nbsp', str_pad("Ejaz", 40));
        // echo str_replace(' ', '&nbsp', str_pad("Ejaz", 40));
        // echo str_replace(' ', '&nbsp', str_pad("Ejaz", 20, ' ', STR_PAD_LEFT));
        // echo nl2br( ( "$left$right$center\n" ) );
        return( ( "$left$center$right\n" ) );
        exit;
    }
}