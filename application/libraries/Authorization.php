<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authorization {

  var $CI;

  /**
   * Constructor
   */
  function __construct()
  {
    // Obtain a reference to the ci super object
    $this->CI =& get_instance();

    $this->CI->load->library('session');
  }
 

  /**
   * Check if user has permission
   *
   * @access public
   * @param array/string $permission_keys
   * @return bool
   */
  function is_permitted($permission_keys, $require_all = FALSE)
  {
    $account_id = $this->CI->session->userdata('user_id');

    $this->CI->load->model('managepermissions/managepermissions_model');

    $account_permissions = $this->CI->managepermissions_model->get_by_account_id($account_id);
    

    // Loop through and check if the account 
    // has any of the permission keys supplied
    if (isset($permission_keys))
    {
      foreach ($account_permissions as $perm) 
      {
        // Array of permission keys
        if (gettype($permission_keys) == 'array')
        {
          foreach ($permission_keys as $key) 
          {
            // Return if only a single one is required.
            if( $perm->key == $key && ! $require_all ) 
            {
              return TRUE;
            } 
            // Only takes one bad apple
            elseif ($perm->key != $key && $require_all)
            {
              return FALSE;
            }
          }
        }
        // Single permission key
        else
        {
          // Return if only a single one is required.
          if ($perm->key == $permission_keys && ! $require_all ) 
          {
            return TRUE;
          }
          // Only takes one bad apple
          elseif ($perm->key != $permission_keys && $require_all) 
          {
            return FALSE;
          }
        }
      }
    }

    // If nothing above matched for single 
    // permission, then this is false.
    if (! $require_all)
    {
      return FALSE;
    }
    // If it made this this far and all are 
    // required, then all is fine in the world
    else
    {
      return TRUE;
    }
  }
  
  // --------------------------------------------------------------------
  
  /**
   * Check if user has permission
   *
   * @access public
   * @param string $permission_key
   * @return bool
   */
  function is_admin()
  {
    $account_id = $this->CI->session->userdata('user_id');

    $this->CI->load->model('account/acl_role_model');

    return $this->CI->acl_role_model->has_role('Admin', $account_id);
  }
  
  function get_profiledata() {
    $user_id = $this->CI->session->userdata('user_id');
     $this->CI->load->model('common_model');
     $profiledata = $this->CI->common_model->get_profiledata($user_id);
     if($profiledata !='') {
         return $profiledata;
     }else {
         return '';
     }
}

function menu() {
//    $menudata = $this->CI->common_model->get_menu();
//    
//foreach($menudata as $obj){
//
//    if ($obj->parent_id == 0) {
//        $parent_menu[$obj->id]['label'] = $obj->label;
//        $parent_menu[$obj->id]['link'] = $obj->link_url;
//    } else {
//        $sub_menu[$obj->id]['parent'] = $obj->parent_id;
//        $sub_menu[$obj->id]['label'] = $obj->label;
//        $sub_menu[$obj->id]['link'] = $obj->link_url;
//        if (empty($parent_menu[$obj->parent_id]['count'])) {
//            $parent_menu[$obj->parent_id]['count'] = 0;
//        }
//        $parent_menu[$obj->parent_id]['count']++;
//    }
//}

//echo "<pre>"; print_r($parent_menu);
//echo "<pre>"; print_r($sub_menu);


$menu = array(
	'Dashboard' => array(
                'permission' => 1,
		'display' => 'Dashboard',
		'icon' => 'menu-icon fa fa-tachometer',
		'url' => BASE_URL .'dashboard'
	),
	'Manage Account' => array(
             'permission' => $this->is_permitted('retrieve_users'),
		'display' => 'Manage Account',
		'icon' => 'menu-icon fa fa-user-md',
		 'sub' => array(
			'Manage Users' => array(
                            'permission' => $this->is_permitted('retrieve_users'),
				'display' => ' Manage Users',
				'url' => BASE_URL .'manage_users',
				'icon' => 'menu-icon fa fa-user-md'
			),
			'Create Users' => array(
                            'permission' => $this->is_permitted('create_users'),
				'display' => 'Create Users',
				'url' => BASE_URL .'manage_users/save',
				'icon' => 'menu-icon fa fa-user-md'
			),
	           
		)
	),
	'Manage Groups' => array(
             'permission' => $this->is_permitted('retrieve_roles'),
		'display' => ' Manage Groups',
		'icon' => 'menu-icon fa fa-sitemap',
		 'sub' => array(
			'Manage Users' => array(
                             'permission' => $this->is_permitted('retrieve_roles'),
				'display' => ' Manage Roles',
				'url' => BASE_URL .'manageroles',
				'icon' => 'menu-icon fa fa-user-md'
			),
			'Create Role' => array(
                             'permission' => $this->is_permitted('create_roles'),
				'display' => 'Create Role',
				'url' => BASE_URL .'manageroles/rolecreate',
				'icon' => 'menu-icon fa fa-user-md'
			),
	           
		)
	),
	' Manage Permissions' => array(
             'permission' => $this->is_permitted('retrieve_permissions'),
		'display' => '  Manage Permissions',
		'icon' => 'menu-icon fa fa-paw',
		 'sub' => array(
			'View Permissions ' => array(
                             'permission' => $this->is_permitted('retrieve_permissions'),
				'display' => ' View Permissions ',
				'url' => BASE_URL .'managepermissions',
				'icon' => 'menu-icon fa fa-user-md',
			),
			' Create Permission' => array(
                             'permission' => $this->is_permitted('create_permissions'),
				'display' => ' Create Permission',
				'url' => BASE_URL .'managepermissions/permissioncreate',
				'icon' => 'menu-icon fa fa-user-md'
			),
	           
		)
	),

	' Manage Volunteer' => array(
             'permission' => $this->is_permitted('manage_volunteer'),
		'display' => '  Manage Volunteer',
		'icon' => 'menu-icon fa fa-users',
		 'sub' => array(
			' View Volunteer ' => array(
                             'permission' => $this->is_permitted('manage_volunteer'),
				'display' => '  View Volunteer ',
				'url' => BASE_URL .'volunteer',
				'icon' => 'menu-icon fa fa-user-md'
			),
			' Create Volunteer' => array(
                             'permission' => $this->is_permitted('create_volunteer'),
				'display' => ' Create Volunteer',
				'url' => BASE_URL .'volunteer/addvolunteer',
				'icon' => 'menu-icon fa fa-user-md'
			),
	           
		)
	),
	' Manage Institutes' => array(
             'permission' => $this->is_permitted('manage_institute'),
		'display' => '  Manage Institutes',
		'icon' => 'menu-icon fa fa-institution',
		 'sub' => array(
			' View Institutes ' => array(
                             'permission' => $this->is_permitted('manage_institute'),
				'display' => '  View Institutes ',
				'url' => BASE_URL .'institute',
				'icon' => 'menu-icon fa fa-user-md'
			),
			' Create Institutes' => array(
                             'permission' => $this->is_permitted('create_institute'),
				'display' => ' Create Institutes',
				'url' => BASE_URL .'institute/addinstitute',
				'icon' => 'menu-icon fa fa-user-md'
			),
	           
		)
	),
	' my institute' => array(
             'permission' => $this->is_permitted('my_institute'),
		'display' => 'My Institute',
		'icon' => 'menu-icon fa fa-institution',
		'url' => BASE_URL .'institute/myinstitute'
	  ),

	' Manage University' => array(
             'permission' => $this->is_permitted('university_manage'),
		'display' => '  Manage University',
		'icon' => 'menu-icon fa fa-institution',
		 'sub' => array(
			' View University ' => array(
                             'permission' => $this->is_permitted('university_manage'),
				'display' => '  View University ',
				'url' => BASE_URL .'university',
				'icon' => 'menu-icon fa fa-user-md'
			),
			' Create University' => array(
                                'permission' => $this->is_permitted('create_university'),
				'display' => ' Create University',
				'url' => BASE_URL .'university/adduniversity',
				'icon' => 'menu-icon fa fa-user-md'
			),
	           
		)
	),


);

echo $this->buildMenu($menu);
}
function buildMenu($menu_array, $is_sub=FALSE)
{
    
	/*
	 * If the supplied array is part of a sub-menu, add the
	 * sub-menu class instead of the menu ID for CSS styling
	 */
	$attr = (!$is_sub) ? ' class="nav nav-list" style="top: 0px;"' : ' class="submenu nav-hide" style="display: none;"';
	$menu = '<ul'.$attr.'>'; // Open the menu container
     
	/*
	 * Loop through the array to extract element values
	 */
	foreach($menu_array as $id => $properties) {
           
               
		/*
		 * Because each page element is another array, we
		 * need to loop again. This time, we save individual
		 * array elements as variables, using the array key
		 * as the variable name.
		 */
		foreach($properties as $key => $val) {
                      
			/*
			 * If the array element contains another array,
			 * call the buildMenu() function recursively to
			 * build the sub-menu and store it in $sub
			 */
			if(is_array($val))
			{
				$sub = $this->buildMenu($val, TRUE);
			}

			/*
			 * Otherwise, set $sub to NULL and store the
			 * element's value in a variable
			 */
			else
			{
				$sub = NULL;
				$$key = $val;
			}
		}

		/*
		 * If no array element had the key 'url', set the
		 * $url variable equal to the containing element's ID
		 */
		if(!isset($url)) {
			$url = '#';
		}

		/*
		 * Use the created variables to output HTML
		 */


                


                
                if($permission){
                //if($userpermission):
                if($sub !=null) {
                $attr1 = 'class="dropdown-toggle"';
                }else {
                	 $attr1 = 'class=""';     
                }
               
		        $menu .= "<li>
		           <a ".$attr1."  href=".$url."><i class='".$icon."'></i>
		            <span class='menu-text'> $display</span> ";
		            if($sub !=NULL) { 
		            $menu .='<b class="arrow fa fa-angle-down"></b>';	
		            }
		            
		            $menu .="
		           </a>
		           <b class='arrow'></b>
		           $sub
		           </li>";
                }
                 // endif;
		/*
		 * Destroy the variables to ensure they're reset
		 * on each iteration
		 */
		unset($url, $display, $sub);

	}

	/*
	 * Close the menu container and return the markup for output
	 */
	return $menu . "</ul>";
}


}



/* End of file Authorization.php */
/* Location: ./application/account/libraries/Authorization.php */

// --------------------------------------------------------------------
  
  