<?php

use yii\web\JsExpression;
use yii\jui\AutoComplete;
use yii\helpers\Html;
use biz\purchase\models\PurchaseDtl;
use mdm\widgets\TabularInput;
use biz\app\assets\BizDataAsset;
use biz\master\components\Helper as MasterHelper;

/* @var $details PurchaseDtl[] */
/* @var $model biz\purchase\models\Purchase */
/* @var $this yii\web\View */
?>
<div class="col-lg-9">
    <div class="panel panel-info">
        <div class="panel-heading">
            Product :
            <?php
            echo AutoComplete::widget([
                'name' => 'product',
                'id' => 'product',
                'clientOptions' => [
                    'source' => new JsExpression('yii.global.sourceProduct'),
                    'select' => new JsExpression('yii.purchase.onProductSelect'),
                    'delay' => 100,
                ]
            ]);
            ?>
            <div class="pull-right">
                Item Discount:
                <?= Html::activeTextInput($model, 'item_discount', ['style' => 'width:60px;','id'=>'item-discount']); ?>
            </div>
        </div>
        <div class="panel-body" style="text-align: right;">
            <?= Html::activeHiddenInput($model, 'purchase_value', ['id'=>'purchase-value']); ?>
            <h4 id="bfore" style="display: none;">Rp <span id="purchase-val">0</span>-<span id="disc-val">0</span></h4>
            <h2>Rp <span id="total-price"></span></h2>
        </div>
        <table class="table table-striped">
            <?=
            TabularInput::widget([
                'id'=>'detail-grid',
                'allModels' => $details,
                'modelClass' => PurchaseDtl::className(),
                'options' => ['tag' => 'tbody'],
                'itemOptions' => ['tag' => 'tr'],
                'itemView'=>'_item_detail',
                'clientOptions'=>[

                ]
            ])
            ?>
        </table>
    </div>
</div>
<?php
$js = $this->render('_script',[],$this->context);
$this->registerJs($js, \yii\web\View::POS_END);
BizDataAsset::register($this, [
    'master'=>  MasterHelper::getMasters('product, barcode, supplier, product_supplier')
]);
$js = <<<JS
yii.purchase.onReady();

JS;
$this->registerJs($js);
