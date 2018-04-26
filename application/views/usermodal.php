<!-- Modal -->
<div id="userModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Enter User Credentials</h4>
            </div>
            <div class="modal-body">
                <!--this is form-->
                <div class="container">
                    <div class="card card-container">
                        <form class="form" method="post" action="<?php echo base_url(); ?>index.php/admincontroller/userinsert">
                            <input type="text" name="username" id="inputName" placeholder="Username" required autofocus><br/><br/>
                            <input type="password" name="password" id="inputPassword" placeholder="Password" required><br/><br/>
                            <div>
                                <label class="radio-inline"><input type="radio" name="optradio" value="1">Admin</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="0" checked>User</label>
                            </div><br/><br/>
                            <button class="btn btn-lg" type="submit">Add</button>
                        </form>
                    </div>
                    <!-- /card-container -->
                </div>
            </div>
        </div>

    </div>
</div>
