
<div class="col-lg-10 col-sm-10 col-md-10 col-xs-10">
    <div class="table-responsive">
    <table class="table table-bordered table-hover ">
      <tr>
      <tr style="background-color: #428BCA">
                    <th>Full Name</th>
                    
                    <th>Specialty</th>
                </tr>
                <tr>
                    <?php
                    if (!empty($show)) {
                        foreach ($show as $row) :
                            ?><tr>  
                            <td><?php echo $row->Name; ?></td>  
                         <td><?php echo $row->Specialty; ?></td>  
                                <?php
                            endforeach;
                        }
                        ?>
                </tr>



        </table>
    </div>
</div>