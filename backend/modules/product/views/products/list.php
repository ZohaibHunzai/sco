<?php 
use yii\widgets\LinkPager;
 ?>




<?php 
echo LinkPager::widget([
    'pagination' => $pages,
]);
 ?>