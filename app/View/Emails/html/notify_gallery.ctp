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
          <p style="font:13px Arial, Helvetica, sans-serif; color:#676767; margin:0;">Gallery request is <?php echo $status;?> by <?php echo ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')); ?>. Please login to My PDCA and check the status of the request.</p><br />

          <p style="font:bold 13px Arial, Helvetica, sans-serif; color:#676767; margin:0;">Below are the posted gallery details,</p>
          <table width="100%" border="0" cellspacing="2" cellpadding="10" style="border:1px solid #ededed; font:bold 13px Arial, Helvetica, sans-serif; color:#6f6e6e; margin:10px 0 20px 0;">
          
              <tr style="background:#f5f4f4;">
              <td width="100">Employee</td>
              <td   colspan="3" style="color:#2a2a2a;"><?php echo $employee;?></td>
            
            </tr>
			
			<tr style="background:#f5f4f4;">
              <td>Gallery Title</td>
              <td   colspan="3" style="color:#2a2a2a;"><?php echo $title;?></td>
            
            </tr>
			
			 <tr style="background:#f5f4f4;">
              <td>Description</td>
              <td   colspan="3" style="color:#2a2a2a;"><?php echo $desc;?></td>
            
            </tr>
			
		
			
			<?php if(!empty($remarks)) :?>
			 <tr style="background:#f5f4f4;">
              <td>
			  Remarks (Reject):</td>
              <td   colspan="3" style="color:#2a2a2a;"><?php echo $remarks;?></td>            
            </tr>
			<?php endif; ?>
			
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
email us.  <a href="mailto:finance@career-tree.in" style="color:#e56712;">hr@career-tree.in</a> 
</p>
    </td>
  </tr>
</table>
</body>
</html>
