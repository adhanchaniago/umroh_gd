<?php
# KONTROL MENU PROGRAM
if($_GET) {
	// Jika mendapatkan variabel URL ?page
	switch($_GET['page']){
		case '' :
			if(!file_exists ("welcome_agent.php")) die ("Empty Main Page!");
			include "welcome_agent.php";	break;

		case 'Halaman-Utama' :
			if(!file_exists ("welcome_agent.php")) die ("Sorry Empty Page!");
			include "welcome_agent.php";	break;


	#Agent - Menu Booking Online
		case 'Berkah-Agent' :
			if(!file_exists ("../modul/agent/supersaver_agent.php")) die ("Sorry Empty Page!");
			include "../modul/agent/supersaver_agent.php";	break;
	case 'input_jamaah' :
				if(!file_exists ("../modul/agent/input_jamaah.php")) die ("Sorry Empty Page!");
				include "../modul/agent/input_jamaah.php";	break;



				#preview data umroh
				case 'Detail-Umroh' :
					if(!file_exists ("../modul/agent/detailumroh.php")) die ("Sorry Empty Page!");
					include "../modul/agent/detailumroh.php";	break;

				#waiting
				case 'Waiting' :
					if(!file_exists ("../modul/agent/waiting.php")) die ("Sorry Empty Page!");
					include "../modul/agent/waiting.php";	break;

				case 'Waiting_Choice' :
						if(!file_exists ("../modul/agent/waitingchoice.php")) die ("Sorry Empty Page!");
						include "../modul/agent/waitingchoice.php";	break;

						case 'DataWaiting' :
							if(!file_exists ("../modul/agent/datawaiting_super.php")) die ("Sorry Empty Page!");
							include "../modul/agent/datawaiting_super.php";	break;



							case 'Invoice_Berkah' :
								if(!file_exists ("../modul/agent/invoice_berkah.php")) die ("Sorry Empty Page!");
								include "../modul/agent/invoice_berkah.php";	break;

								case 'Channel_Payment' :
									if(!file_exists ("../modul/agent/channel_agent.php")) die ("Sorry Empty Page!");
									include "../modul/agent/channel_agent.php";	break;

									case 'Input_Waiting' :
										if(!file_exists ("../modul/agent/input_waiting.php")) die ("Sorry Empty Page!");
										include "../modul/agent/input_waiting.php";	break;

										case 'Input_Agent_Booking' :
											if(!file_exists ("../modul/agent/input_agent_booking.php")) die ("Sorry Empty Page!");
											include "../modul/agent/input_agent_booking.php";	break;


#data jamaah
#DataJamaahBerkah
case 'DataJamaahBerkah' :
	if(!file_exists ("../modul/agent/datajamaahberkah.php")) die ("Sorry Empty Page!");
	include "../modul/agent/datajamaahberkah.php";	break;


	#90 - edit data jamaah
	case 'edit_jamaah' :
		if(!file_exists ("../modul/agent/edit_jamaah.php")) die ("Sorry Empty Page!");
		include "../modul/agent/edit_jamaah.php";	break;

			#Document

					case 'Document' :
						if(!file_exists ("../modul/agent/dokumen.php")) die ("Sorry Empty Page!");
						include "../modul/agent/dokumen.php";	break;

					case 'View_Document' :
						if(!file_exists ("../modul/agent/view_dokumen.php")) die ("Sorry Empty Page!");
						include "../modul/agent/view_dokumen.php";	break;

					case 'Add_Document' :
							if(!file_exists ("../modul/agent/add_dokumen.php")) die ("Sorry Empty Page!");
							include "../modul/agent/add_dokumen.php";	break;

							case 'Document_Personal_Berkah' :
									if(!file_exists ("../modul/agent/document_personal_berkah.php")) die ("Sorry Empty Page!");
									include "../modul/agent/document_personal_berkah.php";	break;


			case 'Agent' :
				if(!file_exists ("../modul/agent/dashboard.php")) die ("Sorry Empty Page!");
				include "../modul/agent/dashboard.php";	break;
				case 'News_All' :
					if(!file_exists ("../modul/agent/news_all.php")) die ("Sorry Empty Page!");
					include "../modul/agent/news_all.php";	break;


						#Rahmah
						case 'News_All_Rahmah' :
							if(!file_exists ("../modul/agent_rahmah/news_all.php")) die ("Sorry Empty Page!");
							include "../modul/agent_rahmah/news_all.php";	break;

						case 'Rahmah_Agent' :
							if(!file_exists ("../modul/agent_rahmah/rahmah.php")) die ("Sorry Empty Page!");
							include "../modul/agent_rahmah/rahmah.php";	break;

              case 'input_jamaah_rahmah' :
      							if(!file_exists ("../modul/agent_rahmah/input_jamaah.php")) die ("Sorry Empty Page!");
      							include "../modul/agent_rahmah/input_jamaah.php";	break;

							// case 'Incentive' :
							// 	if(!file_exists ("../modul/agent/gold.php")) die ("Sorry Empty Page!");
							// 	include "../modul/agent/gold.php";	break;

								case 'DataWaiting_rahmah' :
									if(!file_exists ("../modul/agent_rahmah/datawaiting_super.php")) die ("Sorry Empty Page!");
									include "../modul/agent_rahmah/datawaiting_super.php";	break;

					case 'Input_Agent_Booking_Rahmah' :
						if(!file_exists ("../modul/agent_rahmah/input_agent_booking.php")) die ("Sorry Empty Page!");
						include "../modul/agent_rahmah/input_agent_booking.php";	break;

						case 'Document_Personal_Rahmah' :
								if(!file_exists ("../modul/agent/document_personal_rahmah.php")) die ("Sorry Empty Page!");
								include "../modul/agent/document_personal_rahmah.php";	break;


								case 'View_Document_Rahmah' :
									if(!file_exists ("../modul/agent_rahmah/view_dokumen.php")) die ("Sorry Empty Page!");
									include "../modul/agent_rahmah/view_dokumen.php";	break;

									case 'Add_Document_Rahmah' :
											if(!file_exists ("../modul/agent_rahmah/add_dokumen.php")) die ("Sorry Empty Page!");
											include "../modul/agent_rahmah/add_dokumen.php";	break;

											case 'Invoice_Rahmah' :
												if(!file_exists ("../modul/agent_rahmah/invoice_rahmah.php")) die ("Sorry Empty Page!");
												include "../modul/agent_rahmah/invoice_rahmah.php";	break;


			#DataJamaahBerkah
			case 'DataJamaahRahmah' :
				if(!file_exists ("../modul/agent_rahmah/datajamaahberkah.php")) die ("Sorry Empty Page!");
				include "../modul/agent_rahmah/datajamaahberkah.php";	break;



        #Incentive
        case 'News_All_Incentive' :
          if(!file_exists ("../modul/agent_incentive/news_all.php")) die ("Sorry Empty Page!");
          include "../modul/agent_incentive/news_all.php";	break;

        case 'Rahmah_Agent' :
          if(!file_exists ("../modul/agent_rahmah/rahmah.php")) die ("Sorry Empty Page!");
          include "../modul/agent_rahmah/rahmah.php";	break;

          case 'Incentive_Agent' :
            if(!file_exists ("../modul/agent_incentive/incentive.php")) die ("Sorry Empty Page!");
            include "../modul/agent_incentive/incentive.php";	break;

            case 'input_jamaah_Incentive' :
                  if(!file_exists ("../modul/agent_incentive/input_jamaah.php")) die ("Sorry Empty Page!");
                  include "../modul/agent_incentive/input_jamaah.php";	break;

      case 'DataWaiting_Incentive' :
        if(!file_exists ("../modul/agent_incentive/datawaiting_super.php")) die ("Sorry Empty Page!");
        include "../modul/agent_incentive/datawaiting_super.php";	break;

        case 'Input_Agent_Booking_Incentive' :
          if(!file_exists ("../modul/agent_incentive/input_agent_booking.php")) die ("Sorry Empty Page!");
          include "../modul/agent_incentive/input_agent_booking.php";	break;

          #DataJamaahBerkah
    			case 'DataJamaahIncentive' :
    				if(!file_exists ("../modul/agent_incentive/datajamaahberkah.php")) die ("Sorry Empty Page!");
    				include "../modul/agent_incentive/datajamaahberkah.php";	break;


            case 'View_Document_Incentive' :
              if(!file_exists ("../modul/agent_incentive/view_dokumen.php")) die ("Sorry Empty Page!");
              include "../modul/agent_incentive/view_dokumen.php";	break;

              case 'Add_Document_Incentive' :
                  if(!file_exists ("../modul/agent_incentive/add_dokumen.php")) die ("Sorry Empty Page!");
                  include "../modul/agent_incentive/add_dokumen.php";	break;

                  case 'Invoice_Incentive' :
                    if(!file_exists ("../modul/agent_incentive/invoice_incentive.php")) die ("Sorry Empty Page!");
                    include "../modul/agent_incentive/invoice_incentive.php";	break;


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
			if(!file_exists ("main_agent.php")) die ("Empty Main Page!");
			include "main_agent.php";
		break;
	}
}
else {
	// Jika tidak mendapatkan variabel URL : ?page
	if(!file_exists ("welcome_agent.php")) die ("Empty Main Page!");
	include "welcome_agent.php";
}
?>
