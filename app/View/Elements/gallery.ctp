<?php foreach($gallery_data as $gak_key => $gallery):?>	
		
<?php if($gak_key > 0): $galmargin = 'margin:13px 0px 5px 0px;'; else: $galmargin = 'margin:0px 0px 5px 0px;'; endif;?>		
<div style="<?php echo $galmargin;?>">
<div style="float:left;width:83%;">
<b><?php echo ucwords($gallery['HrGallery']['title']); ?></b> - <?php echo $gallery['HrGallery']['desc']; ?>
</div>


<div>
<span class="widget-toolbar no-border" style="color:#db5e8c;line-height:normal;margin-bottom:5px;" >
<span  style="color:#438EB9;margin-right:10px;"><i title="Likes" class="icon-thumbs-up bigger-110"></i>
				<a href="#"  rel="tooltip" data-placement="bottom"  title="<?php echo $gallery_item[$gallery['HrGallery']['id']][4] ? $gallery_item[$gallery['HrGallery']['id']][4] : 'Be the first to like!';?>" style="color:#438EB9;"><?php echo $gallery_item[$gallery['HrGallery']['id']][3];?></a></span>
				<?php 
				
				if(!$gallery_item[$gallery['HrGallery']['id']][1]):				
				$margin = '10px';
				else:
				$margin2 = '10px';
				$margin = '';
				endif;
				
				?>
				<span  style="color:#FAB451;margin-right:<?php echo $margin;?>"><i title="Comments" class="icon-comments bigger-110"></i>
				<a href="#" rel="tooltip" data-placement="bottom"  title="<?php echo $gallery_item[$gallery['HrGallery']['id']][2] ? $gallery_item[$gallery['HrGallery']['id']][2] : 'Be the first to comment!';?>" style="color:#FAB451;"><?php echo $gallery_item[$gallery['HrGallery']['id']][1];?></a></span>
				<?php if($gallery_item[$gallery['HrGallery']['id']][1] > 0):?>
				<span style="margin-right:<?php echo $margin2;?>"><a val="40_60" class="iframeBox" href="<?php echo $this->webroot;?>home/view_gal_comments/<?php echo $gallery['HrGallery']['id'];?>/"><i rel="tooltip" title="View Comments" data-placement="bottom"  class="click_hide icon-eye-open"></i></a></span>
				<?php endif; ?>
				<i class="icon-time bigger-110" title="Posted"></i>
				<?php echo $this->Functions->time_diff($gallery['HrGallery']['created_date'], 1);?>
																</span>
											</div>
																</div>
	

					
<ul class="bxslider<?php echo ++$gak_key;?>" style="margin-left:0px;">
	<?php foreach($gallery_item[$gallery['HrGallery']['id']][0] as $key =>  $item):  ?>
<li>
<a href="<?php echo $this->webroot;?>home/view_gallery/<?php echo $gallery['HrGallery']['id'];?>/<?php echo $item['HrGalleryItem']['id'];?>/" class="iframeBox"  val="85_98">	
<img  src="<?php echo $this->webroot;?>timthumb.php?src=file_upload/server/php/<?php echo $gallery['HrGallery']['folder'].'/'.$item['HrGalleryItem']['file'];?>&w=250&h=200&q=100"/>
</a>
</li> 
      <?php endforeach; ?> 
	  </ul>

	<input type="hidden" id="gal_ID<?php echo $gak_key;?>" value=""/>

	<?php endforeach;?>
	<input type="hidden"  class="bxslider"  id="galCount" value="<?php echo count($gallery_data);?>"/>