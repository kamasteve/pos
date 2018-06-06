<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../conf.php';
include_once '../froms.php';
include_once '../function.php';
$q = $_GET["q"];
namesearch($q);
function namesearch($m) {
    echo '
<table class="tables"> 
                                                        <thead>
                                                            <tr>
                                                                <th>Member No</th>   
                                                                <th>Amount</th>   
                                                                
																<th>Date</th>
                                                               
																																
                                                             
                                                                <th>Reverse</th>
                                                            </tr>

                                                        </thead>';
     $chqry = mysql_query('select * from monthly_con where membernumber="' . base64_encode($m) . '" and narration="Loan Repayment"') or die(mysql_error());
    if (mysql_num_rows($chqry) == 1) {
        $Row = mysql_fetch_array($chqry);
              echo'	<tr>
                                <td>' . base64_decode($Row['mno']) . '</td>
                            	
		
                       	<td>' . ($Row['date']) . '</td>      
				<td>' . ($Row['debit']) . '</td>
                           
                                <td> <a href="loanedit.php?s=' . $Row['session'] . '"><img src="images/delete.png"></a></td> 
                            </tr>';
    }
    echo '</table>        
';
	?>
	