<?php
// 2017-03-03 取得所有在卡機上的使用者清單
  include("../../lib/sessioncheck.php");
  include("../../lib/socalib.php");  // 載入socalib
  include("../../lib/ib_connect.php");   //連結資料庫


  function GetBlobString($BlobData) {
    $blob_data = ibase_blob_info($BlobData);
    if ($blob_data[0] > 0) {
      $blob_hndl = ibase_blob_open($BlobData);
      $FPData = ibase_blob_get( $blob_hndl, $blob_data[0]);      
    } else {
      $FPData = "";
    }

    return $FPData;
  }
  
  $ReaderIdx = $_POST['ReaderIdx'];

  $sql = 'select C_CARD,U_NAME,G_PRIORITY,P_TIMEZONEIDX,C_FP_COUNT,C_FP_1,C_FP_2,C_FP_3';
  $sql .= ' from CARDS c';
  $sql .= ' inner join LIMIT l on l.C_IDX = c.C_IDX';
  $sql .= ' left join PERMIT p on p.G_IDX = l.G_IDX';
  $sql .= ' left join USERS u on u.U_IDX = c.U_IDX';
  $sql .= ' left join GROUPS g on g.G_IDX = l.G_IDX';
  $sql .= ' where p.R_IDX = '.$ReaderIdx;
  $sql .= ' order by C_CARD,G_PRIORITY';

	$result = ibase_query($ib_connect, $sql) or die(ibase_errmsg());


  $Cards = array();
  $LastCard = "";
  while($row = ibase_fetch_assoc($result)) {
  	if ($LastCard != $row["C_CARD"]) {
      $Name = $row["U_NAME"];
      if ($Name == null) {
        $Name = "";
      }
      $FP_COUNT = $row["C_FP_COUNT"];
      if ($FP_COUNT == null) {
        $FP_COUNT = 0;
      }
	    $Cards[] = array("Card" =>$row["C_CARD"],
	    									"Name" => $Name,
                        "ReaderIdx" => $ReaderIdx,
	                      "Timezone"  =>$row["P_TIMEZONEIDX"],
                        "FP_COUNT" =>$FP_COUNT,
                        "FP1" => GetBlobString($row["C_FP_1"]),
                        "FP2" => GetBlobString($row["C_FP_2"]),
                        "FP3" => GetBlobString($row["C_FP_3"]),
	                      "sendded" => false
	                      );

	    
  	}
    $LastCard = $row["C_CARD"];
	}
  ibase_free_result($result);
  ibase_close($ib_connect);
  echo json_encode($Cards);  
?>