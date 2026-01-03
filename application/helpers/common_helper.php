<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('dump'))
{
    function dump($str ,$exit = false)
    {
        $out = '';
        if(is_array($str))
        {
            $out.= '<pre>';
            var_dump($str);
            $out.= '</pre>';
        }
        else
            var_dump($str);
        
        if($exit) die();
    }
}
if(!function_exists('printdump')) {
    function printdump($str, $exit = false) {
        if(is_array($str)) {
         echo "<pre>"; 
         print_r($str);
        }else {
         echo $str;
        }
        if($exit) die();
    }
}

if(!function_exists('itemCode_gen'))
{
function itemCode_gen($string, $id = null, $l = 1){
    $results = ''; // empty string
        $vowels = array('a', 'e', 'i', 'o', 'u', 'y'); // vowels
        preg_match_all('/[A-Z][a-z]*/', strtoupper($string), $m); // Match every word that begins with a capital letter, added ucfirst() in case there is no uppercase letter
        foreach($m[0] as $substring){
           $results .= preg_replace('/([a-z]{'.$l.'})(.*)/', '$1', $substring); // Extract the first N letters.
        }
        $results .= '-'. str_pad($id, 2, 0, STR_PAD_LEFT); // Add the ID
    return $results;
}
}


if(!function_exists('itemCode_genarate'))
{
function itemCode_genarate($statecode, $universitycode, $institutecode){
   
       $institutecode = $statecode.'-'.'U0'.$universitycode.'-I00'.$institutecode;
        
    return $institutecode;
}
}




if(!function_exists('create_breadcrumb'))
{
    function create_breadcrumb()
    {
        $ci = &get_instance();
        $i=1;
        $uri = $ci->uri->segment($i);
        $link = '<ol class="breadcrumb">';
        $k = 1 ;
        while($uri != '')
        {
            $prep_link = '';
            
            for($j=1; $j<=$i;$j++)
            {
                $prep_link .= $ci->uri->segment($j).'/';
            }

            if($ci->uri->segment($i+1) == '')
            {
                //$link.='<li><a href="'.site_url($prep_link).'"><b>';
                $link.='<li><b>';
                $link.=set_label($ci->uri->segment($i) ).'</b></li> ';
            }
            else
            {
            	
                if($k == 1) 
            	    $link.='<li><a href="'.site_url($prep_link).'"> <i class="fa fa-home"></i> ';
            	else 
            		$link.='<li><a href="'.site_url($prep_link).'"> ';	

                $link.= set_label($ci->uri->segment($i) ).'</a></li> ';
                $k++;
            }

            $i++;
            $uri = $ci->uri->segment($i);
        }
        
        $link .= '</ol>';
        return $link;
    }
}


if(!function_exists('breadcrumb1'))
{
    function breadcrumb1($data)
    {
      $bread ='<div class="breadcrumbs" id="breadcrumbs">
                      <script type="text/javascript">
                              try{ace.settings.check("breadcrumbs" , "fixed")}catch(e){}
                      </script>
                        <ul class="breadcrumb">
                        <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="'.base_url().'">Home</a>
                        </li>';
                        foreach($data as $value => $k) {
                        $bread .='<li>
                                  <a href="'.$k['link'].'">'.ucfirst($k['label']).'</a>
                                  </li>
                                  <li>
                                  '.ucfirst($k['label']).'
                                  </li>';
                        }
                        $bread .='</ul>
                        </div>';
      
            
       
        return  $bread;
    }
}
if ( ! function_exists('timespan1'))
{
    function timespan1($seconds = 1, $time = '')
    {
        $CI =& get_instance();
        $CI->lang->load('date');

        if ( ! is_numeric($seconds))
        {
            $seconds = 1;
        }

        if ( ! is_numeric($time))
        {
            $time = time();
        }

        if ($time <= $seconds)
        {
            $seconds = 1;
        }
        else
        {
            $seconds = $time - $seconds;
        }

        $str = '';
        $years = floor($seconds / 31536000);

        if ($years > 0)
        {
           $str .= $years.' '.$CI->lang->line((($years > 1) ? 'date_years' : 'date_year')).', ';
        }

        $seconds -= $years * 31536000;
        $months = floor($seconds / 2628000);
         
         if($str ==''){
        if ($years > 0 OR $months > 0)
        {
            if ($months > 0)
            {
                $str .= $months.' '.$CI->lang->line((($months   > 1) ? 'date_months' : 'date_month')).', ';
            }

            $seconds -= $months * 2628000;
        }
    }

        $weeks = floor($seconds / 604800);
        if($str ==''){
        if ($years > 0 OR $months > 0 OR $weeks > 0)
        {
            if ($weeks > 0)
            {
                $str .= $weeks.' '.$CI->lang->line((($weeks > 1) ? 'date_weeks' : 'date_week')).', ';
            }

            $seconds -= $weeks * 604800;
        }
     }
        $days = floor($seconds / 86400);
       if($str ==''){
        if ($months > 0 OR $weeks > 0 OR $days > 0)
        {
            if ($days > 0)
            {
                $str .= $days.' '.$CI->lang->line((($days   > 1) ? 'date_days' : 'date_day')).', ';
            }

            $seconds -= $days * 86400;
        }
        }
        $hours = floor($seconds / 3600);
        if($str ==''){
        if ($days > 0 OR $hours > 0)
        {
            if ($hours > 0)
            {
                $str .= $hours.' '.$CI->lang->line((($hours > 1) ? 'date_hours' : 'date_hour')).', ';
            }

            $seconds -= $hours * 3600;
        }
      }
        $minutes = floor($seconds / 60);
if($str ==''){
        if ($days > 0 OR $hours > 0 OR $minutes > 0)
        {
            if ($minutes > 0)
            {
                $str .= $minutes.' '.$CI->lang->line((($minutes > 1) ? 'date_minutes' : 'date_minute')).', ';
            }

            $seconds -= $minutes * 60;
        }
}
        if ($str == '')
        {
            $str .= $seconds.' '.$CI->lang->line((($seconds > 1) ? 'date_seconds' : 'date_second')).', ';
        }

        return substr(trim($str), 0, -1);
    }
}
if ( ! function_exists('is_permit'))
{
   
 function is_permit($module_id,$permissionids){
     $CI = &get_instance();
    if($CI->session->userdata('is_admin') == 1) {
      return true;
    }else {
    $roleid = $CI->session->userdata('user_role');
    $res = $CI->common_model->checkPermission($module_id,$roleid, $permissionids);
    
    if($res !=''){
      return true;
    }else {
      return false;
    }
  }
  }
  }

  if(! function_exists('getEmployeeName')){
  function getEmployeeName($empid=NULL){
    if($empid !='' && $empid !=NULL && $empid !='0'){        
            $CI =& get_instance();
            $params = array('id'=>$empid);
            $employeeDetails =  $CI->Common_model->getSingleRow('emp_profile',$params);
            if(!empty($employeeDetails)){
                return $employeeDetails->fname.' '.$employeeDetails->lname;
            }else{
                return '';
            }
    }else {
        return '';
    }

  }
}

  if(! function_exists('getRowName')){
  function getRowName($module_id=NULL,$link_id=null){
    if($module_id !='' && $link_id !='' ){        
            $CI =& get_instance();
            $res =  $CI->Common_model->getRowName($module_id,$link_id);
            if(!empty($res)){
                if($module_id == '1'){
                    return $res->circle;
                }else if($module_id == '2'){
                    return $res->type_of_loan;
                }else if($module_id == '3'){
                    return $res->barrower_name;
                }else if($module_id == '4'){
                     return $res->r_id;
                }else if($module_id == '5'){
                     return $res->s_id;
                }else if($module_id == '6'){
                     return $res->rel_id;
                }else if($module_id == '7'){
                     return $res->auc_id;
                }else if($module_id == '8'){
                    return $res->fname.' ' .$res->lname;
                }
               
            }else{
                return '';
            }
    }else {
        return '';
    }

  }
}


function convertNumberToWord($number = false)
{
       $CI =& get_instance();   
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakhs', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? '' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  return $result; 
   // return implode(' ', $words);
}
function getloanTypeDetails($type_id=''){

  if($type_id !=''){
         $CI =& get_instance();
          $params['type_id'] = $type_id;
          $res =  $CI->Common_model->getSingleRow('loantypes',$params);
          if($res){
            return $res;
          }else {
            return false;
          }
  }else {
    return false;
  }

}

function getloanRegCloseDetails($loan_id=''){

  if($loan_id !=''){
         $CI =& get_instance();
          $params['loan_id'] = $loan_id;
          $res =  $CI->Common_model->getSingleRow('reg_close_loans_data',$params);
          if($res){
            return $res;
          }else {
            return false;
          }
  }else {
    return false;
  }

}

function calculateParkingDays($loan_id='',$status=''){

  if($loan_id !=''){
         $CI =& get_instance();
          $params['loan_id'] = $loan_id;
           $seizedata =  $CI->Common_model->getSingleRow('seize_form',$params);
           $seizedate = date('d-m-Y', strtotime($seizedata->seize_date));
           $reldate = date('d-m-Y');
           $data['rdate_y'] = 'n';
          if($status == 'rel'){
               $release =  $CI->Common_model->getSingleRow('release_form',$params);
               $reldate = date('d-m-Y', strtotime($release->release_date));
               $data['rdate'] = $reldate;
          }else {            
                 $reldate =date('d-m-Y');
                 $data['rdate'] =date('d-m-Y');

          }

          $data['sdate'] = $seizedate;
          

          $datetime1 = new DateTime($seizedate);
          $datetime2 = new DateTime($reldate);
          $difference = $datetime1->diff($datetime2);
          $days = $difference->d.' days';
          $data['days'] = $days;
          header('Content-type: application/json');
          die( json_encode( $data ) );
          }else {
            return false;
          }
 

}
function getGSTNumber($bank_id='',$state_id=''){

  if($bank_id !='' && $state_id =''){
         $CI =& get_instance();
          $res =  $CI->Common_model->getGSTNumber($bank_id,$state_id);
          if($res){
            return $res;
          }else {
            return false;
          }
  }else {
    return false;
  }

}

function getBranchCreatedBy($branch_id){
  $CI =& get_instance();
  $res =  $CI->Common_model->getBranchCreatedBy($branch_id);
  if($res){
    return $res;
  }else {
    return false;
  }
}
function getInvoiceTotal($invoice_id){
  $CI =& get_instance();
  $res =  $CI->Common_model->getInvoiceTotals($invoice_id);
  if($res){
    return $res;
  }else {
    return false;
  }
}
function checkSettleRejectStatus($invoice_id,$createdDate){
  $CI =& get_instance();
  $today = Date("Y-m-d");
  $CI->load->model('Invoice_model');
    $contractorCharges = $CI->Common_model->getSingleRow('contractor_charges',array('invoice_id'=>$invoice_id));
    $creditNoteRecord = $CI->Common_model->getSingleRow('credit_note',array('invoice_id'=>$invoice_id));
    if(!empty($creditNoteRecord)){
      return "settled";
    }else if(!empty($contractorCharges)){
      return "settled";
    }else{
      $date4Months = date("Y-m-d",strtotime(" -120 days"));
      if($createdDate < $date4Months){
          // check for retain for this month
          $checkRetain = $CI->Invoice_model->checkRetain($invoice_id);
          if(!empty($checkRetain)){
              $retainDate = $checkRetain->retain_date;
              if($retainDate < $today){
                  return "showreject";
              }else{
                  return "showsettle";
              }
          }else{
              return "showreject";
          }
      }else{
          return "showsettle";
      }
  }
}
function getAdvancePaymentHistory($advance_request_id){
  $CI =& get_instance();
  $res =  $CI->Common_model->getAdvancePaymentHistory($advance_request_id);
  if($res){
    return $res;
  }else {
    return false;
  }
}
function getBarrowerName($invoice_id){
  $CI =& get_instance();
  $res =  $CI->Common_model->getBarrowerName($invoice_id);
  if($res){
    return $res->barrower_name;
  }else {
    return false;
  }
}
function getBarrowerNameAccNo($invoice_id){
  $CI =& get_instance();
  $res =  $CI->Common_model->getBarrowerNameAccNo($invoice_id);
  if($res){
    return $res;
  }else {
    return false;
  }
}


function getBalanceAmountEmpId($emp_id){
  $CI =& get_instance();
  $res =  $CI->Common_model->getBalanceAmountEmpId($emp_id);
  if($res){
    return $res;
  }else {
    return false;
  }
}
function getAnnouncements() {
  $CI =& get_instance();
  $res =  $CI->Common_model->getAnnouncements();
  if($res){
    return $res;
  }else {
    return false;
  }
  
}
function getHoursMinitesSeconds($datetime) {
      $datetime_ts = strtotime($datetime); // Convert datetime string to timestamp
      $current_ts = time(); // Get current timestamp
      $seconds_diff = $current_ts - $datetime_ts; // Calculate difference in seconds

      $days = floor($seconds_diff / (60 * 60 * 24)); // Calculate number of days
      $hours = floor(($seconds_diff % (60 * 60 * 24)) / (60 * 60)); // Calculate number of hours
      $minutes = floor(($seconds_diff % (60 * 60)) / 60); // Calculate number of minutes
      $seconds = $seconds_diff % 60; // Calculate number of seconds
      
      if($days > 0) {
         return $days.' days';
      } else if($hours > 0) {
         return $hours.' hours';
      } else if($minutes > 0) {
         return $minutes.' mins';
      } else if($seconds > 0) {
         return $seconds.' sec';
      } else {
        return '';
      }
  }
  function getBranchDetails($branch_id){
  $CI =& get_instance();
  $res =  $CI->Common_model->getBranchDetails($branch_id);
  if($res){
    return $res;
  }else {
    return false;
  }
}
if(! function_exists('getDashboardCounts')){
  function getDashboardCounts($type=''){
    $featureCount = 0;
    if($type !=''){        
        $CI =& get_instance();
        if($type == 'empanelment'){
            $featureCount = $CI->Common_model->geCount('empanelments');
        }else if($type == 'employee'){
            $param = array('user_role!='=>1);
            $featureCount = $CI->Common_model->geCount('emp_profile',$param);
        }else if($type == 'formats'){
            $featureCount = $CI->Common_model->geCount('formats');
        }else if($type == 'invoice'){
            $featureCount = $CI->Common_model->getInvoicesCounts();
        }else if($type == 'receivedinvoice'){
            $featureCount = $CI->Common_model->getReceivedInvoicesCounts();
        }else if($type == 'settledinvoice'){
            $featureCount = $CI->Common_model->getSettledInvoicesCounts();
        }else if($type == 'pendinginvoice'){
            $featureCount = $CI->Common_model->getPendingInvoicesCounts();
        }else if($type == 'deletedinvoice'){
            $featureCount = $CI->Common_model->getDeletedInvoicesCounts();
        }else if($type == 'downloadPending'){
            $featureCount = $CI->Common_model->getDownloadPendingInvoicesCounts();
        }else if($type == 'pendingloans'){
            $featureCount = $CI->Common_model->getPendingLoanCounts();
        }else if($type == 'approvedloans'){
            $featureCount = $CI->Common_model->getApprovedLoanCounts();
        }
        
        return $featureCount;
    }else {
        return 0;
    }

  }
}

 if(! function_exists('checkFirstNotice')){
  function checkFirstNotice($loan_id=NULL){
    if($loan_id !='' && $loan_id !=NULL && $loan_id !='0'){        
            $CI =& get_instance();
            $params = array('loan_id'=>$loan_id);
            $noticeDetails =  $CI->Common_model->getSingleRow('loan_1st_notice',$params);
            if(!empty($noticeDetails)){
                return $noticeDetails;
            }else{
                return '';
            }
    }else {
        return '';
    }

  }
}

 if(! function_exists('checkSecondNotice')){
  function checkSecondNotice($loan_id=NULL){
    if($loan_id !='' && $loan_id !=NULL && $loan_id !='0'){        
            $CI =& get_instance();
            $params = array('loan_id'=>$loan_id);
            $noticeDetails =  $CI->Common_model->getSingleRow('loan_2nd_notice',$params);
            if(!empty($noticeDetails)){
                return $noticeDetails;
            }else{
                return '';
            }
    }else {
        return '';
    }

  }
}

if(! function_exists('checkThirdNotice')){
  function checkThirdNotice($loan_id=NULL){
    if($loan_id !='' && $loan_id !=NULL && $loan_id !='0'){        
            $CI =& get_instance();
            $params = array('loan_id'=>$loan_id);
            $noticeDetails =  $CI->Common_model->getSingleRow('loan_3rd_notice',$params);
            if(!empty($noticeDetails)){
                return $noticeDetails;
            }else{
                return '';
            }
    }else {
        return '';
    }

  }
}

if(! function_exists('checkFinalNotice')){
  function checkFinalNotice($loan_id=NULL){
    if($loan_id !='' && $loan_id !=NULL && $loan_id !='0'){        
            $CI =& get_instance();
            $params = array('loan_id'=>$loan_id);
            $noticeDetails =  $CI->Common_model->getSingleRow('loan_final_notice',$params);
            if(!empty($noticeDetails)){
                return $noticeDetails;
            }else{
                return '';
            }
    }else {
        return '';
    }

  }
}