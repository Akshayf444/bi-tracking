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
<form class="card">
    <ul class="table-view ">
        <li class="table-view-cell table-view-divider">Profiling</li>
        <li class="table-view-cell">
            Select Product
            <select class="form-control" id="product">
                <option>Please Select</option>
                <option value="Actilyse">Actilyse</option>
                <option value="Pradaxa">Pradaxa</option>
                <option value="Trajenta">Trajenta Family</option>              
            </select>

        </li>
        <li class="table-view-cell">
            Select Doctor
            <select class="form-control">
                <option>Please Select</option>
                <option>Yogesh Kanse</option>             
                <option>Naresh Ghadi</option>             
            </select>            
        </li>

        <li class="table-view-cell">
            No of Targeted Patients seen in Month for the <span id="span1">priority indication </span>
            <input type="text" >
        </li>
        <li class="table-view-cell">
            No of Patients prescribed <span id="span2">NOAC </span> by the doctor in Month 
            <input type="text" >
        </li>
        <li class="table-view-cell">
            Is doctor inclined or has shown interest towards being continously engaged or has been engaged by BI?
            <select class="form-control">
                <option>Please Select</option>
                <option>Yes</option>
                <option>No</option>
            </select>
        </li>
        <li class="table-view-cell">
            Whether doctor asks product related questions or objections during clinic visits?
            <select class="form-control">
                <option>Please Select</option>
                <option>Yes</option>
                <option>No</option>
            </select>
        </li>
        <li class="table-view-cell">
            Does the doctor mostly prescribe and is loyal to competitor brand?
            <select class="form-control">
                <option>Please Select</option>
                <option>Yes</option>
                <option>No</option>
            </select>

        </li>
        <li class="table-view-cell">
            <br/>
            <button class="btn btn-lg btn-positive">Submit</button>
            <br/>
        </li>
    </ul>
</form>
<script>
    $("#product").change(function () {

        if ($(this).val() == 'Actilyse') {
            $('#span1').html('Stroke/AIS');
            $('#span2').html('-');
        } else if ($(this).val() == 'Pradaxa') {
            $('#span1').html('SPAF');
            $('#span2').html('NOAC');
        } else if ($(this).val() == 'Trajenta') {
            $('#span1').html('Diabetes');
            $('#span2').html('DPP4');
        }
    });
</script>