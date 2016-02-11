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

<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <a class="btn btn-primary pull-right" onclick="window.location = '<?php echo site_url('admin/lock'); ?>';"> Lock Profile</a>
    <a class="btn btn-primary pull-right" onclick="window.location = '<?php echo site_url('admin/unlock'); ?>';"> UnLock Profile</a>
</div>


<div class="col-lg-10 col-sm-10 col-md-10 col-xs-10">
    <div class="table-responsive">
        <table class="table table-bordered table-hover ">
            <tr>
                <th>BDM Name</th>
                <th> Profiling</th>
                <th>Set Target</th>
                <th>Planning</th>
                <th>Reporting For Activities</th> 
                <th>Reporting For Prescription</th> 
            </tr>
            <tr>
                <?php
                if (!empty($show)) {
                    foreach ($show as $row) :
                        ?><tr>  
                        <td><?php echo $row->Full_Name; ?></td>  
                        <td><input type="checkbox" name="tab1" <?php
                            if ($row->Tab1 == 1) {
                                echo "checked='checked'";
                            }
                            ?></td>  
                        <td><input type="checkbox" name="tab2" <?php
                            if ($row->Tab2 == 1) {
                                echo "checked='checked'";
                            }
                            ?></td>  
                        <td><input type="checkbox" name="tab3" <?php
                            if ($row->Tab3 == 1) {
                                echo "checked='checked'";
                            }
                            ?>></td>  
                        <td><input type="checkbox" name="tab4"<?php
                            if ($row->Tab4 == 1) {
                                echo "checked='checked'";
                            }
                            ?></td>  
                        <td><input type="checkbox" name="tab5"<?php
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



