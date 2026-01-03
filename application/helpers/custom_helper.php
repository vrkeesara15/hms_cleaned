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


if(!function_exists('breadcrumb'))
{
    function breadcrumb($data)  {
        $bread = '<ol class="breadcrumb">
                        <li><a href="'.base_url().'"><i class="fa fa-dashboard"></i> Home</a></li>';
        $bread .='<li class="active">Dashboard</li>';
        $bread .='<li>
                   <a href="'.$data['link'].'">'.ucfirst($data['label']).'</a>
                   </li>';
        $bread .='</ol>';
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


if(! function_exists('getownerName')){

  function getownerName($userid=NULL){

    if($userid !='' && $userid !=NULL && $userid !='0'){
        
            $CI =& get_instance();
            $params = array('user_id'=>$userid);
            $ownerDetails =  $CI->Common_model->getSingleRow('sg_users',$params);
            return $ownerDetails->user_fname.' '.$ownerDetails->user_lname;
    }else {
        return '';
    }

  }
}

