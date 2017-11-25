<?php
	require_once('api.php');

	auth_reauthenticate();
	access_ensure_global_level( plugin_config_get( 'manage_threshold' ) );
	
	html_page_top( lang_get( 'plugin_workload_config' ) );
	
	print_manage_menu();
	
	echo '<br />';
	echo '<div class="form-container">';	
	echo '<form action="'.plugin_page( 'config_edit' ).'" method="post">';
	# Start security field
	echo form_security_field( 'plugin_workload_config_edit' );
	echo '<table>';
	echo '<tr><td class="form-title"colspan="2">'.lang_get('plugin_workload_title').': '.lang_get('plugin_workload_config').'</td></tr>';

	echo '<tr>';
	echo '<td colspan="2">'.lang_get( 'plugin_workload_config_ana' ).'</td>';
	echo '</tr>';
	# workload_status_level config
	echo '<tr>';
	echo '<td class="category">'.lang_get( 'plugin_workload_status_level' ).'</td>';
	echo '<td><input type="text" name="workload_status_level" value="'.plugin_config_get( 'workload_status_level' ).'"/>';
	echo '</td>';
	echo '</tr>';
	# workload_status_threshold config
	echo '<tr>';
	echo '<td class="category">'.lang_get( 'plugin_workload_status_threshold' ).'</td>';
	echo '<td><select name="workload_status_threshold">';
	echo print_enum_string_option_list( 'status', plugin_config_get('workload_status_threshold'));
	echo '</select></td>';
	echo '</tr>';
	# progress_status_level config
	echo '<tr>';
	echo '<td class="category">'.lang_get( 'plugin_workload_progress_status_level' ).'</td>';
	echo '<td><input type="text" name="progress_status_level" value="'.plugin_config_get( 'progress_status_level' ).'"/>';
	echo '</td>';
	echo '</tr>';
	# progress_status_threshold config
	echo '<tr>';
	echo '<td class="category">'.lang_get( 'plugin_workload_progress_status_threshold' ).'</td>';
	echo '<td><select name="progress_status_threshold">';
	echo print_enum_string_option_list( 'status', plugin_config_get('progress_status_threshold'));
	echo '</select></td>';
	echo '</tr>';

	echo '<tr>';
	echo '<td colspan="2">'.lang_get( 'plugin_workload_config_workload' ).'</td>';
	echo '</tr>';	
	# workload_est_var config
	echo '<tr>';
	echo '<td class="category">'.lang_get( 'plugin_workload_est_var' ).'</td>';
	$t_types = array(CUSTOM_FIELD_TYPE_NUMERIC);
	$t_custom_fields = get_custom_fied_ids($t_types);
	if(count($t_custom_fields) > 0) {	
		echo '<td><select name="workload_est_var_idx">';	
		foreach( $t_custom_fields as $t_field_id )
		{
			$t_desc = custom_field_get_definition( $t_field_id );
			echo '<option value="'.$t_field_id.'"';
			check_selected( strval(plugin_config_get('workload_est_var_idx')), strval($t_field_id) ); 
			echo '>'.string_display($t_desc['name']).'</option>';
		}		
		echo '</select></td>';
	}
	else {
		echo '<td>',lang_get('plugin_workload_custom_field_found_none'),'</td>';
	}
	echo '</tr>';
	# workload_done_var config
	echo '<tr>';
	echo '<td class="category">'.lang_get( 'plugin_workload_done_var' ).'</td>';
	if(count($t_custom_fields) > 0) {	
		echo '<td><select name="workload_done_var_idx">';	
		foreach( $t_custom_fields as $t_field_id ) {
			$t_desc = custom_field_get_definition( $t_field_id );
			echo '<option value="'.$t_field_id.'"';
			check_selected( strval(plugin_config_get('workload_done_var_idx')), strval($t_field_id) ); 
			echo '>'.string_display($t_desc['name']).'</option>';
		}		
		echo '</select></td>';
	}
	else {
		echo '<td>',lang_get('plugin_workload_custom_field_found_none'),'</td>';
	}
	echo '</tr>';
	
	echo '<tr>';
	echo '<td colspan="2">'.lang_get( 'plugin_workload_config_progress' ).'</td>';
	echo '</tr>';	
	# progress_var_idx config
	echo '<tr>';
	echo '<td class="category">'.lang_get( 'plugin_workload_progress_var' ).'</td>';
	if(count($t_custom_fields) > 0) {	
		echo '<td><select name="progress_var_idx">';	
		foreach( $t_custom_fields as $t_field_id ) {
			$t_desc = custom_field_get_definition( $t_field_id );
			echo '<option value="'.$t_field_id.'"';
			check_selected( strval(plugin_config_get('progress_var_idx')), strval($t_field_id) ); 
			echo '>'.string_display($t_desc['name']).'</option>';
		}		
		echo '</select></td>';
	}
	else {
		echo '<td>',lang_get('plugin_workload_custom_field_found_none'),'</td>';
	}
	echo '</tr>';
	
	echo '<tr>';
	echo '<td colspan="2">'.lang_get( 'plugin_workload_config_other' ).'</td>';
	echo '</tr>';		
	# manage_threshold config
	echo '<tr>';
	echo '<td class="category">'.lang_get( 'plugin_workload_management_threshold' ).'</td>';
	echo '<td><select name="manage_threshold">';
	echo print_enum_string_option_list( 'access_levels', plugin_config_get('manage_threshold'));
	echo '</select></td>';
	echo '</tr>';
	# submit button
	echo '<tr>';
	echo '<td class="center" colspan="2"><input type="submit" value="'.lang_get('change_configuration').'"/></td>';
	echo '</tr>';	
	echo '</table>';
	echo '</form>';
	echo '</div>';
	
	html_page_bottom();
?>