<?php
	session_start();
	$user = $_SESSION['oid'];
    date_default_timezone_set('Asia/Kolkata');
    $createdAt = date('m/d/Y h:i:s a', time());
	if (isset($_POST['update']))
		
	{
		include('../../../dbcon.php');
	
		// for common table
		$store= $_POST['store'];
		$mc= $_POST['mc'];
		$iid= $_POST['iid'];
		$bid= $_POST['bid'];
				
		$qry="SELECT * from barcode_pvcIssue where isReturn is NULL AND CONCAT(inward_id,'/',barcode_no) = '".$_POST["barcode_id"]."'";
		$params = array();
		$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		$result=sqlsrv_query($con,$qry,$params,$options);
		$count=sqlsrv_num_rows($result);
		if($count < 1)
		{

			
			$_SESSION['noReturn'] ='noReturn';
                          header("location:rmReturnBC.php");
		}

		else{
		
         
              $query1 = "UPDATE barcode_pvcIssue SET store = '$store',mc = '$mc',isReturn = 1,username = '$user',createdAt = '$createdAt' where CONCAT(inward_id,'/',barcode_no) = '".$_POST["barcode_id"]."'"; 
              $run1 = sqlsrv_query($con,$query1);
              if($run1 == true)
            {       
                    $_SESSION['str'] = $store;
                    $_SESSION['mcn'] = $mc;
                    $_SESSION['bcmess'] =' Data Inserted Successfully';
                          header("location:rmReturnBC.php");
            }
        else{
      		print_r(sqlsrv_errors());
            echo "ERROR!!";
        }

    }

	}
		
	
?>