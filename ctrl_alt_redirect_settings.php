<?
	function ctrl_alt_redirect_options_page() {
?>
<?php
		if (!empty($_POST)) {
			$post_options = array();
			
			foreach ($_POST as $key => $url) {
				if (startsWith($key, "ctrl_alt_") === true) {
					$character = str_replace("ctrl_alt_", "", $key);
					$post_options = $post_options + array($character => $url);					
				}
			}

			if (count($post_options) === 0) {
				$post_options = null;
			}
			
			if (get_option( 'ctrl_alt_redirect_redirects' ) === null) {
				add_option( 'ctrl_alt_redirect_redirects', $post_options, '', 'yes' );
			}
			else {
				update_option( 'ctrl_alt_redirect_redirects', $post_options);
			}						
		}
?>
<style>
	.double-space-above {
		margin-top: 10px;
	}
	
	.space {
		height: 10px;
	}
	
	.space-above {
		margin-top: 10px;
	}
</style>
<form method="post">
	<?php $db_options = get_option( 'ctrl_alt_redirect_redirects' ); // get plugin options from the database ?>
	
	<h3>CTRL-ALT-Redirect settings</h3>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row">Redirects:</th>
				<td>
					<div class="redirect-list">
<?
		foreach ($db_options as $key => $val)
		{
?>
						<div class="redirect-item">
						CTRL - ALT - <input type="text" class="font-color-field" name="key_<?php echo $key ?>" value="<?php echo $key ?>" disabled maxLength="1" size=1>
						redirect to <input type="text" class="font-color-field" name="ctrl_alt_<?php echo $key ?>" value="<?php echo $val ?>" >
						<input type="button" value="Remove" onclick="removeRedirectItem(this)" /> 
						</div>
<?
		}
?>
					</div>
					<div class="double-space-above space"></div>
					<div class="space-above"><b>Voeg een nieuwe redirect toe:</b></div>
					<div class="space-above"></div>
					CTRL - ALT - <input type="text" class="font-color-field" id="newk" maxLength="1" size=1>
					redirect to <input type="text" class="font-color-field" id="newv" > 
					<input type="button" value="Add" onclick="addRedirect()"/> 
				</td>
			</tr>
		</tbody>	
	</table>

	<?php @submit_button(); ?>

</form>
<script type="text/javascript">
	function addRedirect() {
		var key = jQuery('#newk').val();
		var list = jQuery('.redirect-list');
		var redirecItem = jQuery('<div class="redirect-item"></div>');
		var value = jQuery('#newv').val();
		
		redirecItem.html(	'CTRL - ALT - <input type="text" class="font-color-field" name="key_' + key +  '" value="' + key + '" disabled maxLength="1" size=1> ' +
							'redirect to <input type="text" class="font-color-field" name="ctrl_alt_' + key + '" value="' + value + '" > ' +
							'<input type="button" value="Remove" onclick="removeRedirectItem(this)" /> (new)');
								
		list.append(redirecItem);
		
		jQuery('#newk').val('');
		jQuery('#newv').val('');
	}

	function removeRedirectItem(sender) {
		var list = jQuery('.redirect-list');
		
		jQuery(sender).closest(".redirect-item").remove();
	}
</script>
<?
	}
	
	function startsWith($haystack, $needle) {
		// search backwards starting from haystack length characters from the end
		return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
	}
?>