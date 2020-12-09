<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_access extends CI_Model {

		var $col_order  = array(null, 'a.username');
		var $col_search = array('a.username'); 
		var $order      = array('b.id_level' => 'ASC');

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

	    private function _get_user_list(){
	    	$datax = array('a.status_active' => 1);
	    	$this->db->select('a.id_user, a.username, a.insert_time, a.status_active, b.id_level, b.level_name');
	        $this->db->from('master_user a');
	        $this->db->join('master_user_level b', 'a.id_level = b.id_level', 'inner');
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

	    function get_user_list($length, $start){
	        $this->_get_user_list();
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_user_list(){
	        $this->_get_user_list();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_user_list(){
	    	$this->_get_user_list();
	    	return $this->db->count_all_results();
	    }

	    function check_user($username){
			$datax =array('username' => $this->pregReps($username), 'status_active' => 1);
	    	$query = $this->db->select('username')
	    		->from('master_user')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row();
	    	} else { return false; }
		}

		function check_user_exist($id_user, $username){
			$datax =array('username' => $this->pregReps($username), 'id_user'=> $this->pregRepn($id_user), 'status_active' => 1);
	    	$query = $this->db->select('username')
	    		->from('master_user')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row();
	    	} else { return false; }
		}

	}
?>