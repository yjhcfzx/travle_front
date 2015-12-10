<div id="container">
  <h1><?php echo $this->lang->line('create_post'); ?></h1>
  <form method="post">
      <?php echo my_generate_controller(array('name'=>'title','label'=>'title','type'=>'text'));?>
     
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
<!--       <div class="form-group">
                <label for="dtp_input2" class="control-label"><?php echo $this->lang->line('travle_time'); ?></label>
                <div class="input-group date form_date" id="travle_time" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" id="travle_time1" size="16" type="text" value="" >
		    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
			<input type="hidden" id="travle_time2" value="" /><br/>	
            </div>-->
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
<h2><?php echo $this->lang->line('itinerary'); ?></h2>
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
</div>
<h2><?php echo $this->lang->line('post_content'); ?></h2>
   <textarea cols="80" id="content" name="content" rows="10">place holder 1</textarea>
   <div class="form-group">
        <!-- Button -->
        <div class="controls">
            <input type="submit" name="submit" value="<?php echo $this->lang->line('submit'); ?>" id="save" class="save" />
        </div>
   </div>
  </form>
  <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<link rel="stylesheet" href="<?php echo $this->config->item( 'base_theme_url');?>css/chosen.css">
<link rel="stylesheet" href="<?php echo $this->config->item( 'base_theme_url');?>css/datepicker.css">
<script src="<?php echo $this->config->item( 'base_theme_url');?>js/datepicker.js"></script>
<script src="<?php echo $this->config->item( 'base_theme_url');?>js/chosen.js"></script>
 <script src="<?php echo $this->config->item( 'base_theme_url');?>js/ckeditor/ckeditor.js"></script>


<script>
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
            $('#itinerary_container .itinerary').each(function(item){
                var values = $(this).find('select.form-control').val(); console.log(values);
                destination_arr = destination_arr.concat(values); 
                console.log(destination_arr);
            });
            destination_arr = arrayUnique(destination_arr);
            var request = {
                'content': editor.getData(),
                 'special_event': $('#special_event').val() ? $('#special_event').val().join(',') : '',
                 'destination': destination_arr ? destination_arr.join(',') : '',
                  'travle_start_time': $('#travle_start_time').val(),
                  'travle_end_time': $('#travle_end_time').val(),
                  'title': $('#title').val(),
                
            };
            console.log(request);return;
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
      //<![CDATA[

				// This call can be placed at any point after the
				// <textarea>, or inside a <head><script> in a
				// window.onload event handler.

				// Replace the <textarea id="editor"> with an CKEditor
				// instance, using default configurations.
		var editor =		CKEDITOR.replace( 'content',
                {
                    language : 'zh-cn',
                    filebrowserBrowseUrl :'<?php echo $this->config->item('base_theme_url');?>js/ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo $this->config->item( "ckeditor_connector_url");?>',
                    filebrowserImageBrowseUrl : '<?php echo $this->config->item('base_theme_url');?>js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?php echo $this->config->item( "ckeditor_connector_url");?>',
                    filebrowserFlashBrowseUrl :'<?php echo $this->config->item('base_theme_url');?>js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?php echo $this->config->item( "ckeditor_connector_url");?>',
					filebrowserUploadUrl  :'<?php echo $this->config->item( "ckeditor_upload_url");?>?Type=File',
					filebrowserImageUploadUrl : '<?php echo $this->config->item( "ckeditor_upload_url");?>?Type=Image',
					filebrowserFlashUploadUrl : '<?php echo $this->config->item( "ckeditor_upload_url");?>?Type=Flash'
				});

			//]]>
                        
                        $('#itinerary_1').hide();
    });
    </script>