
<div class="col-lg-10 col-sm-10 col-md-10 col-xs-10">
    <div class="table-responsive">
    <table class="table table-bordered table-hover ">
      <tr>
      <tr style="background-color: #428BCA">
                    <th>Full Name</th>
                    <th> NO Of Login</th>

                    
                </tr>
                <tr>
                    <?php
                    if (!empty($show)) {
                        foreach ($show as $row) :
                            ?><tr>  
                            <td><?php echo $row->Full_Name; ?></td>  
                            <td> <button class="btn btn-xs btn-info" type="button"  id=" <?php echo $row->id ?>" onclick="view(this.id)"><?Php echo $row->count ;?></button> </td>  
                          
                                <?php
                            endforeach;
                        }
                        ?>
                </tr>


        </table>
    </div>
</div>

<div id="modalpopup"></div>
  
            
<script>
    function view(id) {
        var login_id = id;
       
        $.ajax({
            type: 'POST',
            data: {login_id: login_id, type: 'view'},
            url: base_url+"index.php?/admin/login_view",,
            
            success: function (data) {
                
                $("#modalpopup").html(data);
                 
            }
           
        });
    }



</script>