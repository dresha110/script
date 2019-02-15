<!DOCTYPE html>
<html>
<head>
<title> VOS </title>
<meta charset="utf-8">
<style type="text/css">
.button {
 	padding: 6px 10px;
  	-webkit-border-radius: 2px 2px;
 	border: solid 1px rgb(153, 153, 153);
  	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(rgb(255, 255, 255)), to(rgb(221, 221, 221)));
  	color: #333;
  	text-decoration: none;
  	cursor: pointer;
 	display: inline-block;
  	text-align: center;
  	text-shadow: 0px 1px 1px rgba(255,255,255,1);
  	line-height: 1;
}
.table2
{
   width: 100%;
   border-collapse: collapse;
   vertical-align: top; 
}
.table1 
{
	font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
	font-size: 18px;
	border-radius: 10px;
	border-spacing: 0;
	text-align: center;
}
td {
	border-style: solid;
	border-width: 1px 1px 1px 1px;
	border-color: black;
}
td:first-child {
	text-align: left;
}
td {
	padding: 10px 20px;
	background: #d5b3f5;
}
td:first-child {
	border-radius: 0 0 0 0;
}
tr:last-child td:last-child {
	border-radius: 0 0 0 0;
}

.form1
{
	margin:0;
	width:900px;
	padding: 8px 10px;
	font-size:16px;
	color:black;
	border:solid 1px #585858;
 
	border-radius: 18px 18px;
	-moz-border-radius: 18px 18px;
	-webkit-border-radius: 18px 18px;
 
	box-shadow: inset 1px 1px 3px 0 #000;
	-moz-box-shadow: inset 1px 1px 3px 0 #000;
	-webkit-box-shadow: inset 1px 1px 3px 0 #000;
 
	background:-moz-linear-gradient(0% 100% 90deg,#90ee90);
	background:-webkit-gradient(linear, 0% 0%, 0% 100%, from(#90ee90));
 	background: #90ee90;
}
</style>
</head>
<body>
<form method="post">
<input class="form1" type="text" name="fieldname" />
<input class="form1" type="text" name="fieldname1" />
<INPUT class="button" TYPE=submit VALUE="send">
</form>
<?php
echo "<table class='table2'> <tr> <td>";
$command = $_POST['fieldname'];
$i = 0;
$j = 0;
while($command[$i] != NULL) {
	if ($command[$i] == " "){
		$com2 .= $command[$i];
		$i++;
		while ($command[$i] == " ")
			$i++;
	}
	if(is_numeric($command[$i]) || $command[$i] == "." || $command[$i] == "/") {
		$com2 .= $command[$i];
	}
	else 
		$com2 .= " ";
	$i++;
}
while($com2[$j] != NULL) {
	if ($com2[$j] == " ") {
		$com3 .= $com2[$j];
		$j++;
		while ($com2[$j] == " ")
			$j++;
	}	
	 if(is_numeric($com2[$j]) || $com2[$j] == "." || $com2[$j] == "/") {
                $com3 .= $com2[$j];
        }
	$j++;
}
$L = 0;
$U = 0;
while ($com3[$L] != NULL) {
	$com4 .= $com3[$L];
	if ($com3[$L] == " ")
		$U++;
	if ($U == 15 || $com3[$L + 1] == NULL ){
		$connect = ssh2_connect('10.54.175.240', '22');
		ssh2_auth_password($connect, "VOS.looking.glass", "ABNjL56Zb2us");
		$stream = ssh2_exec($connect, 'v '.$com4);
		stream_set_blocking($stream, true);
		$n = 0;
		echo "<table class='table1'>";

		while($line = fgets($stream)) {
			if ($line[0] == "N")
				$n = 1;
			if($n == 1){
				$s = 0;
				$str = "<td>";
				while ($line[$s] != NULL) {
					if ($line[$s] == "=" && $line[$s + 1] == "="){
					$str = NULL;
					break;
				}
			$str = $str . $line[$s];
			if($line[$s] == " "){
				if ($line[$s - 1] == "P" && $line[$s - 2] == "I")
					;
				else if ($line[$s - 6] == "S" && $line[$s - 4] == b)
					;
				else if ($line[$s - 1] == "t" && $line[$s - 2] == "o" && ($line[$s - 3] == "n" || $line[$s - 3] == "N"))
					;
				else if ($line[$s - 1] == "-" && $line[$s - 2] == "-")
					;
				else if ($line[$s - 1] == "d" && $line[$s - 2] == "n" && $line[$s - 3] == "u" && $line[$s - 4] == "o")
					$str = $str . "</td><td> NULL";
				else 
					$str = $str . "</td><td>";
				while($line[$s] == " ")
					$s = $s + 1;
			}
			else 
				$s = $s + 1;
		}
		$k = 0;
		$s = strlen($str);
		while($s > 0 && $k < 4) {
			if ($str[$s - $k] == "L")
				;
			else
				$str[$s - $k] = NULL; 
			$k = $k + 1;
		}
		if ($str != NULL)
			echo "<tr>" . $str . "</tr>";
	}
	else
		echo $line ."<br />";
	}
echo "</table>";
		$U = 0;
		$com4 = "";
	}
	$L++;
}
echo "<td>";
$command1 = $_POST['fieldname1'];
$i = 0;
$j = 0;
$com2 = "";
$com3 = "";
$com4 = "";
while($command1[$i] != NULL) {
	if ($command1[$i] == " "){
		$com2 .= $command1[$i];
		$i++;
		while ($command1[$i] == " ")
			$i++;
	}
	if(is_numeric($command1[$i]) || $command1[$i] == "." || $command1[$i] == "/") {
		$com2 .= $command1[$i];
	}
	else 
		$com2 .= " ";
	$i++;
}
while($com2[$j] != NULL) {
	if ($com2[$j] == " ") {
		$com3 .= $com2[$j];
		$j++;
		while ($com2[$j] == " ")
			$j++;
	}	
	 if(is_numeric($com2[$j]) || $com2[$j] == "." || $com2[$j] == "/") {
                $com3 .= $com2[$j];
        }
	$j++;
}
$L = 0;
$U = 0;
while ($com3[$L] != NULL) {
	$com4 .= $com3[$L];
	if ($com3[$L] == " ")
		$U++;
	if ($U == 15 || $com3[$L + 1] == NULL ){
		$connect = ssh2_connect('10.54.175.240', '22');
		ssh2_auth_password($connect, "VOS.looking.glass", "ABNjL56Zb2us");
		$stream = ssh2_exec($connect, 'v '.$com4);
		stream_set_blocking($stream, true);
		$n = 0;
		echo "<table class='table1'>";

		while($line = fgets($stream)) {
			if ($line[0] == "N")
				$n = 1;
			if($n == 1){
				$s = 0;
				$str = "<td>";
				while ($line[$s] != NULL) {
					if ($line[$s] == "=" && $line[$s + 1] == "="){
					$str = NULL;
					break;
				}
			$str = $str . $line[$s];
			if($line[$s] == " "){
				if ($line[$s - 1] == "P" && $line[$s - 2] == "I")
					;
				else if ($line[$s - 6] == "S" && $line[$s - 4] == b)
					;
				else if ($line[$s - 1] == "t" && $line[$s - 2] == "o" && ($line[$s - 3] == "n" || $line[$s - 3] == "N"))
					;
				else if ($line[$s - 1] == "-" && $line[$s - 2] == "-")
					;
				else if ($line[$s - 1] == "d" && $line[$s - 2] == "n" && $line[$s - 3] == "u" && $line[$s - 4] == "o")
					$str = $str . "</td><td> NULL";
				else 
					$str = $str . "</td><td>";
				while($line[$s] == " ")
					$s = $s + 1;
			}
			else 
				$s = $s + 1;
		}
		$k = 0;
		$s = strlen($str);
		while($s > 0 && $k < 4) {
			if ($str[$s - $k] == "L")
				;
			else
				$str[$s - $k] = NULL; 
			$k = $k + 1;
		}
		if ($str != NULL)
			echo "<tr>" . $str . "</tr>";
	}
	else
		echo $line ."<br />";
	}
echo "</table>";
		$U = 0;
		$com4 = "";
	}
	$L++;
}
echo "</tr> </table>";
?>
</body>
</html>
