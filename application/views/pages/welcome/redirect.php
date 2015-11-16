 <div id="template_content" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('you_need_login'); ?></h4>
            </div>
            <div class="modal-body">
              
                <div id='template-content' style='height:85%;'>
                    您将穿越至游局门前。。。
                </div>
              
            </div>
            <div class="modal-footer">
           
               	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> 
<script>
    function toLogin(){
        window.location.href = '../user/login';
    }
$(document).ready(function(){
    setTimeout(function(){ toLogin(); }, 5000);
    $("#template_content").modal('show');
    $('#template_content').on('hide.bs.modal', function () {
        toLogin();
    });
});
        </script>
