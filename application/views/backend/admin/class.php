<div class="row">
                    <div class="col-md-5">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <?php echo form_open(base_url(). 'admin/classes/create/', array('class' => 'form-horizontal form-groups-bordered', 'enctype'=> 'multipart/form-data'));?>  
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo get_phrase('Class Name');?></label>
                                            <input type="text" class="form-control" name="name" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo get_phrase('Nick Name');?></label>
                                            <input type="text" class="form-control" name="name_numeric" value="">
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

                                        
                                        <button type="submit" class="btn btn-success btn-rounded btn-sm btn-block"><?php echo get_phrase('Save');?></button>
                                   <?php echo form_close();?>
                                   
                                </div>
                            </div>
                        </div>
                    </div>



    <div class="col-sm-7">
		<div class="panel panel-info">
            <div class="panel-body table-responsive">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('List Claases');?>
                <hr>
 				<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('Name');?></div></th>
                    		<th><div><?php echo get_phrase('Nick Name');?></div></th>
                    		<th><div><?php echo get_phrase('Tecaher');?></div></th>
                    		<th><div><?php echo get_phrase('Actions');?></div></th>
						</tr>
					</thead>
                    <tbody>
    
                 <?php $select_all_classes = $this->class_model->selectClasses();
                        foreach($select_all_classes as $key => $class) : ?> 
                        <tr>
							<td><?php echo $class['name'];?></td>
							<td><?php echo $class['name_numeric'];?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('teacher', $class['teacher_id']);?></td>
							<td>
                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_class/<?php echo $class['class_id'];?>')"><button class="btn btn-info btn-rounded btn-sm"><?php echo get_phrase('Edit');?></button></a>
                            
                            <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/classes/delete/<?php echo $class['class_id'];?>')"><button class="btn btn-danger btn-rounded btn-sm"><?php echo get_phrase('Delete');?></button></a>                            </td>
                        </tr>
                        <?php endforeach;?>
                  
                    </tbody>
                </table>
			</div>
		</div>
	</div>








</div>