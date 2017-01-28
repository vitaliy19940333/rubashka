<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        title: {
            text: 'Статистика'
        },
        xAxis: {
            categories: ['Кол-во журналов', 'Кол-во журналов имеющие ISSN-online', 'Кол-во журналов имеющие свой сайт']
        },
        labels: {
            items: [{
                html: '',
                style: {
                    left: '50px',
                    top: '18px',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                }
            }]
        },
        series: [{
            type: 'column',
            name: 'Индексация',
            data: [<?=$data[0]['indexing']['count']['id']?>, <?=$data[0]['indexing']['issn']['id']?>, <?=$data[0]['indexing']['site']['id']?>]
        }, {
            type: 'column',
            name: 'Поддержка',
            data: [<?=$data[0]['support']['count']['id']?>, <?=$data[0]['support']['issn']['id']?>, <?=$data[0]['support']['site']['id']?>]
        }, {
            type: 'column',
            name: 'Издания',
            data: [<?=$data[0]['publishing']['count']['id']?>, <?=$data[0]['publishing']['issn']['id']?>, <?=$data[0]['publishing']['site']['id']?>]
        },  {
            type: 'pie',
            name: 'Средний GSJP Value',
            data: [{
                name: 'Индексация',
                y:<?=round($data[0]['indexing']['val']['val'],2)?>,
                color: Highcharts.getOptions().colors[0] // Jane's color
            }, {
                name: 'Поддержка',
                y:  <?=round($data[0]['support']['val']['val'],2)?>,
                color: Highcharts.getOptions().colors[1] // John's color
            }, {
                name: 'Издания',
                y:  <?=round($data[0]['publishing']['val']['val'],2)?>,
                color: Highcharts.getOptions().colors[2] // Joe's color
            }],
            center: [20, 40],
            size: 70,
            showInLegend: false,
            dataLabels: {
                enabled: false
            }
        }]
    });
});
</script>
<?
	$stobc = "[";
	$stobc1 = "[";
	
	foreach($data[1] as $key => $value)
	{
		$datas.= "['".$value['title_'.$_SESSION['lang']]."',".$value['alls']."],";
		$stobc.= "'".$value['title_'.$_SESSION['lang']]."',";
		$stobc1.= round($value['sommo']/$value['alls'],0).",";
	}
		$stobc = substr($stobc,0,-1);
	$stobc1 = substr($stobc1,0,-1);
	$stobc.= "]";
	$stobc1.= "]";		
	$datas =  substr($datas,0,-1);
	?>
	<script type="text/javascript">
$(function () {
    $('#container2').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: ''
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: '% от общего кол-ва статьей ',
            data: [
                <?=$datas?>
            ]
        }]
    });
});
		</script>
		<script type="text/javascript">
$(function () {
    $('#container3').highcharts({
        chart: {
            type: 'column',
            margin: 75,
            options3d: {
                enabled: true,
                alpha: 15,
                beta: 22,
                depth: 70
            }
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        plotOptions: {
            column: {
                depth: 40
            }
        },
        xAxis: {
            categories:<?=$stobc?>
        },
        yAxis: {
            title: {
                text: null
            }
        },
        series: [{
            name: 'Среднеарифметическое кол-во просмотров',
            data: <?=$stobc1?>
        }]
    });
});
		</script>
		
<script src="/js/highchartdiagr/highcharts.js"></script>
<script src="/js/highchartdiagr/highcharts-3d.js"></script>
<script src="/js/highchartdiagr//modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div><hr><hr>
<h1>Статистика 2</h1>
<div id="container2" style="height: 400px"></div>
<h1>Статистика 3</h1>
<div id="container3" style="height: 600px"></div>