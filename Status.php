<?php

class Status extends CiiCard
{
	public $scriptName = 'dASaghwDa';

	public $footerText = "Posts";

	public function getPosts()
	{
		header("Content-Type: application/json");
		
		$response = Yii::app()->db->createCommand('SELECT IF(status=1, "Published", "Draft") as status, count(t.status) as value, IF(status=1, "#9ec14a", "#CE4444") as color FROM content AS t WHERE vid=(SELECT MAX(vid) FROM content WHERE id=t.id) AND published <= curtime() GROUP BY status')->queryAll();

		$scheduled = Yii::app()->db->createCommand('SELECT "Scheduled" as status , count(t.status) as value, "#e6a550" as color FROM content AS t WHERE vid=(SELECT MAX(vid) FROM content WHERE id=t.id) AND status = 1 AND published >= curtime();')->queryAll();

		$data = array();

		echo CJSON::encode($data);

		Yii::app()->end();
	}

}