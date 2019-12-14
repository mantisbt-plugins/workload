<?php
	define('PLUGIN_WORKLOAD_LOGIN_HISTORY_FILE', 'plugins/workload/log/log_workload');
	define('PLUGIN_WORKLOAD_LOGIN_HISTORY_ENTRY_MAX', 5000);
	
	define('PLUGIN_WORKLOAD_VAR_IDX_NONE', '-1');
	define('PLUGIN_WORKLOAD_VAR_DEFAULT', 'Not found');

	define('PLUGIN_WORKLOAD_ISSUE_STATUS_LEVEL_DEFAULT', 50);
	define('PLUGIN_WORKLOAD_ISSUE_STATUS_THRSHD_DEFAULT', 'Not found');
	
	define('PLUGIN_WORKLOAD_PRINT_ISSUE_TIME_DEFAULT', 0);
	define('PLUGIN_WORKLOAD_PRINT_ISSUE_WORKLOAD_DEFAULT', -1);
	
	if(!function_exists('log_workload_event')) {
		/**
		 * Log event
		 *
		 * @param string $p_event specifies the event to be logged
		 * @return void
		 * @author rcasteran
		 */
		function log_workload_event( $p_event = '') {
			$t_fileData = file(PLUGIN_WORKLOAD_LOGIN_HISTORY_FILE);

			array_unshift($t_fileData, time().';'.$p_event.';'.PHP_EOL);
  			if (count($t_fileData) > PLUGIN_WORKLOAD_LOGIN_HISTORY_ENTRY_MAX) {
    			$t_fileData = array_slice($t_fileData, 0, PLUGIN_WORKLOAD_LOGIN_HISTORY_ENTRY_MAX);
			}/* Else do nothing */
			
			file_put_contents(PLUGIN_WORKLOAD_LOGIN_HISTORY_FILE, $t_fileData, LOCK_EX);
		}
	}
	
	if(!function_exists('print_workload_menu'))	{
		/**
		 * Print the menu
		 *
		 * @param string $p_page specifies the current page name so it's link can be disabled
		 * @return void
		 * @author rcasteran
		 */
		function print_workload_menu( $p_page = '', $p_project_id, $p_version_id, $p_handler_id ) {
			$t_main_page = 'main.php';
			$t_remaining_page = 'remaining.php';
			$t_changelog_page = 'changelog.php';
		
			switch( $p_page ) {
				case $t_main_page:
					$t_main_page = '';
					$t_remaining_page = plugin_page($t_remaining_page, false);
					$t_changelog_page = plugin_page($t_changelog_page, false);

					if($p_handler_id != -1) {
						$t_remaining_page = $t_remaining_page."&handler_id=".$p_handler_id;
						$t_changelog_page = $t_changelog_page."&handler_id=".$p_handler_id;					
					}else if($p_version_id != -1) {
						$t_remaining_page = $t_remaining_page."&version_id=".$p_version_id;
						$t_changelog_page = $t_changelog_page."&version_id=".$p_version_id;					
					}else if($p_project_id != -1) {
						$t_remaining_page = $t_remaining_page."&project_id=".$p_project_id;						
						$t_changelog_page = $t_changelog_page."&project_id=".$p_project_id;
					} 
					/* Else do nothing */				
					break;
				case $t_remaining_page:
					$t_main_page = plugin_page($t_main_page, false);
					$t_remaining_page = '';
					$t_changelog_page = plugin_page($t_changelog_page, false);

					if($p_handler_id != -1) {
						$t_main_page = $t_main_page."&handler_id=".$p_handler_id;					
						$t_changelog_page = $t_changelog_page."&handler_id=".$p_handler_id;					
					}else if($p_version_id != -1) {
						$t_main_page = $t_main_page."&version_id=".$p_version_id;
						$t_changelog_page = $t_changelog_page."&version_id=".$p_version_id;					
					}else if($p_project_id != -1) {
						$t_main_page = $t_main_page."&project_id=".$p_project_id;
						$t_changelog_page = $t_changelog_page."&project_id=".$p_project_id;
					} 
					/* Else do nothing */				
					break;					
				case $t_changelog_page:
					$t_main_page = plugin_page($t_main_page, false);
					$t_remaining_page = plugin_page($t_remaining_page, false);
					$t_changelog_page = '';
					
					if($p_handler_id != -1) {
						$t_main_page = $t_main_page."&handler_id=".$p_handler_id;					
						$t_remaining_page = $t_remaining_page."&handler_id=".$p_handler_id;
					}else if($p_version_id != -1) {
						$t_main_page = $t_main_page."&version_id=".$p_version_id;
						$t_remaining_page = $t_remaining_page."&version_id=".$p_version_id;						
					}else if($p_project_id != -1) {
						$t_main_page = $t_main_page."&project_id=".$p_project_id;
						$t_remaining_page = $t_remaining_page."&project_id=".$p_project_id;
					}
					/* Else do nothing */				
					break;
				default:
					$t_main_page = plugin_page($t_main_page, false);
					$t_remaining_page = plugin_page($t_remaining_page, false);
					$t_changelog_page = plugin_page($t_changelog_page, false);
					break;
			}
		
			echo '<div align="center"><p>';
			print_bracket_link($t_main_page, lang_get('plugin_workload_menu_main') );
			print_bracket_link($t_remaining_page, lang_get('plugin_workload_menu_remaining') );
			print_bracket_link($t_changelog_page, lang_get('plugin_workload_menu_changelog') );
			echo '</p></div>';
		} /* End of print_workload_menu() */
	}
	
	if(!function_exists('get_custom_fied_ids')) {
		/**
		 * Get the custom field ids of a specified type (if any)
		 *
		 * @param array of custom field type
		 * @return array of custom field ids
		 * @author rcasteran
		 */
		function get_custom_fied_ids($p_types) {
			$t_custom_field_table = db_get_table( 'mantis_custom_field_table' );
			$query = "SELECT *
					  FROM $t_custom_field_table
					  ORDER BY name ASC";
			$result = db_query_bound( $query );
			$t_row_count = db_num_rows( $result );
			$t_ids = array();

			for( $i = 0;$i < $t_row_count;$i++ ) {
				$row = db_fetch_array( $result );
				foreach($p_types as $t_type) {
					if($row['type'] == $t_type) {
						array_push( $t_ids, $row['id'] );
					}
					/* Else do nothing */
				}
			}

			return $t_ids;
		} /* End of get_custom_fied_ids() */
	}

	if(!function_exists('print_bracket_link')) {
		/**
		 * print the bracketed links used near the top
		 * if the $p_link is blank then the text is printed but no link is created
		 * if $p_new_window is true, link will open in a new window, default false.
		 * @param string  $p_link       The URL to link to.
		 * @param string  $p_url_text   The text to display.
		 * @param boolean $p_new_window Whether to open in a new window.
		 * @param string  $p_class      CSS class to use with the link.
		 * @return void
		 */
		function print_bracket_link( $p_link, $p_url_text, $p_new_window = false, $p_class = '' ) {
			echo '<span class="bracket-link';
			if( $p_class !== '' ) {
				echo ' bracket-link-',$p_class; # prefix on a container allows styling of whole link, including brackets
			}
			echo '">[&#160;';
			print_link( $p_link, $p_url_text, $p_new_window, $p_class );
			echo '&#160;]</span> ';
		}
	}
?>