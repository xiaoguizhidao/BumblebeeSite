<?php
if($noProducts==0){
echo("<p class='center_text'>There is no product in this category</p>");
}else{
?>
<table width="710" border="0" cellspacing="0" cellpadding="0"><tr>
                                            <td align="center" valign="top">&nbsp;</td>
                                          </tr>
										  <tr>
                                            <td align="center" valign="top">&nbsp;</td>
                                          </tr>
<tr>
<?php
$row=0;
while($rowProducts=mysql_fetch_array($rsProducts)){
$row++;
?>
<td width="150" height="174" align="center" valign="top">
<table width="159" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td align="center" valign="top"><table width="159" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td height="159" align="center" valign="middle" bgcolor="#ff0000"><a href="product_detail.php?p_id=<?php echo($rowProducts['p_id']);?>"><img src="products/thumbs/<?php echo($rowProducts['product_image']);?>" width="155" height="155" border="0"></a></td>
                                                          </tr>
                                                      </table></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="center" valign="top"><table width="159" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td height="25" align="left" valign="middle" class="center_text2"><strong><?php echo($rowProducts['name']);?> </strong></td>
                                                          </tr>
                                                          <tr>
                                                            <td align="left" valign="middle" class="center_text"><?php echo($rowProducts['description']);?></td>
                                                          </tr>
                                                          <tr>
                                                            <td height="40" align="left" valign="middle"><a href="product_detail.php?p_id=<?php echo($rowProducts['p_id']);?>"><img src="img/addtoinquiry.jpg" width="113" height="20" border="0" /></a></td>
                                                          </tr>
                                                      </table></td>
                                                    </tr>
                                                </table>
</td>

<?php
if($row%4==0){
echo("</tr><tr>
                                            <td align='center' valign='top'>&nbsp;</td>
                                          </tr>
										  <tr>
                                            <td align='center' valign='top'>&nbsp;</td>
                                          </tr><tr>");
}
?>
<?php }?>
</table>
<?php
}?>