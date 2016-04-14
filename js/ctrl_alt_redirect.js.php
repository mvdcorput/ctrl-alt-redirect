<?php
	require_once("../../../../wp-load.php");
	
	Header("content-type: application/x-javascript");

	try {
		if (get_option( 'ctrl_alt_redirect_redirects' ) === null)
		{
			$array_of_options = array(
				'l' => '/wp-admin'
			);

			add_option( 'ctrl_alt_redirect_redirects', $array_of_options, '', 'yes' );
		}
	} 
	catch( \exception $e ) {
		echo "error: $e";
	}
?>
if (Mousetrap) {
<?php
	try {
		$ctrl_alt_redirect_options = get_option( 'ctrl_alt_redirect_redirects' );
		
		foreach ($ctrl_alt_redirect_options as $key => $val)
		{
			echo "Mousetrap.bind('ctrl+alt+$key', function(e, combo) {\n";
			echo "	document.location.href = '$val';\n";
			echo "});\n";
		}
	} catch( \Exception $e ) {
		echo "ERROR: $e";
	}
?>
}