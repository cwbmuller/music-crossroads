<?php namespace flow\cache;
use flow\settings\FFGeneralSettings;
use flow\settings\FFStreamSettings;

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
class FFCacheAdapter implements FFCache{
	private $force;
	private $context;
	/**  @var FFCache */
	private $cache;
	/** @var  FFGeneralSettings */
	private $generalSettings;

	function __construct($context, $force = false){
		$this->force = $force;
		$this->context = $context;
		$dbm = $this->context['db_manager'];
		$this->generalSettings = $dbm->getGeneralSettings();
		$this->cache = new FFCacheManager($this->context, $this->force);
	}

	public function setStream( $stream, $moderation = false ) {
		$this->cache->setStream($stream);
	}

	public function posts( $feeds, $disableCache ) {
		return $this->cache->posts( $feeds, $disableCache );
	}

	public function errors() {
		return $this->cache->errors();
	}

	public function hash() {
		return $this->cache->hash();
	}

	public function transientHash( $streamId ) {
		return $this->cache->transientHash($streamId);
	}

	public function moderate() {
		$this->cache->moderate();
	}
}