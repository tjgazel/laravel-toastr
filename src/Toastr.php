<?php

namespace TJGazel\Toastr;

use Illuminate\Session\SessionManager as Session;
use Illuminate\Config\Repository as Config;

class Toastr
{
	/**
	 * The session manager.
	 * @var Session
	 */
	private $session;

	/**
	 * The Config Handler.
	 *
	 * @var Config
	 */
	private $config;

	/**
	 * The session name for toastr
	 *
	 * @var string
	 */
	private $sessionName;

	/**
	 * The messages in session.
	 *
	 * @var array
	 */
	private $messages = [];

	function __construct(Session $session, Config $config)
	{
		$this->session = $session;
		$this->config = $config;
		$this->sessionName = $config->get('toastr.session_name');
	}

	/**
	 * @param string $message
	 * @param string $title
	 * @return $this
	 */
	public function success($message, $title = null, $options = [])
	{
		$this->add('success', $message, $title, $options);

		return $this;
	}

	/**
	 * @param string $message
	 * @param string $title
	 * @return $this
	 */
	public function error($message, $title = null, $options = [])
	{
		$this->add('error', $message, $title, $options);

		return $this;
	}

	/**
	 * @param string $message
	 * @param string $title
	 * @return $this
	 */
	public function warning($message, $title = null, $options = [])
	{
		$this->add('warning', $message, $title, $options);

		return $this;
	}

	/**
	 * @param string $message
	 * @param string $title
	 * @return $this
	 */
	public function info($message, $title = null, $options = [])
	{
		$this->add('info', $message, $title, $options);

		return $this;
	}

	/**
	 * @param string $type
	 * @param string $message
	 * @param string $title
	 * @return void
	 */
	private function add($type, $message, $title, $options)
	{
		$this->messages[] = [
			'type' => $type,
			'title' => $title,
			'message' => $message,
			'options' => $options
		];

		$this->session->flash($this->sessionName, $this->messages);
	}

	public function render()
	{
		if ($this->session->has($this->sessionName)) {
			
			$toast = $this->session->get($this->sessionName);

			$script = '<script type="text/javascript">';

			foreach ($toast as $t) {
				$config = (array)$this->config->get('toastr.options');

				if (count($t['options'])) {
					$config = array_merge($config, $t['options']);
				}

				if ($config) {
					$script .= 'toastr.options = ' . json_encode($config) . ';';
				}

				$title = $t['title'] ? ', "' . $t['title'] . '"' : '';

				$script .= 'toastr.' . $t['type'] . '("' . $t['message'] . '"' . $title . ');';
			}

			$script .= '</script>';

			$this->messages = [];

			return $script;
		}
	}

}
