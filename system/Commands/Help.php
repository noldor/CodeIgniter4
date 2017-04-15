<?php namespace CodeIgniter\Commands;

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2017, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	CodeIgniter Dev Team
 * @copyright	Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 3.0.0
 * @filesource
 */

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

/**
 * CI Help command for the ci.php script.
 *
 * Lists the basic usage information for the ci.php script,
 * and provides a way to list help for other commands.
 *
 * @package CodeIgniter\Commands
 */
class Help extends BaseCommand
{
	protected $group = 'CodeIgniter';

	/**
	 * The Command's name
	 *
	 * @var string
	 */
	protected $name = 'help';

	/**
	 * the Command's short description
	 *
	 * @var string
	 */
	protected $description = 'Displays basic usage information.';

	/**
	 * the Command's usage
	 *
	 * @var string
	 */
	protected $usage = 'help command_name';

	/**
	 * the Command's Arguments
	 *
	 * @var array
	 */
	protected $arguments = array(
			'command_name' => 'The command name [default: "help"]'
			);

	/**
	 * the Command's Options
	 *
	 * @var array
	 */
	protected $options = array();


	//--------------------------------------------------------------------

	/**
	 * Displays the help for the ci.php cli script itself.
	 *
	 * @param array $params
	 */
	public function run(array $params)
	{
		$command = array_shift($params);
		if(is_null($command)){
			$command = 'help';
		}

		$commands = $this->commands->getCommands();
		$class=new $commands[$command]['class']($this->logger, $this->commands);

		$class->showHelp();
	}
}
