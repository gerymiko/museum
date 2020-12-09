<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_submenu extends CI_Model {

		var $col_order  = array(null, 'name', 'description', 'status_active');
		var $col_search = array('name'); 
		var $order      = array('id_menu' => 'ASC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    private function _get_submenu_list(){
	    	$datax = array('isDelete' => 0);
	    	$this->db->select('id_menu, name, description, status_active, insert_time, update_time');
	        $this->db->from('msm_submenu');
	        $this->db->where($datax);
	        $i = 0;
	        foreach ($this->col_search as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order)){
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_submenu_list($length, $start){
	        $this->_get_submenu_list();
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_submenu_list(){
	        $this->_get_submenu_list();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_submenu_list(){
	    	$this->_get_submenu_list();
	    	return $this->db->count_all_results();
	    }

	    function check_data($name, $desc){
	    	$datax =array('name' => $this->pregReps($name), 'description' => $this->pregReps($desc));
	    	$query = $this->db->from('msm_submenu')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row();
	    	} else { return false; }
	    }

	}
?>