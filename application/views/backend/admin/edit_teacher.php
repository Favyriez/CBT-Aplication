<div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">

                                <?php $select_from_teacher = $this->db->get_where('teacher', array('teacher_id' => $param2))->result_array();
                                        foreach($select_from_teacher as $key => $teacher) : ?>

                                    <?php echo form_open(base_url(). 'admin/teacher/update/'.$param2, array('class' => 'form-horizontal form-groups-bordered', 'enctype'=> 'multipart/form-data'));?>  
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo get_phrase('Teacher Name');?></label>
                                            <input type="text" class="form-control" name="name" value="<?php echo $teacher['name'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo get_phrase('Teacher Email');?></label>
                                            <input type="email" class="form-control" name="email" value="<?php echo $teacher['email'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('Teacher Phone');?></label>
                                            <input type="text" class="form-control" name="phone" value="<?php echo $teacher['phone'];?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('Teacher Image');?></label>
                                            <input type='file' class="form-control" name="userfile" onChange="readURL(this);">
                                            <img src="<?php echo $this->crud_model->get_image_url('teacher', $teacher['teacher_id']);?>" class="img-circle" width="30">
                                        </div>
                                        
                                        <button type="submit" class="btn btn-success btn-rounded btn-sm btn-block"><?php echo get_phrase('Save');?></button>
                                   <?php echo form_close();?>

                                        <?php endforeach;?>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>