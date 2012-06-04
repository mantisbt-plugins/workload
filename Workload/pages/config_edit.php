<?php
	require_once('api.php');
	
	form_security_validate( 'plugin_workload_config_edit' );

	auth_reauthenticate( );
	access_ensure_global_level( plugin_config_get( 'manage_threshold' ) );

	$f_workload_est_var = gpc_get_int( 'workload_est_var_idx', PLUGIN_PM_WORKLOAD_VAR_IDX_NONE );
	$f_workload_done_var = gpc_get_int( 'workload_done_var_idx', PLUGIN_PM_WORKLOAD_VAR_IDX_NONE );
	$f_manage_threshold = gpc_get_int( 'manage_threshold', ADMINISTRATOR );

	html_page_top( null, plugin_page( 'config', true ) );

	print_manage_menu();
	
	echo '<br /><div class="center">';

	if($f_workload_est_var != $f_workload_done_var) {
		if( plugin_config_get( 'workload_est_var_idx' ) != $f_workload_est_var ) {
			plugin_config_set( 'workload_est_var_idx', $f_workload_est_var );
		}
	
		if( plugin_config_get( 'workload_done_var_idx' ) != $f_workload_done_var ) {
			plugin_config_set( 'workload_done_var_idx', $f_workload_done_var );
		}
		
		if( plugin_config_get( 'manage_threshold' ) != $f_manage_threshold ) {
			plugin_config_set( 'manage_threshold', $f_manage_threshold );
		}

		echo lang_get( 'operation_successful' ) . '<br />';
	}
	else {
		trigger_error( ERROR_CONFIG_OPT_INVALID, WARNING );		
	}
	
	print_bracket_link( plugin_page( 'config', true ), lang_get( 'proceed' ) );
	echo '</div>';
	html_page_bottom();			
?>