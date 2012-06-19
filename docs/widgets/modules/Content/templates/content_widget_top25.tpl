{pageaddvar name="javascript" value="jquery"}
{pageaddvar name="javascript" value="javascript/jquery-plugins/jqPlot/jquery.jqplot.min.js"}
{pageaddvar name="javascript" value="javascript/jquery-plugins/jqPlot/plugins/jqplot.dateAxisRenderer.min.js"}
{pageaddvar name="javascript" value="javascript/jquery-plugins/jqPlot/plugins/jqplot.canvasTextRenderer.min.js"}
{pageaddvar name="javascript" value="javascript/jquery-plugins/jqPlot/plugins/jqplot.canvasAxisTickRenderer.min.js"}
{pageaddvar name="javascript" value="javascript/jquery-plugins/jqPlot/plugins/jqplot.categoryAxisRenderer.min.js"}
{pageaddvar name="javascript" value="javascript/jquery-plugins/jqPlot/plugins/jqplot.barRenderer.min.js"}
{pageaddvar name="stylesheet" value="javascript/jquery-plugins/jqPlot/jquery.jqplot.css"}
{pageaddvar name="stylesheet" value="javascript/jquery-plugins/jqPlot/examples/examples.css"}
<script>jQuery(document).ready(function(){
  var line1 = [
               {{foreach from=$views item=page}}
               	['{{$page.page_title}}',{{$page.page_views}}],
               {{/foreach}}
               ];
               
 
  var plot1 = jQuery.jqplot('top25contentchart', [line1], {
    title: 'Top 25 Content Views',
    series:[{renderer:jQuery.jqplot.BarRenderer}],
    axesDefaults: {
        tickRenderer: jQuery.jqplot.CanvasAxisTickRenderer ,
        tickOptions: {
          angle: -30,
          fontSize: '6pt'
        }
    },
    axes: {
      xaxis: {
        renderer: jQuery.jqplot.CategoryAxisRenderer
      }
    },
    seriesDefaults: {
        rendererOptions: {
            barPadding: 0,
            barMargin: 0,      // number of pixels between adjacent groups of bars.
            barDirection: 'vertical', // vertical or horizontal.
            barWidth: 3,     // width of the bars.  null to calculate automatically.
            shadowOffset: 1,
        }
    }
  });
});</script>

<div id="top25contentchart" style="height:200px; width:400px;"></div>
<div class="code prettyprint">

</div>