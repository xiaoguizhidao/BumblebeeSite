<?php
session_start();
$session_id=session_id();
include_once("includes/config.php");
include_once("includes/variables.php");
?>
<script>
function toggleLayer( whichLayer ){  var elem, vis;  if( document.getElementById ) // this is the way the standards

   elem = document.getElementById( whichLayer );  else if( document.all ) // this is the way old msie versions
 
       elem = document.all[whichLayer];  else if( document.layers ) // this is the way nn4 works 
     elem = document.layers[whichLayer];  vis = elem.style;  // if the style.display value is blank we try to figure it out here  
	 if(vis.display==''&&elem.offsetWidth!=undefined&&elem.offsetHeight!=undefined)    vis.display = (elem.offsetWidth!=0&&elem.offsetHeight!=0)?'block':'none';  vis.display = (vis.display==''||vis.display=='block')?'none':'block';}
</script>
<?php 
$r=0;
$q=mysql_query("select * from categories where parent=0") or die(mysql_error());?>
<table width="170" border="0" cellspacing="0" cellpadding="0">
<?php while($rs=mysql_fetch_array($q)){?>
<tr>
                                                  <td align="center" valign="top"><table width="170" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td align="center" valign="top"><table width="170" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                          <td width="14" align="center" valign="middle"><img src="img/folder_icon.jpg" width="14" height="12" /></td>
                                                          <td width="5" align="center" valign="middle">&nbsp;</td>
<td width="151" align="left" valign="middle" class="menu_text"><a href="javascript:toggleLayer('<?php echo $r;?>');" title="Add a comment to this entry"><?php echo $rs['category'].'<br></a>';?></td>
                                                        </tr>
                                                      </table></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="center" valign="top"><table width="170" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                          <td height="10" align="center" valign="top"></td>
                                                        </tr>
                                                        <tr><td align="center" valign="top">
<?php
$cat=$rs['category_id'];
$q1=mysql_query("select * from categories where parent='$cat'") or die(mysql_error()); ?>
<div id="<?php echo $r;?>"><?php
while($rs1=mysql_fetch_array($q1)){?>
<table width="170" border="0" cellspacing="0" cellpadding="0">
                                                            <tr align="center" valign="middle">
                                                              <td width="20">&nbsp;</td>
                                                              <td width="5"><img src="img/red_arrow.jpg" width="5" height="7" /></td>
                                                              <td width="10">&nbsp;</td>
                                                              <td width="135" align="left" class="menu_text2"><a href="<?php echo("products.php?category_id=".$rs1['category_id']);?>">
<?php echo $rs1['category'];?></a>&nbsp;</tr><td height="10" align="center" valign="top"></td>
                                                          </table>
<?php $cat1=$rs1['category_id'];
//$q2=mysql_query("select * from category where parent='$cat1'") or die(mysql_error());
}//second loop
?></div></td>
                                                        </tr> </table>


<?php
$r++;
 }//first loop
?> </table></td>
                                                    </tr></table>