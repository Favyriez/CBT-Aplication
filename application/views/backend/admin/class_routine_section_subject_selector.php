

 <div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_phrase('Subject');?></label>
                                            <select name="subject_id" class="form-control" / required>                                                
                                                <?php $select_subjects = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
                                                        foreach($select_subjects as $key => $subject) : ?>
                                                <option value="<?php echo $subject['subject_id'];?>"><?php echo $subject['name'];?></option>
                                                <?php endforeach;?>

                                            </select>
                                        </div>


                                        <div class="form-group">
                                        <label for="exampleInputPassword1"><?php echo get_phrase('Section');?></label>
                                            <select name="section_id" class="form-control" / required>                                                
                                                <?php $select_sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
                                                        foreach($select_sections as $key => $section) : ?>
                                                <option value="<?php echo $section['section_id'];?>"><?php echo $section['name'];?></option>
                                                <?php endforeach;?>

                                            </select>
                                        </div>