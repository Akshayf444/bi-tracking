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
    <ul class="table-view ">
        <li class="table-view-cell table-view-divider">Add Expected Rx</li>

<!--        <li class="table-view-cell">
            Select Product
            <select class="form-control" id="product">
                <option>Please Select</option>
                <option>Actilyse</option>
                <option>Pradaxa</option>
                <option>Trajenta Family</option>              
            </select>
            <table class="table table-bordered" id="rx" style="display: none">
                <tr>
                    <td></td>
                    <td>Sep</td>
                    <td>Oct</td>
                    <td>Nov</td>
                    <td>Dec</td>
                </tr>
                <tr>
                    <th>Expected Rx</th>
                    <td>10</td>
                    <td>20</td>
                    <td>30</td>
                    <td>40</td>
                </tr>
                <tr>
                    <th>Actual Rx</th>
                    <td>10</td>
                    <td>20</td>
                    <td>30</td>
                    <td>40</td>
                </tr>
            </table>
        </li>   -->
<?php echo form_open('User/Set_Target')?>
        <li class="table-view-cell">
            Total Expected Rx from Doctors in Jan
            <input type="text" name="value">
        </li>
        <li class="table-view-cell">
            <br/>
            <button type="submit" class="btn btn-sm btn-positive"/>Submit</button>
            <br/>
        </li>
    </ul>
</form>
<script>
    $("#product").change(function () {
        $("#rx").show();
    });
</script>