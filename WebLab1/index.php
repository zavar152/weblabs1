<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Web Lab 1</title>

<style type="text/css">
#blocks {
	width: 80%;
	margin: 0px auto;
}

#blocks>div {
	font-family: fantasy;
	border: solid black 2px;
	background-color: white;
	border-radius: 15px;
	margin-top: 1%;
}

#head {
	text-align: center;
	font-size: 25pt;
	color: orange;
}

body {
	background: rgb(213, 213, 217);
}

#footer {
	text-align: center;
	padding: 0.1%;
	font-size: 11pt;
	color: gray;
}

#footer:hover {
    color: aqua;
}

#user {
	font-size: 15pt;
	padding: 2%;
}

#result {
	text-align: center;
	font-size: 15pt;
	max-height: 600px;
	overflow: scroll;
	padding: 2%;
}

#resFrame {
    padding: 10px;
}


table {
	margin: 0px auto;
	font-family: serif;
}

.x {
	margin-right: 10px;
}

.r {
	margin-right: 10px;
}

.error {
	color: red;
}

.info {
	color: gray;
	font-size: 12pt;
}
</style>

</head>
<body>
	<script
		src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(function() {
			$('#calcForm').submit(function(e) {
				e.preventDefault(); //отменяем стандартное действие при отправке формы
				var m_method = $(this).attr('method'); //берем из формы метод передачи данных
				var m_action = $(this).attr('action'); //получаем адрес скрипта на сервере, куда нужно отправить форму
				var m_data = $(this).serialize(); //получаем данные, введенные пользователем в формате input1=value1&input2=value2...,то есть в стандартном формате передачи данных формы
				$.ajax({
					type : m_method,
					url : m_action,
					data : m_data,
					success : function(result) {
						$('#result').html(result);
					}
				});
			});
		});
	</script>
	

	
	<div id="blocks">
		<div id="head">
			<span class="title">Абузов Ярослав Александрович, P3230 <br>Вариант:
				30001
			</span>
		</div>

		<div id="user">
			<form name="inForm" action="handler.php" method="GET" id="calcForm">
					Выберите X: 
					<label class="x"><input type="checkbox" name="x[]" value="-3">-3</label> 
					<label class="x"><input type="checkbox" name="x[]" value="-2">-2</label> 
					<label class="x"><input type="checkbox" name="x[]" value="-1">-1</label> 
					<label class="x"><input type="checkbox" name="x[]" value="0">0</label> 
					<label class="x"><input type="checkbox" name="x[]" value="1">1</label> 
					<label class="x"><input type="checkbox" name="x[]" value="2">2</label> 
					<label class="x"><input type="checkbox" name="x[]" value="3">3</label> 
					<label class="x"><input type="checkbox" name="x[]" value="4">4</label> 
					<label class="x"><input type="checkbox" name="x[]" value="5">5</label> 
					<br> 
					Введите Y: 
					<input type="text" class="y" placeholder="-5..3" size="2" name="y" pattern="-[1-5]|0|[1-3]" required>
					<br>
					Выберите R:
					<label class="r"><input type="radio" name="r" value="1" required>1</label>
					<label class="r"><input type="radio" name="r" value="1.5" required>1.5</label>
					<label class="r"><input type="radio" name="r" value="2" required>2</label>
					<label class="r"><input type="radio" name="r" value="2.5" required>2.5</label>
					<label class="r"><input type="radio" name="r" value="3" required>3</label>
					<br> <input type="submit" id="submit" onclick="return check()">
			</form>
		</div>

		<div id="resFrame">
    		<div id="result"> 
    		<?php
    		$res = "Результаты:<br>";
    		session_start();
    		$table = $res."<table border=\"1\"> <tr> <th> X </th> <th> Y </th> <th> R </th> <th> Результат </th> </tr>";
                foreach ($_SESSION['table'] as $out) {
                    $table.="<tr> <th> $out[0] </th> <th> $out[1] </th> <th> $out[2] </th> <th> $out[3] </th> </tr>";
                }
                $table.="</table>";
                echo $table;?> 
            </div>
		</div>

		<div id="footer">
			<span class="itmo">Национальный исследовательский университет
				ИТМО, 2021г</span>
		</div>
	</div>
	
	<script type="text/javascript">
	function check() {
		var r = document.forms["inForm"]["r"].value;
		var x_ = document.forms["inForm"]['x[]'];
		var y = document.forms["inForm"]["y"].value;

		var x = "";
		var c = 0;
		for(let i = 0; i < 9; i++)
		{
			if(x_.item(i).checked)
			{
				x = x_.item(i).value;
				c++;
			}
				
		}
			
		if (c == 1 && !isNaN(x) && (x == -3 || x == -2 || x == -1 || x == 0 || x == 1 || x == 2 || x == 3 || x == 4 || x == 5)) {

		}
		else {
			alert("Выберите одно значение X");
			return false;
		} 

		if (!isNaN(y) && (y >= -5 && y <= 3)) {

		}
		else {
			alert("Введите корректное значение Y");
			return false;
		}

		if (!isNaN(r) && (r == 1 || r == 1.5 || r == 2 || r == 2.5 || r == 3)) {

		}
		else {
			alert("Выберите корректное значение R");
			return false;
		}
		
		return true;
	}
	</script> 
	
</body>
</html>