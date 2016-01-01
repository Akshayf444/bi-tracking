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
<div class="card">
    <ul class="table-view">
        <li class="table-view-cell table-view-divider">
            <span class="pull-left">Total Expected Rx For Jan 2016 : <b>200</b></span><br>
            <span class="pull-left">Balanced Rx To Plan For Jan 2016: <b>200</b></span>
            <span class="pull-right">
                Sort By
                <select class="form-control">
                    <option>Rx</option>
                    <option>Priority</option>
                    <option>Winability</option>
                    <option>Dependency</option>
                </select>
            </span>
        </li>
    </ul>
</div>

<div class="card">
    <ul class="table-view">
        <li class="table-view-cell table-view-divider">Planning</li>
        <li class="table-view-cell ">

            <table class="table table-bordered">
                <tr>
                    <th>Doctor List</th>
                    <th>Winability</th>
                    <th>Dependency</th>
                    <th>BI Rx Share</th>
                    <th>Oct Rx</th>
                    <th>Nov Rx</th>
                    <th>Dec Rx</th>
                    <th>Planned for Jan</th>
                    <th>Aactual</th>
                </tr>
<?php echo form_open('User/Prescription_Doctor_List');?>
                <?php
                if (isset($doctorList) && !empty($doctorList)) {
                    foreach ($doctorList as $doctor) {
                        ?>
                        <tr>
                            <td><a ><?php echo $doctor->Account_Name; ?></a>
                                <p>Speciality : <?php echo $doctor->Specialty; ?></p></a></td>
                            <td><a class="control-item badge badge-positive">H</a></td>
                            <td><a class="control-item">2%</a></td>
                            <td><a class="control-item">4</a></td>
                            <td><a class="control-item">4</a></td>
                            <td><a class="control-item">4</a></td>
                            <td> <a class="control-item">4</a></td>
                            <td> <input name="" type="text" readonly="readonly"/></td>
                            <td> <input name="value[]" type="text"/><input type="hidden" name="doc_id[]" value="<?php echo $doctor->Account_ID?>"/></td>
                        </tr>
                        <?php
                    }
                }
                ?>


            </table>
        </li>
        <li class="table-view-cell">
            <br/>
            <button type="submit" class="btn btn-positive">Submit</button>
            <br/>
        </li>
</form>
    </ul>
</div>