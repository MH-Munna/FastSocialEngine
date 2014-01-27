<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Статистика</title
</head>
<?php
include('config.php');
if ($_GET['load']) $cpuload='&load=1';

require_once('auth.php');
foreach ($nodes as $key => $value)
{
    echo "&nbsp<a href='cal.php?node=$key'>".$value[0]."</a>";
}

echo "<br>";
echo "<a href='cal.php?node=".$_GET['node']."'>Трафик</a>&nbsp<a href='cal.php?load=1&node=".$_GET['node']."'>CPU</a><br>";
if (is_numeric($_GET['year']) && strlen($_GET['year'])<5) $year=$_GET['year'];
else $year=date('Y', time());

for ($a=($year-2);$a<($year+3);$a++)
{
    if ($a==$year) 
    {
        echo "$a&nbsp;&nbsp;";
        continue;
    }
    echo "<a href=\"cal.php?year=$a&node=".$_GET['node'].$cpuload."\">$a</a>&nbsp;&nbsp;";
}
if ($_GET['node']!='') echo "<br><b>".$nodes[$_GET['node']][0];
else echo "<br><b>".$nodes[0][0];
if ($_GET['load']==1) echo " - CPU load</b>";
else echo " - Traffic load</b>";
echo show_calendar($year);

function show_calendar($year=2009,$row_count=4)
{
$month_names2=array("","Январь","Февраль", "Март", "Апрель", "Май", "Июнь", "Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь");
$week_days_short=array("","Пн","Вт","Ср","Чт","Пт","Су","Вс");

$result="<table><tr><td colspan=$row_count><center><b>$year год</b></center></td><tr>";
for ($a=1;$a<13;$a++)
	{
		if ($rows>=$row_count) {$result.="</tr><tr>"; $rows=0;}
		$result.="<td>";
		$rows++;
		$month=mktime(0,0,0,$a,1,$year);
		$days=date("t",$month);
		$weekday=date("N",$month);

		$result.="<br><table border=1 style=\"border:solid; border-width:1px; border-collapse: collapse;margin:10;\"><tr><td colspan=7><center><b><a href=\"cal.php?from=$month&to=".(86400*$days)."&node=".$_GET['node'].$cpuload."#graf\">".$month_names2[$a]."<center></b></td></tr>";
		$result.="<tr><td><center>".$week_days_short[1]."<center></td><td><center>".$week_days_short[2]."<center></td><td><center>".$week_days_short[3]."<center></td><td><center>".$week_days_short[4]."<center></td><td><center>".$week_days_short[5]."<center></td><td><center><font color=red>".$week_days_short[6]."</font><center></td><td><center><font color=red>".$week_days_short[7]."</font><center></td></tr>";
		$day=1;
		$start=false;
		for ($b=1;$b<7;$b++)
		{
			$result.="<tr>";
			for ($c=1;$c<8;$c++)
				{
					if ($b==1 && $weekday==$c) $start=true;
					if ($start && $day<$days+1) 
					{
					    $to_time=mktime(0,0,0, $a, $day, $year);
                                            if ($_GET['load']) $cpuload='&load=1';
					    $result.='<td><a href="cal.php?from='.$to_time.'&to=86400&node='.$_GET['node'].$cpuload.'#graf">'.$day.'</a></td>';$day++;
					}
					else {  $result.="<td>&nbsp;</td>";}
					
				}
			$result.="</tr>";
		}
		$result.="</table></td>";
	}
$result.="</tr></table>";
return $result;
}
echo "<img id=\"graf\" src=\"stat.php?from=".$_GET['from']."&to=".$_GET['to']."&a=5&node=".$_GET['node'].$cpuload."\">";
?>