var current_page = default_page = 'bussiness';
Date.prototype.yyyymmdd = function() {
   var yyyy = this.getFullYear().toString();
   var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
   var dd  = this.getDate().toString();
   return yyyy + '-' + (mm[1]?mm:"0"+mm[0]) + '-' + (dd[1]?dd:"0"+dd[0]); // padding
  };
  
  
 function pasteHtmlAtCaret(html, selectPastedContent) {
    var sel, range;
    if (window.getSelection) {
        // IE9 and non-IE
        sel = window.getSelection();
        if (sel.getRangeAt && sel.rangeCount) {
            range = sel.getRangeAt(0);
            range.deleteContents();

            // Range.createContextualFragment() would be useful here but is
            // only relatively recently standardized and is not supported in
            // some browsers (IE9, for one)
            var el = document.createElement("div");
            el.innerHTML = html;
            var frag = document.createDocumentFragment(), node, lastNode;
            while ( (node = el.firstChild) ) {
                lastNode = frag.appendChild(node);
            }
            var firstNode = frag.firstChild;
            range.insertNode(frag);
            
            // Preserve the selection
            if (lastNode) {
                range = range.cloneRange();
                range.setStartAfter(lastNode);
                if (selectPastedContent) {
                    range.setStartBefore(firstNode);
                } else {
                    range.collapse(true);
                }
                sel.removeAllRanges();
                sel.addRange(range);
            }
        }
    } else if ( (sel = document.selection) && sel.type != "Control") {
        // IE < 9
        var originalRange = sel.createRange();
        originalRange.collapse(true);
        sel.createRange().pasteHTML(html);
        if (selectPastedContent) {
            range = sel.createRange();
            range.setEndPoint("StartToStart", originalRange);
            range.select();
        }
    }
}
//
// function getCaretCharacterOffsetWithin(element) {
//    var caretOffset = 0;
//    if (typeof window.getSelection != "undefined") {
//        var range = window.getSelection().getRangeAt(0);
//       
//        var preCaretRange = range.cloneRange();
//        preCaretRange.selectNodeContents(element);
//        preCaretRange.setEnd(range.endContainer, range.endOffset);
//        caretOffset = preCaretRange.toString().length;
//    } else if (typeof document.selection != "undefined" && document.selection.type != "Control") {
//        var textRange = document.selection.createRange();
//        var preCaretTextRange = document.body.createTextRange();
//        preCaretTextRange.moveToElementText(element);
//        preCaretTextRange.setEndPoint("EndToEnd", textRange);
//        caretOffset = preCaretTextRange.text.length;
//    }
//    return caretOffset;
//}
//  



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

function setMainImage(ele){
    var $ele = $(ele);
    var img = $ele.parent('.inserted-img-container').find('img').attr('src');
    var main_img_url = img.substring(img.lastIndexOf('/') + 1);
    if (typeof ajaxSetMainImage == 'function') { 
         ajaxSetMainImage(main_img_url); 
    }
}
  function insert_picture(src,target){

       var data = saveBase64(src, base_url + "ajax/image");
       if(data['status'] == 200){
       var new_src  = data['msg'];
       $(target).focus();
       var content_to_insert = "<span class='inserted-img-container'><span class='set-main-img' onclick='setMainImage(this);'><button type='button'>设为主图</button></span><img class='inserted-img' src='" + base_upload_url + new_src + "' /><span>";
       //var content = $(target).text();
       //var position = getCaretCharacterOffsetWithin(document.getElementById($(target).attr('id')));// $(target).getCursorPosition();
      pasteHtmlAtCaret(content_to_insert, false);
     // alert(position);
      //     $(target).insertAtCaret(content, content_to_insert);
      // var newContent = content.substr(0, position) + content_to_insert + content.substr(position);
      // $(target).html(newContent);
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
	// Chosen touch support.
    if ($('.chosen-container').length > 0) {
      $('.chosen-container').on('touchstart', function(e){
        e.stopPropagation(); e.preventDefault();
        // Trigger the mousedown event.
        $(this).trigger('mousedown');
      });
    }
    
    
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