
<p class="text-left txt-primary" style="color: black;"><?php echo validation_errors(); ?></p>
<h3>Home / Forget password</h3>
<br>

<?php echo form_open('admin/forget_password_mail'); ?>
<input type="email" name="email" class="form-control" placeholder="Seu E-mail">
<br>
                               
<a href="<?php echo base_url(); ?>admin/index" class="">Login?</a>
<br>

<button type="submit" class="">Submit</button>
</form>   