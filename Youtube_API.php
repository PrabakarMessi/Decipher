<?php
    //Enter Your Channel Name
    $channel_name="lineesha";
    //Enter Your ID
    $channel="UCU3ez7HzvxeRP7W8W08evlA";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $channel_name;?>'s Channel by Prabakar</title>
</head>
<body>
    <div >
        <div >
            <div class="title">
                <h2><?php echo $channel_name;?>'s Channel</h2>
            </div>
            <ul >
            <?php
                          
                $feedURL=urlencode('https://gdata.youtube.com/feeds/api/videos?author='.$channel.'&start-index=1&max-results=2&orderby=published');
                if (@simplexml_load_file($feedURL))
                {
                    $sxml = simplexml_load_file($feedURL);
                    $counts = $sxml->children('http://a9.com/-/spec/opensearchrss/1.0/');
                    $total = $counts->totalResults;
                    foreach ($sxml->entry as $entry) {
                    $media = $entry->children('http://search.yahoo.com/mrss/');
                    $attrs = $media->group->player->attributes();
                    $watch = $attrs['url'];        
                    $yt = $media->children('http://gdata.youtube.com/schemas/2007');
                    $attrs = $yt->duration->attributes();
                    $length = $attrs['seconds'];  
                    $minute=floor($length/60);
                    $second=$length-$minute*60;        
                    $gd = $entry->children('http://schemas.google.com/g/2005');
                    if ($gd->rating) {
                          $attrs = $gd->rating->attributes();
                          $rating = $attrs['average'];
                    } else {
                          $rating = 0;
                    }
                    $attrs = $media->group->thumbnail[1]->attributes();
                    
                    ?>
                        <li style="border-bottom:1px solid #000; list-style:none; padding:20px;">
                            <div>
                                <a href="<?php echo $watch;?>"><img src="<?php echo $attrs['url'];?>" /></a>
                                <h3><?php echo $media->group->title;?></h3>
                                <span>Duration : <?php echo $minute.':'.$second?></span><br />
                                <span>Published Date : <?php echo date('d M, Y',strtotime($entry->updated));?></span>
                            </div>
                        </li>
                <?php }?>
            </ul>
            <?php } ?>
            <div class="clear">&nbsp;</div>
        </div>
        <div class="clear">&nbsp;</div>
    </div>
</body>
</html>
<!--This API is under licesed -->
