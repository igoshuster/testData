<?php   
session_start();    
include 'apanel/funcs.php';


  if($_POST['token'] == $_SESSION['check_key'])
  { 	 
	  if($_POST['formtype'] == 'sendmail')
	  {		
		$email = filter_string($_POST['uemail']);
		$phone = filter_string($_POST['uphone']);
		$textmess = filter_string($_POST['umsg']);
		$clmessage=	'';	
		
		if(!empty($email) && !empty($textmess)) 
		{
			$email_validate = filter_var($email, FILTER_VALIDATE_EMAIL); 
			if($email_validate)
			{
				$clmessage="<table width='100%' height='100%' cellpadding='0' cellspacing='0' style='min-width:348px' border='0'>		
<tbody><tr><td height='32px' bgcolor='#f3f3f3' style='background-color:#f3f3f3;'>&nbsp;</td></tr>
<tr align='center'><td bgcolor='#f3f3f3' style='background-color:#f3f3f3;'>
				
<table border='0' cellspacing='0' cellpadding='0' width='600' style='max-width:600px;min-width:220px;width:600px;'>
<tbody><tr><td align='center' valign='top'>

<table cellspacing='0' cellpadding='0' border='0' width='100%'>				
<tbody><tr><td align='left' valign='top' bgcolor='#ffffff' style='background-color:#ffffff;'>

<table border='0' cellspacing='0' cellpadding='0' width='83.3%' style='border-collapse:collapse;border-spacing:0;margin:0 auto;min-width:83.3%;'>
<tbody><tr><td height='32px' colspan='2'>&nbsp;</td></tr><tr><td>Укладка плитки в Могилеве. - Plitochniki.by</td><td align='right' valign='top'>
<img src='http://ainoi.by/img/logo-inverse.png' border='0' width='214px' height='77px' alt='Plitochniki.by'>
</td></tr></tbody></table>";
				$clmessage.="<table border='0' cellspacing='0' cellpadding='0' align='center' width='83.3%' style='border-collapse:collapse;border-spacing:0;margin:0 auto;min-width:83.3%;color:#888888;font-family:Arial,sans-serif;font-size:14px;line-height:23px;'>
<tbody><tr><td height='30' colspan='2'></td></tr>";		  
							
				if($phone) $clmessage.= "<tr><td width='120px'><strong>Телефон:</strong></td><td> ".$phone."</td></tr>";
				if($email) $clmessage.= "<tr><td width='120px'><strong>Email:</strong></td><td> ".$email."</td></tr>";				
				if($textmess) $clmessage.= "<tr><td colspan='2'><strong>Комментарий: </strong></td></tr><tr><td colspan='2'>".$textmess."</td></tr>";				         
				$clmessage.= "</tbody></table>";
				$clmessage.="<table border='0' cellspacing='0' cellpadding='0' width='83.3%' style='border-collapse:collapse;border-spacing:0;margin:0 auto;min-width:83.3%;'>
				<tbody>									
				<tr><td height='32px' colspan='2'>&nbsp;</td></tr>				
				</tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr>
				<tr><td height='32px' bgcolor='#f3f3f3' style='background-color:#f3f3f3;'>&nbsp;</td></tr></tbody></table>";

				$subject='Новое сообщение с сайта Plitochniki.by';   
				$subj='=?utf-8?B?'.base64_encode($subject).'?=';            
				$to= INFO_EMAIL;   
				$headers  = 'MIME-Version: 1.0' . "\r\n";				
				$headers.="Content-type: text/html; charset=utf-8 \r\n";  
				$headers.='From: '.$email_validate. "\r\n";  				
					
					 if(stripos($textmess,'www.'))
					{
						$status = ''; 
						$mess = '';  
					}
					else
					{						
						 if(mail($to,$subj,$clmessage,$headers))
						{   
							$status = 'success'; 
							$mess = WELLDONE;    
						}     
						else   
						{         
							$status = 'error'; 
							$mess = CRITICAL_ERROR;             
						}
					}				
			}
			else
			{
			  $status = 'error';      
				$mess = ERR_INVALID_EMAIL;
			}			
		}
		else
		{
		    $status = 'error';      
			$mess = ERR_MANDATORY_NOT_FILLED;
		}			
	  }
	 else
	 {
		$status = 'error';      
		$mess = 'Suspicious activity';
	 }
  } 
  else
  {
    $status = 'error';      
    $mess = 'Invalid Parameter 22';      
  }      
  
  $data = array(     
        'status' => $status, 
        'message' => $mess				
    );      
  echo json_encode($data);        
   exit; 