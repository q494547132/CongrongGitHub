<?php

namespace frontend\controllers;
use yii\web\Controller;
use yii;
use app\models\Liu;
use yii\data\Pagination;
/**
 * Liu controller
 */
class LiuController extends Controller
{
	public function actionAdd()
	{
		$name = Yii::$app->request->post('name');
		$content = Yii::$app->request->post('content');
		$msg['time'] = date("y-m-d h:i:s");
		$connect=Yii::$app->db;
		$str = $connect->createCommand()->insert('day1', [
		'name' => $name,
		'content' => $content,
		'time' =>$msg['time'],
		])->execute();
		$res = $connect->createCommand('SELECT * FROM day1 ORDER BY id DESC LIMIT 1')->queryAll();
		$msg['id'] = $res[0]['id'];
		echo $msg['time'];
		echo",";
		echo $msg['id'];
	}
	public function actionShow()
	{
		$test=new Liu();	//实例化model模型
		$arr=$test->find();
		//$countQuery = clone $arr;
		$pages = new Pagination([
			//'totalCount' => $countQuery->count(),
			'totalCount' => $arr->count(),
			'pageSize'   => 5   //每页显示条数
		]);
		$str = $arr->select('*')
		->from('day1')
		->offset($pages->offset)
		->limit($pages->limit)
		->orderBy(['id'=>SORT_DESC])
		->asArray()
		->all();
		return $this->render('show', [
			'str' => $str,
			'pages'  => $pages
		]);

		}
	public function actionDel()
	{
		$id = Yii::$app->request->post('id');
		$connect=Yii::$app->db;
		$str = $connect->createCommand()->delete("day1", "id = $id")->execute();
	}
}
?>