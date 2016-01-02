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
<<<<<<< HEAD
            <span class="pull-left">Total Expected Rx For Jan 2016 : <b ><input type="text" readonly="readonly" class="ck" value="200"></b></span><br>
=======
            <span class="pull-left">Total Expected Rx For Jan 2016 : <b ><input type="text" readonly="readonly" class="ck" value="<?php echo $expected['target']; ?>"></b></span><br>
>>>>>>> 605661333c67fcdb0faa7e4af361a9a9e6d1600f
            <span class="pull-left">Balanced Rx To Plan For Jan 2016: <b class="ckk">200</b></span>
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
<?php echo form_open('User/doctorList');?>
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
                            <td> <input name="value[]" id="val" type="text"/><input type="hidden" name="doc_id[]" value="<?php echo $doctor->Account_ID?>"/></td>
                            <td> <a class="control-item"></a></td>
                        </tr>
                        <?php
                    }
                }
                ?>


        <li class="table-view-cell ">
            <?php echo isset($doctorList) ? $doctorList : '' ?>
        </li>
        <li class="table-view-cell">
            <br/>
            <button type="submit" class="btn btn-positive">Submit</button>
            <br/>
        </li>
        </form>
    </ul>
</div>
<script>

    $(document).ready(function () {
        $('.val').keyup(function () {
            var one = $('.ck').val();
            var two = $('.val').val();
            var three = one - two;
            $('.ckk').html(one - two);

        })
    })
</script>