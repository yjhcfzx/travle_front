<div id="container">
  <h1>Welcome to CodeIgniter!</h1>
   <?php echo $this->ckeditor->editor('description',@$default_value);?> 
  <input type="submit" name="submit" value="Save" id="save" class="save" />

  <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>