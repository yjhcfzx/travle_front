</div><!-- close page middle content -->
</div><!--close column-->
  <div class="col-lg-2 col-md-2 hidden-xs hidden-sm"><?php include 'right_side_bar.php';?></div>
</div> <!--close row-->
</div><!-- close page content -->
<div id='footer' class='navbar-fixed-bottom'>
<div style='text-align:center'></div>
</div>
<script>
     var validator_settings = {
                        rules: {
                            username: {
                                minlength: 3,
                                maxlength: 15,
                        //        required: true
                            },
                            password: {
                                minlength: 3,
                                maxlength: 15,
                            },
                            name: {
                                minlength: 3,
                                maxlength: 15,
                            }
                        },
                        messages: {
                            username: {
                              
                                //minlength: jQuery.format("Enter at least {0} characters"),
                              //  remote: jQuery.format("{0} is already in use")
                            }
                        },
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
                        },
                         invalidHandler: function(form, validator) {
                            var errors = validator.numberOfInvalids();
                            if (errors) {                    
                                validator.errorList[0].element.focus();
                            }
                        }
                    };
$(document).ready(function(){
    if( $('form.validator').length){
     $.validator.setDefaults({ ignore: ":hidden:not(.chzn-select)" }) ;
     $.validator.messages.required = "<?php echo $this->lang->line('not_empty');?>";
     $.validator.messages.minlength = $.validator.format("<?php echo $this->lang->line('min_length');?>{0}");
     $.validator.messages.maxlength = $.validator.format("<?php echo $this->lang->line('max_length');?>{0}");
    
     $('form.validator').validate(validator_settings);
                }
});</script>
</body>
</html>