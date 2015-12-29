     <script src="<?php echo asset_url() ?>js/highcharts.js" type="text/javascript"></script>
   
      
               
           <form class="card">
                <ul class="table-view " >
                    <li class="table-view-cell" style="text-align: center">
                        <b>Jan 2016 Result</b>
                        </li>
               <li class="table-view-cell">
           
                     Sort By
            <select class="form-control ">
                <option>Please Select</option>
                <option>Parameter1</option>
                    <option>Parameter2</option>
                    <option>Parameter3</option>      
            
                   
            </select>
               </li>
                </ul>
                    
           
           <div class="col-lg-12">
                <div class="panel-body" id="piechart">
                </div>
                </div>
                </form>

        
      </div>
 
   
<script>
    $(function () {
        $('#piechart').highcharts({
            chart: {
                plotBackgroundColor: null,
              
                plotShadow: false
            },
            title: {
                text: ''
               
                
                
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            credits: {
                enabled: false,
                text: 'Techvertica.com',
                href: 'http://www.techvertica.com'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                       
                    }
                }
            },
            
            series: [{
                    type: 'pie',
                    name: 'Class',
                   data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5]
                    
                }]
            
        });
    });
</script>