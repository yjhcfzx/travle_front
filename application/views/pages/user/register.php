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
                    $attributes = array('class' => $router . '_' . $action, 'id' => $router . '_' . $action);
                    echo form_open("../$router/$action", $attributes);
                    ?>

                    <input type="hidden" id='_method' name="_method" value="CREATE">
                    <input type='hidden' name='postback' value='1' />

                    <!-- Prod Info-->

                    <div class="control-group" style="max-width:600px;margin:0 auto;">
                        <div class="form-group">
                            <!-- Text input-->
                            <label class="control-label col-sm-4" for="name"><?php echo $this->lang->line('name'); ?></label>
                            <div class="controls col-sm-8">
                                <input type="text" class="input-xlarge required" name='name' id='name'  value=''>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="control-label  col-sm-4" for="email"><?php echo $this->lang->line('email'); ?></label>
                            <div class="controls  col-sm-8">
                                <input type="text"  class="input-xlarge required" name='email' id='"email'  value=''>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="control-label  col-sm-4" for="phone"><?php echo $this->lang->line('phone'); ?></label>
                            <div class="controls col-sm-8">
                                <input type="text"  class="input-xlarge required" name='phone' id='phone'  value=''>
                            </div>
                        </div>
                        <!-- category-->
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="phone"><?php echo $this->lang->line('password'); ?></label>
                            <div class="controls col-sm-8 ">
                                <input type="text"  class="input-xlarge required" name='password' id='password' value=''>
                            </div>
                        </div>
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
                           $('form').validate({
        rules: {
            name: {
                minlength: 3,
                maxlength: 15,
                required: true
            },
            email: {
                minlength: 3,
                maxlength: 15,
                required: true
            }
        },
        messages: {
            required:'去问问看',
        firstname: "Enter your firstname",
        lastname: "Enter your lastname",
        username: {
            required: "Enter a username",
            minlength: jQuery.format("Enter at least {0} characters"),
            remote: jQuery.format("{0} is already in use")
        }
    }
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
                    </script>
<?php endif; ?>