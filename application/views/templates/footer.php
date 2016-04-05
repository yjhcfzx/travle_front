</div><!-- close page middle content -->
</div><!--close column-->
  <div class="col-lg-2 col-md-2 hidden-xs hidden-sm"><?php include 'right_side_bar.php';?></div>
</div> <!--close row-->
</div><!-- close page content -->
<div id='footer' class='navbar-fixed-bottom'>
<div style='text-align:center'></div>
</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-75863302-1', 'auto');
  ga('send', 'pageview');

</script>
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
                             email: {
                                email: true
                            },
                            phone:{
                                 phoneNumber: true,
                                  minlength: 5,
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
     $.validator.addMethod("phoneNumber", function(phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, "");
    return this.optional(element) || 
    phone_number.match(/^[0-9\-\(\)\s]+$/);
}, "<?php echo $this->lang->line('valid_phone');?>");
     $.validator.messages.required = "<?php echo $this->lang->line('not_empty');?>";
     $.validator.messages.minlength = $.validator.format("<?php echo $this->lang->line('min_length');?>{0}");
      $.validator.messages.email = $.validator.format("<?php echo $this->lang->line('valid_email');?>");
     $.validator.messages.maxlength = $.validator.format("<?php echo $this->lang->line('max_length');?>{0}");
    
     $('form.validator').validate(validator_settings);
                }
});</script>
</body>
</html>