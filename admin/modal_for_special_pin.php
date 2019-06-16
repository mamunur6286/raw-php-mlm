<!-- Modal -->
<div class="modal fade" id="special_pin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-info" id="exampleModalLongTitle">Create Special Pin Here</h3>
                <button type="button" style="font-size: 29px;margin-top: -35px;" class="close" data-dismiss="modal" aria-label="Close">
                    <span  aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['set_pin'])){
                $special_result= $pin->specialPin($_POST);
            }
            ?>
            <form role="form" enctype="multipart/form-data" method="post">
                <?php
                    if(isset($special_result)){
                        echo $special_result;
                    }
                ?>
                <div class="modal-body">

                    <h5 class="" style="font-size: 18px">Type how many pin create :</h5>
                    <input type="text" value="" name="special_pin" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit"  class="btn btn-primary" name="set_pin" value="Confirm">
                </div>
            </form>
        </div>
    </div>
</div>
