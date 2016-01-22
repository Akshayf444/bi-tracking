
<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover ">
                <tr>
                    <th>Name</th>
                   
                    
                    <th>Action</th>
                </tr>
                <tr>
                    <?php
                    if (!empty($unlock)) {
                        foreach ($unlock as $row) :
                            ?><tr> 
             <td>   <input type="hidden" value="<?php $row->VEEVA_Employee_ID;?>" name="id">
                            <?php echo $row->Full_Name; ?></td>  
                             


                            <td>  
                                <a class="btn btn-success" onclick="window.location = '<?php echo site_url('admin/unlock_account?id=') . $row->VEEVA_Employee_ID; ?>';">Unlocked</a> 
                              </td>
                                <?php
                            endforeach;
                        }
                        ?>
                </tr>
            </table>
        </div>
    </div>
</div>