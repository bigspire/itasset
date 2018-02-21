<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body style="margin:0; padding:0; background:#e1e1e1;">

<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" style="border:2px solid #fff; background:#fff; margin-bottom:40px">
  <tr style="background:#438eb9;">
    <td width="436" height="80" style="padding-left:20px;"><img src="<?php echo Configure::read('WEBSITE');?>img/logo2.png" border="0"  /></td>
    <td width="269" align="right" style="padding-right:20px;"></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="490" valign="top"  style="padding:0 20px;"><h1 style="font:bold 15px Arial, Helvetica, sans-serif; color:#676767; margin:0 0 10px 0;">Dear <b><?php echo ucwords($name); ?>,</h1>
          <p style="font:13px Arial, Helvetica, sans-serif; color:#676767; margin:0;">You havn't marked your attendance for the below days.
 Please login to MyPDCA and create attendance change request for the below missed dates.</p><br />

 <table cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td align="center" width="150" height="40" bgcolor="#438eb9" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; 
display: block;"><a href="<?php echo Configure::read('WEBSITE');?>" style="color: #ffffff; font-size: 16px; font-weight: bold; font-family: Helvetica,
 Arial, sans-serif; text-decoration: none; line-height: 40px; width: 100%; display: inline-block;">My PDCA Login</a></td>
</tr>
</tbody>
</table>
 
 
          <table width="100%" border="0" cellspacing="2" cellpadding="10" style="border:1px solid #ededed; font:bold 13px Arial, Helvetica, sans-serif; color:#6f6e6e; margin:10px 0 20px 0;">
          
          
          
            
			
			 <tr style="background:#f5f4f4;">
			  <td width="60">S. No</td>
              <td width="300">Date</td>
             
             </tr>
			 
			 
			<?php foreach($attendance as $key => $data):?>
           
			 
				 <tr style="background:#f5f4f4;">
			  <td width="60" style="color:#2a2a2a;"><?php echo ++$key;?> </td>
              <td width="300" style="color:#2a2a2a;"><?php echo $this->Functions->format_date($data);?></td>
             
            
            </tr>
			
            
          <?php endforeach; ?>
		
			
			
          </table>
        
</td>
      </tr>
    </table></td>
  </tr>
 
  <tr>
    <td height="80" colspan="2" valign="top" bgcolor="#ededed" style="font:normal 12px Arial, Helvetica, sans-serif; color:#6f6e6e; padding:0 20px">
    <p >Note: This is system generated mail. Please do not reply to this email ID. if you have a query or need 
any clarification you may
email us.  <a href="mailto:hr@career-tree.in" style="color:#e56712;">hr@career-tree.in</a> 
</p>
    </td>
  </tr>
</table>
</body>
</html>
