<?php $format = "Y-m-d";
		echo $todayDate = date($format, time());
        echo $today = time();
        echo "<br/>";
echo $monthsTime = date($format, strtotime("-30 day", $today));
echo "<br/>";
echo time();