var current_page = default_page = 'bussiness';
Date.prototype.yyyymmdd = function() {
   var yyyy = this.getFullYear().toString();
   var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
   var dd  = this.getDate().toString();
   return yyyy + '-' + (mm[1]?mm:"0"+mm[0]) + '-' + (dd[1]?dd:"0"+dd[0]); // padding
  };

function arrayUnique(array) {
    var a = array.concat();
    for(var i=0; i<a.length; ++i) {
        for(var j=i+1; j<a.length; ++j) {
            if(a[i] === a[j])
                a.splice(j--, 1);
        }
    }

    return a;
}

function saveBase64(src, url){
    var rst = '';
    $.ajax({
		async:false,
		url: url,
		type: "POST",
		data: { 
                        'request':{'src':src}
                    },
		dataType: "json"
		}).done(function(data){
			if(!data){
				return false;
                            }
                            else{
                               rst = data;
                            }
			
			});
                        return rst;
}

  function insert_picture(src,target){

       var data = saveBase64(src, base_url + "ajax/image");
       if(data['status'] == 200){
       var new_src  = data['msg'];
       var content = $(target).html();
       content += "<img style='max-width:600px;max-height:600px' src='" + base_upload_url + new_src + "' />";
       $(target).html(content);
        }
        else{
            alert('请选择正确的图片');
        }
   }
   
  function readURL(input, target, callback) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                callback(e.target.result, target);
               // $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

$(document).ready(function(){
	
	/*var current_page = getHash() || default_page;
	$('#nav-item-' + current_page).addClass('active');
	var docHeight = $(document).height();
	$('.page-section').css('min-height', docHeight + 'px');
	
	
	$('.nav li.nav-item').click(function(){
		var prev_page = current_page;
		var hash = $(this).find('a').attr('href').substring(1);
		$('#nav-item-' + current_page).removeClass('active');
		//$('#' + current_page + '-content').fadeOut();
		current_page = hash;
		$('#nav-item-' + current_page).addClass('active');
		$('#' + current_page + '-content').hide().fadeIn();
		
		var page_diff = Math.abs(prev_page - current_page);
		
		var time_diff = 800*0;
		
		//$('html body').animate({ scrollTop: 580 }, 800);
		$('html body').animate({ scrollTop: $('#' + current_page + '-content').offset().top - 50 }, time_diff);
	});*/
	//alert($('.nav li.nav-item.active').attr('id'));
	//$('.nav li.nav-item.active').trigger('click');
	
});