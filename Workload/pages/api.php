<?php
	define(PLUGIN_WORKLOAD_VAR_IDX_NONE, '-1');
	
	define(PLUGIN_WORKLOAD_PRINT_ISSUE_TIME_DEFAULT, '0');
	define(PLUGIN_WORKLOAD_PRINT_ISSUE_WORKLOAD_DEFAULT, '-1');
	
	if(!function_exists('get_custom_fied_ids'))
	{
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
?>