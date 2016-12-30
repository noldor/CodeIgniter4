<?php

/**
 * Queue Customer.
 * Queue Customers recieve message from queueing system.
 * There can be many customers, but each message is processed just once.
 * Message is deleted when process is completed.
 * When incompleted, message is returnd to queueing system.
 */
class QueueCustomer
{
	/**
	 * recieve message from queueing system.
	 *
	 * @param  string   $taskName
	 * @param  callable $callback  callback when there is a task
	 * @return boolean  true if a task is processed
	 */
	public function dequeue(string $taskName, callable $callback)
	{
		$message = $this->handler->fetch();
		if ($message) {
			$callback($message['data']);
			///@todo commit的ななにか
			return true;
		}

		return false;
	}
}