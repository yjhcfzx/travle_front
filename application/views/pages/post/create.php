<div id="container">
  <form method="post">

<!--       <div class="form-group">
                <label for="dtp_input2" class="control-label"><?php echo $this->lang->line('travle_time'); ?></label>
                <div class="input-group date form_date" id="travle_time" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" id="travle_time1" size="16" type="text" value="" >
		    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
			<input type="hidden" id="travle_time2" value="" /><br/>	
            </div>-->
<div class='fieldset'>
     <?php echo my_generate_legend('itinerary');?>
    <div class="field-section">
 <?php echo my_generate_controller(array('name'=>'travle_start_time','label'=>'travle_start_time','type'=>'text',
          'attribute'=>array('input_wrapper_class'=>'date ', 'class'=>'date-picker'),//input-group
          'option'=>array(
           //   'after'=>' <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>'
          )));?>
       <?php echo my_generate_controller(array('name'=>'travle_end_time','label'=>'travle_end_time','type'=>'text',
          'attribute'=>array('input_wrapper_class'=>'date ', 'class'=>'date-picker'),//input-group
          'option'=>array(
           //   'after'=>' <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>'
          )));?>
<div id='itinerary_container'>
<div class='itinerary' id='itinerary_1'>
    <h3><span class='itinerary_index'>D1</span> <span class='itinerary_time'></span></h3>
    <?php 
        $options = array();
        if(!isset($destination['error'])){ foreach($destination as $item){
            $options[$item['id']] = $item['name'];
            }}
      echo my_generate_controller(array('name'=>'destination_1','label'=>'destination','type'=>'select',
          'attribute'=>array('multiple'=>TRUE,
              'placeholder'=>'choose_or_create',
              'options'=>$options
              )));?>

</div>
</div><!--end itineary conainer-->
    </div><!--end field section-->
</div>
<div class='fieldset'>
    <?php echo my_generate_legend('post_content');?>
    <div class="field-section">
  <?php echo my_generate_controller(array('name'=>'title','label'=>'title','type'=>'text'));?>
  
   <?php echo my_generate_controller(array('name'=>'prepare_content','label'=>'prepare_content','type'=>'textarea'));?>
    <div class="breaker40"></div>
     <?php echo my_generate_controller(array('name'=>'travle_tip','label'=>'travle_tip','type'=>'textarea'));?>
    <div class="breaker40"></div>
   <?php echo my_generate_controller(array('name'=>'post_content','label'=>'post_content','type'=>'textarea'));?>
    </div>
</div>
<div class='fieldset'>
    <?php echo my_generate_legend('other');?>
    <div class="field-section">
 <?php 
        $options = array();
        if(!isset($event['error'])){ foreach($event as $item){
            $options[$item['id']] = $item['name'];
            }}
      echo my_generate_controller(array('name'=>'special_event','label'=>'special_event','type'=>'select',
          'attribute'=>array('multiple'=>TRUE,
              'placeholder'=>'choose_or_create',
              'options'=>$options
              )));?>
<!--   <textarea cols="80" id="content" name="content" rows="10">place holder 1</textarea>-->
    </div>
</div>
   <div class="form-group">
        <!-- Button -->
        <div class="controls">
            <input type="submit" name="submit" value="<?php echo $this->lang->line('submit'); ?>" id="save" class="save" />
        </div>
   </div>
  </form>
</div>

<link rel="stylesheet" href="<?php echo $this->config->item( 'base_theme_url');?>css/chosen.css">
<link rel="stylesheet" href="<?php echo $this->config->item( 'base_theme_url');?>css/datepicker.css">
<script src="<?php echo $this->config->item( 'base_theme_url');?>js/datepicker.js"></script>
<script src="<?php echo $this->config->item( 'base_theme_url');?>js/chosen.js"></script>
 <script src="<?php echo $this->config->item( 'base_theme_url');?>js/ckeditor/ckeditor.js"></script>


<script>
        
    var main_img = "";
    function ajaxSetMainImage(img){
        if(img){
            main_img = img;
        }
    }   
    function generateItinerary(){
          var end_date =  $('#travle_end_time').val();
            var start_date = $('#travle_start_time').val();
            if(start_date){
                 $('#itinerary_1').show();
                $('#itinerary_1').find('.itinerary_time').html('(' + start_date + ')');
            }
            if(start_date && end_date){
            var date1 = new Date(start_date);
            var date2 = new Date(end_date);
            if(date2 < date1){
                return;
            }
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
            $('#itinerary_container .itinerary:gt(0)').remove();
            for(var i = 0; i < diffDays; i++){
              var new_item =  $('#itinerary_1').clone();
              new_item.removeAttr('id').attr('id', 'itinerary_' + (i +2 ));
              var new_date =  new Date();
              new_date.setDate(date1.getDate()+1 + i);
              new_item.find('#destination_1').removeAttr('id').attr('id', 'destination_' + (i +2 )).removeAttr('value');
              new_item.find('.itinerary_index').html('D' + (i + 2));             
              new_item.find('.itinerary_time').html('(' + new_date.yyyymmdd() + ')');
              new_item.find('.chosen-container').remove();
              new_item.appendTo('#itinerary_container');
              new_item.find('.chzn-select').chosen({ width: '100%',
                  create_option: true,
                persistent_create_option: true,
                create_option_text : '<?php echo $this->lang->line('add_option'); ?>',
                skip_no_results: true });
          }
    }
    }
    $(document).ready(function(){
        
        $('#travle_end_time,#travle_start_time').change(function(){
                generateItinerary();
        });
        $('#save').click(function(event ){
            event.preventDefault();
            var destination_arr = [];
            var itinerary = [];
            $('#itinerary_container .itinerary').each(function(item){
                var values = $(this).find('select.form-control').val(); 
                itinerary.push( values.join(','));
                destination_arr = destination_arr.concat(values);
               
            });
            itinerary = itinerary.join('#');
            destination_arr = arrayUnique(destination_arr);
            var request = {
               // 'content': editor.getData(),
               'content': $('#post_content').html(),
                 'special_event': $('#special_event').val() ? $('#special_event').val().join(',') : '',
                 'destination': destination_arr ? destination_arr.join(',') : '',
                  'travle_start_time': $('#travle_start_time').val(),
                  'travle_end_time': $('#travle_end_time').val(),
                  'title': $('#title').val(),
                  'prepare_content':$('#prepare_content').html(),
                   'travle_tip':$('#travle_tip').html(),
                 'itinerary': itinerary,
            };
            if(main_img){
                request['main_image'] = main_img;
            }
            $.ajax({
		async:false,
		url: "<?php echo $this->config->item('base_url');?>ajax",
		type: "POST",
		data: { 'url': '<?php echo $router;?>/detail/format/json' ,
			'method': 'POST',
                        'request':request
                    },
		dataType: "json"
		}).done(function(data){
			if(!data){
				return false;
                            }
                            else{
                                 window.location.href = "<?php echo $this->config->item( 'base_url');?>post";
                            }
			
			});
        });
       $('.chzn-select').chosen({
            create_option: true,
            create_option_text : '<?php echo $this->lang->line('add_option'); ?>',
             persistent_create_option: true,
    
         skip_no_results: true
       });
      
       
         $('.date-picker').datetimepicker({
        language:  'ch',
        weekStart: 1,
        todayBtn:  1,
        format: 'yyyy-mm-dd',
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });

                        
                        $('#itinerary_1').hide();
                        
                        $('.legend').click(function(){
                            var $self = $(this).parent('.fieldset').find('.field-section');
                            
                           // $('.fieldset').find('.field-section').slideUp();
                            $self.slideToggle();
                        });
    });
    </script>