<style>
    .table-view .table-view-cell {
        background-position: 0px 100%;
    }
    .col-xs-9, .col-xs-3{
        padding: 0px;
    }
    .table-view-cell {
        padding: 11px 12px 11px 15px;
    }
</style>

<div class="row">
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <a class="btn btn-primary pull-left" onclick="window.location = '<?php echo site_url('admin/lock'); ?>';"> Lock Profile</a>
    <div class="col-lg-9">
    <a class="btn btn-primary pull-right" onclick="window.location = '<?php echo site_url('admin/unlock'); ?>';"> UnLock Profile</a>
    </div>
    <div class="col-lg-9">
    <a class="btn btn-primary pull-right" onclick="window.location = '<?php echo site_url('admin/profile_view'); ?>';"> Control Access</a>
    </div>
  
</div>
</div>
<div class="row">

<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <div class="table-responsive">
        <table class="table table-bordered table-hover "   >
            <tr>
                <th >
                    
                    Zone
                
                </th>
                <th > Territory</th>
                 <th > 
                     <input type="checkbox" id ="chckHead"/>Profiling
                <!--<input type="checkbox" name="checkAll" id="checkAll">-->
                 </th>
                <th>   <input type="checkbox" id ="chckHead2"/>ProfilingSet Target</th>
                <th>    <input type="checkbox" id ="chckHead3"/>ProfilingPlanning</th>
                <th>   <input type="checkbox" id ="chckHead4"/>ProfilingReporting For Activities</th> 
                <th>   <input type="checkbox" id ="chckHead5"/>ProfilingReporting For Prescription</th> 
            </tr>
            <tr>
                <?php
                 echo form_open('admin/profile_view'); 

                if (!empty($show)) {
                    foreach ($show as $row) :
                        ?><tr>  
                        <td>  <input type="checkbox" id ="chckHeadrow"/><?php echo $row->Zone; ?></td> 
                         <td><?php echo $row->Territory; ?></td> 
                        <td ><input type="checkbox" name="tab1" class = "chcktbl" <?php
                            if ($row->Tab1 == 1) {
                                echo "checked='checked'";
                            }
                            ?></td>  
                        <td><input type="checkbox" name="tab2" class = "chcktbl2" <?php
                            if ($row->Tab2 == 1) {
                                echo "checked='checked'";
                            }
                            ?></td>  
                        <td><input type="checkbox" name="tab3" class = "chcktbl3" <?php
                                   if ($row->Tab3 == 1) {
                                       echo "checked='checked'";
                                   }
                                   ?>></td>  
                        <td><input type="checkbox" name="tab4" class = "chcktbl4"<?php
                        if ($row->Tab4 == 1) {
                            echo "checked='checked'";
                        }
                        ?></td>  
                        <td><input type="checkbox" name="tab5" class = "chcktbl5"<?php
                if ($row->Tab5 == 1) {
                    echo "checked='checked'";
                }
                ?></td>  

        <?php
    endforeach;
}
?>
            </tr>
        </table>
    </div>
</div>
</div>
    <script>

$(function () {
    $("#tab1 #checkAll").click(function () {
        if ($("#tab1 #checkAll").is(':checked')) {
            $("#tab1 input[type=checkbox]").each(function () {
                $(this).attr("checked", true);
            });

        } else {
            $("#tab1 input[type=checkbox]").each(function () {
                $(this).attr("checked", false);
            });
        }
    });
});

</script>
<script type="text/javascript">
    $('#chckHeadrow').click(function () {
        if (this.checked == false) {
            $('.chcktbl:checked').attr('checked', false);
             $('.chcktbl2:checked').attr('checked', false);
              $('.chcktbl3:checked').attr('checked', false);
               $('.chcktbl4:checked').attr('checked', false);
               $('.chcktbl5:checked').attr('checked', false);
               
        }
        else {
            $('.chcktbl:not(:checked)').attr('checked', true);
            $('.chcktbl2:not(:checked)').attr('checked', true);
              $('.chcktbl3:not(:checked)').attr('checked', true);
               $('.chcktbl4:not(:checked)').attr('checked', true);
               $('.chcktbl5:not(:checked)').attr('checked',true);
        }
    });
    $('#chckHeadrow').click(function () {
    });
</script>
<script type="text/javascript">
    $('#chckHead').click(function () {
        if (this.checked == false) {
            $('.chcktbl:checked').attr('checked', false);
        }
        else {
            $('.chcktbl:not(:checked)').attr('checked', true);
        }
    });
    $('#chckHead').click(function () {
    });
</script>
<script type="text/javascript">
    $('#chckHead2').click(function () {
        if (this.checked == false) {
            $('.chcktbl2:checked').attr('checked', false);
        }
        else {
            $('.chcktbl2:not(:checked)').attr('checked', true);
        }
    });
    $('#chckHead').click(function () {
    });
</script><script type="text/javascript">
    $('#chckHead3').click(function () {
        if (this.checked == false) {
            $('.chcktbl3:checked').attr('checked', false);
        }
        else {
            $('.chcktbl3:not(:checked)').attr('checked', true);
        }
    });
    $('#chckHead3').click(function () {
    });
</script><script type="text/javascript">
    $('#chckHead4').click(function () {
        if (this.checked == false) {
            $('.chcktbl4:checked').attr('checked', false);
        }
        else {
            $('.chcktbl4:not(:checked)').attr('checked', true);
        }
    });
    $('#chckHead4').click(function () {
    });
</script>
<script type="text/javascript">
    $('#chckHead5').click(function () {
        if (this.checked == false) {
            $('.chcktbl5:checked').attr('checked', false);
        }
        else {
            $('.chcktbl5:not(:checked)').attr('checked', true);
        }
    });
    $('#chckHead5').click(function () {
    });
</script>


</html>