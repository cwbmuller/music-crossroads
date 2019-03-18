<?php namespace flow\tabs;

use la\core\tabs\LATab;

if ( ! defined( 'WPINC' ) ) die;
/**
 * FlowFlow.
 *
 * @package   FlowFlow
 * @author    Looks Awesome <email@looks-awesome.com>
 *
 * @link      http://looks-awesome.com
 * @copyright 2014-2016 Looks Awesome
 */
class FFBackupTab implements LATab {
	public function __construct() {
	}

	public function id() {
		return 'backup-tab';
	}

	public function flaticon() {
		return 'flaticon-data';
	}

	public function title() {
		return 'Database';
	}

	public function includeOnce( $context ) {
		$context['backups'] = array();
		include_once($context['root']  . 'views/backup.php');
	}
}