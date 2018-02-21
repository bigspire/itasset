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
          <p style="font:13px Arial, Helvetica, sans-serif; color:#676767; margin:0;"><span style="font:bold 14px Arial;color:#08D14B;">Congratulation!</span> Your ticket for the travel (<?php echo $tvl_id; ?>)  has been booked successfully by <?php echo $from_name; ?>. Please find the attached ticket copy. </p><br />

          <p style="font:bold 13px Arial, Helvetica, sans-serif; color:#676767; margin:0;">Below are the travel details,</p>
          <table width="100%" border="0" cellspacing="2" cellpadding="10" style="border:1px solid #ededed; font:bold 13px Arial, Helvetica, sans-serif; color:#6f6e6e; margin:10px 0 20px 0;">
          
            <tr   style="background:#f5f4f4;">
			  <td width="100">Journey Date</td>
			  <?php if($tvl_type == 'return'):
			  $journey_date = $return_date;
			  else:
			  $journey_date = $start_date;
			  endif;
			  ?>
              <td style="color:#2a2a2a;"><?php echo $this->Functions->format_date($journey_date);?></td>
              <td>Place</td>
			    <?php if($tvl_type == 'return'):
			  $journey_place = $dest_place.' to '.$start_place;
			  else:
			  $journey_place = $start_place.' to '.$dest_place;
			  endif;
			  ?>
			  
              <td style="color:#2a2a2a;"><?php echo $journey_place;?></td>
            </tr>
			
			
			
			<tr>
			  <td>Purpose</td>			 
			  
              <td style="color:#2a2a2a;"><?php echo $purpose;?></td>
			  
			   <td>Ticket Fare</td>		 
			  
              <td style="color:#2a2a2a;">Rs.<?php echo $amount;?></td>
			  
			</tr>
			
			
          </table>
		  
		  <p style="font:bold 13px Arial, Helvetica, sans-serif; color:#676767; margin:0;">Below are the passenger details,</p>
          <table width="100%" border="0" cellspacing="2" cellpadding="10" style="border:1px solid #ededed; font:bold 12px Arial, Helvetica, sans-serif; color:#6f6e6e; margin:10px 0 20px 0;">
          
            <tr style="background:#f5f4f4;">
											<th>Name</th>
											<th class="">Age</th>
											<th class="">Gender</th>
											<th class="">Mobile</th>
												<th class="">Email</th>
													<th class="">Id Card</th>
														<th class="">Id No.</th>
            </tr>
			
		
			
			
			<?php foreach($tvl_person as $key => $person):?>		
										<tr style="font-weight:normal;">
							<td><?php echo $person['TvlPassenger']['passenger'];?></td>
							<td class="hidden-350"><?php echo $person['TvlPassenger']['age'];?></td>
							<td class="hidden-1024"><?php echo $this->Functions->show_gender($person['TvlPassenger']['gender']);?></td>
							<td class="hidden-480"><?php echo $person['TvlPassenger']['mobile'];?></td>
							<td class="hidden-480"><?php echo $person['TvlPassenger']['email_id'];?></td>
							<td class="hidden-480"><?php echo $person['TvlIdType']['title'];?></td>
							<td class="hidden-480"><?php echo $person['TvlPassenger']['id_no'];?></td>
							</tr>
							<?php endforeach; ?>
			
			
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
email us.  <a href="mailto:support@career-tree.in" style="color:#e56712;">support@career-tree.in</a> 
</p>
    </td>
  </tr>
</table>
</body>
</html>
