<?php

class Status extends CiiCard
{
	public $scriptName = 'dASaghwDa';

	public $footerText = "Posts";

	public function getPosts()
	{
		header("Content-Type: application/json");
		$response = Yii::app()->db->createCommand('SELECT IF(status=1, "Published", "Draft") as label, count(t.status) as value FROM content AS t WHERE vid=(SELECT MAX(vid) FROM content WHERE id=t.id) AND published <= curtime() GROUP BY status')->queryAll();

		$scheduled = Yii::app()->db->createCommand('SELECT "Scheduled" as label , count(t.status) as value FROM content AS t WHERE vid=(SELECT MAX(vid) FROM content WHERE id=t.id) AND status = 1 AND published >= curtime();')->queryAll();

		$data = array('element' => 'chart', 'colors' => array('#CE4444', '#9ec14a', '#e6a550'), 'data' => array());

		foreach ($response as $r)
			$data['data'][] = $r;

		foreach ($scheduled as $r)
			$data['data'][] = $r;

		echo CJSON::encode($data);
		Yii::app()->end();
	}

}