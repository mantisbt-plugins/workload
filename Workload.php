<?php
	require_once('pages/api.php');
	
	class WorkloadPlugin extends MantisPlugin {
		 /**
		 * Register plugin
		 *
		 * @return void
		 * @author rcasteran
		 */
		public function register() {
		$this->name        = lang_get( 'plugin_workload_title' );
		$this->description = lang_get( 'plugin_workload_description' );
		$this->page        = 'config';
	
		$this->version  = '1.1.0';
		$this->requires = array(
		'MantisCore' => '1.2.0'
		);
	
		$this->author  = 'Embedia';
		$this->contact = 'maintenance@embedia.fr';
		$this->url     = 'http://www.embedia.fr';
		} #End of register()

		 /**
		 * Execute plugin schema at installation
		 *
		 * @return array
		 * @author rcasteran
		 */
		public function schema() {
			return array();
		} #End of schema()

		/**
		 * Configure plugin at installation
		 *
		 * @return array
		 * @author rcasteran
		 */
		public function config() {
			return array(
				'workload_est_var_idx' 	=> PLUGIN_WORKLOAD_VAR_IDX_NONE,
				'workload_done_var_idx'	=> PLUGIN_WORKLOAD_VAR_IDX_NONE,
				'manage_threshold' 		=> ADMINISTRATOR
				);
		} #End of config()

		/**
		 * Register plugin event hook
		 *
		 * @return array
		 * @author rcasteran
		 */
		public function hooks() {
			return array(
				'EVENT_MENU_MAIN' => 'menu_main_callback',
			);
		} #End of hooks()

		/**
		 * EVENT_MENU_MAIN callback
		 *
		 * @return string
		 * @author rcasteran
		 */
		public function menu_main_callback($p_event, $p_bug_id) {				
			return '<a href="'.plugin_page('main', false).'">'.lang_get('plugin_workload_menu').'</a>';						
		} #End of menu_main_callback()
	}
?>
