<div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center mb-5">Student List</h2>
                    <div class="card card-outline-secondary">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-9">
                                    <label class="col-lg-2 col-form-label form-control-label"><b>Action</b></label>
                                    <label class="col-lg-2 col-form-label form-control-label"><b>ID</b></label>

                                    <label class="col-lg-3 col-form-label form-control-label"><b>Name</b></label>
                                    <label class="col-lg-3 col-form-label form-control-label"><b>Pocket Money</b></label>
                                </div>
                                    <div class="col-lg-9">
                                        

                                        <?php 
                                        if(count($arrmixUserData) != 0) {
                                            foreach( $arrmixUserData as $row ) {
                                            ?>
                                                <label class="col-lg-2 col-form-label form-control-label"><input type="checkbox"></label>
                                                <label class="col-lg-2 col-form-label form-control-label"><?php echo $row->id; ?></label>

                                                <label class="col-lg-3 col-form-label form-control-label"><?php echo $row->first_name . " " . $row->last_name; ?></label>
                                                <label class="col-lg-3 col-form-label form-control-label"><?php echo $row->pocket_money; ?></label>

                                            <?php
                                            }
                                        }
                                        ?>
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--/col-->
            </div>

        </div>