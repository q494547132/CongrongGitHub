<?php

namespace frontend\controllers;
use yii\web\Controller;
use yii;
/**
 * Congrong controller
 */
class CongrongController extends Controller
{
    /**
     * @inheritdoc
     */
    	//查看
	public function actionList()
	{
		$connect=Yii::$app->db;
		$data=$connect->createCommand('SELECT * FROM day1')->queryAll();
		print_r($data);
	}
	//添加
	public function actionAdd()
	{
		$connect=Yii::$app->db;
		$str = $connect->createCommand()->insert('day1', [
		'name' => '赵四',
		'content' => 'root',
		])->execute();
		if($str)
		{
			echo "添加成功";
		}
		else
		{
			echo "修改失败";
		}
	}
	//修改
	public function actionUpdate()
	{
		$connect=Yii::$app->db;
		$str = $connect->createCommand()->update('day1', ['name' => '刘能'], 'id=2')->execute();
		if($str)
		{
			echo "修改成功";
		}
		else
		{
			echo "修改失败";
		}
	}
	//删除
	public function actionDel()
	{
		$connect=Yii::$app->db;
		$str = $connect->createCommand()->delete('day1', 'id = 1')->execute();
		if($str)
		{
			echo "删除成功";
		}
		else
		{
			echo "删除失败";
		}
	}
}
?>