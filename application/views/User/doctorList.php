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
        <li class="table-view-cell table-view-divider">
            <div class="row">
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
                <tr>
                    <td><a ><a>Yogesh Kanse</a>
                <p>Speciality : Diabetes</p></a></td>
                    <td><a class="control-item badge-positive">H</a></td>
                    <td><a class="control-item">2%</a></td>
                    <td><a class="control-item">4</a></td>
                    <td><a class="control-item">4</a></td>
                    <td><a class="control-item">4</a></td>
                   <td> <a class="control-item">4</a></td>
                   <td> <input type="text"/></td>
                   <td> <a class="control-item">4</a></td>
                </tr>
            </table>
                </div>
            <div class="row">
                <div class="col-xs-2 pull-right">
            <input type="submit" class="btn btn-success btn-xs" value="Submit"/>
            </div>
            </div>
        </li>
    </ul>
</div>