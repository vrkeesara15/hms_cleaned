<?php (defined('BASEPATH')) OR exit('No direct script access allowed');





require APPPATH . 'third_party/MX/Controller.php';



class MY_Controller extends MX_Controller {



    private $_ci;



     public function __construct()

    {

        parent::__construct();

        date_default_timezone_set("Asia/Calcutta");

        $this->_ci =& get_instance();

        $this->load->helper(array('date', 'language', 'url','custom','form'));

        $this->load->library(array('authentication', 'authorization', 'form_validation'));

        header("cache-Control: no-store, no-cache, must-revalidate");

        header("cache-Control: post-check=0, pre-check=0", false);

        header("Pragma: no-cache");

        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

                        

    }





    /**

     * Load Javascript inside the page's body

     * @access  public

     * @param   string  $script

     */

    public function _load_script($script)

    {

        //if (isset($this->_ci->template) && is_object($this->_ci->template))

        //var_dump($this->_ci->template);

        if (isset($this->_ci->template) && is_object($this->_ci->template))

        {

            // Queue up the script to be executed after the page is completely rendered

            echo <<< JS

<script>

    var CIS = CIS || { Script: { queue: [] } };

    CIS.Script.queue.push(function() { $script });

</script>

JS;

        }

        else

        {

            echo '<script>' . $script . '</script>';

        }

    }

}



class Ajax_Controller extends MY_Controller {



    public function __construct()

    {

        parent::__construct();



        $this->load->library('response');

    }

}



/* End of file MY_Controller.php */

/* Location: ./application/core/MY_Controller.php */