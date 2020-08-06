<!DOCTYPE html>

<?php
require('../config/wiwe360-config.php'); //Load DB(mysql) config parameter
session_start();
$Hotel = $_SESSION['Hotel'];


$queryTrafficVolume = "SELECT date_format(TIMESTAMP, '%h:%i %p') as TIMESTAMP, Sent, Receive FROM KPITrafficVolume WHERE HotelName = '$Hotel' and Period = 'Last Hour' order by TIMESTAMP ASC";
$resultTrafficVolume = mysql_query($queryTrafficVolume,$Link) or die ($Link);
$rowTrafficVolume = array();
while ($r = mysql_fetch_assoc($resultTrafficVolume))
{
    $rowTrafficVolume[] = $r;
}

$queryTrafficVolumeLast12Hours = "SELECT date_format(TIMESTAMP, '%h %p') as TIME, sum(Sent) as Sent, sum(Receive) as Receive FROM KPITrafficVolume WHERE HotelName = 'GIS' and Period = 'Last 12 Hours' group by date_format(TIMESTAMP, '%h %p') order by TIMESTAMP ASC";
$resultTrafficVolumeLast12Hours = mysql_query($queryTrafficVolumeLast12Hours,$Link) or die ($Link);
$rowTrafficVolumeLast12Hours = array();
while ($r = mysql_fetch_assoc($resultTrafficVolumeLast12Hours))
{
    $rowTrafficVolumeLast12Hours[] = $r;
}


$queryTrafficVolumeLast24Hours = "SELECT date_format(TIMESTAMP, '%h %p') as TIME, sum(Sent) as Sent, sum(Receive) as Receive FROM KPITrafficVolume WHERE HotelName = 'GIS' and Period = 'Last 24 Hours' group by date_format(TIMESTAMP, '%h %p') order by TIMESTAMP ASC";
$resultTrafficVolumeLast24Hours = mysql_query($queryTrafficVolumeLast24Hours,$Link) or die ($Link);
$rowTrafficVolumeLast24Hours = array();
while ($r = mysql_fetch_assoc($resultTrafficVolumeLast24Hours))
{
    $rowTrafficVolumeLast24Hours[] = $r;
}

// ----> 1st query
$query = "SELECT * FROM service_level WHERE period = 'Today' and hotel_name = '$Hotel'";
$result = mysql_query($query,$Link) or die(mysql_error($Link));
        $row = mysql_fetch_assoc($result);


// ----> 2nd query
$query1 = "SELECT * FROM service_level WHERE period = 'Last7days' and hotel_name = '$Hotel' ";
$result1 = mysql_query($query1,$Link) or die(mysql_error($Link));
            $row1 = mysql_fetch_assoc($result1);

// ----> 3rd query
$query2 = "SELECT * FROM service_level WHERE period = 'Last30days' and hotel_name = '$Hotel'";
$result2 = mysql_query($query2,$Link) or die(mysql_error($Link));
            $row2 = mysql_fetch_assoc($result2);

// ----> Query Response Time Today

$queryResponseTimeToday = "SELECT ResponseTime FROM ResponseTime where period = 'today' and hotel_name = '$Hotel'";
$resultResponseTimeToday = mysql_query($queryResponseTimeToday,$Link) or die (mysql_error($Link));
            $rowResponseTimeToday = mysql_fetch_assoc($resultResponseTimeToday);

// ----> Query Response Time Last 7 Days

$queryResponseTimeLast7Days = "SELECT ResponseTime FROM ResponseTime where period = 'Last7Days' and hotel_name = '$Hotel'";
$resultResponseTimeLast7Days = mysql_query($queryResponseTimeLast7Days,$Link) or die (mysql_error($Link));
            $rowResponseTimeLast7Days = mysql_fetch_assoc($resultResponseTimeLast7Days);

// ----> Query Response Time Last 30 Days

$queryResponseTimeLast30Days = "SELECT ResponseTime FROM ResponseTime where period = 'Last30days' and hotel_name = '$Hotel'";
$resultResponseTimeLast30Days = mysql_query($queryResponseTimeLast30Days,$Link) or die (mysql_error($Link));
            $rowResponseTimeLast30Days = mysql_fetch_assoc($resultResponseTimeLast30Days);

// ----> Disconnect AP

$queryDisconnectAP = "SELECT COALESCE(TotalDisconnectedAP)as TotalDisconnectedAP,TotalAP FROM APStatus WHERE HotelName = '$Hotel'";
$resultDisconnectAP = mysql_query($queryDisconnectAP,$Link) or die(mysql_error($Link));
            $rowDisconnectAP = mysql_fetch_assoc($resultDisconnectAP);
            $TotalDisconnectAP = $rowDisconnectAP['TotalDisconnectedAP'];
            $TotalAP = $rowDisconnectAP['TotalAP'];
            $percentageDisconnectedAP = $TotalDisconnectAP / $TotalAP *100;


// ----> 4th query
$query3 = "SELECT * FROM service_level WHERE period = 'Yesterday'";
$result3 = mysql_query($query3,$Link) or die(mysql_error($Link));
            $row3 = mysql_fetch_assoc($result3);

// ----> 5th query
$query4 = "SELECT * FROM service_level WHERE period = '7-14'";
$result4 = mysql_query($query4,$Link) or die(mysql_error($Link));
            $row4 = mysql_fetch_assoc($result4);

// ----> 6th query
$query5 = "SELECT * FROM service_level WHERE period = '30-60'";
$result5 = mysql_query($query5,$Link) or die(mysql_error($Link));
            $row5 = mysql_fetch_assoc($result5);

//----> uptime calculation

            $uptime1 = $row['service_level'] - $row3['service_level'];
                if ( $uptime1 <= 0 ) $rest_uptime1 = round($uptime1,1);
                else $rest_uptime1 = "+".round($uptime1,1);
            $uptime2 = $row1['service_level'] - $row4['service_level'];
                if ( $uptime2 <= 0 ) $rest_uptime2 = round($uptime2,1);
                else $rest_uptime2 = "+".round($uptime2,1);

            $uptime3 = $row2['service_level'] - $row5['service_level'];
                if ( $uptime3 <= 0 ) $rest_uptime3 = round($uptime3,1);
                else $rest_uptime3 = "+".round($uptime3,1);

// ---->  query check status
        $queryStatus = "SELECT * FROM heartbeat_status where hotel_name = 'Como' order by date_time DESC limit 1";
        $resultStatus = mysql_query($queryStatus,$Link) or die(mysql_error($Link));
        if(mysql_num_rows($resultStatus) != 0){
            $rowStatus = mysql_fetch_assoc($resultStatus);

            if ($rowStatus['remarks'] == 'online')
                {
                    $queryOffline = "SELECT TIMESTAMPDIFF(HOUR, now(), date_time) as `difference` FROM heartbeat_status WHERE remarks = 'offline'";
                    $resultQueryOffline = mysql_query($queryOffline,$Link) or die(mysql_error($Link));
                    if (mysql_num_rows($resultQueryOffline) != 0)
                    {
                        $rowStatusOffline = mysql_fetch_assoc($resultQueryOffline);
                        $hourOffline = $rowStatusOffline['difference'];
                        $status = 'Online: '.abs ($hourOffline).' hours';
                    }

                }

                else if ($rowStatus['remarks'] == 'offline')
                {
                    $queryOnline = "SELECT TIMESTAMPDIFF(HOUR, now(), date_time) as `difference` FROM heartbeat_status WHERE remarks = 'online'";
                    $resultQueryOnline = mysql_query($queryOffline,$Link) or die(mysql_error($Link));
                    if (mysql_num_rows($resultQueryOnline) != 0)
                    {
                        $rowStatusOnline = mysql_fetch_assoc($resultQueryOnline);
                        $hourOnline = $rowStatusOnline['difference'] ;
                        $status = 'Offline: '.abs ($hourOnline).' hours';

                    }
}

// ----> Query User & Margin New User Today

        $queryUserToday = "SELECT * FROM KPIUser WHERE hotel_name = '$Hotel' and period ='Today'";
        $resultQueryUserToday = mysql_query($queryUserToday,$Link) or die (mysql_error($Link));
        $rowQueryUserToday = mysql_fetch_assoc($resultQueryUserToday);
        $newUserToday = $rowQueryUserToday['NewUser'];
        $totalUserToday = $rowQueryUserToday['TotalUser'];
        $marginUserToday = $newUserToday / $totalUserToday * 100;


// ----> Query User & Margin New User Last 7 Days

        $queryUserLast7Days = "SELECT * FROM KPIUser WHERE hotel_name ='$Hotel' and period ='Last 7 Days'";
        $resultQueryUserLast7Days = mysql_query($queryUserLast7Days,$Link) or die (mysql_error($Link));
        $rowQueryUserLast7Days = mysql_fetch_assoc($resultQueryUserLast7Days);
        $newUserLast7Days = $rowQueryUserLast7Days['NewUser'];
        $totalUserLast7Days = $rowQueryUserLast7Days['TotalUser'];
        $marginUserLast7Days = $newUserLast7Days / $totalUserLast7Days *100;

// ----> Query User & Margin New User Last 30 Days

        $queryUserLast30Days = "SELECT * FROM KPIUser WHERE hotel_name = '$Hotel' and period ='Last 30 Days'";
        $resultQueryUserLast30Days = mysql_query($queryUserLast30Days,$Link) or die (mysql_error($Link));
        $rowQueryUserLast30days = mysql_fetch_assoc($resultQueryUserLast30Days);
        $newUserLast30Days = $rowQueryUserLast30days ['NewUser'];
        $totalUserLast30Days = $rowQueryUserLast30days['TotalUser'];
        $marginUserLast30Days = $newUserLast30Days /$totalUserLast30Days * 100;

// ----> Query Login Type for Last 30 Days

        $queryLoginType30Days = "SELECT * FROM KPIUserLoginType WHERE hotel_name = '$Hotel' and Period = 'Last 30 days'";

        $resultQueryLoginType30Days = mysql_query($queryLoginType30Days) or die (mysql_error($Link));

        $rowQueryLoginType30Days = mysql_fetch_assoc($resultQueryLoginType30Days);

        $loginTypeRoomLogin30Days = 578;

        $loginTypeSocialMedia30Days = 361;

        $loginTypeRegistration30Days = 25;

// ----> Query Login Type for Last 7 days

        $queryLoginType7Days = "SELECT * FROM KPIUserLoginType WHERE hotel_name = '$Hotel' and Period = 'Last 7 Days' ";

        $resultQueryLoginType7Days = mysql_query($queryLoginType7Days) or die (mysql_error($Link));

        $rowQueryLoginType7Days = mysql_fetch_assoc($resultQueryLoginType7Days);

        $loginTypeRoomLogin7Days = 146;

        $loginTypeSocialMedia7Days = 138;

        $loginTypeRegistration7Days = 5;

// ----> Query Login Type for Today

         $queryLoginTypeToday = "SELECT * FROM KPIUserLoginType WHERE hotel_name = '$Hotel' and Period = 'Today' ";

        $resultQueryLoginTypeToday = mysql_query($queryLoginTypeToday) or die (mysql_error($Link));

        $rowQueryLoginTypeToday = mysql_fetch_assoc($resultQueryLoginTypeToday);

        $loginTypeRoomLoginToday = 30;

        $loginTypeSocialMediaToday = 46;

        $loginTypeRegistrationToday = 2;



// ----> Check new device for today

         $queryNewDeviceToday = "SELECT NewDevice as newdevice FROM KPIDevice WHERE Period = 'today' and hotel_name = '$Hotel'";
         $resultQueryNewDeviceToday = mysql_query($queryNewDeviceToday,$Link) or die(myssql_error($Link));

         if (mysql_num_rows($resultQueryNewDeviceToday) != 0)
         {
            $rowNewDeviceToday = mysql_fetch_assoc($resultQueryNewDeviceToday);
            $newDeviceToday = $rowNewDeviceToday['newdevice'];
         }

// ---> Check All Device for Today
          $queryTotalDeviceToday = "SELECT TotalDevice as newdevice FROM KPIDevice WHERE Period = 'today' and hotel_name = '$Hotel'";
         $resultQueryTotalDeviceToday = mysql_query($queryTotalDeviceToday,$Link) or die(myssql_error($Link));

         if (mysql_num_rows($resultQueryTotalDeviceToday) != 0)
         {
            $rowTotalDeviceToday = mysql_fetch_assoc($resultQueryTotalDeviceToday);
            $TotalDeviceToday = $rowTotalDeviceToday['newdevice'];
         }

// ----> Percentage for New Device
         $newDevicePercentage = @($newDeviceToday / $TotalDeviceToday *100 + 0.001);

// ---> Check New Device for Last 7 Days

         $queryNewDeviceLast7Day = "SELECT NewDevice as newdevice FROM KPIDevice WHERE Period = 'Last 7 days' and hotel_name = '$Hotel'";
         $resultQueryNewDeviceLast7Day = mysql_query($queryNewDeviceLast7Day,$Link) or die(myssql_error($Link));

         if (mysql_num_rows($resultQueryNewDeviceLast7Day) != 0)
         {
            $rowNewDeviceLast7Day = mysql_fetch_assoc($resultQueryNewDeviceLast7Day);
            $newDeviceLast7Day = $rowNewDeviceLast7Day['newdevice'];
         }

// ----> Check Total Device for Last 7 Days

          $queryTotalDeviceLast7Day = "SELECT TotalDevice as newdevice FROM KPIDevice WHERE Period = 'Last 7 days' and hotel_name = '$Hotel'";
         $resultQueryTotalDeviceLast7Day = mysql_query($queryTotalDeviceLast7Day,$Link) or die(myssql_error($Link));

         if (mysql_num_rows($resultQueryTotalDeviceLast7Day) != 0)
         {
            $rowTotalDeviceLast7Day = mysql_fetch_assoc($resultQueryTotalDeviceLast7Day);
            $TotalDeviceLast7Day = $rowTotalDeviceLast7Day['newdevice'];
         }

// ----> Percentage for New device Last 7 Days

         $newDeviceLast7DayPercentage = $newDeviceLast7Day / $TotalDeviceLast7Day * 100 +0.001;

// ----> Check New Device for Last 30 Days

         $queryNewDeviceLast30Day = "SELECT NewDevice as newdevice FROM KPIDevice WHERE Period = 'Last 30 days' and hotel_name = '$Hotel'";
         $resultQueryNewDeviceLast30Day = mysql_query($queryNewDeviceLast30Day,$Link) or die(myssql_error($Link));

         if (mysql_num_rows($resultQueryNewDeviceLast30Day) != 0)
         {
            $rowNewDeviceLast30Day = mysql_fetch_assoc($resultQueryNewDeviceLast30Day);
            $newDeviceLast30Day = $rowNewDeviceLast30Day['newdevice'];
         }

// ----> Check Total device for Last 30 Days

          $queryTotalDeviceLast30Day = "SELECT TotalDevice as newdevice FROM KPIDevice WHERE Period = 'Last 30 days' and hotel_name = '$Hotel'";
         $resultQueryTotalDeviceLast30Day = mysql_query($queryTotalDeviceLast30Day,$Link) or die(myssql_error($Link));

         if (mysql_num_rows($resultQueryTotalDeviceLast30Day) != 0)
         {
            $rowTotalDeviceLast30Day = mysql_fetch_assoc($resultQueryTotalDeviceLast30Day);
            $TotalDeviceLast30Day = $rowTotalDeviceLast30Day['newdevice'];
         }

// ----> New Device Last 30 days Percentage

         $newDeviceLast30DayPercentage = $newDeviceLast30Day / $TotalDeviceLast30Day * 100 + 0.001;

// ----> Query New Device Yesterday

         $queryNewDeviceYesterday = "SELECT NewDevice as newdevice FROM KPIDevice WHERE Period = 'Yesterday' and hotel_name = '$Hotel'";
         $resultQueryNewDeviceYesterday = mysql_query($queryNewDeviceYesterday,$Link) or die(myssql_error($Link));

         if (mysql_num_rows($resultQueryNewDeviceYesterday) != 0)
         {
            $rowNewDeviceYesterday = mysql_fetch_assoc($resultQueryNewDeviceYesterday);
            $newDeviceYesterday = $rowNewDeviceYesterday['newdevice'];
         }

// ----> Query Total Device Yesterday

           $queryTotalDeviceYesterday = "SELECT TotalDevice as newdevice FROM KPIDevice WHERE Period = 'Yesterday' and hotel_name = '$Hotel'";
         $resultQueryTotalDeviceYesterday = mysql_query($queryTotalDeviceYesterday,$Link) or die(myssql_error($Link));

         if (mysql_num_rows($resultQueryTotalDeviceYesterday) != 0)
         {
            $rowTotalDeviceYesterday = mysql_fetch_assoc($resultQueryTotalDeviceYesterday);
            $TotalDeviceYesterday = $rowTotalDeviceYesterday['newdevice'];
         }


//----> Margin Calculation for Today

         $marginNewDeviceToday = @((($newDeviceToday / $totalDeviceToday) - ($newDeviceYesterday / $TotalDeviceYesterday)) * 100);

         if ($marginNewDeviceToday == 0)
         {
            $statusMarginNewDeviceToday = $marginNewDeviceToday.'% Same as yesterday';
         }
         else if ($marginNewDeviceToday < 0)
         {
            $statusMarginNewDeviceToday = $marginNewDeviceToday.'% Less than Yesterday';
         }

         else if ($marginNewDeviceToday > 0 )
         {
            $statusMarginNewDeviceToday = '+'.$marginNewDeviceToday.'% More than Yesterday';
         }

// ---> Query New Device for 7 - 14

         $queryNewDevice714 = "SELECT NewDevice as newdevice FROM KPIDevice WHERE Period = '7-14' and hotel_name = '$Hotel'";
         $resultQueryNewDevice714 = mysql_query($queryNewDevice714,$Link) or die(myssql_error($Link));

         if (mysql_num_rows($resultQueryNewDevice714) != 0)
         {
            $rowNewDevice714 = mysql_fetch_assoc($resultQueryNewDevice714);
            $newDevice714 = $rowNewDevice714['newdevice'];
         }

// ----> Query Total Device 7 -14

        $queryTotalDevice714 = "SELECT TotalDevice as newdevice FROM KPIDevice WHERE Period = '7-14' and hotel_name = '$Hotel'";
         $resultQueryTotalDevice714 = mysql_query($queryTotalDevice714,$Link) or die(myssql_error($Link));

         if (mysql_num_rows($resultQueryTotalDevice714) != 0)
         {
            $rowTotalDevice714 = mysql_fetch_assoc($resultQueryTotalDevice714);
            $TotalDevice714 = $rowTotalDevice714['newdevice'];
         }

// ----> Margin New Device last 7 days Calculation

         $marginNewDeviceLast7Day = @((($newDeviceLast7Day / $TotalDeviceLast7Day) - ($newDevice714/$TotalDevice714)) * 100);

         if ($marginNewDeviceLast7Day == 0)
         {
            $statusMarginNewDeviceLast7Day = $marginNewDeviceLast7Day.'% Same as Last Week';
         }

         else if ($marginNewDeviceLast7Day > 0 )
         {
            $statusMarginNewDeviceLast7Day = '+'.$marginNewDeviceLast7Day.'% More Than Last Week';
         }
         else if ($marginNewDeviceLast7Day < 0)
         {
            $statusMarginNewDeviceLast7Day = $marginNewDeviceLast7Day.'% Less Than Last Week';
         }

// ---> Query New Device for 30 - 60

         $queryNewDevice3060 = "SELECT NewDevice as newdevice FROM KPIDevice WHERE Period = '30-60' and hotel_name = '$Hotel'";
         $resultQueryNewDevice3060 = mysql_query($queryNewDevice3060,$Link) or die(myssql_error($Link));

         if (mysql_num_rows($resultQueryNewDevice3060) != 0)
         {
            $rowNewDevice3060 = mysql_fetch_assoc($resultQueryNewDevice3060);
            $newDevice3060 = $rowNewDevice3060['newdevice'];
         }

// ----> Query Total Device 30 - 60

        $queryTotalDevice3060 = "SELECT TotalDevice as newdevice FROM KPIDevice WHERE Period = '30-60' and hotel_name = '$Hotel'";
         $resultQueryTotalDevice3060 = mysql_query($queryTotalDevice3060,$Link) or die(mysql_error($Link));

         if (mysql_num_rows($resultQueryTotalDevice3060) != 0)
         {
            $rowTotalDevice3060 = mysql_fetch_assoc($resultQueryTotalDevice3060);
            $TotalDevice3060 = $rowTotalDevice3060['newdevice'];
         }

// ----> Margin New Device for Last 30 Days

         $marginNewDeviceLast30Day = @((($newDeviceLast30Day/$TotalDeviceLast30Day) - ($newDevice3060/$totalDevice3060)) * 100);

        if($marginNewDeviceLast30Day == 0)
        {
            $statusMarginNewDeviceLast30Day = $marginNewDeviceLast30Day.'% same as last month';
        }

        else if ($marginNewDeviceLast30Day > 0)
        {
            $statusMarginNewDeviceLast30Day = '+'.$marginNewDeviceLast30Day.'% more than last month';
        }

        else if ($marginNewDeviceLast30Day < 0)
        {
            $statusMarginNewDeviceLast30Day = $marginNewDeviceLast30Day.'% less than last month';
        }

// //---->>>>>

// Query for Login Type Room Login Today
            $queryLoginType1Today = "SELECT `RoomLogin` FROM `KPIUserLoginType` where `Period` = 'Today' AND `hotel_name` = '$Hotel'";
            $resultQueryLoginType1Today = mysql_query($queryLoginType1Today,$Link) or die (mysql_error($Link));
            $rowLoginType1Today = mysql_fetch_assoc($resultQueryLoginType1Today);
            $countLoginTypeRoomLoginToday = $rowLoginType1Today['Count'];

// Query for Login Type Form Registration Today
            $queryLoginType2Today = "SELECT `Registration` FROM `KPIUserLoginType` where `Period` = 'Today' AND `hotel_name` = '$Hotel'";
            $resultQueryLoginType2Today = mysql_query($queryLoginType2Today,$Link) or die (mysql_error($Link));
            $rowLoginType2Today = mysql_fetch_assoc($resultQueryLoginType2Today);
            $countLoginTypeFormRegistrationToday = $rowLoginType2Today['Count'];

 // Query for Login Type Social Media Login Today
            $queryLoginType3Today = "SELECT `SocialMedia` FROM `KPIUserLoginType` where `Period` = 'Today' AND `hotel_name` = '$Hotel'";
            $resultQueryLoginType3Today = mysql_query($queryLoginType3Today,$Link) or die (mysql_error($Link));
            $rowLoginType3Today = mysql_fetch_assoc($resultQueryLoginType3Today);
            $countLoginTypeSocialMediaLoginToday = $rowLoginType3Today['Count'];


// Query for statistic last 7 days

            $queryStatisticUserLogin7days = "SELECT `Time`, sum(`NewUser`) as 'NewUser', sum(`Returning`) as Returning FROM KPIUserLogin where `Period` = 'Daily' and `id` <= 7 and `HotelName` = '$Hotel' group by `Time` order by `id` desc";
            $resultQueryStatisticUserLogin7Days = mysql_query($queryStatisticUserLogin7days,$Link) or die (mysql_error($Link));
                $rowStatisticUserLogin7days = array();
                while ($r = mysql_fetch_assoc($resultQueryStatisticUserLogin7Days))
                {
                    $rowStatisticUserLogin7days[] = $r;
                }

// Query for Statistic Today

             $queryStatisticUserLoginToday = "SELECT `Time`,sum(`NewUser`) as 'NewUser',sum(`Returning`) as 'Returning' FROM `KPIUserLogin` WHERE `Period` = 'Today' and `HotelName` = '$Hotel' group by `Time` order by id ASC";
            $resultQueryStatisticUserLoginToday = mysql_query($queryStatisticUserLoginToday,$Link) or die (mysql_error($Link));
                $rowStatisticUserLoginToday = array();
                while ($r = mysql_fetch_assoc($resultQueryStatisticUserLoginToday))
                {
                    $rowStatisticUserLoginToday[] = $r;
                }

// Query for Statistic Last 30 days

             $queryStatisticUserLogin30days ="SELECT `Time`, sum(`NewUser`) as 'NewUser', sum(`Returning`) as Returning FROM KPIUserLogin where `Period` = 'Daily' and `HotelName` = '$Hotel' group by `Time` order by `id` desc";
             $resultQueryStatisticUserLogin30Days = mysql_query($queryStatisticUserLogin30days,$Link) or die (mysql_error($Link));
             $rowStatisticUserLogin30Days = array();
             while($r = mysql_fetch_assoc($resultQueryStatisticUserLogin30Days))
             {
                $rowStatisticUserLogin30Days[] = $r;
             }

// Query Connected Devices

          $queryConnectedDevices = "SELECT date_format(TIMESTAMP, '%h:%i %p') as TIMESTAMP, ClientNumber as Area, ClientNumber FROM KPIClientNumber WHERE HotelName = '$Hotel' and Period = 'Last Hour' order by cast(TIMESTAMP as datetime) ASC";;
            $resultConnectedDevices = mysql_query($queryConnectedDevices,$Link) or die ($Link);
            $rowConnectedDevices = array();
            while ($r = mysql_fetch_assoc($resultConnectedDevices))
            {
              $rowConnectedDevices[] = $r;
            }



?>

<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta charset="utf-8">
    <title>WiWE 90 - Listener</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="icon" sizes="192x192" href="../img/Icon.png"/>
    <!-- Glazzed & Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../css/main.min.css">
    <!-- Pixeden Icon Fonts -->
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">

    <!-- Google Font -->
    <link rel="stylesheet" type="text/css" href="../css/font.css">



    <style>
        .progressbar {background: rgba(184, 184, 184, 0.59); background: -webkit-linear-gradient(top, rgba(56, 56, 56, 0.34) 0%, rgba(184, 184, 184, 0.59) 100%); background: linear-gradient(to bottom, rgba(56, 56, 56, 0.34) 0%, rgba(184, 184, 184, 0.59) 100%); border: 1px solid rgba(56, 56, 56, 0.1); border-radius: 0px; height: 3px;}
        .progress-bar-custom {background: rgba(17, 255, 0, 1); background: -webkit-linear-gradient(top, rgba(67, 153, 25, 0.66) 0%, rgba(17, 255, 0, 1) 100%); background: linear-gradient(to bottom, rgba(67, 153, 25, 0.66) 0%, rgba(17, 255, 0, 1) 100%);}

        .newProgress-bar-custom {background: rgba(255, 255, 255, 0.6); background: -webkit-linear-gradient(top, rgba(90, 112, 100, 0.66) 0%, rgba(17, 100, 0, 1) 100%); background: linear-gradient(to bottom, rgba(255, 0, 0, 0.66) 0%, rgba(255, 0, 0, 1) 100%);}
    </style>

</head>
<body>
<style>

#trafficVolume {
    width: 100%;
    height: 262px;
    }

#trafficVolume2 {
    width: 100%;
    height: 262px;
    }

#trafficVolume3 {
    width: 100%;
    height: 262px;
    }

table, th, td {
 border: 1px solid #1e2333;
  height :82px;
  padding-top: 12px;
  padding-left: 10px;
  padding-right: 10px;
  padding-bottom: 15px;
  margin-top: -35px;
  border-radius: 5px;
    font-family: 'Raleway', sans-serif;
  }

.table-number {

  font-family: 'Roboto', sans-serif;
}

#balabala {
  width: 100%;
  height: 210px;
  margin-left: auto;
  margin-right: auto;
  margin-top: 15px;
}

#balabala2 {
  width: 100%;
  height: 210px;
  margin-left: auto;
  margin-right: auto;
  margin-top: 15px;
}

#balabala3 {
  width: 100%;
  height: 210px;
  margin-left: auto;
  margin-right: auto;
  margin-top: 15px;
}

</style>

    <div id="loading">
        <div class="loader loader-light loader-large"></div>
    </div>
    <!-- Calling Top Bar & Side Bar -->
    <?php include "menu.php"; ?>
      <style type="text/css">
    body {color: #fff; }
    #chartdiv20 {
    width: 100%;
    height: 250px;
    }

     body {color: #fff; }
    #chartdiv21 {
    width: 100%;
    height: 250px;
    }

     body {color: #fff; }
    #chartdiv22 {
    width: 100%;
    height: 250px;
    }
    </style>

    <!-- Content -->

<section class="content">
            <header class="main-header">
                <div class="main-header__nav">
                    <h1 class="main-header__title">
                        <i class="pe-7s-signal"></i>
                        <span>Dashboard</span>
                    </h1>
                    <ul class="main-header__breadcrumb">
                        <li><a href="?page=90" onclick="return false;"></a></li>

                    </ul>
                </div>

                <div class="main-header__date">
                    <input type="radio" id="radio_date_1" name="tab-radio" value="Today" checked><!--
                    --><label class="fixed-width" for="radio_date_1">Today</label><!--
                    --><input type="radio" id="radio_date_2" name="tab-radio" value="7Days"><!--
                    --><label class="fixed-width" for="radio_date_2">7 Days</label><!--
                    --><input type="radio" id="radio_date_3" name="tab-radio" value="30Days"><!--
                    --><label class="fixed-width" for="radio_date_3">30 Days</label>

                </div>


            <div data-tab-radio="tab-radio" class="tab-radio-content row" id="Today">

              <!-- mulai dari sini -->
                          <br><br>
                              <div class ="row">
                                <div class="col-md-3">
                                   <article class="widget">
                                       <table width="100%" height="100%" >
                                         <thead>
                                           <tr>
                                             <th bgcolor="#6438ab" colspan="2">
                                               <div class ="row">
                                                 <div class ="col-md-8">
                                                  <font size ="2px"> internet uptime
                                                </div>
                                                <div class ="col-md-4">
                                                   <img src="../img/upportal.png" alt="Up" width="20px"> <sup>0.1%</sup></font>
                                                 </div>
                                                </div>
                                                <br>
                                               <div id="line1" style="vertical-align: middle; display: inline-block; width: 200px; height: 30px;"></div>
                                         </thead>
                                       <br>
                                       <tbody>
                                         <tr class="spacer"></tr>
                                         <tr>
                                 <td bgcolor="#ffffff" width="50%">
                                   <p style="color:#6438ab; font-size:13px;">uptime</p><br>
                                   <div style="text-align:right">
                                   <div class ="table-number"><p style="color:#6438ab; font-size:35px; font-weight:bold;">98.8</p></div>
                                    <p style="color:#6438ab; font-size:13px;">&nbsp &nbsp  &nbsp  &nbsp  &nbsp percent</p>
                                  </div>
                                 </td>
                                 <td bgcolor="#ffffff"  width="50%">
                                    <p style="color:#6438ab; font-size:13px;">response  &nbsp;</p><br>
                                     <div style="text-align:right">
                                     <div class ="table-number"><p style="color:#6438ab; font-size:35px; font-weight:bold;">14</p></div>
                                     <p style="color:#6438ab; font-size:15px;">ms</p>
                                   </div>
                                 </td>
                               </tr>
                                       </tbody>
                                     </table>

                                       </article>
                                       </div>


                                   <div class="col-md-3">
                                      <article class="widget">
                                      <table width="100%" height="100%">
                                        <thead>
                                          <tr>
                                            <th bgcolor="#aa3c78" colspan="2">
                                              <div class ="row">
                                                <div class ="col-md-8">
                                                 <font size ="2px"> coverage
                                               </div>
                                               <div class ="col-md-4">
                                                  <img src="../img/upportal.png" alt="Up" width="20px"> <sup>0%</sup></font>
                                                </div>
                                               </div>
                                               <br>
                                              <div id="line2" style="vertical-align: middle; display: inline-block; width: 200px; height: 30px;"></div>
                                        </thead>
                                          <br>
                                          <tbody>
                                            <tr class="spacer"></tr>
                                            <tr>
                                                    <td bgcolor="#ffffff"  width="50%">
                                      <p style="color:#aa3c78; font-size:13px;">access point</p><br>
                                         <div style="text-align:right">
                                       <div class ="table-number"><p style="color:#aa3c78; font-size:35px; font-weight:bold;">47</p></div>
                                       <p style="color:#aa3c78; font-size:15px;">units</p>
                                     </div>
                                                    </td>
                                                    <td bgcolor="#ffffff"  width="50%">
                                      <p style="color:#aa3c78; font-size:13px;">access point</p><br>
                                         <div style="text-align:right">
                                       <div class ="table-number"><p style="color:#aa3c78; font-size:35px; font-weight:bold;">0</p><div>
                                       <p style="color:#aa3c78; font-size:15px;">disconnected</p>
                                     </div>
                                    </td>
                                                </tr>
                                    </tbody>
                                    </table>
                                  </article>
                                  </div>


                                          <div class="col-md-3">
                                             <article class="widget">

                                                 <table width="100%" height="100%" >

                                                   <thead>
                                                     <tr>
                                                       <th bgcolor="#3e86b0" colspan="2">
                                                         <div class ="row">
                                                           <div class ="col-md-8">
                                                            <font size ="2px"> user
                                                          </div>
                                                          <div class ="col-md-4">
                                                             <img src="../img/upportal.png" alt="Up" width="20px"> <sup>3%</sup></font>
                                                           </div>
                                                          </div>
                                                          <br>
                                                         <div id="line3" style="vertical-align: middle; display: inline-block; width: 200px; height: 30px;"></div>
                                                   </thead>

                                                 <br>
                                                 <tbody>
                                                   <tr class="spacer"></tr>
                                                   <tr>
                                           <td bgcolor="#ffffff" width="50%">
                                             <p style="color:#3e86b0; font-size:13px;">new user &nbsp &nbsp</p><br>
                                              <div style="text-align:right">
                                              <div class ="table-number"><p style="color:#3e86b0; font-size:35px; font-weight:bold;">65</p></div>
                                              <p style="color:#3e86b0; font-size:15px;">&nbsp &nbsp users</p>
                                            </div>
                                           </td>
                                            <td bgcolor="#ffffff"  width="50%">
                                              <p style="color:#3e86b0; font-size:13px;">returning </p><br>
                                               <div style="text-align:right">
                                              <div class ="table-number"><p style="color:#3e86b0; font-size:35px; font-weight:bold;">45</p></div>
                                               <p style="color:#3e86b0; font-size:15px;"> &nbsp users</p>
                                             </div>
                                           </td>
                                         </tr>
                                                 </tbody>
                                               </table>

                                                 </article>
                                                 </div>


                                                 <div class="col-md-3">
                                                    <article class="widget">
                                                        <table width="100%" height="100%" >
                                                          <thead>
                                                            <tr>
                                                              <th bgcolor="#d5743b" colspan="2">
                                                                <div class ="row">
                                                                  <div class ="col-md-8">
                                                                   <font size ="2px"> device
                                                                 </div>
                                                                 <div class ="col-md-4">
                                                                    <img src="../img/upportal.png" alt="Up" width="20px"> <sup>3%</sup></font>
                                                                  </div>
                                                                 </div>
                                                                 <br>
                                                                <div id="line4" style="vertical-align: middle; display: inline-block; width: 200px; height: 30px;"></div>
                                                          </thead>
                                                        <br>
                                                        <tbody>
                                                          <tr class="spacer"></tr>
                                                          <tr>
                                                      <td bgcolor="#ffffff"  width="50%">
                                                    <p style="color:#d5743b; font-size:13px;">total device </p><br>
                                                     <div style="text-align:right">
                                                      <div class ="table-number"><p style="color:#d5743b; font-size:35px; font-weight:bold;">231</p></div>
                                                     <p style="color:#d5743b; font-size:15px;">devices</p>
                                                   </div>
                                                  </td>
                                                    <td bgcolor="#ffffff"  width="50%">
                                                      <p style="color:#d5743b; font-size:13px;">average/room</p><br>
                                                       <div style="text-align:right">
                                                      <div class ="table-number"><p style="color:#d5743b; font-size:35px; font-weight:bold;">2.1</p></div>
                                                       <p style="color:#d5743b; font-size:15px;">devices</p>
                                                     </div>
                                                  </td>
                                                </tr>
                                                        </tbody>
                                                      </table>

                                                        </article>
                                                      </div>
                                   </div>
                                 <!-- Bundar Bundar selsai di sini -->
                    <div class="row"> <!-- Statistic for today -->
                      <br>
                        <div class="col-md-6">
                         <header class="widget__header">
                                <div class="widget__title">
                                    <i class=""></i><h3>Traffic Volume (MB)</h3>
                                </div>
                                <div class="widget__config">
                                    <a href="#"><i class=""></i></a>
                                    <a href="#"><i class="pe-7s-graph3"></i></a>
                                </div>
                            </header>
                            <div class="widget__content filled">
                            <div id="trafficVolume"></div>
                            </div>
                          </div>

                            <div class="col-md-6">
                    							<header class="widget__header">
                    								<div class="widget__title">
                    									<i class=""></i><h3>Connected Devices</h3>
                    								</div>
                    								<div class="widget__config">
                    									<a href="#"><i class=""></i></a>
                    									<a href="#"><i class="pe-7s-graph3"></i></a>
                    								</div>
                    							</header>

                    							<div class="widget__content filled pad20">

                    								<div class="row">
                    									<div class="col-md-12 text-center btn__showcase2">
                                        <div id="balabala"></div>
                    									</div>

                    								</div>

                    							</div>

                    					</div>

                </div> <!-- end of Last 7 Days Statistics -->
                </div> <!-- end of Last 7 Days Data -->


                <div data-tab-radio="tab-radio" class="tab-radio-content row" id="7Days">
                  <!-- mulai dari sini 7day -->
                 <br><br>
                     <div class ="row">
                       <div class="col-md-3">
                          <article class="widget">
                              <table width="100%" height="100%" >
                                <thead>
                                  <tr>
                                    <th bgcolor="#6438ab" colspan="2">
                                      <div class ="row">
                                        <div class ="col-md-8">
                                         <font size ="2px"> internet uptime
                                       </div>
                                       <div class ="col-md-4">
                                          <img src="../img/upportal.png" alt="Up" width="20px"> <sup>0.1%</sup></font>
                                        </div>
                                       </div>
                                       <br>
                                      <div id="line5" style="vertical-align: middle; display: inline-block; width: 200px; height: 30px;"></div>
                                </thead>
                              <br>
                              <tbody>
                                <tr class="spacer"></tr>
                                <tr>
                        <td bgcolor="#ffffff" width="50%">
                          <p style="color:#6438ab; font-size:13px;">uptime</p><br>
                          <div style="text-align:right">
                          <div class ="table-number"><p style="color:#6438ab; font-size:35px; font-weight:bold;">98.8</p></div>
                           <p style="color:#6438ab; font-size:13px;">&nbsp &nbsp  &nbsp  &nbsp  &nbsp percent</p>
                         </div>
                        </td>
                        <td bgcolor="#ffffff"  width="50%">
                           <p style="color:#6438ab; font-size:13px;">response  &nbsp;</p><br>
                            <div style="text-align:right">
                            <div class ="table-number"><p style="color:#6438ab; font-size:35px; font-weight:bold;">14</p></div>
                            <p style="color:#6438ab; font-size:15px;">ms</p>
                          </div>
                        </td>
                      </tr>
                              </tbody>
                            </table>

                              </article>
                              </div>


                          <div class="col-md-3">
                             <article class="widget">
                             <table width="100%" height="100%">
                               <thead>
                                 <tr>
                                   <th bgcolor="#aa3c78" colspan="2">
                                     <div class ="row">
                                       <div class ="col-md-8">
                                        <font size ="2px"> coverage
                                      </div>
                                      <div class ="col-md-4">
                                         <img src="../img/upportal.png" alt="Up" width="20px"><sup> 3%</sup></font>
                                       </div>
                                      </div>
                                      <br>
                                     <div id="line6" style="vertical-align: middle; display: inline-block; width: 200px; height: 30px;"></div>
                               </thead>
                                 <br>
                                 <tbody>
                                   <tr class="spacer"></tr>
                                   <tr>
                                           <td bgcolor="#ffffff"  width="50%">
                             <p style="color:#aa3c78; font-size:13px;">access point</p><br>
                                <div style="text-align:right">
                              <div class ="table-number"><p style="color:#aa3c78; font-size:35px; font-weight:bold;">47</p></div>
                              <p style="color:#aa3c78; font-size:15px;">units</p>
                            </div>
                                           </td>
                                           <td bgcolor="#ffffff"  width="50%">
                             <p style="color:#aa3c78; font-size:13px;">access point</p><br>
                                <div style="text-align:right">
                              <div class ="table-number"><p style="color:#aa3c78; font-size:35px; font-weight:bold;">0</p><div>
                              <p style="color:#aa3c78; font-size:15px;">disconnected</p>
                            </div>
                           </td>
                                       </tr>
                           </tbody>
                           </table>
                         </article>
                         </div>


                                 <div class="col-md-3">
                                    <article class="widget">

                                        <table width="100%" height="100%" >

                                          <thead>
                                            <tr>
                                              <th bgcolor="#3e86b0" colspan="2">
                                                <div class ="row">
                                                  <div class ="col-md-8">
                                                   <font size ="2px"> user
                                                 </div>
                                                 <div class ="col-md-4">
                                                    <img src="../img/upportal.png" alt="Up" width="20px"><sup> 3%</sup></font>
                                                  </div>
                                                 </div>
                                                 <br>
                                                <div id="line7" style="vertical-align: middle; display: inline-block; width: 200px; height: 30px;"></div>
                                          </thead>
                                        <br>
                                        <tbody>
                                          <tr class="spacer"></tr>
                                          <tr>
                                  <td bgcolor="#ffffff" width="50%">
                                    <p style="color:#3e86b0; font-size:13px;">new user &nbsp &nbsp</p><br>
                                     <div style="text-align:right">
                                     <div class ="table-number"><p style="color:#3e86b0; font-size:35px; font-weight:bold;">65</p></div>
                                     <p style="color:#3e86b0; font-size:15px;">&nbsp &nbsp users</p>
                                   </div>
                                  </td>
                                   <td bgcolor="#ffffff"  width="50%">
                                     <p style="color:#3e86b0; font-size:13px;">returning </p><br>
                                      <div style="text-align:right">
                                     <div class ="table-number"><p style="color:#3e86b0; font-size:35px; font-weight:bold;">45</p></div>
                                      <p style="color:#3e86b0; font-size:15px;"> &nbsp users</p>
                                    </div>
                                  </td>
                                </tr>
                                        </tbody>
                                      </table>

                                        </article>
                                        </div>


                                        <div class="col-md-3">
                                           <article class="widget">
                                               <table width="100%" height="100%" >


                                                 <thead>
                                                   <tr>
                                                     <th bgcolor="#d5743b" colspan="2">
                                                       <div class ="row">
                                                         <div class ="col-md-8">
                                                          <font size ="2px"> device
                                                        </div>
                                                        <div class ="col-md-4">
                                                           <img src="../img/upportal.png" alt="Up" width="20px"><sup> 3%</sup></font>
                                                         </div>
                                                        </div>
                                                        <br>
                                                       <div id="line8" style="vertical-align: middle; display: inline-block; width: 200px; height: 30px;"></div>
                                                 </thead>

                                               <br>
                                               <tbody>
                                                 <tr class="spacer"></tr>
                                                 <tr>
                                             <td bgcolor="#ffffff"  width="50%">
                                           <p style="color:#d5743b; font-size:13px;">Total Device </p><br>
                                            <div style="text-align:right">
                                             <div class ="table-number"><p style="color:#d5743b; font-size:35px; font-weight:bold;">231</p></div>
                                            <p style="color:#d5743b; font-size:15px;">devices</p>
                                          </div>
                                         </td>
                                           <td bgcolor="#ffffff"  width="50%">
                                             <p style="color:#d5743b; font-size:13px;">average/room</p><br>
                                              <div style="text-align:right">
                                             <div class ="table-number"><p style="color:#d5743b; font-size:35px; font-weight:bold;">2.1</p></div>
                                              <p style="color:#d5743b; font-size:15px;">devices</p>
                                            </div>
                                         </td>
                                       </tr>
                                               </tbody>
                                             </table>

                                               </article>
                                             </div>
                          </div>
                        <!-- Bundar Bundar selsai di sini -->


                    <div class="row"> <!-- Statistic for Last 7 Days -->
                        <div class="col-md-6">
                            <header class="widget__header">
                                <div class="widget__title">
                                    <i class=""></i><h3>Tracffic Volume (MB)</h3>
                                </div>
                                <div class="widget__config">
                                    <a href="#"><i class=""></i></a>
                                    <a href="#"><i class="pe-7f-graph3"></i></a>
                                </div>
                            </header>

                            <div class="widget__content filled">
                            <div id="trafficVolume2"></div>
                            </div>
                    </div>
			<!-- Pie Chart for Last 7 Days -->
      <div class="col-md-6">
            <header class="widget__header">
              <div class="widget__title">
                <i class=""></i><h3>Connected Devices</h3>
              </div>
              <div class="widget__config">
                <a href="#"><i class=""></i></a>
                <a href="#"><i class="pe-7s-graph3"></i></a>
              </div>
            </header>

            <div class="widget__content filled pad20">

              <div class="row">
                <div class="col-md-12 text-center btn__showcase2">
                  <div id="balabala2"></div>
                </div>

              </div>

            </div>

        </div>

</div> <!-- end of Last 7 Days Statistics -->
</div> <!-- end of Last 7 Days Data -->



                <div data-tab-radio="tab-radio" class="tab-radio-content row" id="30Days">

                  <!-- mulai dari sini 30 day -->
                    <br><br>
                        <div class ="row">
                          <div class="col-md-3">
                             <article class="widget">
                                 <table width="100%" height="100%" >
                                   <thead>
                                     <tr>
                                       <th bgcolor="#6438ab" colspan="2">
                                         <div class ="row">
                                           <div class ="col-md-8">
                                            <font size ="2px"> internet uptime
                                          </div>
                                          <div class ="col-md-4">
                                             <img src="../img/upportal.png" alt="Up" width="20px"><sup> 0.1% </sup></font>
                                           </div>
                                          </div>
                                          <br>
                                         <div id="line9" style="vertical-align: middle; display: inline-block; width: 200px; height: 30px;"></div>
                                   </thead>
                                 <br>
                                 <tbody>
                                   <tr class="spacer"></tr>
                                   <tr>
                           <td bgcolor="#ffffff" width="50%">
                             <p style="color:#6438ab; font-size:13px;">uptime</p><br>
                             <div style="text-align:right">
                             <div class ="table-number"><p style="color:#6438ab; font-size:35px; font-weight:bold;">98.8</p></div>
                              <p style="color:#6438ab; font-size:13px;">&nbsp &nbsp  &nbsp  &nbsp  &nbsp percent</p>
                            </div>
                           </td>
                           <td bgcolor="#ffffff"  width="50%">
                              <p style="color:#6438ab; font-size:13px;">response  &nbsp;</p><br>
                               <div style="text-align:right">
                               <div class ="table-number"><p style="color:#6438ab; font-size:35px; font-weight:bold;">14</p></div>
                               <p style="color:#6438ab; font-size:15px;">ms</p>
                             </div>
                           </td>
                         </tr>
                                 </tbody>
                               </table>

                                 </article>
                                 </div>


                             <div class="col-md-3">
                                <article class="widget">
                                <table width="100%" height="100%">
                                  <thead>
                                    <tr>
                                      <th bgcolor="#aa3c78" colspan="2">
                                        <div class ="row">
                                          <div class ="col-md-8">
                                           <font size ="2px"> coverage
                                         </div>
                                         <div class ="col-md-4">
                                            <img src="../img/upportal.png" alt="Up" width="20px"><sup> 0% </sup></font>
                                          </div>
                                         </div>
                                         <br>
                                        <div id="line10" style="vertical-align: middle; display: inline-block; width: 200px; height: 30px;"></div>
                                  </thead>
                                    <br>
                                    <tbody>
                                      <tr class="spacer"></tr>
                                      <tr>
                                              <td bgcolor="#ffffff"  width="50%">
                                <p style="color:#aa3c78; font-size:13px;">access point</p><br>
                                   <div style="text-align:right">
                                 <div class ="table-number"><p style="color:#aa3c78; font-size:35px; font-weight:bold;">47</p></div>
                                 <p style="color:#aa3c78; font-size:15px;">units</p>
                               </div>
                                              </td>
                                              <td bgcolor="#ffffff"  width="50%">
                                <p style="color:#aa3c78; font-size:13px;">access point</p><br>
                                   <div style="text-align:right">
                                 <div class ="table-number"><p style="color:#aa3c78; font-size:35px; font-weight:bold;">0</p><div>
                                 <p style="color:#aa3c78; font-size:15px;">disconnected</p>
                               </div>
                              </td>
                                          </tr>
                              </tbody>
                              </table>
                            </article>
                            </div>


                                    <div class="col-md-3">
                                       <article class="widget">

                                           <table width="100%" height="100%" >

                                             <thead>
                                               <tr>
                                                 <th bgcolor="#3e86b0" colspan="2">
                                                   <div class ="row">
                                                     <div class ="col-md-8">
                                                      <font size ="2px"> user
                                                    </div>
                                                    <div class ="col-md-4">
                                                       <img src="../img/upportal.png" alt="Up" width="20px"><sup> 3% </sup></font>
                                                     </div>
                                                    </div>
                                                    <br>
                                                   <div id="line11" style="vertical-align: middle; display: inline-block; width: 200px; height: 30px;"></div>
                                             </thead>
                                           <br>
                                           <tbody>
                                             <tr class="spacer"></tr>
                                             <tr>
                                               <td bgcolor="#ffffff"  width="50%">
                                 <p style="color:#3e86b0; font-size:13px;">new user</p><br>
                                    <div style="text-align:right">
                                  <div class ="table-number"><p style="color:#3e86b0; font-size:35px; font-weight:bold;">65</p><div>
                                  <p style="color:#3e86b0; font-size:15px;">users</p>
                                </div>
                               </td>
                                      <td bgcolor="#ffffff"  width="50%">
                                        <p style="color:#3e86b0; font-size:13px;">returning </p><br>
                                         <div style="text-align:right">
                                        <div class ="table-number"><p style="color:#3e86b0; font-size:35px; font-weight:bold;">45</p></div>
                                         <p style="color:#3e86b0; font-size:15px;"> &nbsp users</p>
                                       </div>
                                     </td>
                                   </tr>
                                           </tbody>
                                         </table>

                                           </article>
                                           </div>


                                           <div class="col-md-3">
                                              <article class="widget">
                                                  <table width="100%" height="100%" >
                                                    <thead>
                                                      <tr>
                                                        <th bgcolor="#d5743b" colspan="2">
                                                          <div class ="row">
                                                            <div class ="col-md-8">
                                                             <font size ="2px"> device
                                                           </div>
                                                           <div class ="col-md-4">
                                                              <img src="../img/upportal.png" alt="Up" width="20px"><sup> 3% </sup></font>
                                                            </div>
                                                           </div>
                                                           <br>
                                                          <div id="line12" style="vertical-align: middle; display: inline-block; width: 200px; height: 30px;"></div>
                                                    </thead>
                                                  <br>
                                                  <tbody>
                                                    <tr class="spacer"></tr>
                                                    <tr>
                                                <td bgcolor="#ffffff"  width="50%">
                                              <p style="color:#d5743b; font-size:13px;">Total Device </p><br>
                                               <div style="text-align:right">
                                                <div class ="table-number"><p style="color:#d5743b; font-size:35px; font-weight:bold;">231</p></div>
                                               <p style="color:#d5743b; font-size:15px;">devices</p>
                                             </div>
                                            </td>
                                              <td bgcolor="#ffffff"  width="50%">
                                                <p style="color:#d5743b; font-size:13px;">average/room</p><br>
                                                 <div style="text-align:right">
                                                <div class ="table-number"><p style="color:#d5743b; font-size:35px; font-weight:bold;">2.1</p></div>
                                                 <p style="color:#d5743b; font-size:15px;">devices</p>
                                               </div>
                                            </td>
                                          </tr>
                                                  </tbody>
                                                </table>

                                                  </article>
                                                </div>
                             </div>
                           <!-- Bundar Bundar selsai di sini -->

                    <div class ="row">
                        <div class ="col-md-6">
                            <header class="widget__header">
                                <div class="widget__title">
                                    <i class=""></i><h3>Traffic Volume (MB)</h3>
                                </div>
                                <div class="widget__config">
                                    <a href="#"><i class=""></i></a>
                                    <a href="#"><i class="pe-7f-graph3"></i></a>
                                </div>

                            </header>

                             <div class="widget__content filled">
                            <div id="trafficVolume3"></div>
                            </div>
                        </div>

                    <!-- Pie Chart for Last 30 Days -->
                    <div class="col-md-6">
                                <header class="widget__header">
                                  <div class="widget__title">
                                    <i class=""></i><h3>Connected Devices</h3>
                                  </div>
                                  <div class="widget__config">
                                    <a href="#"><i class=""></i></a>
                                    <a href="#"><i class="pe-7s-graph3"></i></a>
                                  </div>
                                </header>

                                <div class="widget__content filled pad20">

                                  <div class="row">
                                    <div class="col-md-12 text-center btn__showcase2">
                                      <div id="balabala3"></div>
                                    </div>

                                  </div>

                                </div>

                            </div>

                    </div>

                </div>
             </header> <!-- /main-header -->
            <footer class="footer-brand">
                    <?php include "footer.php"; ?>
            </footer>

        </section> <!-- /content -->

    <script src="http://d3js.org/d3.v3.min.js" language="JavaScript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->
    <script type="text/javascript" src="../js/amcharts/newAmcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/pie.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>

    <script type="text/javascript" src="../js/pieChart3.js"></script>
    <script type="text/javascript" src="../js/pieChart2.js"></script>
    <script type="text/javascript" src="../js/pieChart1.js"></script>
    <script type="text/javascript" src="../js/linechart.js"></script>
    <script type="text/javascript" src="../js/linechart2.js"></script>
    <script type="text/javascript" src="../js/linechart3.js"></script>

    <script type="text/javascript" src="../js/amcharts/newSerial.js"></script>

    <script>

    var chartData =  <?php print json_encode($rowConnectedDevices);  ?>;

      var chart = AmCharts.makeChart("balabala", {
      "type": "serial",
      "theme": "none",
      "marginRight": 80,
      "dataProvider": chartData,
      "valueAxes": [{
          "position": "left",
          "title": ""
      }],
      "graphs": [{
          "id": "g1",
          "fillAlphas": 0.4,
          "valueField": "Area",
           "balloonText": "<div style='margin:5px; font-size:19px;'>Devices:<b>[[value]]</b></div>"
      }],
      "chartCursor": {
          "categoryBalloonDateFormat": "JJ:NN, DD MMMM",
          "cursorPosition": "mouse"
      },
      "categoryField": "TIMESTAMP",
      "categoryAxis": {
          "gridAlpha": 0.01,
          "axisColor": "#DADADA",
          "tickLength": 0
      }
      });


      var chart = AmCharts.makeChart("balabala2", {
      "type": "serial",
      "theme": "none",
      "marginRight": 80,
      "dataProvider": chartData,
      "valueAxes": [{
          "position": "left",
          "title": ""
      }],
      "graphs": [{
          "id": "g1",
          "fillAlphas": 0.4,
          "valueField": "Area",
           "balloonText": "<div style='margin:5px; font-size:19px;'>Devices:<b>[[value]]</b></div>"
      }],
      "chartCursor": {
          "categoryBalloonDateFormat": "JJ:NN, DD MMMM",
          "cursorPosition": "mouse"
      },
      "categoryField": "TIMESTAMP",
      "categoryAxis": {
          "gridAlpha": 0.01,
          "axisColor": "#DADADA",
          "tickLength": 0
      }
      });

      var chart = AmCharts.makeChart("balabala3", {
      "type": "serial",
      "theme": "none",
      "marginRight": 80,
      "dataProvider": chartData,
      "valueAxes": [{
          "position": "left",
          "title": ""
      }],
      "graphs": [{
          "id": "g1",
          "fillAlphas": 0.4,
          "valueField": "Area",
           "balloonText": "<div style='margin:5px; font-size:19px;'>Devices:<b>[[value]]</b></div>"
      }],
      "chartCursor": {
          "categoryBalloonDateFormat": "JJ:NN, DD MMMM",
          "cursorPosition": "mouse"
      },
      "categoryField": "TIMESTAMP",
      "categoryAxis": {
          "gridAlpha": 0.01,
          "axisColor": "#DADADA",
          "tickLength": 0
      }
      });


      chart.addListener("dataUpdated", zoomChart);
      // when we apply theme, the dataUpdated event is fired even before we add listener, so
      // we need to call zoomChart here
      zoomChart();
      // this method is called when chart is first inited as we listen for "dataUpdated" event
      function zoomChart() {
      // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
      chart.zoomToIndexes(chartData.length - 250, chartData.length - 100);
      }

      // generate some random data, quite different range
      function generateChartData() {
      var chartData = [];
      // current date
      var firstDate = new Date();
      // now set 500 minutes back
      firstDate.setMinutes(firstDate.getDate() - 1000);

      // and generate 500 data items
      for (var i = 0; i < 500; i++) {
          var newDate = new Date(firstDate);
          // each time we add one minute
          newDate.setMinutes(newDate.getMinutes() + i);
          // some random number
          var visits = Math.round(Math.random() * 40 + 10 + i + Math.random() * i / 5);
          // add data item to the array
          chartData.push({
              date: newDate,
              visits: visits
          });
      }
      return chartData;
      }

    </script>

    <script type="text/javascript">
    var chart = AmCharts.makeChart("chartdiv20", {
    "type": "serial",
    "theme": "light",
    "legend": {
        "horizontalGap": 0,
        "maxColumns": 1,
        "position": "right",
        "useGraphSettings": true,
        "markerSize": 10
    },
    "dataProvider":[{"Time":"12 AM","NewUser":"0","Returning":"3"},{"Time":"01 AM","NewUser":"0","Returning":"2"},{"Time":"02 AM","NewUser":"0","Returning":"0"},
    {"Time":"03 AM","NewUser":"0","Returning":"0"},{"Time":"04 AM","NewUser":"0","Returning":"0"},{"Time":"05 AM","NewUser":"0","Returning":"0"},
    {"Time":"06 AM","NewUser":"0","Returning":"3"},{"Time":"07 AM","NewUser":"0","Returning":"5"},{"Time":"08 AM","NewUser":"0","Returning":"4"},
    {"Time":"09 AM","NewUser":"2","Returning":"5"},{"Time":"10 AM","NewUser":"3","Returning":"4"},{"Time":"11 AM","NewUser":"4","Returning":"5"},
    {"Time":"12 PM","NewUser":"12","Returning":"7"},{"Time":"01 PM","NewUser":"10","Returning":"8"}]
    ,
    "valueAxes": [{
        "stackType": "regular",
        "axisAlpha": 0.3,
        "gridAlpha": 0
    }],
    "graphs": [{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "New User",
        "type": "column",
                "color": "transparent",
        "valueField": "NewUser"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Returning",
        "type": "column",
                "color": "transparent",
        "valueField": "Returning"
    }],
    "categoryField": "Time",
    "categoryAxis": {
        "gridPosition": "start",
        "labelRotation" :90,
        "minHorizontalGap":10,
        "axisAlpha": 0.3,
        "gridAlpha": 0,
        "position": "left"
    },
    "export": {
        "enabled": false
     }

    });

    var chart = AmCharts.makeChart("chartdiv21", {
    "type": "serial",
    "theme": "light",
    "legend": {
        "horizontalGap": 0,
        "maxColumns": 1,
        "position": "right",
        "useGraphSettings": true,
        "markerSize": 10
    },
    "dataProvider": [{"Time":"19 Apr","NewUser":"17","Returning":"20"},{"Time":"20 Apr","NewUser":"10","Returning":"15"},{"Time":"21 Apr","NewUser":"25","Returning":"16"},
    {"Time":"22 Apr","NewUser":"16","Returning":"23"},{"Time":"23 Apr","NewUser":"12","Returning":"18"},{"Time":"24 Apr","NewUser":"20","Returning":"29"},
    {"Time":"25 Apr","NewUser":"32","Returning":"46"}]
    ,
    "valueAxes": [{
        "stackType": "regular",
        "axisAlpha": 0.3,
        "gridAlpha": 0
    }],
    "graphs": [{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "New User",
        "type": "column",
                "color": "transparent",
        "valueField": "NewUser"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Returning",
        "type": "column",
                "color": "transparent",
        "valueField": "Returning"
    }],
    "categoryField": "Time",
    "categoryAxis": {
        "gridPosition": "start",
        "labelRotation" :90,
        "minHorizontalGap":10,
        "axisAlpha": 0.3,
        "gridAlpha": 0,
        "position": "left"
    },
    "export": {
        "enabled": false
     }

    });


    var chart = AmCharts.makeChart("chartdiv22", {
    "type": "serial",
    "theme": "dark",
    "legend": {
        "horizontalGap": 10,
        "maxColumns": 1,
        "position": "bottom",
        "useGraphSettings": true,
        "maxColumns" : 2,
        "markerSize": 10
    },
    "dataProvider": [{"Time":"27 Mar","NewUser":"17","Returning":"8"},{"Time":"28 Mar","NewUser":"18","Returning":"15"},{"Time":"29 Mar","NewUser":"15","Returning":"13"},
    {"Time":"30 Mar","NewUser":"16","Returning":"8"},{"Time":"31 Mar","NewUser":"12","Returning":"11"},{"Time":"01 Apr","NewUser":"15","Returning":"15"},
    {"Time":"02 Apr","NewUser":"32","Returning":"10"},{"Time":"03 Apr","NewUser":"17","Returning":"15"},{"Time":"04 Apr","NewUser":"10","Returning":"15"},
    {"Time":"05 Apr","NewUser":"18","Returning":"8"},{"Time":"06 Apr","NewUser":"16","Returning":"12"},{"Time":"07 Apr","NewUser":"12","Returning":"13"},
    {"Time":"09 Apr","NewUser":"19","Returning":"17"},{"Time":"10 Apr","NewUser":"32","Returning":"16"},{"Time":"11 Apr","NewUser":"17","Returning":"18"},
    {"Time":"12 Apr","NewUser":"10","Returning":"15"},{"Time":"13 Apr","NewUser":"15","Returning":"16"},{"Time":"14 Apr","NewUser":"19","Returning":"17"},
    {"Time":"15 Apr","NewUser":"12","Returning":"18"},{"Time":"16 Apr","NewUser":"20","Returning":"9"},{"Time":"17 Apr","NewUser":"20","Returning":"17"},
    {"Time":"18 Apr","NewUser":"17","Returning":"10"},{"Time":"19 Apr","NewUser":"17","Returning":"20"},{"Time":"20 Apr","NewUser":"10","Returning":"15"},
    {"Time":"21 Apr","NewUser":"15","Returning":"16"},{"Time":"22 Apr","NewUser":"16","Returning":"23"},{"Time":"23 Apr","NewUser":"12","Returning":"18"},
    {"Time":"24 Apr","NewUser":"20","Returning":"29"},{"Time":"25 Apr","NewUser":"32","Returning":"46"}]
    ,
    "valueAxes": [{
        "stackType": "regular",
        "axisAlpha": 0.3,
        "gridAlpha": 0
    }],
    "graphs": [{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "New User",
        "type": "column",
                "color": "transparent",
        "valueField": "NewUser"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Returning",
        "type": "column",
                "color": "transparent",
        "valueField": "Returning"
    }],
    "categoryField": "Time",
    "categoryAxis": {
        "gridPosition": "start",
        "labelRotation" :90,
        "minHorizontalGap":10,
        "axisAlpha": 0.3,
        "gridAlpha": 0,
        "position": "left"
    },
    "export": {
        "enabled": false
     }

    });


    </script>


    <!-- untuk data box -->
    <script>

    /**
     * Line Chart untuk data today
     */

    /**
     * Line Chart #1
     */
    AmCharts.makeChart( "line1", {
      "type": "serial",
    "theme": "light",

      "dataProvider": [ {
        "day": 1,
        "value": 120
      }, {
        "day": 2,
        "value": 124
      }, {
        "day": 3,
        "value": 127
      }, {
        "day": 4,
        "value": 122
      }, {
        "day": 5,
        "value": 121
      }, {
        "day": 6,
        "value": 123
      }, {
        "day": 7,
        "value": 118
      }, {
        "day": 8,
        "value": 113
      }, {
        "day": 9,
        "value": 122
      }, {
        "day": 10,
        "value": 125,
        "bullet": "round"
      } ],
      "categoryField": "day",
      "autoMargins": false,
      "marginLeft": 0,
      "marginRight": 5,
      "marginTop": 0,
      "marginBottom": 0,
      "graphs": [ {
        "valueField": "value",
        "bulletField": "bullet",
        "showBalloon": false,
        "lineColor": "#ffffff"
      } ],
      "valueAxes": [ {
        "gridAlpha": 0,
        "axisAlpha": 0
      } ],
      "categoryAxis": {
        "gridAlpha": 0,
        "axisAlpha": 0,
        "startOnAxis": true
      }
    } );


    /**
     * Line Chart #2
     */
    AmCharts.makeChart( "line2", {
      "type": "serial",
    "theme": "light",

      "dataProvider": [ {
        "day": 1,
        "value": 47
      }, {
        "day": 2,
        "value": 47
      }, {
        "day": 3,
        "value": 43
      }, {
        "day": 4,
        "value": 43
      }, {
        "day": 5,
        "value": 47
      }, {
        "day": 6,
        "value": 47
      }, {
        "day": 7,
        "value": 47
      }, {
        "day": 8,
        "value": 47
      }, {
        "day": 9,
        "value": 47
      }, {
        "day": 10,
        "value": 47,
        "bullet": "round"
      } ],
      "categoryField": "day",
      "autoMargins": false,
      "marginLeft": 0,
      "marginRight": 5,
      "marginTop": 0,
      "marginBottom": 0,
      "graphs": [ {
        "valueField": "value",
        "bulletField": "bullet",
        "showBalloon": false,
        "lineColor": "#ffffff"
      } ],
      "valueAxes": [ {
        "gridAlpha": 0,
        "axisAlpha": 0
      } ],
      "categoryAxis": {
        "gridAlpha": 0,
        "axisAlpha": 0,
        "startOnAxis": true
      }
    } );

    /**
     * Line Chart #3
     */
    AmCharts.makeChart( "line3", {
      "type": "serial",
    "theme": "light",

      "dataProvider": [ {
        "day": 1,
        "value": 45
      }, {
        "day": 2,
        "value": 47
      }, {
        "day": 3,
        "value": 49
      }, {
        "day": 4,
        "value": 49
      }, {
        "day": 5,
        "value": 52
      }, {
        "day": 6,
        "value": 55
      }, {
        "day": 7,
        "value": 55
      }, {
        "day": 8,
        "value": 59
      }, {
        "day": 9,
        "value": 65
      }, {
        "day": 10,
        "value": 65,
        "bullet": "round"
      } ],
      "categoryField": "day",
      "autoMargins": false,
      "marginLeft": 0,
      "marginRight": 5,
      "marginTop": 0,
      "marginBottom": 0,
      "graphs": [ {
        "valueField": "value",
        "bulletField": "bullet",
        "showBalloon": false,
        "lineColor": "#ffffff"
      } ],
      "valueAxes": [ {
        "gridAlpha": 0,
        "axisAlpha": 0
      } ],
      "categoryAxis": {
        "gridAlpha": 0,
        "axisAlpha": 0,
        "startOnAxis": true
      }
    } );

    /**
     * Line Chart #3
     */
    AmCharts.makeChart( "line3", {
      "type": "serial",
    "theme": "light",

      "dataProvider": [ {
        "day": 1,
        "value": 45
      }, {
        "day": 2,
        "value": 47
      }, {
        "day": 3,
        "value": 49
      }, {
        "day": 4,
        "value": 49
      }, {
        "day": 5,
        "value": 52
      }, {
        "day": 6,
        "value": 55
      }, {
        "day": 7,
        "value": 55
      }, {
        "day": 8,
        "value": 59
      }, {
        "day": 9,
        "value": 65
      }, {
        "day": 10,
        "value": 65,
        "bullet": "round"
      } ],
      "categoryField": "day",
      "autoMargins": false,
      "marginLeft": 0,
      "marginRight": 5,
      "marginTop": 0,
      "marginBottom": 0,
      "graphs": [ {
        "valueField": "value",
        "bulletField": "bullet",
        "showBalloon": false,
        "lineColor": "#ffffff"
      } ],
      "valueAxes": [ {
        "gridAlpha": 0,
        "axisAlpha": 0
      } ],
      "categoryAxis": {
        "gridAlpha": 0,
        "axisAlpha": 0,
        "startOnAxis": true
      }
    } );

    /**
     * Line Chart #4
     */
    AmCharts.makeChart( "line4", {
      "type": "serial",
    "theme": "light",

      "dataProvider": [ {
        "day": 1,
        "value": 100
      }, {
        "day": 2,
        "value": 140
      }, {
        "day": 3,
        "value": 140
      }, {
        "day": 4,
        "value": 150
      }, {
        "day": 5,
        "value": 180
      }, {
        "day": 6,
        "value": 188
      }, {
        "day": 7,
        "value": 200
      }, {
        "day": 8,
        "value": 231
      }, {
        "day": 9,
        "value": 231
      }, {
        "day": 10,
        "value": 231,
        "bullet": "round"
      } ],
      "categoryField": "day",
      "autoMargins": false,
      "marginLeft": 0,
      "marginRight": 5,
      "marginTop": 0,
      "marginBottom": 0,
      "graphs": [ {
        "valueField": "value",
        "bulletField": "bullet",
        "showBalloon": false,
        "lineColor": "#ffffff"
      } ],
      "valueAxes": [ {
        "gridAlpha": 0,
        "axisAlpha": 0
      } ],
      "categoryAxis": {
        "gridAlpha": 0,
        "axisAlpha": 0,
        "startOnAxis": true
      }
    } );


    /**
     * Line Chart untuk data 7day
     */

    /**
     * Line Chart #5
     */
    AmCharts.makeChart( "line5", {
      "type": "serial",
    "theme": "light",

      "dataProvider": [ {
        "day": 1,
        "value": 120
      }, {
        "day": 2,
        "value": 124
      }, {
        "day": 3,
        "value": 127
      }, {
        "day": 4,
        "value": 122
      }, {
        "day": 5,
        "value": 121
      }, {
        "day": 6,
        "value": 123
      }, {
        "day": 7,
        "value": 118
      }, {
        "day": 8,
        "value": 113
      }, {
        "day": 9,
        "value": 122
      }, {
        "day": 10,
        "value": 125,
        "bullet": "round"
      } ],
      "categoryField": "day",
      "autoMargins": false,
      "marginLeft": 0,
      "marginRight": 5,
      "marginTop": 0,
      "marginBottom": 0,
      "graphs": [ {
        "valueField": "value",
        "bulletField": "bullet",
        "showBalloon": false,
        "lineColor": "#ffffff"
      } ],
      "valueAxes": [ {
        "gridAlpha": 0,
        "axisAlpha": 0
      } ],
      "categoryAxis": {
        "gridAlpha": 0,
        "axisAlpha": 0,
        "startOnAxis": true
      }
    } );


    /**
     * Line Chart #6
     */
    AmCharts.makeChart( "line6", {
      "type": "serial",
    "theme": "light",

      "dataProvider": [ {
        "day": 1,
        "value": 47
      }, {
        "day": 2,
        "value": 47
      }, {
        "day": 3,
        "value": 43
      }, {
        "day": 4,
        "value": 43
      }, {
        "day": 5,
        "value": 47
      }, {
        "day": 6,
        "value": 47
      }, {
        "day": 7,
        "value": 47
      }, {
        "day": 8,
        "value": 47
      }, {
        "day": 9,
        "value": 47
      }, {
        "day": 10,
        "value": 47,
        "bullet": "round"
      } ],
      "categoryField": "day",
      "autoMargins": false,
      "marginLeft": 0,
      "marginRight": 5,
      "marginTop": 0,
      "marginBottom": 0,
      "graphs": [ {
        "valueField": "value",
        "bulletField": "bullet",
        "showBalloon": false,
        "lineColor": "#ffffff"
      } ],
      "valueAxes": [ {
        "gridAlpha": 0,
        "axisAlpha": 0
      } ],
      "categoryAxis": {
        "gridAlpha": 0,
        "axisAlpha": 0,
        "startOnAxis": true
      }
    } );

    /**
     * Line Chart #7
     */
    AmCharts.makeChart( "line7", {
      "type": "serial",
    "theme": "light",

      "dataProvider": [ {
        "day": 1,
        "value": 45
      }, {
        "day": 2,
        "value": 47
      }, {
        "day": 3,
        "value": 49
      }, {
        "day": 4,
        "value": 49
      }, {
        "day": 5,
        "value": 52
      }, {
        "day": 6,
        "value": 55
      }, {
        "day": 7,
        "value": 55
      }, {
        "day": 8,
        "value": 59
      }, {
        "day": 9,
        "value": 65
      }, {
        "day": 10,
        "value": 65,
        "bullet": "round"
      } ],
      "categoryField": "day",
      "autoMargins": false,
      "marginLeft": 0,
      "marginRight": 5,
      "marginTop": 0,
      "marginBottom": 0,
      "graphs": [ {
        "valueField": "value",
        "bulletField": "bullet",
        "showBalloon": false,
        "lineColor": "#ffffff"
      } ],
      "valueAxes": [ {
        "gridAlpha": 0,
        "axisAlpha": 0
      } ],
      "categoryAxis": {
        "gridAlpha": 0,
        "axisAlpha": 0,
        "startOnAxis": true
      }
    } );

    /**
     * Line Chart #8
     */
    AmCharts.makeChart( "line8", {
      "type": "serial",
    "theme": "light",

      "dataProvider": [ {
        "day": 1,
        "value": 45
      }, {
        "day": 2,
        "value": 47
      }, {
        "day": 3,
        "value": 49
      }, {
        "day": 4,
        "value": 49
      }, {
        "day": 5,
        "value": 52
      }, {
        "day": 6,
        "value": 55
      }, {
        "day": 7,
        "value": 55
      }, {
        "day": 8,
        "value": 59
      }, {
        "day": 9,
        "value": 65
      }, {
        "day": 10,
        "value": 65,
        "bullet": "round"
      } ],
      "categoryField": "day",
      "autoMargins": false,
      "marginLeft": 0,
      "marginRight": 5,
      "marginTop": 0,
      "marginBottom": 0,
      "graphs": [ {
        "valueField": "value",
        "bulletField": "bullet",
        "showBalloon": false,
        "lineColor": "#ffffff"
      } ],
      "valueAxes": [ {
        "gridAlpha": 0,
        "axisAlpha": 0
      } ],
      "categoryAxis": {
        "gridAlpha": 0,
        "axisAlpha": 0,
        "startOnAxis": true
      }
    } );

    /* data untuk 30 hari */

    /**
     * Line Chart #9
     */
    AmCharts.makeChart( "line9", {
      "type": "serial",
    "theme": "light",

      "dataProvider": [ {
        "day": 1,
        "value": 100
      }, {
        "day": 2,
        "value": 140
      }, {
        "day": 3,
        "value": 140
      }, {
        "day": 4,
        "value": 150
      }, {
        "day": 5,
        "value": 180
      }, {
        "day": 6,
        "value": 188
      }, {
        "day": 7,
        "value": 200
      }, {
        "day": 8,
        "value": 231
      }, {
        "day": 9,
        "value": 231
      }, {
        "day": 10,
        "value": 231,
        "bullet": "round"
      } ],
      "categoryField": "day",
      "autoMargins": false,
      "marginLeft": 0,
      "marginRight": 5,
      "marginTop": 0,
      "marginBottom": 0,
      "graphs": [ {
        "valueField": "value",
        "bulletField": "bullet",
        "showBalloon": false,
        "lineColor": "#ffffff"
      } ],
      "valueAxes": [ {
        "gridAlpha": 0,
        "axisAlpha": 0
      } ],
      "categoryAxis": {
        "gridAlpha": 0,
        "axisAlpha": 0,
        "startOnAxis": true
      }
    } );

    /**
     * Line Chart #10
     */
    AmCharts.makeChart( "line10", {
      "type": "serial",
    "theme": "light",

      "dataProvider": [ {
        "day": 1,
        "value": 47
      }, {
        "day": 2,
        "value": 47
      }, {
        "day": 3,
        "value": 43
      }, {
        "day": 4,
        "value": 43
      }, {
        "day": 5,
        "value": 47
      }, {
        "day": 6,
        "value": 47
      }, {
        "day": 7,
        "value": 47
      }, {
        "day": 8,
        "value": 47
      }, {
        "day": 9,
        "value": 47
      }, {
        "day": 10,
        "value": 47,
        "bullet": "round"
      } ],
      "categoryField": "day",
      "autoMargins": false,
      "marginLeft": 0,
      "marginRight": 5,
      "marginTop": 0,
      "marginBottom": 0,
      "graphs": [ {
        "valueField": "value",
        "bulletField": "bullet",
        "showBalloon": false,
        "lineColor": "#ffffff"
      } ],
      "valueAxes": [ {
        "gridAlpha": 0,
        "axisAlpha": 0
      } ],
      "categoryAxis": {
        "gridAlpha": 0,
        "axisAlpha": 0,
        "startOnAxis": true
      }
    } );

    /**
     * Line Chart #11
     */
    AmCharts.makeChart( "line11", {
      "type": "serial",
    "theme": "light",

      "dataProvider": [ {
        "day": 1,
        "value": 100
      }, {
        "day": 2,
        "value": 140
      }, {
        "day": 3,
        "value": 140
      }, {
        "day": 4,
        "value": 150
      }, {
        "day": 5,
        "value": 180
      }, {
        "day": 6,
        "value": 188
      }, {
        "day": 7,
        "value": 200
      }, {
        "day": 8,
        "value": 231
      }, {
        "day": 9,
        "value": 231
      }, {
        "day": 10,
        "value": 231,
        "bullet": "round"
      } ],
      "categoryField": "day",
      "autoMargins": false,
      "marginLeft": 0,
      "marginRight": 5,
      "marginTop": 0,
      "marginBottom": 0,
      "graphs": [ {
        "valueField": "value",
        "bulletField": "bullet",
        "showBalloon": false,
        "lineColor": "#ffffff"
      } ],
      "valueAxes": [ {
        "gridAlpha": 0,
        "axisAlpha": 0
      } ],
      "categoryAxis": {
        "gridAlpha": 0,
        "axisAlpha": 0,
        "startOnAxis": true
      }
    } );

    /**
     * Line Chart #12
     */
    AmCharts.makeChart( "line12", {
      "type": "serial",
    "theme": "light",

      "dataProvider": [ {
        "day": 1,
        "value": 100
      }, {
        "day": 2,
        "value": 140
      }, {
        "day": 3,
        "value": 140
      }, {
        "day": 4,
        "value": 150
      }, {
        "day": 5,
        "value": 180
      }, {
        "day": 6,
        "value": 188
      }, {
        "day": 7,
        "value": 200
      }, {
        "day": 8,
        "value": 231
      }, {
        "day": 9,
        "value": 231
      }, {
        "day": 10,
        "value": 231,
        "bullet": "round"
      } ],
      "categoryField": "day",
      "autoMargins": false,
      "marginLeft": 0,
      "marginRight": 5,
      "marginTop": 0,
      "marginBottom": 0,
      "graphs": [ {
        "valueField": "value",
        "bulletField": "bullet",
        "showBalloon": false,
        "lineColor": "#ffffff"
      } ],
      "valueAxes": [ {
        "gridAlpha": 0,
        "axisAlpha": 0
      } ],
      "categoryAxis": {
        "gridAlpha": 0,
        "axisAlpha": 0,
        "startOnAxis": true
      }
    } );


    </script>

    <!-- ############################################################# TRAFFIC VOLUME CONFIGURATION ######################################################## -->
            <script>

    var chart = AmCharts.makeChart("trafficVolume", {
        "type": "serial",
        "theme": "light",
        "legend": {
            "horizontalGap": 0,
            "maxColumns": 1,
            "position": "right",
            "useGraphSettings": true,
            "markerSize": 10
        },
        "dataProvider": <?php print json_encode($rowTrafficVolume);?>
        ,
        "valueAxes": [{
            "stackType": "regular",
            "axisAlpha": 0.3,
            "gridAlpha": 0
        }],
        "graphs": [{
            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
            "fillAlphas": 0.8,
            "labelText": "[[value]]",
            "lineAlpha": 0.3,
            "title": "Sent",
            "type": "column",
                    "color": "transparent",
            "valueField": "Sent"
        }, {
            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
            "fillAlphas": 0.8,
            "labelText": "[[value]]",
            "lineAlpha": 0.3,
            "title": "Receive",
            "type": "column",
                    "color": "transparent",
            "valueField": "Receive"
        }],
        "categoryField": "TIMESTAMP",
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation" :90,
            "minHorizontalGap":10,
            "axisAlpha": 0.3,
            "gridAlpha": 0,
            "position": "left"
        },
        "export": {
            "enabled": false
         }

        });


    var chart = AmCharts.makeChart("trafficVolume2", {
        "type": "serial",
        "theme": "light",
        "legend": {
            "horizontalGap": 0,
            "maxColumns": 1,
            "position": "bottom",
            "maxColumns":2,
            "useGraphSettings": true,
            "markerSize": 10
        },
        "dataProvider": <?php print json_encode($rowTrafficVolumeLast12Hours);?>
        ,
        "valueAxes": [{
            "stackType": "regular",
            "axisAlpha": 0.3,
            "gridAlpha": 0
        }],
        "graphs": [{
            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
            "fillAlphas": 0.8,
            "labelText": "[[value]]",
            "lineAlpha": 0.3,
            "title": "Sent",
            "type": "column",
                    "color": "transparent",
            "valueField": "Sent"
        }, {
            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
            "fillAlphas": 0.8,
            "labelText": "[[value]]",
            "lineAlpha": 0.3,
            "title": "Receive",
            "type": "column",
                    "color": "transparent",
            "valueField": "Receive"
        }],
        "categoryField": "TIME",
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation" :90,
            "minHorizontalGap":10,
            "axisAlpha": 0.3,
            "gridAlpha": 0,
            "position": "left"
        },
        "export": {
            "enabled": false
         }

        });

    var chart = AmCharts.makeChart("trafficVolume3", {
        "type": "serial",
        "theme": "light",
        "legend": {
            "horizontalGap": 0,
            "maxColumns": 1,
            "position": "bottom",
            "maxColumns":2,
            "useGraphSettings": true,
            "markerSize": 10
        },
        "dataProvider": <?php print json_encode($rowTrafficVolumeLast24Hours);?>
        ,
        "valueAxes": [{
            "stackType": "regular",
            "axisAlpha": 0.3,
            "gridAlpha": 0
        }],
        "graphs": [{
            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
            "fillAlphas": 0.8,
            "labelText": "[[value]]",
            "lineAlpha": 0.3,
            "title": "Sent",
            "type": "column",
                    "color": "transparent",
            "valueField": "Sent"
        }, {
            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
            "fillAlphas": 0.8,
            "labelText": "[[value]]",
            "lineAlpha": 0.3,
            "title": "Receive",
            "type": "column",
                    "color": "transparent",
            "valueField": "Receive"
        }],
        "categoryField": "TIME",
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation" :90,
            "minHorizontalGap":10,
            "axisAlpha": 0.3,
            "gridAlpha": 0,
            "position": "left"
        },
        "export": {
            "enabled": false
         }

        });

            </script>

</body>
</html>

<?php

} // ----> End of Query Status
?>
<?php
if(isset($_SESSION["role"])) {
  exit;
}
else {
  echo "<meta http-equiv='refresh' content='0; url=../modul/logout.php'>";
}
?>
