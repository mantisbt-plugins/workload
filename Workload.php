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
		
			$this->version  = '3.0.4';
			$this->requires = array(
			'MantisCore' => '2.1.0'
			);
		
			$this->author  = 'STRUCT-IT';

			$this->url     = 'http://www.struct-it.fr';
			
			log_workload_event('Registration successfull');			
		} #End of register()

		 /**
		 * Execute plugin schema at installation
		 *
		 * @return array
		 * @author rcasteran
		 */
		public function schema() {
			log_workload_event('Schema execution successfull');			
			return array();
		} #End of schema()

		/**
		 * Configure plugin at installation
		 *
		 * @return array
		 * @author rcasteran
		 */
		public function config() {
			log_workload_event('Configuration successfull');
			
			return array(
				'workload_status_level'		=> PLUGIN_WORKLOAD_ISSUE_STATUS_LEVEL_DEFAULT,			
				'workload_status_threshold'	=> PLUGIN_WORKLOAD_ISSUE_STATUS_THRSHD_DEFAULT,
				'progress_status_level'		=> PLUGIN_WORKLOAD_ISSUE_STATUS_LEVEL_DEFAULT,			
				'progress_status_threshold'	=> PLUGIN_WORKLOAD_ISSUE_STATUS_THRSHD_DEFAULT,		
				'workload_est_var_idx' 		=> PLUGIN_WORKLOAD_VAR_IDX_NONE,
				'workload_done_var_idx'		=> PLUGIN_WORKLOAD_VAR_IDX_NONE,
				'progress_var_idx'			=> PLUGIN_WORKLOAD_VAR_IDX_NONE,
				'manage_threshold' 			=> ADMINISTRATOR
				);
		} #End of config()

		/**
		 * Register plugin event hook
		 *
		 * @return array
		 * @author rcasteran
		 */
		public function hooks() {
			log_workload_event('Event hooks configuration successfull');
			
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
			return  array(
						array(
							'title' => lang_get('plugin_workload_menu'),
							'access_level' => VIEWER,
							'url' => plugin_page('main', false),
							'icon' => 'fa-briefcase'
						)
					);			
		} #End of menu_main_callback()
	}
?>
