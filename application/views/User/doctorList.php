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
            <span class="pull-left">Total Expected Rx : 200</span>
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
        <li class="table-view-cell table-view-divider">
            <div class="col-xs-7">Doctor List</div>
            <div class="col-xs-5">
                <div class="segmented-control">
                    <a class="control-item ">Winability</a>
                    <a class="control-item">Dependency</a>
                    <a class="control-item">Planned Rx</a>
                    <a class="control-item">Actual Rx</a>
                </div>
            </div>
        </li>
        <li class="table-view-cell">
            <div class="col-xs-7"><a>Yogesh Kanse</a>
                <p>Speciality : Diabetes</p>
                <p>Segment : A</p>
            </div>
            <div class="col-xs-5">
                <div class="segmented-control">
                    <a class="control-item badge-positive">H</a>
                    <a class="control-item">2%</a>
                    <a class="control-item">4</a>
                    <a class="control-item">4</a>
                </div>
            </div>
        </li>
        <li class="table-view-cell">
            <div class="col-xs-7"><a>Amit P</a>
                <p>Speciality : Ortho</p>
                <p>Segment : B</p>
            </div>
            <div class="col-xs-5">
                <div class="segmented-control">
                    <a class="control-item badge-positive">H</a>
                    <a class="control-item">4%</a>
                    <a class="control-item">10</a>
                    <a class="control-item">4</a>
                </div>
            </div>
        </li>
        <li class="table-view-cell">
            <div class="col-xs-7"><a>Naresh Ghadi</a>
                <p>Speciality : General</p>
                <p>Segment : C</p>
            </div>
            <div class="col-xs-5">
                <div class="segmented-control">
                    <a class="control-item badge-negative">L</a>
                    <a class="control-item">2%</a>
                    <a class="control-item">22</a>
                    <a class="control-item">4</a>
                </div>
            </div>
        </li>
    </ul>
</div>