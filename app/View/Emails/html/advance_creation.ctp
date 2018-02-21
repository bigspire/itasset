<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body style="margin:0; padding:0; background:#e1e1e1;">

<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" style="border:2px solid #fff; background:#fff; margin-bottom:40px">
  <tr style="background:#438eb9;">
    <td width="436" height="80" style="padding-left:20px;"><img src="<?php echo Configure::read('WEBSITE').$this->webroot; ?>img/logo2.png" border="0"  /></td>
    <td width="269" align="right" style="padding-right:20px;"></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="490" valign="top"  style="padding:0 20px;"><h1 style="font:bold 15px Arial, Helvetica, sans-serif; color:#676767; margin:0 0 10px 0;">Dear <?php echo ucwords($name); ?>,</h1>
          <p style="font:13px Arial, Helvetica, sans-serif; color:#676767; margin:0;">You have received a advance request  from <?php echo $from_name; ?>. Please login to My PDCA and update the status of the request.</p><br />

          <p style="font:bold 13px Arial, Helvetica, sans-serif; color:#676767; margin:0;">Below are the advance request details,</p>
          <table width="100%" border="0" cellspacing="2" cellpadding="10" style="border:1px solid #ededed; font:bold 13px Arial, Helvetica, sans-serif; color:#6f6e6e; margin:10px 0 20px 0;">
          
            <tr style="background:#f5f4f4;">
			  <td>Employee</td>
              <td style="color:#2a2a2a;"><?php echo $from_name;?></td>
              <td>Amount</td>
              <td style="color:#2a2a2a;">Rs. <?php echo $amt;?></td>
			              
            </tr>
            <tr style="background:#f5f4f4;">              
              <td>Required Date</td>
              <td style="color:#2a2a2a;"><?php echo $this->Functions->format_date($req_date);?></td>	  
			  <td>Debit to Client</td>
              <td style="color:#2a2a2a;"><?php echo $this->Functions->debit_client($client);?></td>
            </tr>
			
			 <tr style="background:#f5f4f4;">
              <td>Purpose</td>
              <td   colspan="3" style="color:#2a2a2a;"><?php echo $purpose;?></td>            
            </tr>
			
            <tr style="background:#f5f4f4;">
              <td>Description</td>
              <td   colspan="3" style="color:#2a2a2a;"><?php echo $desc;?></td>
            
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
email us.  <a href="mailto:finance@career-tree.in" style="color:#e56712;">finance@career-tree.in</a> 
</p>
    </td>
  </tr>
</table>
</body>
</html>
