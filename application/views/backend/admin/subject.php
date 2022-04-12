<div class="row">
                    <div class="col-md-5">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <?php echo form_open(base_url(). 'admin/subject/create/', array('class' => 'form-horizontal form-groups-bordered', 'enctype'=> 'multipart/form-data'));?>  
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo get_phrase('Subject Name');?></label>
                                            <input type="text" class="form-control" name="name" value="">
                                        </div>
                                      
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('Teacher');?></label>
                                            <select name="teacher_id" class="form-control">
                                                <option value="">Select Teacher</option>
                                                
                                                <?php $select_teachers = $this->teacher_model->selectTeacher();
                                                        foreach($select_teachers as $key => $teacher) : ?>
                                                <option value="<?php echo $teacher['teacher_id'];?>"><?php echo $teacher['name'];?></option>
                                                <?php endforeach;?>

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('Class');?></label>
                                            <select name="class_id" class="form-control">
                                                <option value="">Select Class</option>
                                                
                                                <?php $select_classes = $this->class_model->selectClasses();
                                                        foreach($select_classes as $key => $class) : ?>
                                                <option value="<?php echo $class['class_id'];?>"><?php echo $class['name'];?></option>
                                                <?php endforeach;?>

                                            </select>
                                        </div>


                                        
                                        <button type="submit" class="btn btn-success btn-rounded btn-sm btn-block"><?php echo get_phrase('Save');?></button>
                                   <?php echo form_close();?>
                                   
                                </div>
                            </div>
                        </div>
                    </div>



    <div class="col-sm-7">
		<div class="panel panel-info">
            <div class="panel-body table-responsive">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('List Subjects');?>
                <hr>
 				<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('Name');?></div></th>
                    		<th><div><?php echo get_phrase('Tecaher');?></div></th>
                            <th><div><?php echo get_phrase('Class');?></div></th>
                    		<th><div><?php echo get_phrase('Actions');?></div></th>
						</tr>
					</thead>
                    <tbody>
    
                 <?php $select_all_subjects = $this->subject_model->selectSubjects();
                        foreach($select_all_subjects as $key => $subject) : ?> 
                        <tr>
							<td><?php echo $subject['name'];?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('teacher', $subject['teacher_id']);?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('class', $subject['teacher_id']);?></td>
                            <td>
                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_subject/<?php echo $subject['subject_id'];?>')"><button class="btn btn-info btn-rounded btn-sm"><?php echo get_phrase('Edit');?></button></a>
                            
                            <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/subject/delete/<?php echo $subject['subject_id'];?>')"><button class="btn btn-danger btn-rounded btn-sm"><?php echo get_phrase('Delete');?></button></a>                            </td>
                        </tr>
                        <?php endforeach;?>
                  
                    </tbody>
                </table>
			</div>
		</div>
	</div>








</div>