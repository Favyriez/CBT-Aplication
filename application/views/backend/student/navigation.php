    <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                   
                    <li class="user-pro">
                        <a href="#" class="waves-effect">
                        <?php 
                        $key = $this->session->userdata('login_type'). '_id';
                        $face_file = 'uploads/'. $this->session->userdata('login_type'). '_image/'.$this->session->userdata($key).'.jpg'; 
                        if(!file_exists($face_file)){
                            $face_file = 'uploads/default.jpg';
                        }
                        ?>
                        <img src="<?php echo base_url() . $face_file;?>" alt="user-img" class="img-circle"> 
                        
                        <span class="hide-menu">
                        <?php
                        $account_type = $this->session->userdata('login_type');
                        $account_id = $account_type.'_id';
                        $name = $this->crud_model->get_type_name_by_id($account_type, $this->session->userdata($account_id), 'name');
                        echo $name;
                        ?>
                       </span>
                        </a>
                       
                    </li>
                   
                    <li class="<?php if($page_name == 'dashboard') echo 'active'; ?>"> <a href="<?php echo base_url();?>student/dashboard" class="waves-effect"><i class="ti-dashboard p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Dashboard');?></span></a> </li>
                    
                    <li class="<?php if($page_name == 'online_exam' || $page_name == 'online_exam_take') echo 'active'; ?>"> <a href="<?php echo base_url();?>student/online_exam" class="waves-effect"><i class="fa fa-angle-double-right p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Online Exam');?></span></a> </li>
                    <li class="<?php if($page_name == 'manage_profile') echo 'active'; ?>"> <a href="<?php echo base_url();?>student/manage_profile" class="waves-effect"><i class="fa fa-angle-double-right p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Manage Profile');?></span></a> </li>

                    <li><a href="<?php echo base_url();?>login/logout/" class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu"><?php echo get_phrase('Log Out');?></span></a></li>
                    
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->