<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_about extends CI_Model {

		var $col_order  = array(null, 'name', 'description', 'status_active');
		var $col_search = array('name'); 
		var $order      = array('id' => 'ASC');

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

	    private function _get_about(){
	    	$array = array('3', '4');
	    	$datax = array('status_active' => 1);
	    	$this->db->select('id, name, description, status_active');
	        $this->db->from('master_about');
	        $this->db->where($datax);
	        $this->db->where_in('id', $array);
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

	    function get_about($length, $start){
	        $this->_get_about();
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_about(){
	        $this->_get_about();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_about(){
	    	$this->_get_about();
	    	return $this->db->count_all_results();
	    }

	}
?>