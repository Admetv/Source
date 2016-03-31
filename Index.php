<?php 
	$server = ''; $user = ''; $password = ''; $db = '';
	$dblink = mysql_connect($server, $user, $password) or die('Could not connect : ' . mysql_error());; $selected = mysql_select_db($db, $dblink) or die('Could not connect BD: ' . mysql_error());; mysql_query('set names utf8'); 
	if (!$_GET['d']) { 
		$l=10*$_GET['l']; $m=$_GET['l']+10; if($_GET['s']){$p='/?s='.$_GET['s'].'&';}else{$p='/?';} if($_GET['l']){$n=$_GET['l']-1;}else{$n=$_GET['l']=0;} $q=$p.'l='.$n; $t['title']='Заметки об ошибках, неисправностях и т.д. в программах, системах и др.';
		$result=mysql_query("SELECT id,DATE_FORMAT(date, '%d.%m.%y') as date,title FROM news WHERE v=1 and title LIKE '%$_GET[s]%' ORDER BY id desc LIMIT $l,10"); $r=mysql_num_rows($result);
	} else {
		$result=mysql_query("SELECT title,text FROM news WHERE id=$_GET[d]"); $t=mysql_fetch_array($result);
	}
echo "
<!doctype html>
<html>
	<head>
		<title>$t[title]</title>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
		<meta name='description' content='Сайт заметок об ошибках, неисправностях и т.д. в информационных системах, технологиях, базах данных, программах, играх и др.'>
		<meta name='keywords' content='Системы, технологии, программы'>
		<link rel='shortcut icon' type='image/png' sizes='16x16' href='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAACQkWg2AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAFLSURBVDhPlVKJTsJQEOT/P8qoUTxAFBAo9OBqS0vL0YMWER1n6SPaYIhuNpt9x+zs7HsV/NMqxf0kSeKy5Xn+aykF2L/z+LPs+3OApgXdBeOziZqO2gAPfYn3muzUDSRHPsVgzjAJ0JvCcCWaHroTDH2pwqWz+CZTgPYII19q32loGHgyhKE+EBInhL9CECmMAjRMoWbVOBNfpYg2WKaS0Pcf2B0VKYBmYxxIr60RXiyQkGyUxJxsdoi+XWYoJD724a0wnsNdiPPeNJCEYra7MqCuC2mwRhgj3iCMDh4fPEKSnYimYnsBNjZwwIlZHoyZuOUfElfGVZjScNNBeyyTqfZw3cFlCxdNXL1KvO2iqp0wsEt/jaGH2VIeZB5J94xcFkr4Gun2BwN3eUZe9sPIDplQve4geyt9EdUShxBl8v5pLlM/Ywrw9z/+BQhZ3dEbqVyJAAAAAElFTkSuQmCC'/>
		<style>
			@charset 'utf-8';body{font-family:Arial,tahoma,verdana,sans-serif;padding:20px;font-size:0;min-width:1200px}body,header,aside,section,footer{float:left;width:100%}a{color:#0054FF;text-decoration:underline;outline:none}a,p,span,input{font-size:12px}form{margin:14px 0 16px 0}input{width:220px;border:1px solid #ccc;border-top:2px solid #777;border-left:2px solid #777}header{margin-bottom:15px}aside{margin-right:20px;width:200px}section{width:900px}ol{list-style-type:none;padding:0}ol li{margin-bottom:6px}nav{margin-top:16px}nav a{margin-right:4px}footer{margin-top:15px}
		</style>
	</head>
	<body>
		<header><a href='/'>Главная</a></header>
		<aside>
			<img width='200' height='418' onclick='h()' src='ad.png'/>
		</aside>
		<section>";
			 if (!$_GET['d']) { echo "
			<form action='/'><input type='text' name='s' value='$_GET[s]'/></form>
			<ol>";
				for($i=0;$i<$r;$i++) { $t=mysql_fetch_array($result); echo "
					<li><a href='/?d=$t[id]'>$t[date] - $t[title]</a></li>
				";} echo "
			</ol>
			<nav>
				<a href='$q' style='margin-right:7px'><</a>";
				for($i=$_GET['l'];$i<$m;$i++) { $v=$i+1; $q=$p.'l='.$i; echo "
					<a href='$q'>$v</a>
				";} $q=$p.'l='.$i; echo "
				<a href='$q' style='margin-left:3px'>>></a>
			</nav>";
			} else { echo "
			<article>
				$t[text] <!--<img width='320' height='240' src='.jpg'>-->
			</article>
			";} echo "
		</section>
		<footer><a href='/?d=1'>2016 г., О сайте</a></footer>
		<script>
			function h(){window.open('http://www.mos.ru','_blank');}
		</script>
	</body>
</html>";
