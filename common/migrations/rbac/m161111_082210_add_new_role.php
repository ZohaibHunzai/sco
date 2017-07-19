<?php

use common\rbac\Migration;
use common\models\User;

class m161111_082210_add_new_role extends Migration
{
    public function up()
    {
        $manager = $this->auth->getRole(User::ROLE_MANAGER);

        $casher = $this->auth->createRole(User::ROLE_CASHER);
        $this->auth->add($casher);
        $this->auth->addChild($manager, $casher);
        $this->auth->assign($casher, 4);

    }

    public function down()
    {
        $this->auth->remove($this->auth->getRole(User::ROLE_CASHER));
        
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
