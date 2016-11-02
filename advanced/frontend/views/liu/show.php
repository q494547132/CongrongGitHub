<?php
use yii\widgets\LinkPager;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>查</title>
</head>
<script src="style/jq.js"></script>
<body>
	<form action="" method="post">
		<center>
			<table style="margin-bottom:50px">
				<tr>
					<td style="width:110px; height:30px;"><center><font size=2>姓名：</font></center></td>
					<td style="width:110px; height:30px"><font size=2><input type="text" id="name"></font></td>
				</tr>
				<tr>
					<td style="width:110px; height:30px"><center><font size=2>留言内容：</font></center></td>
					<td style="width:110px; height:30px"><font size=2><textarea id="content" cols="30" rows="10"></textarea></font></td>
				</tr>
				<tr>
					<td style="width:110px; height:30px"><center><font size=2><input type="button" id="sub" value="提交"></font></center></td>
					<td style="width:110px; height:30px"><center><font size=2><input type="reset" value="重置"></font></center></td>
				</tr>
			</table>
		</center>
	</form>
	<center>
		<table border=3 id="table">
			<tr>
				<td style="width:110px; height:30px"><center><font size=2>姓名</font></center></td>
				<td style="width:110px; height:30px"><center><font size=2>留言内容</font></center></td>
				<td style="width:110px; height:30px"><center><font size=2>留言时间</font></center></td>
				<td style="width:110px; height:30px"><center><font size=2>操作</font></center></td>
			</tr>
			<?php foreach ($str as $key => $value) : ?>
				<tr du="<?=$value['id'];?>">
					<td style="width:110px; height:30px"><center><font size=2><?=$value['name'];?></font></center></td>
					<td style="width:110px; height:30px"><center><font size=2><?=$value['content'];?></font></center></td>
					<td style="width:250px; height:30px"><center><font size=2><?=$value['time'];?></font></center></td>
					<td style="width:110px; height:30px"><a id="del"><center><font size=2>删除</font></center></a></td>
				</tr>
			<?php endforeach ?>
		</table>
		<?php
			echo LinkPager::widget([
				'pagination'=>$pages,
			]);
		?>
	</center>
</body>
</html>
<script type="text/javascript">
	$(function(){
		//ajax无跳转刷新添加
		$('#sub').click(function()
		{
			var name = $('#name').val();
			var content = $('#content').val();
			$.ajax({
				type:"post",
				url:"?r=liu/add",
				data: {name:name,content:content},
				success:function(msg)
				{
					var time = msg.substring(0,17);
					var id = msg.substring(18);
					$str = "<tr align='center' du="+id+"><td style='width:110px; height:30px'><font size=2>"+name+"</font></td><td style='width:110px; height:30px'><font size=2>"+content+"</font></td><td style='width:250px; height:30px'><font size=2>20"+time+"</font></td><td style='width:110px; height:30px'><a id='del'><center><font size=2>删除</font></center></a></td></tr>";
					$('#table').append($str);
					location.reload();
				}
			})
		})
		//ajax无跳转刷新删除
		$(document).on('click','#del',function(){
			var _this = $(this);
			var id = _this.parent().parent().attr('du');
			$.ajax({
				type:"post",
				url:"?r=liu/del",
				data:{id:id},
				success:function(msg)
				{
					_this.parent().parent().remove();
					location.reload();
				}
			})
		})
	})
</script>