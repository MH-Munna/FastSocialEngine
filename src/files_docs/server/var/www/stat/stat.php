<?php
require_once('auth.php');
require_once('config.php');

if (is_numeric($_GET['res']) && strlen($_GET['res'])<5)
{
    $x_size=$_GET['res'];
    $y_size=(($_GET['res']/1.33333)-50);
}
else
{
    $x_size=1024;
    $y_size=720;
}

if (isset($nodes[$_GET['node']])) $db_path=$nodes[$_GET['node']][1];
else $db_path=$nodes[0][1];
$trafic_top=150000;
$db=$db_path;
if ($_GET['load']==true)
{
    header ("Content-type: image/png");

    $poligon=false;
    $diver=1000;
    $img = imagecreatetruecolor($x_size, $y_size+48);

    $red = imagecolorallocate($img, 255, 0, 0);
    $green = imagecolorallocate($img, 0, 255, 0);
    $white= imagecolorallocate($img, 255, 255, 255);

    $grey= imagecolorallocate($img, 40, 40, 40);

    //imageline($img,0,0,320-1,240-1,$ink);

    $dbhandle = sqlite_open($db);
    if ($dbhandle)
    {

        if (!is_numeric($_GET['from']))
        {
            $curr_time=time();
            $curr_day=date("d", $curr_time);
            $curr_month=date("m", $curr_time);
            $curr_year=date("Y", $curr_time);

            $_GET['from']=mktime(0,0,0,$curr_month, $curr_day, $curr_year);
            $_GET['to']=$curr_time-$_GET['from'];
        
        }

        if (!is_numeric($_GET['from']) && strlen($_GET['from'])>1)
        {
            exit;
        }
        elseif (is_numeric($_GET['from']))
        {
            if (is_numeric($_GET['to']) && strlen($_GET['to'])>1)
            {
                $where="WHERE datetime BETWEEN ".$_GET['from']." AND ".($_GET['from']+$_GET['to']);
            }
            else
            {
                $curr_time=time();

                $where="WHERE datetime>'".$_GET['from']."'";
                $_GET['to']=$curr_time-$_GET['from'];
            }
        }

        $query=sqlite_query($dbhandle, "SELECT * from cpuload $where order by datetime");

        $lines=sqlite_num_rows($query);
        if ($lines>0)
        $step=$x_size/$lines;

        $x_cpu_location=0;
        $y_cpu_location=$y_size;
        $x_cpu_current=0;
        $y_cpu_current=$y_size;

        $y_text=0;
        $x_text=0;


        $first=true;

        $x_up_current=0;
        $y_up_current=$y_size;
    //Надписи вертикальные
        while($y_text<=$y_size)
        {
            $text=(round(((100/$y_size)*($y_size-$y_text))));
            imagestring($img,12, 0,$y_text,"$text",$white);
            imageline($img,0,$y_text,$x_size,$y_text,$grey);

            $y_text=$y_text+72;
        }

        //Надписи горизонтальные
        while($x_text<=$x_size)
        {
            $text2=date('d.m.y',$_GET['from']+($_GET['to']/$x_size)*$x_text);
            $text=date('G:i',$_GET['from']+(($_GET['to']/$x_size)*$x_text));
            imagestring($img,12, $x_text,$y_size+30,"$text",$white);
            imagestring($img,12, $x_text,$y_size+15,"$text2",$white);
            imageline($img,$x_text,0,$x_text,$y_size,$grey);

            $x_text=$x_text+86;
        }

        while ($entry = sqlite_fetch_array($query, SQLITE_ASSOC)) 
        {

            if ($_GET['a']>0)
            {
                $count=1;
                $entry2 = sqlite_fetch_array($query, SQLITE_ASSOC);
                while (($entry2 = sqlite_fetch_array($query, SQLITE_ASSOC)) && $count<$_GET['a'])
                {
                    $entry['load']+=$entry2['load'];

                    $count++;
                }
                if ($count ) 
                {
                    $entry['load']=$entry['load']/$count;
                }
            }
            $count2++;
            $entry_time=$entry['datetime']-$_GET['from'];
        
        
            $x_up_location=($x_size/$_GET['to'])*$entry_time;
            $y_up_location=$y_size-(($y_size/10000)*$entry['load']);


            if ($first==true)
            {
                $points[]=$x_up_location;
                $points[]=$y_size;

                $x_up_current=$x_up_location;
                $first=false;
            }

            if ($poligon)
            {
                $points[]=$x_up_location;
                $points[]=$y_up_location;
            }
            else
            {
                imageline($img,$x_up_current,$y_up_current,$x_up_location,$y_up_location,$green);
                if ($count2%10==0) imagestring($img,12, $x_up_location, $y_up_location-30,$entry['users'],$white);

            }
        
            $x_up_current=$x_up_location;
            $y_up_current=$y_up_location;
        

        

        }
        if ($poligon)
        {
            $points[]=$x_up_location;
            $points[]=$y_size;
            imagefilledpolygon($img, $points, $count2+2, $green);
        }
        
    }
    else
    {
        exit;
    }

    imagepng($img);
    imagedestroy($img);
}
else
{
    header ("Content-type: image/png");


    $diver=1000;
    $img = imagecreatetruecolor($x_size, $y_size+48);

    $red = imagecolorallocate($img, 255, 0, 0);
    $green = imagecolorallocate($img, 0, 255, 0);
    $white= imagecolorallocate($img, 255, 255, 255);

    $grey= imagecolorallocate($img, 40, 40, 40);

    //imageline($img,0,0,320-1,240-1,$ink);

    $dbhandle = sqlite_open($db);
    if ($dbhandle)
    {

        if (!is_numeric($_GET['from']))
        {
            $curr_time=time();
            $curr_day=date("d", $curr_time);
            $curr_month=date("m", $curr_time);
            $curr_year=date("Y", $curr_time);

            $_GET['from']=mktime(0,0,0,$curr_month, $curr_day, $curr_year);
            $_GET['to']=$curr_time-$_GET['from'];
        
        }

        if (!is_numeric($_GET['from']) && strlen($_GET['from'])>1)
        {
            exit;
        }
        elseif (is_numeric($_GET['from']))
        {
            if (is_numeric($_GET['to']) && strlen($_GET['to'])>1)
            {
                $where="WHERE datetime BETWEEN ".$_GET['from']." AND ".($_GET['from']+$_GET['to']);
            }
            else
            {
                $curr_time=time();

                $where="WHERE datetime>'".$_GET['from']."'";
                $_GET['to']=$curr_time-$_GET['from'];
            }
        }

        $query=sqlite_query($dbhandle, "SELECT max(uptrafic), max(downtrafic) from trafic $where");
        if (sqlite_num_rows($query)>0)
        {
            $entry = sqlite_fetch_array($query, SQLITE_ASSOC);
            if ( $entry['max(uptrafic)']>$entry['max(downtrafic)'] ) $trafic_top=$entry['max(uptrafic)'];
            else $trafic_top=$entry['max(downtrafic)'];
        }

        $query=sqlite_query($dbhandle, "SELECT * from trafic $where order by datetime");

        $lines=sqlite_num_rows($query);
        if ($lines>0)
        $step=$x_size/$lines;
        $x_down_location=0;
        $y_down_location=$y_size;
        $x_down_current=0;
        $y_down_current=$y_size;

        $x_up_location=0;
        $y_up_location=$y_size;
        $x_up_current=0;
        $y_up_current=$y_size;

        $y_text=0;
        $x_text=0;

    //Надписи вертикальные
        while($y_text<=$y_size)
        {
            if ($diver==1000) $bytes='KB';
            elseif ($diver==1000000) $bytes="Mb";
            $text=(round((($trafic_top/$y_size)*($y_size-$y_text))/$diver)*8)." ".$bytes;


            imagestring($img,12, 0,$y_text,"$text",$white);
            imageline($img,0,$y_text,$x_size,$y_text,$grey);

            $y_text=$y_text+64;
        }

        //Надписи горизонтальные
        while($x_text<=$x_size)
        {
            $text2=date('d.m.y',$_GET['from']+($_GET['to']/$x_size)*$x_text);
            $text=date('G:i',$_GET['from']+(($_GET['to']/$x_size)*$x_text));
            imagestring($img,12, $x_text,$y_size+30,"$text",$white);
            imagestring($img,12, $x_text,$y_size+15,"$text2",$white);
            imageline($img,$x_text,0,$x_text,$y_size,$grey);

            $x_text=$x_text+86;
        }

        $first=true;

        while ($entry = sqlite_fetch_array($query, SQLITE_ASSOC)) 
        {
            if ($_GET['a']>0)
            {
                $count=1;
                $entry2 = sqlite_fetch_array($query, SQLITE_ASSOC);
                while (($entry2 = sqlite_fetch_array($query, SQLITE_ASSOC)) && $count<$_GET['a'])
                {
                    $entry['uptrafic']+=$entry2['uptrafic'];
                    $entry['downtrafic']+=$entry2['downtrafic'];

                    $count++;
                }
                if ($count ) 
                {
                    $entry['uptrafic']=$entry['uptrafic']/$count;
                    $entry['downtrafic']=$entry['downtrafic']/$count;
                }
            }

            $entry_time=$entry['datetime']-$_GET['from'];
        
        
            $x_down_location=($x_size/$_GET['to'])*$entry_time;
            $y_down_location=$y_size-(($y_size/$trafic_top)*$entry['downtrafic']);

            $x_up_location=($x_size/$_GET['to'])*$entry_time;
            $y_up_location=$y_size-(($y_size/$trafic_top)*$entry['uptrafic']);


            if ($first==true)
            {
                $x_down_current=$x_down_location;
                $x_up_current=$x_up_location;
                $first=false;
            }

//            $red=imagecolorallocate($img, (round(255-((255/$y_size)*$y_down_current))), 0, 250);
//            $green=imagecolorallocate($img,250, (round(255-((255/$y_size)*$y_down_current))), 0);

            imageline($img,$x_down_current,$y_down_current,$x_down_location,$y_down_location,$red);
            imageline($img,$x_up_current,$y_up_current,$x_up_location,$y_up_location,$green);

        
            $x_down_current=$x_down_location;
            $y_down_current=$y_down_location;

            $x_up_current=$x_up_location;
            $y_up_current=$y_up_location;

        }
    }
    else
    {
        exit;
    }

    imagepng($img);
    imagedestroy($img);
}
?>
