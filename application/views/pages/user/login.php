<div class='center'>
    <h2><?php echo $title; ?><span style='font-size:0.6em;padding-left:1%;'><a href='../user/register'><?php echo $this->lang->line('register'); ?> >></a></<span></h2>

                <?php echo validation_errors(); ?>
                <?php if (isset($error)) var_dump($error); ?>
                <?php
                $attributes = array( 'class' => 'validator ' . $router . '_' . $action, 'id' => $router . '_' . $action);
                echo form_open("../$router/$action", $attributes);
                ?>

                <input type="hidden" id='_method' name="_method" value="CREATE">
                <input type='hidden' name='postback' value='1' />

                <!-- Prod Info-->
 <div class="control-group" style="max-width:600px;margin:0 auto;">
                  <?php echo my_generate_controller(array('name'=>'username','label'=>'username','type'=>'text',
                              'attribute'=>array('required'=>'required')));?>
                 <?php echo my_generate_controller(array('name'=>'password','label'=>'password','type'=>'password',
                              'attribute'=>array('required'=>'required')));?>

                <div class="form-group">
                    <!-- Button -->
                    <div class="controls">
                        <button type="submit" id='submit' class="btn btn-success"><i class="icon-white icon-hand-right"></i> <?php echo $this->lang->line('submit'); ?></button>
                    </div>
                </div>
 </div>
                </div>

                </form>
                </div>
                
                <script>
                 
                    $(document).ready(function () {
                    

                    });
                </script>