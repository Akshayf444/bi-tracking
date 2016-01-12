<?php echo form_open('User/Priority'); ?>
<div class="card">
    <ul class="table-view">
        <li class="table-view-cell table-view-divider">Set Priority</li>
        <li class="table-view-cell ">
            <?php echo isset($doctorList) ? $doctorList : '' ?>
        </li>
        <li class="table-view-cell">
            <br/>
            <button type="submit" class="btn btn-positive">Submit</button>
            <br/>
        </li>

    </ul>
</div>
</form>