<?php $get_student_info = $this->student_model->select_student_information_from_student_table() ;

        foreach($get_student_info as $key => $student_data):?>

<div class="row">
                    <div class="col-md-6">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <?php echo form_open(base_url(). 'student/manage_profile/update/', array('class' => 'form-horizontal form-groups-bordered', 'enctype'=> 'multipart/form-data'));?>  
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo get_phrase('student Name');?></label>
                                            <input type="text" class="form-control" name="name" value="<?php echo $student_data['name'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo get_phrase('student Email');?></label>
                                            <input type="email" class="form-control" name="email" value="<?php echo $student_data['email'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('student Phone');?></label>
                                            <input type="text" class="form-control" name="phone" value="<?php echo $student_data['phone'];?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('student Image');?></label>
                                            <input type='file' class="form-control" name="userfile" onChange="readURL(this);">
					                        <img id="blah" src="<?php echo $this->crud_model->get_image_url('student', $student_data['student_id']);?>" alt="" height="200" width="200"/>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-success btn-rounded btn-sm btn-block"><?php echo get_phrase('Save');?></button>
                                   <?php echo form_close();?>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="white-box">
                           
                            <?php echo form_open(base_url(). 'student/manage_profile/changePassword/', array('class' => 'form-horizontal form-groups-bordered', 'enctype'=> 'multipart/form-data'));?>  

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