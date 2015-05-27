<?php 
session_start();
require_once("includes/config.php");
$query="SELECT * from products WHERE status=1 LIMIT 3";
$rs=mysql_query($query);
?>
<table border="0" cellspacing="0" cellpadding="0">
                                      <tr align="center" valign="top"><?php while($row=mysql_fetch_array($rs)){ ?>
                                        <td width="223"><table width="223" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="117" align="center" valign="top"><table width="117" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td height="93" align="center" valign="middle" bgcolor="4f4f4f"><a href="product_detail.php?p_id=<?php echo($row['p_id']);?>"><img src="products/thumbs/<?php echo($row['product_image']);?>" width="109" height="85" border=0 /></td>
                                              </tr>
                                            </table></td>
                                            <td width="106" align="center" valign="top"><table width="106" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="10" align="center" valign="top"></td>
                                                <td width="86" align="center" valign="top"><table width="86" border="0" cellspacing="0" cellpadding="0">
                                                  <tr>
                                                    <td height="15" align="left" valign="top"><span class="center_text2"><strong><?php echo $row['name'];?></strong></span></td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left" valign="top" class="center_text"><div align="left"><?php echo $row['description'];?></div></td>
                                                  </tr>
                                                  <tr>
                                                    <td height="20" align="left" valign="bottom"><a href="product_detail.php?p_id=<?php echo($row['p_id']);?>"><img src="img/more.jpg" width="30" height="15"  border="0"/></a></td>
                                                  </tr>
                                                </table></td>
                                                <td width="10" align="center" valign="top">&nbsp;</td>
                                              </tr>
                                            </table></td>
                                          </tr>
                                        </table></td>
										<?php }?>
                                          
                                            
                                          
                                    </table>