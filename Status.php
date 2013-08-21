<?php

class Status extends CiiCard
{
	public $scriptName = 'dASaghwDa';

	public $footerText = "Posts";

	public $settingsView = false;

	protected $justMe = true;

	public function rules()
	{
		return array(
			array('justMe', 'boolean')
		);
	}

	public function attributeLabels()
	{
		return array(
			'justMe' => 'Display My Status'
		);
	}
	/**
	 * Retrieves posts for card
	 */
	public function getPosts()
	{
		header("Content-Type: application/json");
		$me = Yii::app()->user->id;

		if ($this->justMe)
			$response = Yii::app()->db->createCommand('SELECT IF(status=1, "Published", "Draft") as label, count(t.status) as value FROM content AS t WHERE vid=(SELECT MAX(vid) FROM content WHERE id=t.id) AND author_id = :author_id AND published <= curtime() GROUP BY status')->bindParam(':author_id', $me)->queryAll();
		else
			$response = Yii::app()->db->createCommand('SELECT IF(status=1, "Published", "Draft") as label, count(t.status) as value FROM content AS t WHERE vid=(SELECT MAX(vid) FROM content WHERE id=t.id) AND published <= curtime() GROUP BY status')->queryAll();

		if ($this->justMe)
			$scheduled = Yii::app()->db->createCommand('SELECT "Scheduled" as label , count(t.status) as value FROM content AS t WHERE vid=(SELECT MAX(vid) FROM content WHERE id=t.id) AND status = 1 AND author_id = :author_id AND published >= curtime();')->bindParam(':author_id', $me)->queryAll();
		else
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