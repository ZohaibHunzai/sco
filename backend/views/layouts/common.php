<?php
/**
 * @var $this yii\web\View
 */
use backend\assets\BackendAsset;
use backend\widgets\Menu;
use common\models\TimelineEvent;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$bundle = BackendAsset::register($this);
?>
<?php $this->beginContent('@backend/views/layouts/base.php'); ?>
  <div class="wrapper">
    <!-- header logo: style can be found in header.less -->
    <header class="main-header">
      <a href="<?php echo Url::to(["/dashboard/default/index"]) ?>" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        <?php echo Yii::$app->name ?>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only"><?php echo Yii::t('backend', 'Toggle navigation') ?></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li id="timeline-notifications" class="notifications-menu">
              <a href="<?php echo Url::to(['/timeline-event/index']) ?>">
                <i class="fa fa-bell"></i>
                <span class="label label-success">
                                    <?php echo TimelineEvent::find()->today()->count() ?>
                                </span>
              </a>
            </li>
            <!-- Notifications: style can be found in dropdown.less -->
            <li id="log-dropdown" class="dropdown notifications-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-warning"></i>
                <span class="label label-danger">
                                <?php echo \backend\models\SystemLog::find()->count() ?>
                            </span>
              </a>
              <ul class="dropdown-menu">
                <li
                  class="header"><?php echo Yii::t('backend', 'You have {num} log items', ['num' => \backend\models\SystemLog::find()->count()]) ?></li>
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu">
                    <?php foreach (\backend\models\SystemLog::find()->orderBy(['log_time' => SORT_DESC])->limit(5)->all() as $logEntry): ?>
                      <li>
                        <a href="<?php echo Yii::$app->urlManager->createUrl(['/log/view', 'id' => $logEntry->id]) ?>">
                          <i
                            class="fa fa-warning <?php echo $logEntry->level == \yii\log\Logger::LEVEL_ERROR ? 'text-red' : 'text-yellow' ?>"></i>
                          <?php echo $logEntry->category ?>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </li>
                <li class="footer">
                  <?php echo Html::a(Yii::t('backend', 'View all'), ['/log/index']) ?>
                </li>
              </ul>
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img
                  src="<?php echo Yii::$app->user->identity->userProfile->getAvatar($this->assetManager->getAssetUrl($bundle, 'img/anonymous.jpg')) ?>"
                  class="user-image">
                <span><?php echo Yii::$app->user->identity->username ?> <i class="caret"></i></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header light-blue">
                  <img
                    src="<?php echo Yii::$app->user->identity->userProfile->getAvatar($this->assetManager->getAssetUrl($bundle, 'img/anonymous.jpg')) ?>"
                    class="img-circle" alt="User Image"/>
                  <p>
                    <?php echo Yii::$app->user->identity->username ?>
                    <small>
                      <?php echo Yii::t('backend', 'Member since {0, date, short}', Yii::$app->user->identity->created_at) ?>
                    </small>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <?php echo Html::a(Yii::t('backend', 'Profile'), ['/sign-in/profile'], ['class' => 'btn btn-default btn-flat']) ?>
                  </div>
                  <div class="pull-left">
                    <?php echo Html::a(Yii::t('backend', 'Account'), ['/sign-in/account'], ['class' => 'btn btn-default btn-flat']) ?>
                  </div>
                  <div class="pull-right">
                    <?php echo Html::a(Yii::t('backend', 'Logout'), ['/sign-in/logout'], ['class' => 'btn btn-default btn-flat', 'data-method' => 'post']) ?>
                  </div>
                </li>
              </ul>
            </li>
            <li>
              <?php echo Html::a('<i class="fa fa-cogs"></i>', ['/site/settings']) ?>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img
              src="<?php echo Yii::$app->user->identity->userProfile->getAvatar($this->assetManager->getAssetUrl($bundle, 'img/anonymous.jpg')) ?>"
              class="img-circle"/>
          </div>
          <div class="pull-left info">
            <p><?php echo Yii::t('backend', 'Hello, {username}', ['username' => Yii::$app->user->identity->getPublicIdentity()]) ?></p>
            <a href="<?php echo Url::to(['/sign-in/profile']) ?>">
              <i class="fa fa-circle text-success"></i>
              <?php echo Yii::$app->formatter->asDatetime(time()) ?>
            </a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?php echo Menu::widget([
          'options' => ['class' => 'sidebar-menu'],
          'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
          'submenuTemplate' => "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
          'activateParents' => true,
          'items' => [
            [
              'label' => Yii::t('backend', 'Main'),
              'options' => ['class' => 'header'],
              // 'encodeLabel' => false,
            ],
            [
              'label' => Yii::t('backend', 'Dashboard'),
              'icon' => '<i class="fa fa-bar-chart-o"></i>',
              'url' => ['/dashboard/default/index'],
//              'badge' => TimelineEvent::find()->today()->count(),
              'badgeBgClass' => 'label-success',
            ],
            [
              'label' => 'Initialization',
              'url' => '#',
              'icon' => '<i class="fa fa-dashboard"></i>',
              'items' => [
                // ['label' => 'Regions', 'url' => ['/init/regions/index'], 'icon' => '<i class="fa fa-angle-right"></i>'],
                // ['label' => 'Town', 'url' => ['/init/towns/index'], 'icon' => '<i class="fa fa-angle-right"></i>'],
                ['label' => 'Brand Sectors', 'url' => ['/init/brand-sectors/index'], 'icon' => '<i class="fa fa-angle-right"></i>'],
                [
                  'label' => 'Categories',
                  'url' => ['/categories/categories/index'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],
                ['label' => 'Brands', 'url' => ['/init/brands/index'], 'icon' => '<i class="fa fa-angle-right"></i>'],
                // ['label' => 'Units', 'url' => ['/init/units/index'], 'icon' => '<i class="fa fa-angle-right"></i>'],
                ['label' => 'Stores', 'url' => ['/init/stores/index'], 'icon' => '<i class="fa fa-angle-right"></i>'],


              ]
            ],


            [
              'label' => 'Cash Management',
              'icon' => '<i class="fa fa-dollar"></i>',
              'url' => '#',
              'options' => ['class' => 'treeview'],
              'items' => [
                [
                  'label' => 'Cash Collection',
                  'url' => ['/cash/cash-collection/index'],
                  'icon' => '<i class="fa fa-angle-right"></i>',
                ],
                
                [
                  'label' => 'Expenses',
                  'url' => ['/expenses/expenses/index'],
                  'icon' => '<i class="fa fa-angle-right"></i>',
                ],


              ],
            ],
            [
              'label' => 'Articles',
              'icon' => '<i class="fa fa-leaf"></i>',
              'url' => '#',
              'options' => ['class' => 'treeview'],
              'items' => [
                [
                  'label' => 'List Articles',
                  'url' => ['/products/products/index'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],
                // [
                //   'label' => 'Articles Stock',
                //   'url' => ['/products/products/sizes-stock'],
                //   'icon' => '<i class="fa fa-angle-right"></i>',

                // ],
                [
                  'label' => 'Inventory Details',
                  'url' => ['/products/products/inventory'],
                  'icon' => '<i class="fa fa-angle-right"></i>',
                  'visible' => false,
                ],
                [
                  'label' => 'Add New Article',
                  'url' => ['/products/products/create'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],

                // [
                //   'label' => 'Variant Definitions',
                //   'url' => ['/products/product-variants/index'],
                //   'icon' => '<i class="fa fa-angle-right"></i>',

                // ],


              ]

            ],


            [
              'label' => 'Manage Locations',
              'url' => ['/location'],
              'icon' => '<i class="fa fa-angle-right"></i>',
              'visible' => false,
            ],
            [
              'label' => 'Management',
              'icon' => '<i class="fa fa-bar-chart-o"></i>',
              'url' => '#',
              'visible' => false,
              'options' => ['class' => 'treeview'],
              'items' => [
                [
                  'label' => 'Manage Locations',
                  'url' => ['/location'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],


              ]

            ],

            [
              'label' => 'Customers',
              'icon' => '<i class="fa fa-users"></i>',
              'url' => '#',
              'options' => ['class' => 'treeview'],
              'items' => [
                [
                  'label' => 'Customer List',
                  'url' => ['/customers/default/index'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],
                [
                  'label' => 'Add Customer',
                  'url' => ['/customers/default/create'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],


              ]

            ],

            [
              'label' => 'Suppliers',
              'url' => '#',
              'icon' => '<i class="fa fa-leaf"></i>',
              'items' => [
                [
                  'label' => 'View Suppliers',
                  'url' => ['/supplier/suppliers/index'],
                  'icon' => '<i class="fa fa-angle-right"></i>'
                ],
                [
                  'label' => 'Create Supplier',
                  'url' => ['/supplier/suppliers/create'],
                  'icon' => '<i class="fa fa-angle-right"></i>'
                ],
                [
                  'label' => 'Payments To HO',
                  'url' => ['/cash/supplier-payments/index'],
                  'icon' => '<i class="fa fa-angle-right"></i>',
                ],


              ]
            ],
            //here the dispacthes
            [
              'label' => 'Dispatches',
              'icon'  => '<i class="fa fa-bar-chart-o"></i>',
              'url'   =>  '#',
              'options' => ['class' => 'treeview'],
              'items' => [
                [
                  'label' => 'List Dispatches',
                  'url' => ['/dispacthe/default/'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],
                [
                  'label' => 'New Dispatch',
                  'url' => ['/dispacthe/default/create'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],

              ]

            ],
            // [
            //   'label' => 'Inventory',
            //   'icon' => '<i class="fa fa-bar-chart-o"></i>',
            //   'url' => '#',
            //   'options' => ['class' => 'treeview'],
            //   'items' => [
            //     [
            //       'label' => 'List Inventory',
            //       'url' => ['/inventory'],
            //       'icon' => '<i class="fa fa-angle-right"></i>',

            //     ],
            //     [
            //       'label' => 'Add Inventory',
            //       'url' => ['/inventory/inventory/create'],
            //       'icon' => '<i class="fa fa-angle-right"></i>',

            //     ],

            //   ]

            // ],

            [
              'label' => 'Sales',
              'icon' => '<i class="fa fa-pencil"></i>',
              'url' => '#',
              'options' => ['class' => 'treeview'],
              'items' => [

                [
                  'label' => 'All Sales',
                  'url' => ['/sales/sales/index'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],
                [
                  'label' => 'New Sale',
                  'url' => ['/sales/sales/create'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],
                [
                  'label' => 'Sales Return',
                  'url' => ['/sales/sales/return'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],

                [
                  'label' => 'Add Inventory',
                  'url' => ['/inventory/inventory/create'],
                  'icon' => '<i class="fa fa-angle-right"></i>',
                  'visible' => false,

                ],

              ]

            ],

            [
              'label' => 'Recieve Inventory',
              'icon' => '<i class="fa fa-pencil"></i>',
              'url' => '#',
              'options' => ['class' => 'treeview'],
              'items' => [

                [
                  'label' => 'All Recieve Inventory',
                  'url' => ['/purchases/purchases/index'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],
                [
                  'label' => 'New Recieve Inventory',
                  'url' => ['/purchases/purchases/create'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],
                [
                  'label' => 'Recieve Inventory Return',
                  'url' => ['/purchases/purchases/return'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],

                // [
                //     'label' => 'Add Inventory',
                //     'url' => ['/inventory/inventory/create'],
                //     'icon'=>'<i class="fa fa-angle-right"></i>',

                // ],

              ]

            ],

            [
              'label' => Yii::t('backend', 'Accounts'),
              'icon' => '<i class="fa fa-bar-chart-o"></i>',
              'url' => '#',
              'options' => ['class' => 'treeview'],
              'items' => [
                [
                  'label' => 'Primary',
                  'url' => ['/accounts/primary-accounts/index'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],
                [
                  'label' => 'Secondary',
                  'url' => ['/accounts/secondary-accounts/index'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],
                [
                  'label' => 'Accounts',
                  'url' => ['/accounts/accounts/index'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],
                [
                  'label' => 'Groups',
                  'url' => ['/accounts/groups/index'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],

                [
                  'label' => 'Transactions',
                  'url' => '#',
                  'icon' => '<i class="fa fa-angle-right"></i>',
                  'options' => ['class' => 'treeview'],
                  'items' => [

                    [
                      'label' => 'All Transctions',
                      'url' => ['/accounts/transactions/index'],
                      'icon' => '<i class="fa fa-angle-right"></i>',
                    ],
                    [
                      'label' => 'Create Transction',
                      'url' => ['/accounts/transactions/create'],
                      'icon' => '<i class="fa fa-angle-right"></i>',
                    ],

                  ]

                ],

                [
                  'label' => 'Trail Balance',
                  'url' => ['/accounts/accounts/trialbalance'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],
                [
                  'label' => 'Income Statement',
                  'url' => ['/accounts/primary-accounts/income-statement'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],
                [
                  'label' => 'Balance Sheet',
                  'url' => ['/accounts/secondary-accounts/balance-sheet'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],



                [
                  'label' => 'Account Settings',
                  'url' => ['/accounts/account-settings/index'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],


              ]
            ],
            [
              'label' => 'Reports',
              'url' => '#',
              'icon' => '<i class="fa fa-bars"></i>',
              'options' => ['class' => 'treeview'],
              'visible' => true,
              'items' => [
                [
                  'label' => 'Daily Sales',
                  'url' => ['/reports/default/daily-sales'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],
                [
                  'label' => 'Product Wise Stock',
                  'url' => ['/reports/default/product-stock'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],
                [
                  'label' => 'Brand Wise Sales',
                  'url' => ['/reports/default/brand-sales'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],

                [
                  'label' => 'Stock Recaptulation',
                  'url' => ['/reports/default/recaptulation'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],

              ]
            ],
            [
              'label' => Yii::t('backend', 'Content'),
              'url' => '#',
              'icon' => '<i class="fa fa-edit"></i>',
              'options' => ['class' => 'treeview'],
              'visible' => false,
              'items' => [
                ['label' => Yii::t('backend', 'Static pages'), 'url' => ['/page/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                ['label' => Yii::t('backend', 'Articles'), 'url' => ['/article/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                ['label' => Yii::t('backend', 'Article Categories'), 'url' => ['/article-category/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                ['label' => Yii::t('backend', 'Text Widgets'), 'url' => ['/widget-text/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                ['label' => Yii::t('backend', 'Menu Widgets'), 'url' => ['/widget-menu/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                ['label' => Yii::t('backend', 'Carousel Widgets'), 'url' => ['/widget-carousel/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
              ]
            ],
            [
              'label' => Yii::t('backend', 'System'),
              'options' => ['class' => 'header']
            ],
            [
              'label' => Yii::t('backend', 'Users'),
              'icon' => '<i class="fa fa-users"></i>',
              'url' => ['/user/index'],
              'visible' => Yii::$app->user->can('administrator')
            ],
            [
              'label' => Yii::t('backend', 'Other'),
              'url' => '#',
              'icon' => '<i class="fa fa-cogs"></i>',
              'options' => ['class' => 'treeview'],
              'visible' => false,
              'items' => [
                [
                  'label' => Yii::t('backend', 'i18n'),
                  'url' => '#',
                  'icon' => '<i class="fa fa-flag"></i>',
                  'options' => ['class' => 'treeview'],
                  'items' => [
                    ['label' => Yii::t('backend', 'i18n Source Message'), 'url' => ['/i18n/i18n-source-message/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                    ['label' => Yii::t('backend', 'i18n Message'), 'url' => ['/i18n/i18n-message/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                  ]
                ],
                ['label' => Yii::t('backend', 'Key-Value Storage'), 'url' => ['/key-storage/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                ['label' => Yii::t('backend', 'File Storage'), 'url' => ['/file-storage/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                ['label' => Yii::t('backend', 'Cache'), 'url' => ['/cache/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                ['label' => Yii::t('backend', 'File Manager'), 'url' => ['/file-manager/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                [
                  'label' => Yii::t('backend', 'System Information'),
                  'url' => ['/system-information/index'],
                  'icon' => '<i class="fa fa-angle-double-right"></i>'
                ],
                [
                  'label' => Yii::t('backend', 'Logs'),
                  'url' => ['/log/index'],
                  'icon' => '<i class="fa fa-angle-double-right"></i>',
                  'badge' => \backend\models\SystemLog::find()->count(),
                  'badgeBgClass' => 'label-danger',
                ],
              ]
            ],

            [
              'label' => 'Settings',
              'icon' => '<i class="fa fa-gears"></i>',
              'url' => '#',
              'options' => ['class' => 'treeview'],
              'items' => [
                [
                  'label' => 'Business Information',
                  'url' => ['/business/businesses'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],
                [
                  'label' => 'Printers',
                  'url' => ['/printers'],
                  'icon' => '<i class="fa fa-angle-right"></i>',

                ],
              ],
            ],
            
          ]
        ]) ?>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?php echo $this->title ?>
          <?php if (isset($this->params['subtitle'])): ?>
            <small><?php echo $this->params['subtitle'] ?></small>
          <?php endif; ?>
        </h1>

        <?php echo Breadcrumbs::widget([
          'tag' => 'ol',
          'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
      </section>

      <!-- Main content -->
      <section class="content">
        <?php if (Yii::$app->session->hasFlash('alert')): ?>
          <?php echo \yii\bootstrap\Alert::widget([
            'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
            'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
          ]) ?>
        <?php endif; ?>
        <?php echo $content ?>
      </section><!-- /.content -->
    </aside><!-- /.right-side -->
  </div><!-- ./wrapper -->

<?php $this->endContent(); ?>