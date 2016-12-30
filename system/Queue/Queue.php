<?php namespace CodeIgniter\Queue;

/**
 * Queue class.
 */
class Queue
{
	protected static $instances = [];

	/**
	 * connecting queueing system.
	 *
	 *
	 * @param  string|array  $group     The name of the connection group to use,
	 *                                  or an array of configuration settings.
	 * @param  bool          $getShared Whether to return a shared instance of the connection.
	 * @return mixed
	 */
	public static function connect($group = '', bool $getShared = true)
	{
		if (is_array($group))
		{
			$group_config = $group;
			$group = 'custom';
		}

		if ($getShared && isset(self::$instances[$group]))
		{
			return self::$instances[$group];
		}

		$config = new \Config\Queue();

		if ($group == '')
		{
			$group = ENVIRONMENT == 'testing' ? 'tests' : (string)$config->defaultGroup;
		}

		if (isset($config->$group))
		{
			$group_config = $config->$group;
		}
		elseif ($group != 'custom')
		{
			throw new \InvalidArgumentException($group.' is not a valid queue connection group.');
		}

		$handler = '\\CodeIgniter\\Queue\\Handlers\\' . $group_config['handler'] . 'Handler';
		self::$instances[$group] = new $handler($group_config, $config);

		return self::$instances[$group];
	}
}