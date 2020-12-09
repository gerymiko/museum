<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_detail extends CI_Model {

		var $col_order  = array(null, 'a.name', 'b.name', 'c.name', 'c.description', 'c.status_active');
		var $col_search = array('c.name'); 
		var $order      = array('b.name' => 'ASC');

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

	    private function _get_detail_alumni(){
	    	$status_active = $this->pregRepn($this->input->post('status_search'));
	    	if($status_active == "")
	    		$this->db->or_not_like('c.status_active', '2');
	    	if ($status_active == "1")
				$this->db->where('c.status_active', 1);
			if ($status_active == "0" )
				$this->db->where('c.status_active', 0);
			if($this->pregReps($this->input->post('name_search')))
				$this->db->like('c.name', $this->pregReps($this->input->post('name_search')), 'both');
	    	if($this->pregRepn($this->input->post('category_search')))
				$this->db->where('b.id_category', $this->pregRepn($this->input->post('category_search')));
			if($this->pregReps($this->input->post('type_search')))
				$this->db->where('c.type', $this->pregReps($this->input->post('type_search')));
	    	$datax = array('a.isDelete' => 0, 'b.isDelete' => 0);
	    	$this->db->select('a.id_menu, a.id_alumni, b.id_category, c.id_detail, a.name as alumni_name, b.name as category_name, c.name as detail_name, c.description, c.type, c.thumbnail, c.file, c.status_active');
	    	$this->db->from('mom_alumni a');
	        $this->db->join('mom_alumni_category b', 'a.id_alumni = b.id_alumni AND a.status_active = 1 AND b.status_active = 1', 'inner');
	        $this->db->join('mom_alumni_detail c', 'b.id_category = c.id_category AND c.status_active = 1', 'inner');
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

	    function get_detail_alumni($length, $start){
	        $this->_get_detail_alumni();
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_detail_alumni(){
	        $this->_get_detail_alumni();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_detail_alumni(){
	    	$this->_get_detail_alumni();
	    	return $this->db->count_all_results();
	    }

	    function get_image($id_detail){
	    	$datax = array('id_detail' => $this->pregRepn($id_detail));
	    	$query = $this->db->select('type, thumbnail, file')
	    		->from('mom_alumni_detail')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function check_data($name, $desc){
	    	$datax = array('name' => $this->pregReps($name), 'description' => $this->pregReps($desc));
	    	$query = $this->db->from('mom_alumni_detail')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row();
	    	} else { return false; }
	    }

	}
?>