<?php

/* @var $this yii\web\View */

/* @var $dataProvider \yii\data\ActiveDataProvider */

use yii\helpers\Html;

$this->title = 'Вопросы анкеты';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <span class="text-semibold"><?= $this->title ?></span>
            </h4>
        </div>

        <div class="heading-elements">

            <div class="heading-btn-group">
                <a href="/questions/add?<?= http_build_query($_GET) ?>" class="btn btn-link btn-float has-text"><i
                        class="icon-add text-primary"></i><span>Добавить</span></a>
            </div>
        </div>
    </div>
</div>
<!-- /page header -->

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">
        <div class="panel panel-white">

            <!-- Main content -->
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => [
                    'class' => 'table table-striped table-bordered table-hover',
                    'id' => 'items-list',
                ],
                'summary' => false,
                'columns' => [
                    [
                        'label' => '',
                        'format' => 'raw',
                        'contentOptions' => [
                            'class' => 'draggable-cell',
                            'style' => 'width: 40px;'
                        ],
                        'value' => function($data){
                            return $data->id;
                        },
                    ],
                    [
                        'attribute' => 'id',
                        'headerOptions' => ['style' => 'width: 60px;'],
                        'contentOptions' => ['style' => 'text-align: right'],
                    ],
                    'label',
                    'description',
                    'name',
                    'input_mask',
                    [
                        'headerOptions' => ['style' => 'width: 60px;'],
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update}',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                    'title' => 'Редактировать запись',
                                ]);
                            },
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'update') {
                                $url = '/questions/update?id=' . $model->id;
                                return $url;
                            }
                        }
                    ],
                ],
            ]); ?>
            <!-- /main content -->
        </div>
    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

<?php
$this->registerJs(
    '
	$(document).ready(function() {
		
		var fixHelper = function(e, ui) {
            ui.children().each(function() {
                $(this).width($(this).width());
            });
            return ui;
        }
		
		$("#items-list tbody").sortable({
		    handle: ".draggable-cell",
		    containment: "parent",
		    forceHelperSize: true,
		    scroll: false,
			helper: fixHelper,
			stop: function(event,ui) {
				renumber_table("#items-list")
			}
		}).disableSelection();
	});

	 //Renumber table rows
	 function renumber_table(tableID) {
		var Order = [];
		 $(tableID + " tr").each(function() {
			 count = $(this).parent().children().index($(this)) + 1;
			 var id = $(this).find(".draggable-cell").text();
			 if (parseInt(id) > 0){
			 	Order.push(id);
			 }
		 });

		$.ajax({
			method: "POST",
			type: "json",
			url: "/questions/sort",
			data: {Order: Order},
			cache: false,
			success: function(data){
				console.log(data);
			}
		})
	 }
	', \yii\web\View::POS_READY, 'draggable-table ');
?>