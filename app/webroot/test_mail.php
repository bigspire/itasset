<?php
error_reporting(1);
ini_set('display_errors', 1);
$to      = 'contact@bigspire.com';
$subject = ' created attendance change request (No Action Required)!';
$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
	<title>Emails/html</title>
</head>
<body>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body style="margin:0; padding:0; background:#e1e1e1;">

<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" style="border:2px solid #fff; background:#fff; margin-bottom:40px">
  <tr style="background:#438eb9;">
    <td width="436" height="80" style="padding-left:20px;"><img src="http://mypdca.in/img/logo2.png" border="0"  /></td>
    <td width="269" align="right" style="padding-right:20px;"></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="490" valign="top"  style="padding:0 20px;"><h1 style="font:bold 15px Arial, Helvetica, sans-serif; color:#676767; margin:0 0 10px 0;">Dear Philip Joshua Assey,</h1>
          <p style="font:13px Arial, Helvetica, sans-serif; color:#676767; margin:0;">You have received a change attendance request  from Ravichandran J. Please login to My PDCA and update the status of the request.</p><br />

          <p style="font:bold 13px Arial, Helvetica, sans-serif; color:#676767; margin:0;">Below are the change attendance details,</p>
          <table width="100%" border="0" cellspacing="2" cellpadding="10" style="border:1px solid #ededed; font:bold 13px Arial, Helvetica, sans-serif; color:#6f6e6e; margin:10px 0 20px 0;">
          
            <tr style="background:#f5f4f4;">
			  <td>Employee</td>
              <td style="color:#2a2a2a;">Ravichandran J</td>
              <td width="100">Date</td>
              <td style="color:#2a2a2a;"><div class="cake-debug-output">
<span><strong>/app/View/Helper/FunctionsHelper.php</strong> (line <strong>8</strong>)</span>
<pre class="cake-debug">
array()
</pre>
</div>22-May-2014</td>            
            </tr>
			
			
			<tr style="background:#f5f4f4;">
              <td>Type</td>
              <td   colspan="3" style="color:#2a2a2a;">Both</td>
            
            </tr>		
			 
           
		   
			<tr style="background:#f5f4f4;">
              <td>In Time</td>
              <td   colspan="3" style="color:#2a2a2a;">02:00 PM</td>
            </tr>
						
			  
			
			 <tr style="background:#f5f4f4;">
              <td>Out Time</td>
              <td   colspan="3" style="color:#2a2a2a;">07:00 PM</td>            
            </tr>
						
			
			 <tr style="background:#f5f4f4;">
              <td>Reason</td>
              <td   colspan="3" style="color:#2a2a2a;">testing pls..</td>
            
            </tr>
			
			
          </table>
        
</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
 <tr>
    <td height="80" colspan="2" valign="top" bgcolor="#ededed" style="font:normal 12px Arial, Helvetica, sans-serif; color:#6f6e6e; padding:0 20px">
    <p >Note: This is system generated mail. Please do not reply to this email ID. if you have a query or need 
any clarification you may
email us.  <a href="mailto:hrd@ceotalentsearch.com" style="color:#e56712;">hrd@ceotalentsearch.com</a> 
</p>
    </td>
  </tr>
</table>
</body>
</html>
	
</body>
</html>
';
//$headers = 'From: noreply@mypdca.in' . "\r\n" .
//'Reply-To: testing@bigspire.com' . "\r\n"; 
    

if(mail($to, $subject, $message)){
	echo 'mail sent';
}else{
	echo 'problem in sending mail to'. $to;
}

$to      = 'ravi@bigspire.com';

if(mail($to, $subject, $message, $headers)){
	echo 'mail sent';
}else{
	echo 'problem in sending mail to'. $to;
}
?>