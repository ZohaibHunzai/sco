<?php

/**
 * @author ejoo   
 */

namespace backend\components;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\DataColumn;

class TotalColumn extends DataColumn {

    private $_total;
    private $_attr = null;

    public function init()
    {
    	# if there is data in url use it.
    	
    	if(isset($_GET['last_sum'])) {
    		
    		$this->_total = (int) $_GET['last_sum'];
    	} else {
    		$this->_total = 0;
    	}
    }
    public function getAttribute() {
        return $this->_attr;
    }

    public function setAttribute($value) {
        $this->_attr = $value;
    }

    public function renderDataCellContent($model, $key, $index) {

        if(is_array($model)) {
            return $this->_total += $model[$this->attribute];
        }
        $this->_total += $model->{$this->attribute};
        return Yii::$app->formatter->format($this->_total, 'decimal');
    }
}
?>