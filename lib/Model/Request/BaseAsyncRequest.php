<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 29/05/2017
 * Time: 11:52
 */

namespace Wix\Mediaplatform\Model\Request;


/**
 * Class BaseAsyncRequest
 * @package Wix\Mediaplatform\Model\Request
 */
abstract class BaseAsyncRequest extends BaseRequest
{
	/**
	 * @var $jobCallback JobCallback
	 */
	protected $jobCallback;

	/**
	 * @return JobCallback
	 */
	public function getJobCallback() {
		return $this->jobCallback;
	}

	/**
	 * @param JobCallback $jobCallback
	 *
	 * @return $this
	 */
	public function setJobCallback( $jobCallback ) {
		$this->jobCallback = $jobCallback;

		return $this;
	}
}