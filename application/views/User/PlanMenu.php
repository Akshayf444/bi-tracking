<div class="card">
    <ul class="table-view">
        <li class="table-view-cell">
            <a class="navigate-right" onclick="window.location = '<?php echo site_url('User/Planning'); ?>';" >
                <?php
                if ($this->Product_Id == '1') {
                    echo "Vials";
                } else {
                    echo "Rx";
                }
                ?> Planning 
            </a>
        </li>
    </ul>
</div>
<div class="card">
    <ul class="table-view">
        <li class="table-view-cell">
            <a class="navigate-right"  onclick="window.location = '<?php echo site_url('User/ActivityPlanning'); ?>';" >
                Activity Planning
            </a>
            <span class="pull-right" style="    margin-top: -20px;">Activity Planned : <?php echo $activity_planned['activity_planned']; ?> </span><br><span class="pull-right" style="margin-top: -15px;">No Of Prioritize Dr : <?php
           
                if ($prio_dr['doctor_id'] == 0) {
                    echo "0</br><span style='color:red'><b>No Doctor Prioritized</b></span>";
                } else {
                   echo $prio_dr['doctor_id'];
                }
                ?> </span>
        </li>
    </ul>
</div>