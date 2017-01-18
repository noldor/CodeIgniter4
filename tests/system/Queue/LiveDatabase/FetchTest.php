<?php namespace CodeIgniter\Queue\LiveDatabase;


class FetchTest extends \CodeIgniter\CIQueueDatabaseTestCase
{
	protected $refresh = true;

	public function testFetchNoData()
	{
		$message = '';
		$this->queue->fetch(
			function($data) use ($message)
			{
				$message = $data;
			}
		);
		$this->assertEquals('', $message);
	}

	//--------------------------------------------------------------------

	public function testFetch()
	{
		$this->queue->send('Rock Musician');

		$message = '';
		$this->queue->fetch(
			function($data) use (&$message)
			{
				$message = $data;
			}
		);
		$this->assertEquals('Rock Musician', $message);
	}
}