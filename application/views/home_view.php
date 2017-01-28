<style>
#container {
    height: 500px; 
    min-width: 310px; 
    max-width: 800px; 
    margin: 0 auto; 
}
.loading {
    margin-top: 10em;
    text-align: center;
    color: gray;
}
		</style>
		<script type="text/javascript">
$(function () {
        // Initiate the chart
        $('#container').highcharts('Map', {

          title: {
                text: 'Geographical location our journals',
				 style: {
                        color: (Highcharts.theme && Highcharts.theme.textColor) || '#8B2727'
                    }
            },

            legend: {
                title: {
                    text: '',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'red'
                    }
                }
            },
            mapNavigation: {
                enabled: true,
                enableDoubleClickZoomTo: true
            },

           colorAxis: {
                min: 1,
                max: 1000,
                type: 'logarithmic',
				stops: [
                        [0, 'rgba(96, 148, 39, 0.4)'],
                        [0.5, 'rgba(96, 148, 39, 1)'],
                        [1, Highcharts.Color('rgba(96, 148, 39, 1)').brighten(-0.6).get()]
                    ]
            },

            series : [{
                 data : [<?=$data?>
						],
                mapData: Highcharts.maps['custom/world'],
                joinBy: ['iso-a2', 'code'],
                name: ' ',
                 states: {
                    hover: {
                        color: '#8B2727'
                    }
                },
                tooltip: {
                    valueSuffix: ''
                }
            }]
        });

});
		</script>
<script src="/js/highchart/highmaps.js"></script>
<script src="/js/highchart/modules/data.js"></script>
<script src="/js/highchart/modules/exporting.js"></script>
<script src="/js/highchart/data.js"></script>
<!-- Flag sprites service provided by Martijn Lafeber, https://github.com/lafeber/world-flags-sprite/blob/master/LICENSE -->
<div id="container"></div>
<style>
#example{padding:0px 0px 0px 100px;display:none;}
#example .new{opacity: 0;}
#example .div_opacity{
  -webkit-transition: opacity .1s ease-in-out;
  -moz-transition: opacity .1s ease-in-out;
  -ms-transition: opacity .1s ease-in-out;
  -o-transition: opacity .1s ease-in-out;
  transition: opacity .1s ease-in-out;
  opacity: 1;}
  #example{
	  font-size:40px;
	  color:#6F9048;
	  text-align:left;
	  font-family:georgia
  }
  
  .modal {
    text-align: center;
    white-space: nowrap;
}

.modal::after {
    display: inline-block;
    vertical-align: middle;
    width: 0;
    height: 100%;
    content: '';
}

.modal-dialog {
    display: inline-block;
    vertical-align: middle;
}

.modal-content {
    margin: 50px;
    padding: 20px;
    min-width: 200px;
    text-align: left;
    white-space: normal;
    background-color: #fff;    
    color: #000;
}
</style>
<?
if(!(strpos($_SERVER['HTTP_REFERER'],'gsjp',0) > 1))
{
?>
<button style="display:none" id='mymodal' class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"></button>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
       <button style="display:none" id='mymodals' type="button" class="btn btn-default" data-dismiss="modal"></button>
			<h1 style='font-size:50px'>Welcome to GSJP</h1>
			<div id="example">
			Global Science Journal Publishing
			</div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#mymodal").trigger("click");
	  setTimeout(cl,4500);
	  function cl(){
		   $("#mymodals").trigger("click");
	  }
 $.fn.animate_Text = function() {
  var string = this.text();
  return this.each(function(){
   var $this = $(this);
   $this.html(string.replace(/./g, '<span class="new">$&</span>'));
   $this.find('span.new').each(function(i, el){
    setTimeout(function(){ $(el).addClass('div_opacity'); }, 100 * i);
   });
  });
 };
 $('#example').show();
 $('#example').animate_Text();
});
</script>
<?
}
?>