<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_category extends CI_Model {

		var $col_order  = array(null, 'a.name', 'b.name', 'b.description', 'b.status_active');
		var $col_search = array('b.name'); 
		var $order      = array('a.id_menu' => 'ASC');

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

	    private function _get_category_list(){
	    	$status_active = $this->pregRepn($this->input->post('status_search'));
	    	if($status_active == "")
	    		$this->db->or_not_like('b.status_active', '2');
	    	if ($status_active == "1")
				$this->db->where('b.status_active', 1);
			if ($status_active == "0" )
				$this->db->where('b.status_active', 0);
			if($this->pregReps($this->input->post('category_search')))
				$this->db->like('b.name', $this->pregReps($this->input->post('category_search')), 'both');
	    	if($this->pregRepn($this->input->post('submenu_search')))
				$this->db->where('a.id_menu', $this->pregReps($this->input->post('submenu_search')));
	    	$datax = array('b.isDelete' => 0, 'a.isDelete' => 0);
	    	$this->db->select('a.id_menu, a.name AS submenu_name, b.id_category, b.name AS category_name, b.description, b.image, b.status_active');
	        $this->db->from('msm_submenu a');
	        $this->db->join('msm_category b', 'a.id_menu = b.id_menu AND a.status_active = 1 AND b.status_active = 1', 'inner');
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

	    function get_category_list($length, $start){
	        $this->_get_category_list();
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_category_list(){
	        $this->_get_category_list();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_category_list(){
	    	$this->_get_category_list();
	    	return $this->db->count_all_results();
	    }

	    function get_image($id_category){
	    	$datax = array('id_category' => $this->pregRepn($id_category));
	    	$query = $this->db->select('image')
	    		->from('msm_category')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	}
?>