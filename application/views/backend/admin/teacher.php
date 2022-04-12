<div class="row">
                    <div class="col-md-5">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <?php echo form_open(base_url(). 'admin/teacher/create/', array('class' => 'form-horizontal form-groups-bordered', 'enctype'=> 'multipart/form-data'));?>  
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo get_phrase('Teacher Name');?></label>
                                            <input type="text" class="form-control" name="name" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo get_phrase('Teacher Email');?></label>
                                            <input type="email" class="form-control" name="email" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('Teacher Phone');?></label>
                                            <input type="text" class="form-control" name="phone" value="">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('Teacher Image');?></label>
                                            <input type='file' class="form-control" name="userfile" onChange="readURL(this);">
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
                <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('List Teachers');?>
                <hr>
 				<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                	<thead>
                		<tr>
                            <th><div><?php echo get_phrase('Image');?></div></th>
                    		<th><div><?php echo get_phrase('Name');?></div></th>
                    		<th><div><?php echo get_phrase('Email');?></div></th>
                    		<th><div><?php echo get_phrase('Phone');?></div></th>
                    		<th><div><?php echo get_phrase('Actions');?></div></th>
						</tr>
					</thead>
                    <tbody>
    
                 <?php $select_all_teachers = $this->teacher_model->selectTeacher();
                        foreach($select_all_teachers as $key => $teacher) : ?> 
                        <tr>
                            <td><img src="<?php echo $this->crud_model->get_image_url('teacher', $teacher['teacher_id']);?>" class="img-circle" width="30"></td>
							<td><?php echo $teacher['name'];?></td>
							<td><?php echo $teacher['email'];?></td>
							<td><?php echo $teacher['phone'];?></td>
							<td>
                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_teacher/<?php echo $teacher['teacher_id'];?>')"><button class="btn btn-info btn-rounded btn-sm"><?php echo get_phrase('Edit');?></button></a>
                            
                            <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/teacher/delete/<?php echo $teacher['teacher_id'];?>')"><button class="btn btn-danger btn-rounded btn-sm"><?php echo get_phrase('Delete');?></button></a>                            </td>
                        </tr>
                        <?php endforeach;?>
                  
                    </tbody>
                </table>
			</div>
		</div>
	</div>








</div>