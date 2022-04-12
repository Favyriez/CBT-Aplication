 <!--row -->
 <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box">
                            <div class="r-icon-stats">
                                <i class="ti-home bg-megna"></i>
                                <div class="bodystate">
                                    <h4><?php echo $this->db->get('class')->num_rows();?></h4>
                                    <span class="text-muted"><?php echo get_phrase('class');?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box">
                            <div class="r-icon-stats">
                                <i class="ti-book bg-info"></i>
                                <div class="bodystate">
                                    <h4><?php echo $this->db->get('subject')->num_rows();?></h4>
                                    <span class="text-muted"><?php echo get_phrase('subject');?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box">
                            <div class="r-icon-stats">
                                <i class="ti-user bg-success"></i>
                                <div class="bodystate">
                                    <h4><?php echo $this->db->get('student')->num_rows();?></h4>
                                    <span class="text-muted"><?php echo get_phrase('student');?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box">
                            <div class="r-icon-stats">
                                <i class="ti-list bg-inverse"></i>
                                <div class="bodystate">
                                    <h4>
                                    <?php 
                                    $running_year = $this->db->get_where('settings', array('type' => 'session'))->row()->description;
                                    echo $this->db->get_where('online_exam', array('running_year' => $running_year))->num_rows();
                                    ?>
                                    </h4>
                                    <span class="text-muted"><?php echo get_phrase('online exam');?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <!--/row -->
                
                <!--row -->
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="panel panel-info">
            <div class="panel-body"> 
                <div class="chat-box">
                    <ul class="chat-list slimscroll" style="overflow: hidden;" tabindex="5005">   
                        <div class="view">
                            
                                            
                            <?php 

                            $select_all_messages = $this->crud_model->select_all_messages();
                            foreach($select_all_messages as $key => $all_messages_selected) : 
                            
                            $user = explode('-', $all_messages_selected['user_id']);
                            $user_type = $user[0];
                            $user_id = $user[1]; 
                            
                            ?>
                            <?php if($all_messages_selected['user_id'] == $this->session->userdata('login_type').'-'. $this->session->userdata('login_user_id')) : ?>
                            <li class="odd">
                                <div class="chat-image"><img src="<?php echo $this->crud_model->get_image_url($user_type, $user_id);?>" draggable="false"/><span class="profile-status online pull-right"></span> </div>
                                    <div class="chat-body">
                                        <div class="chat-text">
                                            <h4><?php echo $this->db->get_where($user_type, array($user_type.'_id' => $user_id))->row()->name;?></h4>
                                                <p>
                                                <?php echo $all_messages_selected['message'];?>
                                                </p>
                                                <p>
                                                <span class="profile-status online pull-right"><?php echo date('d M, Y', $all_messages_selected['date']);?></span>
                                                </p>
                                        </div>
                                    </div>
                            </li>
                            <?php endif;?>

                            
                            <?php if($all_messages_selected['user_id'] != $this->session->userdata('login_type').'-'. $this->session->userdata('login_user_id')) : ?>               
                            <li>
                            <div class="chat-image"><img src="<?php echo $this->crud_model->get_image_url($user_type, $user_id);?>" draggable="false"/><span class="profile-status online pull-right"></span> </div>
                                    <div class="chat-body">
                                        <div class="chat-text">
                                            <h4><?php echo $this->db->get_where($user_type, array($user_type.'_id' => $user_id))->row()->name;?></h4>
                                                <p>
                                                <?php echo $all_messages_selected['message'];?>
                                                </p>
                                                <p>
                                                <span class="profile-status online pull-right"><?php echo date('d M, Y', $all_messages_selected['date']);?></span>
                                                </p>
                                        </div>
                                    </div>
                            </li>
                            <?php endif;?>
                            <?php endforeach;?>
                            
                                        
                        </div>
                    </ul>
                        <style>
                        hr.sep-3{
                            border:none;
                            height:1px;
                            background-image:linear-gradient(to right, #f0f0f0, #00b9ff, #59d941,#f0f0f0);
                        }

                        hr.sep-3::after{
                            display:inline-block;
                            position:absolute;
                            left:50%;
                            transform:translate(-50%, -50%) rotate(60deg);
                            transform-origin: 50% 50%;
                            padding:1rem;
                            background-color:whiite;
                        }
                        
                        </style>
                        
                        <hr class="sep-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php echo form_open();?>
                                    <div class="input-group">		
                                        <input class="form-control" type="hidden" id="user_id" name="user_id" value="<?php echo $this->session->userdata('login_type').'-'.$this->session->userdata('login_user_id');?>"/>
                                        <textarea class="form-control"  type="text" id="message" name="message" style="width:100%; border:none"  placeholder="Type your message here and hit enter key on the keyboard"></textarea>
                                    </div>
                                <?php echo form_close(); ?> 
                            </div>
                        </div>
                </div>
            </div>	
        </div>	
    </div>
</div>
<!-- row -->
    
    <script>
        setInterval( function (){
            $(' .view').load(location.href + ' .view');
        }, 1000); // 60000 = 1 minute
    </script>

    <script scr="<?php echo base_url();?>js/optimumajax.js"></script>
    <script src="<?php echo base_url(); ?>js/optimumajax.js"></script>
    <script language="javascript">

            $(function() {

                $("#message").keypress(function (e) {
                    if(e.which == 13) {

                        //submit form via ajax
                        var message = $("textarea#message").val();
                        var user_id = $("input#user_id").val();

                            jQuery.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>" + "admin/general_message",
                            dataType: 'json',
                            data: {message: message, user_id: user_id},
                                success: function(res) {
                                    if (res){
                                    // echo some message here
                                    }
                                }
                            });
                        $(this).val("");
                        e.preventDefault();
                    }
                });
            });


    </script>



                