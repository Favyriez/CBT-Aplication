<div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                
                                <?php $select_from_subjects = $this->db->get_where('subject', array('subject_id' => $param2))->result_array();
                                        foreach($select_from_subjects as $key => $subject) : ?>

                                    <?php echo form_open(base_url(). 'admin/subject/update/'. $param2, array('class' => 'form-horizontal form-groups-bordered', 'enctype'=> 'multipart/form-data'));?>  
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo get_phrase('subject Name');?></label>
                                            <input type="text" class="form-control" name="name" value="<?php echo $subject['name'];?>">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('Teacher');?></label>
                                            <select name="teacher_id" class="form-control">
                                                <option value="">Select Teacher</option>
                                                
                                                <?php $select_teachers = $this->db->get('teacher')->result_array();
                                                        foreach($select_teachers as $key => $teacher) : ?>
                                                <option value="<?php echo $teacher['teacher_id'];?>"
                                                <?php if($subject['teacher_id'] == $teacher['teacher_id']) echo 'selected="selected"' ;?>><?php echo $teacher['name'];?></option>
                                                <?php endforeach;?>

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('Classes');?></label>
                                            <select name="class_id" class="form-control">
                                                <option value="">Select Class</option>
                                                
                                                <?php $select_classes = $this->db->get('class')->result_array();
                                                        foreach($select_classes as $key => $class) : ?>
                                                <option value="<?php echo $class['class_id'];?>"
                                                <?php if($subject['class_id'] == $class['class_id']) echo 'selected="selected"' ;?>><?php echo $class['name'];?></option>
                                                <?php endforeach;?>

                                            </select>
                                        </div>

                                        
                                        <button type="submit" class="btn btn-success btn-rounded btn-sm btn-block"><?php echo get_phrase('Save');?></button>
                                   <?php echo form_close();?>
                                   <?php endforeach;?>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
</div>