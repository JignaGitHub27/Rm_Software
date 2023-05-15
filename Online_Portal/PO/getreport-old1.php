<?php
include('..\..\dbcon.php');
$sql = "SELECT b.sr_no,b.receive_at,a.p_po_no,format(b.receive_date,'dd-MMM-yyyy') as rec_date,b.invoice_no,format(b.invoice_date,'dd-MMM-yyyy') as inv_date,c.party_name,g.category,f.main_grade,e.sub_grade,d.item,
b.mat_ord_by,a.p_project,a.plant,a.p_job,a.p_remark,a.p_pkg,a.p_unit,a.rec_qnty,a.pur_rate,(a.rec_qnty*a.pur_rate) as basic_rate,a.gst_per,a.gst_amt,a.total_amt,b.total_bill_amt FROM inward_ind a
LEFT OUTER JOIN inward_com b on a.sr_no= b.sr_no and a.receive_at=b.receive_at
LEFT OUTER JOIN rm_party_master c on c.pid= b.mat_from_party
LEFT OUTER JOIN rm_item d on d.i_code= a.p_item
LEFT OUTER JOIN rm_s_grade e on e.s_code= d.s_code
LEFT OUTER JOIN rm_m_grade f on f.m_code= d.m_code
LEFT OUTER JOIN rm_category g on g.c_code= d.c_code order by sr_no desc";
$run = sqlsrv_query($con,$sql);
$rows = array();
while($row = sqlsrv_fetch_array($run, SQLSRV_FETCH_ASSOC))
{
       $rows[] = $row;
}

echo json_encode($rows);

?>