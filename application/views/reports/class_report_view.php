<?php
// $html = '<style>'.file_get_contents('./css/bootstrap.min.css').'</style>';
// $html .= '<style>'.file_get_contents('./css/styles.css').'</style>';
$html = <<<EOF
    <style>
#class-report-check-in-table{
    color: #003300;
    font-family: helvetica;
    font-size: 8pt;
    border-left: 3px solid red;
    border-right: 3px solid #FF00FF;
    border-top: 3px solid green;
    border-bottom: 3px solid blue;
    background-color: #ccffcc;
}
    </style>
EOF;

$html .= "<html><body>";
$html .= '<h1>Class Report</h1>
        <table id="class-report-check-in-table" class="table table-striped table-bordered table-condensed">
		<thead>
		<tr style="background: red;">
			<th class="check-in-name" data-class="expand">Name</th>
			<th class="check-in-time">Checked In</th>
			<th class="check-in-time">Checked Out</th>
            <th class="check-in-class" data-hide="phone">Class</th>
            <th class="check-in-visitor" data-hide="phone">Visitor</th>
            <th class="check-in-offering" data-hide="phone">Offering</th>
		</tr>
		</thead>

		<tbody>';
            $cnt = 0;
			if(sizeof($check_ins) > 0){
				$cnt++;
				foreach($check_ins as $check_in){
                    $check_in_time = "";
                    $check_out_time = "";
					if($check_in["checked_in"] > 0)$check_in_time = date("g:i a", strtotime($check_in["checked_in"]));
					if($check_in["checked_out"] > 0)$check_out_time = date("g:i a", strtotime($check_in["checked_out"]));
                    $html .= '<tr id="check-in-'.$check_in['id'].'">
						<td>'.$check_in['fname']." ".$check_in['lname'].'</td>
                        <td>'.$check_in_time.'</td>
                        <td>'.$check_out_time.'</td>
                        <td>'.$check_in['class_name'].'</td>
                        <td>';
                            switch($check_in['visitor']){
                                case '0':
                                    $html .= 'No';
                                break;
                                
                                case '1':
                                    $html .= 'Yes';
                                break;
                            }
                        $html .= '</td>
                        <td>$ '.$check_in['offering'].'</td>
					</tr>';
				}
				$cnt++;
			}else{
                $html .= '<tr><td colspan="3" class="alert">No check-ins found.</td></tr>';
            }
		$html .= '</tbody>
        <tfoot>
            <tr>
                <td>Totals</td>
                <td>'.$totals['num_check_ins'].'</td>
                <td>'.$totals['num_check_outs'].'</td>
                <td></td>
                <td>'.$totals['num_visitors'].'</td>
                <td>$'.$totals['offering_total'].'</td>
            </tr>
        </tfoot>
	</table>';
$html .= "</body></html>";