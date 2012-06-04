<?php
	define(PLUGIN_WORKLOAD_VAR_IDX_NONE, '-1');
	
	define(PLUGIN_WORKLOAD_PRINT_ISSUE_TIME_DEFAULT, '0');
	define(PLUGIN_WORKLOAD_PRINT_ISSUE_WORKLOAD_DEFAULT, '-1');
	define(PLUGIN_WORKLOAD_PRINT_ISSUE_OVERLOAD_DEFAULT, '-1');
	
 	/**
	 * Get the numeric custom field ids (if any)
	 *
	 * @return array of custom field ids
	 * @author rcasteran
	 */
	function get_numeric_custom_fied_ids() {
		$t_custom_field_table = db_get_table( 'mantis_custom_field_table' );
		$query = "SELECT *
				  FROM $t_custom_field_table
				  ORDER BY name ASC";
		$result = db_query_bound( $query );
		$t_row_count = db_num_rows( $result );
		$t_ids = array();

		for( $i = 0;$i < $t_row_count;$i++ ) {
			$row = db_fetch_array( $result );
			if($row['type'] == CUSTOM_FIELD_TYPE_NUMERIC) {
				array_push( $t_ids, $row['id'] );
			}
			/* Else do nothing */
		}

		return $t_ids;
	} /* End of get_numeric_custom_fied_ids() */
?>