<div class="simplenewsletter" data-showon='<?php echo get_option('simplenewsletter_showon'); ?>'>
	<?php $formID = uniqid('form_simplenewsletter-'); ?>
	<form method='POST' id='subscribe-form' class='<?php echo $formID ?>'>
		<?php 
		if(get_option('simplenewsletter_showname') == 1)
		{
			?>
				<input  name='simplenewsletter[name]' type='hidden' placeholder='<?php echo __("Name", 'simple-newsletter-br') ?>' value="Subscriber"/>
		
			<?php 
		} ?>
		<div class="form-group">
                  <div class="input-group animated" 
                    data-animation="fadeInUp" 
                    data-delay="500">
                    <input type="email" name="simplenewsletter[email]" class="form-control" id="subscribe-email" placeholder="<?php echo __("Email", 'simple-newsletter-br') ?>">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-subscribe simplenewsleter-field-submit">
                        <i class="fa fa-fw fa-paper-plane submit"></i>
                      </button>
                    </span>
                  </div>
                </div>
                <label class="subscribe-notice animated" for="subscribe-email" 
                data-animation="fadeInUp" 
                data-delay="600"></label>

	</form>
	<div class="simplenewsletter_spinner" style="display:none;">
		<img src="<?php echo plugins_url('../images/loading_spinner.gif', __FILE__) ?>" style="margin-left:45%;">
	</div>
</div>
<script>
	/** initSimpleNewsletter('.<?php echo $formID; ?>'); **/
</script>
