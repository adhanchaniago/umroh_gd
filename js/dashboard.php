<!DOCTYPE html>

<?php
require('../config/wiwe360-config.php'); //Load DB(mysql) config parameter
session_start();
$Hotel = $_SESSION['Hotel'];
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

// Query Login Type Room Login Last 7 days

        $queryLoginType1Last7Day = "SELECT  'Last7Days' as Period, 'Room Login' as 'Category', count(`pass`) as 'Count' from radpostauth where  date(`authdate`) >= CURDATE() - INTERVAL 1 Week
            and `username` not in (SELECT `emailAddress` FROM `reg_users` WHERE date(`regDate`) >= CURDATE() - INTERVAL 1 Week)
            group by Period, Category";
            
            $resultQueryLoginType1Last7Day = mysql_query($queryLoginType1Last7Day,$Link) or die (mysql_error($Link));
            if(mysql_num_rows($resultQueryLoginType1Last7Day) != 0)
            {
                $rowLoginType1Last7Day = mysql_fetch_assoc($resultQueryLoginType1Last7Day);

                $loginType1Last7Day = $rowLoginType1Last7Day['Category'];
                $countLoginTypeRoomLoginLast7Day = $rowLoginType1Last7Day['Count'];
            }

// Query Login Type Form Registration Last 7 day

            $queryLoginType2Last7Day = "SELECT  'Last7Days' as Period, 'Form Registration' as 'Category', count(`pass`) as 'Count' from radpostauth where  date(`authdate`) >= CURDATE() - INTERVAL 1 Week
            and `username` in (SELECT `emailAddress` FROM `reg_users` WHERE date(`regDate`) >= CURDATE() - INTERVAL 1 Week)
            group by Period, Category";
            
            $resultQueryLoginType2Last7Day = mysql_query($queryLoginType2Last7Day,$Link) or die (mysql_error($Link));
            if(mysql_num_rows($resultQueryLoginType2Last7Day) != 0)
            {
                $rowLoginType2Last7Day = mysql_fetch_assoc($resultQueryLoginType2Last7Day);

                $countLoginTypeFormRegistrationLast7Day = $rowLoginType2Last7Day['Count'];
            }

// Query Login Type Social Media Login Last 7 day

            $queryLoginType3Last7Day = "SELECT  'Last7Days' as Period, 'Social Media Login' as 'Category', 0 as 'Count' from radpostauth where  date(`authdate`) >= CURDATE() - INTERVAL 1 Week
            group by Period, Category";
            
            $resultQueryLoginType3Last7Day = mysql_query($queryLoginType3Last7Day,$Link) or die (mysql_error($Link));
            if(mysql_num_rows($resultQueryLoginType3Last7Day) != 0)
            {
                $rowLoginType3Last7Day = mysql_fetch_assoc($resultQueryLoginType3Last7Day);

                $countLoginTypeSocialMediaLoginLast7Day = $rowLoginType3Last7Day['Count'];
            }

// Query Login Type Voucher Last 7 day

            $queryLoginType4Last7Day = "SELECT  'Last7Days' as Period, 'Voucher' as 'Category', 0 as 'Count' from radpostauth where  date(`authdate`) >= CURDATE() - INTERVAL 1 Week
                group by Period, Category";
            
            $resultQueryLoginType4Last7Day = mysql_query($queryLoginType4Last7Day,$Link) or die (mysql_error($Link));
            if(mysql_num_rows($resultQueryLoginType4Last7Day) != 0)
            {
                $rowLoginType4Last7Day = mysql_fetch_assoc($resultQueryLoginType4Last7Day);

                $countLoginTypeVoucherLast7Day = $rowLoginType4Last7Day['Count'];
            }

// //---->>>>>

// Query Login Type Room Login Last 30 days

        $queryLoginType1Last30Day = "SELECT 'Last30Days' as Period, 'Room Login' as 'Category', count(`pass`) as 'Count' from radpostauth where  date(`authdate`) >= CURDATE() - INTERVAL 1 month
            and `username` not in (SELECT `emailAddress` FROM `reg_users` WHERE date(`regDate`) >= CURDATE() - INTERVAL 1 month)
            group by Period, Category";
            
            $resultQueryLoginType1Last30Day = mysql_query($queryLoginType1Last30Day,$Link) or die (mysql_error($Link));
            if(mysql_num_rows($resultQueryLoginType1Last30Day) != 0)
            {
                $rowLoginType1Last30Day = mysql_fetch_assoc($resultQueryLoginType1Last30Day);

                $loginType1Last30Day = $rowLoginType1Last30Day['Category'];
                $countLoginTypeRoomLoginLast30Day = $rowLoginType1Last30Day['Count'];
            }

// Query Login Type Form Registration Last 30 day

            $queryLoginType2Last30Day = "SELECT 'Last30Days' as Period, 'Form Registration' as 'Category', count(`pass`) as 'Count' from radpostauth where  date(`authdate`) >= CURDATE() - INTERVAL 1 month
            and `username` in (SELECT `emailAddress` FROM `reg_users` WHERE date(`regDate`) >= CURDATE() - INTERVAL 1 month)
            group by Period, Category";
            
            $resultQueryLoginType2Last30Day = mysql_query($queryLoginType2Last30Day,$Link) or die (mysql_error($Link));
            if(mysql_num_rows($resultQueryLoginType2Last30Day) != 0)
            {
                $rowLoginType2Last30Day = mysql_fetch_assoc($resultQueryLoginType2Last30Day);

                $countLoginTypeFormRegistrationLast30Day = $rowLoginType2Last30Day['Count'];
            }

// Query Login Type Social Media Login Last 30 day

            $queryLoginType3Last30Day = "SELECT  'Last30Days' as Period, 'Social Media Login' as 'Category', 0 as 'Count' from radpostauth where  date(`authdate`) >= CURDATE() - INTERVAL 1 Week
            group by Period, Category";
            
            $resultQueryLoginType3Last30Day = mysql_query($queryLoginType3Last30Day,$Link) or die (mysql_error($Link));
            if(mysql_num_rows($resultQueryLoginType3Last30Day) != 0)
            {
                $rowLoginType3Last30Day = mysql_fetch_assoc($resultQueryLoginType3Last30Day);

                $countLoginTypeSocialMediaLoginLast30Day = @($rowLoginType3Last73Day['Count']);
            }

// Query Login Type Voucher Last 30 day

            $queryLoginType4Last30Day = "SELECT  'Last7Days' as Period, 'Voucher' as 'Category', 0 as 'Count' from radpostauth where  date(`authdate`) >= CURDATE() - INTERVAL 1 Week
                group by Period, Category";
            
            $resultQueryLoginType4Last30Day = mysql_query($queryLoginType4Last30Day,$Link) or die (mysql_error($Link));
                $rowLoginType4Last30Day = mysql_fetch_assoc($resultQueryLoginType4Last30Day);

                $countLoginTypeVoucherLast30Day = $rowLoginType4Last30Day['Count'];

// Query for Login Type Room Login Today
            $queryLoginType1Today = "SELECT  'Today' as Period, 'Room Login' as 'Category', count(`pass`) as 'Count' from radpostauth where  date(`authdate`) >= CURDATE()
				 and `username` not in (SELECT `emailAddress` FROM `reg_users` WHERE date(`regDate`) >= CURDATE())
				 group by Period, Category";
            $resultQueryLoginType1Today = mysql_query($queryLoginType1Today,$Link) or die (mysql_error($Link));
            $rowLoginType1Today = mysql_fetch_assoc($resultQueryLoginType1Today);
            $countLoginTypeRoomLoginToday = $rowLoginType1Today['Count']; 

// Query for Login Type Form Registration Today
            $queryLoginType2Today = "SELECT  'Today' as Period, 'Form Registration' as 'Category', count(`pass`) as 'Count' from radpostauth where  date(`authdate`) >= CURDATE()
				and `username` in (SELECT `emailAddress` FROM `reg_users` WHERE date(`regDate`) >= CURDATE())
				group by Period, Category";
            $resultQueryLoginType2Today = mysql_query($queryLoginType2Today,$Link) or die (mysql_error($Link));
            $rowLoginType2Today = mysql_fetch_assoc($resultQueryLoginType2Today);
            $countLoginTypeFormRegistrationToday = $rowLoginType2Today['Count'];

 // Query for Login Type Social Media Login Today
            $queryLoginType3Today = "SELECT  'Today' as Period, 'Social Media Login' as 'Category', 0 as 'Count' from radpostauth where  date(`authdate`) >= CURDATE() - INTERVAL 1 Week
           		 group by Period, Category";
            $resultQueryLoginType3Today = mysql_query($queryLoginType3Today,$Link) or die (mysql_error($Link));
            $rowLoginType3Today = mysql_fetch_assoc($resultQueryLoginType3Today);
            $countLoginTypeSocialMediaLoginToday = $rowLoginType3Today['Count']; 

// Query for Login Type Voucher Login Today
            $queryLoginType3Today = "SELECT  'Today' as Period, 'Social Media Login' as 'Category', 0 as 'Count' from radpostauth where  date(`authdate`) >= CURDATE() - INTERVAL 1 Week
           		 group by Period, Category";
            $resultQueryLoginType3Today = mysql_query($queryLoginType3Today,$Link) or die (mysql_error($Link));
            $rowLoginType3Today = mysql_fetch_assoc($resultQueryLoginType3Today);
            $countLoginTypeVoucherToday = $rowLoginType3Today['Count'];

?>

<html>
<head>
    <title>WiWE 90 - Listener</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="icon" sizes="192x192" href="../img/Icon.png"/>
    <!-- Glazzed & Bootstrap -->    
    <link rel="stylesheet" type="text/css" href="../css/main.min.css">
    <!-- Pixeden Icon Fonts -->
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all">

    <script src="../js/liquidFillGauge.js" language="JavaScript"></script>
    <style>
        .liquidFillGaugeText { font-family: Helvetica; font-weight: bold; }
        .progressbar {background: rgba(184, 184, 184, 0.59); background: -webkit-linear-gradient(top, rgba(56, 56, 56, 0.34) 0%, rgba(184, 184, 184, 0.59) 100%); background: linear-gradient(to bottom, rgba(56, 56, 56, 0.34) 0%, rgba(184, 184, 184, 0.59) 100%); border: 1px solid rgba(56, 56, 56, 0.1); border-radius: 0px; height: 3px;}
        .progress-bar-custom {background: rgba(17, 255, 0, 1); background: -webkit-linear-gradient(top, rgba(67, 153, 25, 0.66) 0%, rgba(17, 255, 0, 1) 100%); background: linear-gradient(to bottom, rgba(67, 153, 25, 0.66) 0%, rgba(17, 255, 0, 1) 100%);}

        .newProgress-bar-custom {background: rgba(255, 255, 255, 0.6); background: -webkit-linear-gradient(top, rgba(90, 112, 100, 0.66) 0%, rgba(17, 100, 0, 1) 100%); background: linear-gradient(to bottom, rgba(255, 0, 0, 0.66) 0%, rgba(255, 0, 0, 1) 100%);}
    </style>

</head>
<bo</y>

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
                        <i class="pe-7f-home"></i>
                        <span>Dashboard</span>
                    </h1>
                    <ul class="main-header__breadcrumb">
                        <li><a href="?page=90" onclick="return false;">Home</a></li>
                        <li><a href="#" onclick="return false;">Dashboard</a></li>
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
                <div class ="row">
                   <div class="col-md-3">
                        <article class="widget">
                            <div class="widget__content widget__grid filled pad20" style="height: 150px">
                            <font size ="4">INTERNET UPTIME</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo round($row['service_level'],1)?>%</strong></font><br><br>

                            <div class="progressbar">
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row['service_level']?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                            <font size ="3"><strong style="font-weight: bold;"> <?php echo $rowResponseTimeToday['ResponseTime']; ?> &nbsp ms</strong> &nbsp response time</font>
                            </div>
                            </article>
                            </div>

                     <div class="col-md-3">
                        <article class="widget">
                            <div class="widget__content widget__grid filled pad20" style="height: 150px">
                            <font size ="4">DISCONNECTED AP</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo $TotalDisconnectAP ?></strong></font><br><br>
                            <div class="progressbar">
                            <div class="progress-bar newProgress-bar-custom" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentageDisconnectedAP ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                            <font size ="3"><strong style="font-weight: bold;"> <?php echo $TotalAP ?></strong> &nbsp Total Access Point</font>
                            </article>
                            </div>

                     <div class="col-md-3">
                        <article class="widget">
                            <div class="widget__content widget__grid filled pad20" style="height: 150px">
                            <font size ="4">NEW USER</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo $newUserToday ?></strong></font><br><br>

                            <div class="progressbar">
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $marginUserToday ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                             <font size ="3"><strong style="font-weight: bold;"> <?php echo $totalUserToday ?> </strong> Total Users </font>
                            </article>
                            </div>

                     <div class="col-md-3">
                        <article class="widget">
                            <div class="widget__content widget__grid filled pad20" style="height: 150px">
                            <font size ="4">NEW DEVICE</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo $newDeviceToday ?></strong></font><br><br>

                            <div class="progressbar">
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $newDevicePercentage ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                            <font size ="3"> <strong style="font-weight: bold;"> <?php echo $TotalDeviceToday?> </strong> Total devices</font>
                            </article>
                            </div>
                     </div>
                   <!-- Bundar Bundar selsai di sini --> 

                    <div class="row"> <!-- Statistic for today --> 
                        <div class="col-md-6">
                         <header class="widget__header">
                                <div class="widget__title">
                                    <i class="pe-7s-graph"></i><h3>Login Type for Today</h3>
                                </div>
                                <div class="widget__config">
                                    <a href="#"><i class="pe-7f-refresh"></i></a>
                                    <a href="#"><i class="pe-7s-close"></i></a>
                                </div>
                            </header>

                            <div class="widget__content filled">
                              <div id="chartdiv20"></div> 
                            </div>
                    </div>

                    <!-- Pie Chart for Today -->
                    <div class="col-md-6">
                        <header class="widget__header">
                                <div class="widget__title">
                                    <i class="pe-7s-graph"></i><h3>Login Type for Today</h3>
                                </div>
                                <div class="widget__config">
                                    <a href="#"><i class="pe-7f-refresh"></i></a>
                                    <a href="#"><i class="pe-7s-close"></i></a>
                                </div>
                            </header>
                            
                            <div class="widget__content filled widget-ui" style="height: 265px">
                                <div class="row">
                                <?php

                                if ($countLoginTypeRoomLoginToday == 0 && $countLoginTypeVoucherToday == 0 && $countLoginTypeFormRegistrationToday == 0 && $countLoginTypeSocialMediaLoginToday == 0)
                                {
                                    ?>
                                    <br><br><br><br><br><br>
                                    <center><font size ="6" color =" rgba(0, 0, 0, 0.6)"><i> No Data to Show !</i></font></center>
                                    <?php
                                } 
                                else
                                {
                                    ?>
                                    <div class="col-md-12 text-center">
                                        <div id="chartdiv10" style="width: 100%; height: 250px;">
                                            <div id="chart3" Room-Login = <?php echo $countLoginTypeRoomLoginToday ?> Voucher = <?php echo $countLoginTypeVoucherToday ?>
                                             Form-Registration = <?php echo $countLoginTypeFormRegistrationToday ?> Social-Media-Login = <?php echo $countLoginTypeSocialMediaLoginToday?> > </div>
                                        </div>
                                    </div>

                                    <?php
                                }
                                ?>
                                </div>
                            </div> <!-- /widget__content -->
                        </article> <!-- /widget -->
                    </div>
                </div> <!-- end of Last 7 Days Statistics -->
                </div> <!-- end of Last 7 Days Data -->


                <div data-tab-radio="tab-radio" class="tab-radio-content row" id="7Days">
                   <div class ="row">
                   <div class="col-md-3">
                        <article class="widget">
                            <div class="widget__content widget__grid filled pad20" style="height: 150px">
                            <font size ="4">INTERNET UPTIME</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo round($row1['service_level'],1)?>%</strong></font><br><br>

                            <div class="progressbar">
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row1['service_level']?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                            <font size ="3"><strong style="font-weight: bold;"> <?php echo $rowResponseTimeLast7Days['ResponseTime']; ?>&nbsp ms</strong> &nbsp response time</font>
                            </div>
                            </article>
                            </div>

                     <div class="col-md-3">
                        <article class="widget">
                            <div class="widget__content widget__grid filled pad20" style="height: 150px">
                            <font size ="4">DISCONNECT AP</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo $TotalDisconnectAP ?></strong></font><br><br>
                            <div class="progressbar">
                            <div class="progress-bar newProgress-bar-custom" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentageDisconnectedAP ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                            <font size ="3"><strong style="font-weight: bold;"> <?php echo $TotalAP ?></strong> &nbsp Total Access Point</font>
                            </article>
                            </div>

                     <div class="col-md-3">
                        <article class="widget">
                            <div class="widget__content widget__grid filled pad20" style="height: 150px">
                            <font size ="4">NEW USER</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo $newUserLast7Days ?></strong></font><br><br>

                            <div class="progressbar">
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $marginUserLast7Days ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                             <font size ="3"><strong style="font-weight: bold;"> <?php echo $totalUserLast7Days ?> </strong> &nbsp Total Users </font>
                            </article>
                            </div>

                     <div class="col-md-3">
                        <article class="widget">
                            <div class="widget__content widget__grid filled pad20" style="height: 150px">
                            <font size ="4">NEW DEVICE</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo $newDeviceLast7Day ?> </strong></font><br><br>

                            <div class="progressbar">
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $newDevicePercentage ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                            <font size ="3"> <strong style="font-weight: bold;"> <?php echo $TotalDeviceLast7Day?></strong> Total Devices</font>
                            </article>
                            </div>
                     </div>

                    <div class="row"> <!-- Statistic for Last 7 Days --> 
                        <div class="col-md-6">
                            <header class="widget__header">
                                <div class="widget__title">
                                    <i class="pe-7f-graph3"></i><h3>Statistics for Last 7 Days</h3>
                                </div>
                                <div class="widget__config">
                                    <a href="#"><i class="pe-7f-refresh"></i></a>
                                    <a href="#"><i class="pe-7s-close"></i></a>
                                </div>
                            </header>

                            <div class="widget__content filled">
                              <div id="chartdiv21"></div> 
                            </div>
                    </div>


                    <!-- Pie Chart for Last 7 Days -->
                    <div class="col-md-6">
                        <header class="widget__header">
                                <div class="widget__title">
                                    <i class="pe-7s-graph"></i><h3>Login Type for Last 7 days</h3>
                                </div>
                                <div class="widget__config">
                                    <a href="#"><i class="pe-7f-refresh"></i></a>
                                    <a href="#"><i class="pe-7s-close"></i></a>
                                </div>
                            </header>
                            
                            <div class="widget__content filled widget-ui">
                                <div class="row">
                                    <div class="col-md-8 text-center">
                                        <div id="chartdiv5" style="width: 100%; height: 250px;">
                                            <div id="chart2" Room-Login = <?php echo $countLoginTypeRoomLoginLast7Day ?> Voucher = <?php echo $countLoginTypeVoucherLast7Day?> Form-Registration = <?php echo $countLoginTypeFormRegistrationLast7Day?> Social-Media-Login = <?php echo $countLoginTypeSocialMediaLoginLast7Day?> > </div>
                                        </div>
                                    </div>
                                    <br><br><br><br>
                                     <div class="pie-small blue"> </div> Room Login <br><br>
                                     <div class="pie-small blue"> </div> Room Login <br><br>
                                     <div class="pie-small blue"> </div> Room Login <br><br>
                                     <div class="pie-small blue"> </div> Room Login <br><br>
                                </div>
                            </div> <!-- /widget__content -->
                    </div>

                </div> <!-- end of Last 7 Days Statistics -->

                </div> <!-- End of Last 7 Days row -->

                <div data-tab-radio="tab-radio" class="tab-radio-content row" id="30Days">
                  
                  <div class ="row">
                   <div class="col-md-3">
                        <article class="widget">
                            <div class="widget__content widget__grid filled pad20" style="height: 150px">
                            <font size ="4">INTERNET UPTIME</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo round($row2 ['service_level'],1)?>%</strong></font><br><br>

                            <div class="progressbar">
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row2['service_level']?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                            <font size ="3"><strong style="font-weight: bold;"> <?php echo $rowResponseTimeLast30Days['ResponseTime'] ?>&nbsp ms</strong> &nbsp response time</font>
                            </div>
                            </article>
                            </div>

                     <div class="col-md-3">
                        <article class="widget">
                            <div class="widget__content widget__grid filled pad20" style="height: 150px">
                            <font size ="4">DISCONNECT AP</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo $TotalDisconnectAP ?></strong></font><br><br>
                            <div class="progressbar">
                            <div class="progress-bar newProgress-bar-custom" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentageDisconnectedAP ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                            <font size ="3"><strong style="font-weight: bold;"> <?php echo $TotalAP ?></strong> &nbsp Total Access Point</font>
                            </article>
                            </div>

                     <div class="col-md-3">
                        <article class="widget">
                            <div class="widget__content widget__grid filled pad20" style="height: 150px">
                            <font size ="4">NEW USER</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo $newUserLast30Days ?> </strong></font><br><br>

                            <div class="progressbar">
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $marginUserLast30Days  ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                             <font size ="3"><strong style="font-weight: bold;"> <?php echo $totalUserLast30Days ?> </strong> &nbsp  Total Users </font>
                            </article>
                            </div>

                     <div class="col-md-3">
                        <article class="widget">
                            <div class="widget__content widget__grid filled pad20" style="height: 150px">
                            <font size ="4">NEW DEVICE</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo $newDeviceLast30Day ?></strong></font><br><br>

                            <div class="progressbar">
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $newDeviceLast30DayPercentage ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                            <font size ="3"><strong style ="font-weight : bold;"><?php echo $TotalDeviceLast30Day ?> </strong> Total Devices</font>
                            </article>
                            </div>
                     </div>
                        
                    <div class ="row">
                        <div class ="col-md-6">
                            <header class="widget__header">
                                <div class="widget__title">
                                    <i class="pe-7f-graph3"></i><h3>Statistics for Last 30 Days</h3>
                                </div>
                                <div class="widget__config">
                                    <a href="#"><i class="pe-7f-refresh"></i></a>
                                    <a href="#"><i class="pe-7s-close"></i></a>
                                </div>

                            </header>

                             <div class="widget__content filled">
                              <div id="chartdiv22"></div> 
                            </div>
                        </div>

                    <!-- Pie Chart Last 30 Days -->
                    <div class="col-md-6">
                        <header class="widget__header">
                                <div class="widget__title">
                                    <i class="pe-7s-graph"></i><h3>Login Type for Last 30 Days</h3>
                                </div>
                                <div class="widget__config">
                                    <a href="#"><i class="pe-7f-refresh"></i></a>
                                    <a href="#"><i class="pe-7s-close"></i></a>
                                </div>
                            </header>
                            

                            <div class="widget__content filled widget-ui">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <div id="chartdiv3" style="width: 100%; height: 250px;">
                                            <div id="chart1" Room-Login = <?php echo $countLoginTypeRoomLoginLast30Day ?> Voucher = <?php echo $countLoginTypeVoucherLast30Day ?> Form-Registration = <?php echo $countLoginTypeFormRegistrationLast30Day ?> Social-Media-Login = <?php echo $countLoginTypeSocialMediaLoginLast30Day ?> > </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div> <!-- /widget__content -->
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

    <script type="text/javascript">
    var chart = AmCharts.makeChart("chartdiv20", {
    "type": "serial",
    "theme": "light",
    "legend": {
        "horizontalGap": 10,
        "maxColumns": 1,
        "position": "right",
        "useGraphSettings": true,
        "markerSize": 10
    },
    "dataProvider": [{
        "Hour": '1 PM',
        "New User": 5,
        "Returning": 2
    }, {
        "Hour": '2 PM',
        "New User": 6,
        "Returning": 7
    }, {
        "Hour": '2 PM',
        "New User": 6,
        "Returning": 3
    }, {
        "Hour": '4 PM',
        "New User": 5,
        "Returning": 7
    }],
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
                "color": "#fff",
        "valueField": "New User"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Returning",
        "type": "column",
                "color": "#fff",
        "valueField": "Returning"
    }],
    "categoryField": "Hour",
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
        "horizontalGap": 10,
        "maxColumns": 1,
        "position": "right",
        "useGraphSettings": true,
        "markerSize": 10
    },
    "dataProvider": [{
        "Hour": '1 PM',
        "New User": 5,
        "Returning": 2
    }, {
        "Hour": '2 PM',
        "New User": 6,
        "Returning": 7
    }, {
        "Hour": '2 PM',
        "New User": 6,
        "Returning": 3
    }, {
        "Hour": '4 PM',
        "New User": 5,
        "Returning": 7
    }],
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
                "color": "#fff",
        "valueField": "New User"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Returning",
        "type": "column",
                "color": "#fff",
        "valueField": "Returning"
    }],
    "categoryField": "Hour",
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
    "theme": "light",
    "legend": {
        "horizontalGap": 10,
        "maxColumns": 1,
        "position": "right",
        "useGraphSettings": true,
        "markerSize": 10
    },
    "dataProvider": [{
        "Hour": '1 PM',
        "New User": 5,
        "Returning": 2
    }, {
        "Hour": '2 PM',
        "New User": 6,
        "Returning": 7
    }, {
        "Hour": '2 PM',
        "New User": 6,
        "Returning": 3
    }, {
        "Hour": '4 PM',
        "New User": 5,
        "Returning": 7
    }],
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
                "color": "#fff",
        "valueField": "New User"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Returning",
        "type": "column",
                "color": "#fff",
        "valueField": "Returning"
    }],
    "categoryField": "Hour",
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

