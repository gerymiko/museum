<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_detail extends CI_Model {

		var $col_order  = array(null, 'a.name', 'b.name', 'b.description');
		var $col_search = array('b.name'); 
		var $order      = array('a.id_category' => 'ASC');

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

	    private function _get_detail_list(){
	    	$status_active = $this->pregRepn($this->input->post('status_search'));
	    	if($status_active == "")
	    		$this->db->or_not_like('b.status_active', '2');
	    	if ($status_active == "1")
				$this->db->where('b.status_active', 1);
			if ($status_active == "0" )
				$this->db->where('b.status_active', 0);
			if($this->pregReps($this->input->post('detail_search')))
				$this->db->like('b.name', $this->pregReps($this->input->post('detail_search')), 'both');
	    	if($this->pregRepn($this->input->post('category_search')))
				$this->db->where('a.id_category', $this->pregRepn($this->input->post('category_search')));
			if($this->pregReps($this->input->post('type_search')))
				$this->db->where('b.type', $this->pregReps($this->input->post('type_search')));
	    	$datax = array('a.isDelete' => 0, 'b.isDelete' => 0);
	    	$this->db->select('a.id_category, a.name as category_name, b.id_detail, b.name as detail_name, b.description, b.file, b.type, b.thumbnail, b.status_active, b.tanggal');
	        $this->db->from('msm_category a');
	        $this->db->join('msm_detail b', 'a.id_category = b.id_category AND a.status_active = 1 AND b.status_active = 1', 'inner');
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

	    function get_detail_list($length, $start){
	        $this->_get_detail_list();
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_detail_list(){
	        $this->_get_detail_list();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_detail_list(){
	    	$this->_get_detail_list();
	    	return $this->db->count_all_results();
	    }

	    function get_image($id_detail){
	    	$datax = array('id_detail' => $this->pregRepn($id_detail));
	    	$query = $this->db->select('type, thumbnail, file')
	    		->from('msm_detail')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }
	}
?>