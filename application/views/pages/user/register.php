<div class='center'>
    <h2><?php echo $title; ?><span style='font-size:0.6em;padding-left:1%;'><a href='../user/login'><?php echo $this->lang->line('login'); ?> >></a></<span></h2>
                <?php $user = $this->session->userdata('user');
                if ($user): ?>
                    <h3><?php echo $this->lang->line('register_success'); ?></h3>
                    <div><a href="<?php echo $this->config->item('base_url'); ?>resource/index/<?php echo $user['id']; ?>"><?php echo $this->lang->line('fill_resource_p'); ?></a></div>
                    <div><a href="<?php echo $this->config->item('base_url'); ?>"><?php echo $this->lang->line('return_home'); ?></a></div>
                <?php else: ?>
                    <?php echo validation_errors(); ?>
                    <?php if (isset($error)) var_dump($error); ?>
                    <?php
                    $attributes = array('class' => 'validator ' . $router . '_' . $action, 'id' => $router . '_' . $action);
                    echo form_open("../$router/$action", $attributes);
                    ?>

                    <input type="hidden" id='_method' name="_method" value="CREATE">
                    <input type='hidden' name='postback' value='1' />

                    <!-- Prod Info-->

                    <div class="control-group" style="max-width:600px;margin:0 auto;">
                          <?php echo my_generate_controller(array('name'=>'name','label'=>'name','type'=>'text',
                              'attribute'=>array('required'=>'required')));?>
                        <!-- Text input-->
                         <?php echo my_generate_controller(array('name'=>'email','label'=>'email','type'=>'text',
                              'attribute'=>array('required'=>'required')));?>
                        <!-- Text input-->
                         <?php echo my_generate_controller(array('name'=>'phone','label'=>'phone','type'=>'text',
                              'attribute'=>array('required'=>'required')));?>
                        <!-- category-->
                         <?php echo my_generate_controller(array('name'=>'password','label'=>'password','type'=>'password',
                              'attribute'=>array('required'=>'required')));?>
                        <div class="form-group">
                            <!-- Button -->
                            <div class="controls">
                                <button id='submit' class="btn btn-success"><i class="icon-white icon-hand-right"></i> <?php echo $this->lang->line('submit'); ?></button>
                            </div>
                        </div>
                    </div>

                    </form>
                    </div>
               
                    <script>
                         
                    </script>
<?php endif; ?>