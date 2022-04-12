<?php $get_admin_info = $this->admin_model->select_admin_information_from_admin_table() ;

        foreach($get_admin_info as $key => $admin_data):?>

<div class="row">
                    <div class="col-md-6">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <?php echo form_open(base_url(). 'admin/manage_profile/update/', array('class' => 'form-horizontal form-groups-bordered', 'enctype'=> 'multipart/form-data'));?>  
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo get_phrase('Admin Name');?></label>
                                            <input type="text" class="form-control" name="name" value="<?php echo $admin_data['name'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo get_phrase('Admin Email');?></label>
                                            <input type="email" class="form-control" name="email" value="<?php echo $admin_data['email'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('Admin Phone');?></label>
                                            <input type="text" class="form-control" name="phone" value="<?php echo $admin_data['phone'];?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('Admin Image');?></label>
                                            <input type='file' class="form-control" name="userfile" onChange="readURL(this);">
					                        <img id="blah" src="<?php echo $this->crud_model->get_image_url('admin', $admin_data['admin_id']);?>" alt="" height="200" width="200"/>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-success btn-rounded btn-sm btn-block"><?php echo get_phrase('Save');?></button>
                                   <?php echo form_close();?>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="white-box">
                           
                            <?php echo form_open(base_url(). 'admin/manage_profile/changePassword/', array('class' => 'form-horizontal form-groups-bordered', 'enctype'=> 'multipart/form-data'));?>  

                                <div class="form-group row">
                                    <label for="example-text" class="col-md-12 "><?php echo get_phrase('Current Password');?></label>
                                    <div class="col-sm-12">
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text" class="col-md-12 "><?php echo get_phrase('Confirm Password');?></label>
                                    <div class="col-sm-12">
                                        <input type="password" class="form-control" name="confirm_password">
                                    </div>
                                </div>
                              
                               
                                <div class="form-group">
                                   
                                    <button type="submit" class="btn btn-success btn-rounded btn-sm btn-block"><?php echo get_phrase('Save');?></button>
                               
                                <?php echo form_close();?>
                                </div>
                           
                        </div>
                    </div>
                </div>
        <?php endforeach;?>