<?php
# KONTROL MENU PROGRAM
if($_GET) {
	// Jika mendapatkan variabel URL ?page
	switch($_GET['page']){
		case '' :
			if(!file_exists ("welcome.php")) die ("Empty Main Page!");
			include "welcome.php";	break;

		case 'Halaman-Utama' :
			if(!file_exists ("welcome.php")) die ("Sorry Empty Page!");
			include "welcome.php";	break;


#agent -menu agent
case 'agent' :
	if(!file_exists ("agent.php")) die ("Sorry Empty Page!");
	include "agent.php";	break;

	#90 - Menu Booking Online
		case '90' :
			if(!file_exists ("../modul/90/dashboard.php")) die ("Sorry Empty Page!");
			include "../modul/90/dashboard.php";	break;
		case 'Safwa' :
			if(!file_exists ("../modul/90/supersaver.php")) die ("Sorry Empty Page!");
			include "../modul/90/supersaver.php";	break;




	#equipment untuk memberikan perlengkapan ke jamaah lama satuan nnti di edit kembali


	case 'Equipment-Data90' :
		if(!file_exists ("../modul/90/equipment_data.php")) die ("Sorry Empty Page!");
		include "../modul/90/equipment_data.php";	break;

		#equipment untuk memberikan perlengkapan ke jamaah
		case 'Equipment-Add90' :
			if(!file_exists ("../modul/90/equipadd_jamaah.php")) die ("Sorry Empty Page!");
			include "../modul/90/equipadd_jamaah.php";	break;


# perlengkapan untuk diberkan ke jamaah baru (rame2)
case 'Equipment-Data-Jamaah-Cro' :
	if(!file_exists ("../modul/90/perlengkapan.php")) die ("Sorry Empty Page!");
	include "../modul/90/perlengkapan.php";	break;


		#preview data umroh
		case 'Detail-Umroh' :
			if(!file_exists ("../modul/90/detailumroh.php")) die ("Sorry Empty Page!");
			include "../modul/90/detailumroh.php";	break;

		case 'Marwa' :
			if(!file_exists ("../modul/90/silver.php")) die ("Sorry Empty Page!");
			include "../modul/90/silver.php";	break;

		case 'Incentive' :
			if(!file_exists ("../modul/90/gold.php")) die ("Sorry Empty Page!");
			include "../modul/90/gold.php";	break;

		case 'Document' :
			if(!file_exists ("../modul/90/dokumen.php")) die ("Sorry Empty Page!");
			include "../modul/90/dokumen.php";	break;

			case 'View_Document' :
				if(!file_exists ("../modul/90/view_dokumen.php")) die ("Sorry Empty Page!");
				include "../modul/90/view_dokumen.php";	break;

//data view dokumen rahmah
case 'View_Document_Rahmah' :
	if(!file_exists ("../modul/90/view_dokumen_rahmah.php")) die ("Sorry Empty Page!");
	include "../modul/90/view_dokumen_rahmah.php";	break;


	//data view dokumen incentive
	case 'View_Document_Incentive' :
		if(!file_exists ("../modul/90/view_dokumen_incentive.php")) die ("Sorry Empty Page!");
		include "../modul/90/view_dokumen_incentive.php";	break;


		case 'Add_Document' :
				if(!file_exists ("../modul/90/add_dokumen.php")) die ("Sorry Empty Page!");
				include "../modul/90/add_dokumen.php";	break;

				case 'Document_Personal_Berkah' :
						if(!file_exists ("../modul/90/document_personal_berkah.php")) die ("Sorry Empty Page!");
						include "../modul/90/document_personal_berkah.php";	break;

#90 - Input data jamaah
		case 'input_jamaah' :
			if(!file_exists ("../modul/90/input_jamaah.php")) die ("Sorry Empty Page!");
			include "../modul/90/input_jamaah.php";	break;
		case 'input_jamaah_silver' :
			if(!file_exists ("../modul/90/input_silver.php")) die ("Sorry Empty Page!");
			include "../modul/90/input_silver.php";	break;
			case 'input_gold' :
			if(!file_exists ("../modul/90/input_gold.php")) die ("Sorry Empty Page!");
			include "../modul/90/input_gold.php";	break;
		case 'input_waiting_booking' :
			if(!file_exists ("../modul/90/input_waiting_booking.php")) die ("Sorry Empty Page!");
			include "../modul/90/input_waiting_booking.php";	break;

			case 'input_jamaah_booking' :
				if(!file_exists ("../modul/90/input_jamaah_booking.php")) die ("Sorry Empty Page!");
				include "../modul/90/input_jamaah_booking.php";	break;

	#90 - edit data jamaah
	case 'edit_jamaah' :
		if(!file_exists ("../modul/90/edit_jamaah.php")) die ("Sorry Empty Page!");
		include "../modul/90/edit_jamaah.php";	break;

	#90 - Menu Booking Online

	#data jamaah super

	case 'DataJamaahCancel' :
		if(!file_exists ("../modul/90/datajamaahcancel.php")) die ("Sorry Empty Page!");
		include "../modul/90/datajamaahcancel.php";	break;


		// case 'JamaahDelete' :
		// 	if(!file_exists ("../modul/90/jamaah_delete.php")) die ("Sorry Empty Page!");
		// 	include "../modul/90/jamaah_delete.php";	break;


#DataJamaahBerkah
case 'DataJamaahSafwa' :
	if(!file_exists ("../modul/90/datajamaahberkah.php")) die ("Sorry Empty Page!");
	include "../modul/90/datajamaahberkah.php";	break;

	case 'DataJamaahRahmah' :
		if(!file_exists ("../modul/90/datajamaahrahmah.php")) die ("Sorry Empty Page!");
		include "../modul/90/datajamaahrahmah.php";	break;

		case 'DataJamaahIncentive' :
			if(!file_exists ("../modul/90/datajamaahincentive.php")) die ("Sorry Empty Page!");
			include "../modul/90/datajamaahincentive.php";	break;


			case 'JamaahPrint' :
			if(!file_exists ("../modul/90/jamaah_print.php")) die ("Sorry Empty Page!");
			include "../modul/90/jamaah_print.php";	break;


# 90 - data untuk list roomlist per paket
			case 'DataRoomlistBerkah' :
			if(!file_exists ("../modul/90/dataroomlistberkah.php")) die ("Sorry Empty Page!");
			include "../modul/90/dataroomlistberkah.php";	break;

			case 'DataRoomlistRahmah' :
			if(!file_exists ("../modul/90/dataroomlistrahmah.php")) die ("Sorry Empty Page!");
			include "../modul/90/dataroomlistrahmah.php";	break;

			case 'DataRoomlistIncentive' :
			if(!file_exists ("../modul/90/dataroomlistincentive.php")) die ("Sorry Empty Page!");
			include "../modul/90/dataroomlistincentive.php";	break;


	#90 -  data  edit room list all packages


		case 'DataEditRoomlistBerkah' :
			if(!file_exists ("../modul/90/edit_roomlistberkah.php")) die ("Sorry Empty Page!");
			include "../modul/90/edit_roomlistberkah.php";	break;

			case 'DataEditRoomlistRahmah' :
				if(!file_exists ("../modul/90/edit_roomlistrahmah.php")) die ("Sorry Empty Page!");
				include "../modul/90/edit_roomlistrahmah.php";	break;

				case 'DataEditRoomlistIncentive' :
					if(!file_exists ("../modul/90/edit_roomlistincentive.php")) die ("Sorry Empty Page!");
					include "../modul/90/edit_roomlistincentive.php";	break;

#90 data edit mahrom perpaket
			case 'DataEditMahromBerkah' :
				if(!file_exists ("../modul/90/edit_mahromberkah.php")) die ("Sorry Empty Page!");
				include "../modul/90/edit_mahromberkah.php";	break;

				case 'DataEditMahromRahmah' :
					if(!file_exists ("../modul/90/edit_mahromrahmah.php")) die ("Sorry Empty Page!");
					include "../modul/90/edit_mahromrahmah.php";	break;

					case 'DataEditMahromIncentive' :
						if(!file_exists ("../modul/90/edit_mahromincentive.php")) die ("Sorry Empty Page!");
						include "../modul/90/edit_mahromincentive.php";	break;

	#90 - Menu mahrom Online
  // case 'DataMahromSuper' :
	// 		if(!file_exists ("../modul/90/datamahromsuper.php")) die ("Sorry Empty Page!");
	// 		include "../modul/90/datamahromsuper.php";	break;

   case 'DataMahromBerkah' :
			if(!file_exists ("../modul/90/datamahromberkah.php")) die ("Sorry Empty Page!");
			include "../modul/90/datamahromberkah.php";	break;

			case 'DataMahromRahmah' :
				 if(!file_exists ("../modul/90/datamahromrahmah.php")) die ("Sorry Empty Page!");
				 include "../modul/90/datamahromrahmah.php";	break;

				 case 'DataMahromIncentive' :
	 				 if(!file_exists ("../modul/90/datamahromincentive.php")) die ("Sorry Empty Page!");
	 				 include "../modul/90/datamahromincentive.php";	break;



		case 'DataReport' :
			if(!file_exists ("../modul/90/datareport.php")) die ("Sorry Empty Page!");
			include "../modul/90/datareport.php";	break;
	#90 - Menu Report cro
			#manifest
		case 'DataManifest-All' :
			if(!file_exists ("../modul/90/datamanifestall.php")) die ("Sorry Empty Page!");
			include "../modul/90/datamanifestall.php";	break;

		case 'DataManifest_Berkah' :
			if(!file_exists ("../modul/90/datamanifestberkah.php")) die ("Sorry Empty Page!");
			include "../modul/90/datamanifestberkah.php";	break;

		case 'DataManifest_Rahmah' :
				if(!file_exists ("../modul/90/datamanifestrahmah.php")) die ("Sorry Empty Page!");
				include "../modul/90/datamanifestrahmah.php";	break;

				case 'DataManifest_Incentive' :
						if(!file_exists ("../modul/90/datamanifestincentive.php")) die ("Sorry Empty Page!");
						include "../modul/90/datamanifestincentive.php";	break;





			case 'DataRoomlist-All' :
				if(!file_exists ("../modul/90/dataroomlistall.php")) die ("Sorry Empty Page!");
				include "../modul/90/dataroomlistall.php";	break;
			case 'ReportRoomlist_Berkah' :
				if(!file_exists ("../modul/90/reportroomlistberkah.php")) die ("Sorry Empty Page!");
				include "../modul/90/reportroomlistberkah.php";	break;
				case 'ReportRoomlist_Rahmah' :
					if(!file_exists ("../modul/90/reportroomlistrahmah.php")) die ("Sorry Empty Page!");
					include "../modul/90/reportroomlistrahmah.php";	break;
					case 'ReportRoomlist_Incentive' :
						if(!file_exists ("../modul/90/reportroomlistincentive.php")) die ("Sorry Empty Page!");
						include "../modul/90/reportroomlistincentive.php";	break;


			#Mahroom
		case 'DataMahrom-All' :
			if(!file_exists ("../modul/90/datamahromall.php")) die ("Sorry Empty Page!");
			include "../modul/90/datamahromall.php";	break;

			case 'ReportMahrom_Berkah' :
				if(!file_exists ("../modul/90/reportmahromberkah.php")) die ("Sorry Empty Page!");
				include "../modul/90/reportmahromberkah.php";	break;

				case 'ReportMahrom_Rahmah' :
					if(!file_exists ("../modul/90/reportmahromrahmah.php")) die ("Sorry Empty Page!");
					include "../modul/90/reportmahromrahmah.php";	break;

					case 'ReportMahrom_Incentive' :
						if(!file_exists ("../modul/90/reportmahromincentive.php")) die ("Sorry Empty Page!");
						include "../modul/90/reportmahromincentive.php";	break;

	#90 - invoice di menu cr

	case 'Invoice-All' :
		if(!file_exists ("../modul/90/invoice_all.php")) die ("Sorry Empty Page!");
		include "../modul/90/invoice_all.php";	break;

		case 'Invoice-CR' :
			if(!file_exists ("../modul/90/invoice_cr.php")) die ("Sorry Empty Page!");
			include "../modul/90/invoice_cr.php";	break;
		case 'Channel90' :
				if(!file_exists ("../modul/90/channel_cr.php")) die ("Sorry Empty Page!");
				include "../modul/90/channel_cr.php";	break;

				case 'Invoice-Rahmah' :
					if(!file_exists ("../modul/90/invoice_rahmah.php")) die ("Sorry Empty Page!");
					include "../modul/90/invoice_rahmah.php";	break;

					case 'Invoice-Incentive' :
						if(!file_exists ("../modul/90/invoice_incentive.php")) die ("Sorry Empty Page!");
						include "../modul/90/invoice_incentive.php";	break;



	#90 - data waiting choice
		case 'Waiting_Choice' :
			if(!file_exists ("../modul/90/waitingchoice.php")) die ("Sorry Empty Page!");
			include "../modul/90/waitingchoice.php";	break;



	#90 - Waiting list input
		case 'Waiting' :
			if(!file_exists ("../modul/90/waiting.php")) die ("Sorry Empty Page!");
			include "../modul/90/waiting.php";	break;

		/*case 'DataWaiting_Super' :
			if(!file_exists ("../modul/90/datawaiting_super.php")) die ("Sorry Empty Page!");
			include "../modul/90/datawaiting_super.php";	break;

		case 'WaitingDeleteSuper' :
			if(!file_exists ("../modul/90/waitingdeletesuper.php")) die ("Sorry Empty Page!");
			include "../modul/90/waitingdeletesuper.php";	break; */

			case 'DataWaiting_Safwa' :
				if(!file_exists ("../modul/90/datawaiting_berkah.php")) die ("Sorry Empty Page!");
				include "../modul/90/datawaiting_berkah.php";	break;

				case 'DataWaiting_Marwa' :
					if(!file_exists ("../modul/90/datawaiting_rahmah.php")) die ("Sorry Empty Page!");
					include "../modul/90/datawaiting_rahmah.php";	break;

					case 'DataWaiting_Incentive' :
						if(!file_exists ("../modul/90/datawaiting_incentive.php")) die ("Sorry Empty Page!");
						include "../modul/90/datawaiting_incentive.php";	break;



		case 'APMonitor' :
			if(!file_exists ("../modul/90/apmonitor.php")) die ("Sorry Empty Page!");
			include "../modul/90/apmonitor.php";	break;
        	case 'WebPerform' :
			if(!file_exists ("../modul/90/website.php")) die ("Sorry Empty Page!");
			include "../modul/90/website.php";	break;
		case 'UsrMonitor' :
			if(!file_exists ("../modul/90/usermonitor.php")) die ("Sorry Empty Page!");
			include "../modul/90/usermonitor.php";	break;
		case 'CustFolio' :
			if(!file_exists ("../modul/90/customerfolio.php")) die ("Sorry Empty Page!");
			include "../modul/90/customerfolio.php";	break;
		case 'CompRev' :
			if(!file_exists ("../modul/90/competition.php")) die ("Sorry Empty Page!");
			include "../modul/90/competition.php";	break;
    case 'Channel180' :
			if(!file_exists ("../modul/180/channel.php")) die ("Sorry Empty Page!");
			include "../modul/180/channel.php";	break;
        case '180' :
			if(!file_exists ("../modul/180/priceanalysis.php")) die ("Sorry Empty Page!");
			include "../modul/180/priceanalysis.php";	break;
		case 'Analysisdata' :
			if(!file_exists ("../modul/180/analysisdata.php")) die ("Sorry Empty Page!");
			include "../modul/180/analysisdata.php";	break;


# 270 menu konten


		case '270' :
			if(!file_exists ("../modul/270/management_user.php")) die ("Sorry Empty Page!");
			include "../modul/270/management_user.php";	break;

# kontrol travel
case 'Travel' :
  if(!file_exists ("../modul/270/travel.php")) die ("Sorry Empty Page!");
  include "../modul/270/travel.php";	break;

case 'Travel-Add' :
    if(!file_exists ("../modul/270/travel_add.php")) die ("Sorry Empty Page!");
    include "../modul/270/travel_add.php";	break;

    case 'Travel-Delete' :
        if(!file_exists ("../modul/270/travel_delete.php")) die ("Sorry Empty Page!");
        include "../modul/270/travel_delete.php";	break;
	#control menu packages
        case 'Packages' :
			if(!file_exists ("../modul/270/packages.php")) die ("Sorry Empty Page!");
			include "../modul/270/packages.php";	break;
		case 'Packages_Delete' :
			if(!file_exists ("../modul/270/packages_delete.php")) die ("Sorry Empty Page!");
			include "../modul/270/packages_delete.php";	break;
		case 'Packages_Add' :
			if(!file_exists ("../modul/270/packages_add.php")) die ("Sorry Empty Page!");
			include "../modul/270/packages_add.php";	break;

			case 'Packages_Edit' :
				if(!file_exists ("../modul/270/packages_edit.php")) die ("Sorry Empty Page!");
				include "../modul/270/packages_edit.php";	break;


	#itenenary upload data
	case 'itenenary':
	if(!file_exists ("../modul/270/itenenary.php")) die ("Sorry Empty Page!");
	include "../modul/270/itenenary.php";	break;
	case 'itenenary-Add':
	if(!file_exists ("../modul/270/itenenary_add.php")) die ("Sorry Empty Page!");
	include "../modul/270/itenenary_add.php";	break;


			case 'News_All' :
				if(!file_exists ("../modul/90/news_all.php")) die ("Sorry Empty Page!");
				include "../modul/90/news_all.php";	break;

			#control menu push news
			case 'News' :
				if(!file_exists ("../modul/270/news.php")) die ("Sorry Empty Page!");
				include "../modul/270/news.php";	break;
				case 'News-Add' :
					if(!file_exists ("../modul/270/news_add.php")) die ("Sorry Empty Page!");
					include "../modul/270/news_add.php";	break;
					case 'News-Delete' :
						if(!file_exists ("../modul/270/news_delete.php")) die ("Sorry Empty Page!");
						include "../modul/270/news_delete.php";	break;

	#control menu user
		 case 'User' :
			if(!file_exists ("../modul/270/user.php")) die ("Sorry Empty Page!");
			include "../modul/270/user.php";	break;
		case 'User_Delete' :
			if(!file_exists ("../modul/270/user_delete.php")) die ("Sorry Empty Page!");
			include "../modul/270/user_delete.php";	break;
		case 'User_Add' :
			if(!file_exists ("../modul/270/user_add.php")) die ("Sorry Empty Page!");
			include "../modul/270/user_add.php";	break;
		case 'User-Edit' :
			if(!file_exists ("../modul/270/user_edit.php")) die ("Sorry Empty Page!");
			include "../modul/270/user_edit.php";	break;
    #control menu perlengkapan

	case 'Equipment' :
		if(!file_exists ("../modul/270/equipment.php")) die ("Sorry Empty Page!");
			include "../modul/270/equipment.php";	break;
	case 'Equipment-Delete' :
		if(!file_exists ("../modul/270/equipment_delete.php")) die ("Sorry Empty Page!");
			include "../modul/270/equipment_delete.php";	break;
	case 'Equipment-Add' :
		if(!file_exists ("../modul/270/equipment_add.php")) die ("Sorry Empty Page!");
			include "../modul/270/equipment_add.php";	break;
	case 'Equipment-Edit' :
		if(!file_exists ("../modul/270/equipment_edit.php")) die ("Sorry Empty Page!");
			include "../modul/270/equipment_edit.php";	break;


			# 360 menu konten


					case '360' :
						if(!file_exists ("../modul/360/website.php")) die ("Sorry Empty Page!");
						include "../modul/360/website.php";	break;

            case 'sms' :
  						if(!file_exists ("../modul/360/sms_gateway.php")) die ("Sorry Empty Page!");
  						include "../modul/360/sms_gateway.php";	break;


						case 'Monitor-Agent' :
							if(!file_exists ("../modul/360/monitor_agent.php")) die ("Sorry Empty Page!");
							include "../modul/360/monitor_agent.php";	break;


		// case '90' :
		//	if(!file_exists ("index.php")) die ("Sorry Empty Page!");
		//	include "index.php";	break;

		case 'Logout' :
			if(!file_exists ("logout.php")) die ("Sorry Empty Page!");
			include "logout.php"; break;
		case 'Menu' :
			if(!file_exists ("menu.php")) die ("Sorry Empty Page!");
			include "menu.php";	break;
		case 'Admin' :
			if(!file_exists ("admin.php")) die ("Sorry Empty Page!");
			include "admin.php";	break;

		default:
			if(!file_exists ("main.php")) die ("Empty Main Page!");
			include "main.php";
		break;
	}
}
else {
	// Jika tidak mendapatkan variabel URL : ?page
	if(!file_exists ("welcome.php")) die ("Empty Main Page!");
	include "welcome.php";
}
?>
