<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <?php if (!empty($productlist)) { ?>
        <div class="panel panel-default"> 
            <div class="panel-heading"> RX Planning Status For Approval   </div>
            <div class="panel-body">

                <ul align="center" class="nav nav-tabs ">
                    <?php
                    if (!empty($productlist)) {
                        $count = 1;
                        foreach ($productlist as $product) {
                            ?>
                            <li class="<?php echo isset($count) && $count == 1 ? 'active' : ''; ?>"><a data-toggle="tab" style="    padding: 12px;" href="#<?php echo $product->id ?>"><?php echo $product->Brand_Name ?></a></li>
                            <?php
                            $count ++;
                        }
                    }
                    ?>
                </ul>

                <div class="tab-content">
                    <?php
                    if (!empty($productlist)) {
                        $count = 1;

                        foreach ($productlist as $product) {
                            $ApproveCount = 0;
                            $UnApproveCount = 0;
                            $Pending = 0;
                            $Submitted = 0;
                            ?>

                            <div id="<?php echo $product->id ?>" class="tab-pane fade <?php echo isset($count) && $count == 1 ? 'in active' : ''; ?>">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>BDM Name</th>
                                        <th>Approved</th>
                                        <th>Rejected</th>
                                        <th>Pending</th>
                                        <th>Approved&Submitted</th>
                                    </tr>
                                    <?php
                                    $Status = $this->asm_model->PlanningStatusAll($product->id);
                                    if (!empty($Status)) {
                                        foreach ($Status as $value) {
                                            $ApproveCount += $value->ApproveCount;
                                            $UnApproveCount += $value->UnApproveCount;
                                            $Pending += $value->SFACount;
                                            $Submitted += $value->SubmitCount;
                                            echo '<tr><td>' . $value->Full_Name . '</td><td>' . $value->ApproveCount . '</td><td>' . $value->UnApproveCount . '</td><td>' . $value->SFACount . '</td><td>' . $value->SubmitCount . '</td></tr>';
                                        }

                                        echo '<tr><th>Total</th><td>' . $ApproveCount . '</td><td>' . $UnApproveCount . '</td><td>' . $Pending . '</td><td>' . $Submitted . '</td></tr>';
                                    }
                                    ?>
                                </table>
                            </div>


                            <?php
                            $count ++;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>  
    <?php } ?>
</div>