

<div class="row">
                    <div class="col-md-6">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <?php echo form_open(base_url(). 'setting/system_settings/update/', array('class' => 'form-horizontal form-groups-bordered', 'enctype'=> 'multipart/form-data'));?>  
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo get_phrase('System Name');?></label>
                                            <input type="text" class="form-control" name="system_name" value="<?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo get_phrase('System Abbreviation');?></label>
                                            <input type="text" class="form-control" name="system_title" value="<?php echo $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('Phone');?></label>
                                            <input type="text" class="form-control" name="phone" value="<?php echo $this->db->get_where('settings', array('type' => 'phone'))->row()->description;?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('System Currency');?></label>
                                            <input type="text" class="form-control" name="currency" value="<?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description;?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('system_email');?></label>
                                            <input type="email" class="form-control" name="system_email" value="<?php echo $this->db->get_where('settings', array('type' => 'system_email'))->row()->description;?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('paypal_email');?></label>
                                            <input type="email" class="form-control" name="paypal_email" value="<?php echo $this->db->get_where('settings', array('type' => 'paypal_email'))->row()->description;?>">
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('Session');?></label>
                                            <select class="form-control" name="session">
                                                <?php $current_session = $this->db->get_where('settings', array('type' => 'session'))->row()->description; ?>
                                                <?php for($i = 0; $i < 10; $i++) : ?>
                                                    <option value="<?php echo (2020+$i);?>-<?php echo (2020+$i+1);?>"<?php if($current_session == (2020+$i).'-'.(2020+$i+1)) echo 'selected' ;?>><?php echo (2020+$i);?>-<?php echo (2020+$i+1);?></option>
                                                <?php endfor;?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                   							<label for="exampleInputPassword1"><?php echo get_phrase('timezone');?></label>
				
											<select name="timezone" class="form-control form-control-rounded" >
											 <?php $timezone = $this->db->get_where('settings', array('type' => 'timezone'))->row()->description; ?>
											   <?php $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL); ?>
											  <?php foreach ($tzlist as $tz): ?>
												<!-- <option value="<?php // echo $tz ;?>" @if(env('TIMEZONE') == $tz) selected @endif><?php //echo $tz ;?></option>-->
												<option value="<?php echo $tz ;?>"<?php if($tz == $timezone) echo 'selected';?>><?php echo $tz ;?></option>
											  <?php endforeach; ?>
											 </select>
                						</div>
                                        

                                        <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('text_align');?></label>
                                            <select class="form-control" name="text_align">
                                            <?php $text =  $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;?>
                                                    <option value="left-to-right"<?php if($text == 'left-to-right') echo 'selected';?>><?php echo get_phrase('Letf to Right');?></option>
                                                    <option value="right-to-left"<?php if($text == 'right-to-left') echo 'selected';?>><?php echo get_phrase('Right to Left');?></option>
                                            </select>
                                        </div>



                                        <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('address');?></label>
                                            <textarea  class="form-control" name="address"><?php echo $this->db->get_where('settings', array('type' => 'address'))->row()->description;?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('Footer Message');?></label>
                                            <input type="text" class="form-control" name="footer" value="<?php echo $this->db->get_where('settings', array('type' => 'footer'))->row()->description;?>">
                                        </div>


                            

                                        
                                        
                                        <button type="submit" class="btn btn-success btn-rounded btn-sm btn-block"><?php echo get_phrase('Save');?></button>
                                   <?php echo form_close();?>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="white-box">
                           
                            <?php echo form_open(base_url(). 'setting/system_settings/logo/', array('class' => 'form-horizontal form-groups-bordered', 'enctype'=> 'multipart/form-data'));?>  

                            <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('System Logo');?></label>
                                            <input type='file' class="form-control" name="userfile" onChange="readURL(this);">
					                        <img id="blah" src="<?php echo base_url();?>uploads/logo.png" alt="" height="200" width="200"/>
                                        </div>
                               
                                <div class="form-group">
                                   
                                    <button type="submit" class="btn btn-success btn-rounded btn-sm btn-block"><?php echo get_phrase('Save');?></button>
                               
                                <?php echo form_close();?>


                                <hr>
                                <?php echo get_phrase('Theme');?>
                                <?php echo form_open(base_url(). 'setting/system_settings/theme/', array('class' => 'form-horizontal form-groups-bordered', 'enctype'=> 'multipart/form-data'));?>  
                                <div class="radio radio-custom">
                                <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'default') echo 'checked';?> name="skin_colour" id="radio2" value="default">
                                <label for="radio2"> Default </label>
                                </div>

                                <div class="radio radio-success">
                                <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'green') echo 'checked';?> name="skin_colour" id="radio3" value="green">
                                <label for="radio3"> Green </label>
                                </div>

                                <div class="radio radio-gray">
                                <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'gray') echo 'checked';?> name="skin_colour" id="radio4" value="gray">
                                <label for="radio4"> Gray </label>
                                </div>

                                <div class="radio radio-black">
                                <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'black') echo 'checked';?> name="skin_colour" id="radio5" value="black">
                                <label for="radio5"> Black </label>
                                </div>

                                <div class="radio radio-purple">
                                <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'purple') echo 'checked';?> name="skin_colour" id="radio6" value="purple">
                                <label for="radio6"> Purple </label>
                                </div>

                                <div class="radio radio-info">
                                <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'blue') echo 'checked';?> name="skin_colour" id="radio7" value="blue">
                                <label for="radio7"> Blue </label>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-rounded btn-sm btn-block"><?php echo get_phrase('Save');?></button>
                                </div>
                                <?php echo form_close();?>

                                

                                </div>
                           
                        </div>
                    </div>
                </div>
