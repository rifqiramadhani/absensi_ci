<?php

class Workday_plan extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->loginstatus->check_login();
		$this->load->library('template');
		$this->load->model(array('workday_plan_model'));
	}

	public function index(){
		redirect('workday_plan/listdata');
	}

	public function listdata($start=0,$perpage=10){
		$data = array();

		$count = $this->workday_plan_model->get_all_per_month()->num_rows();
		$data['workday_plan'] = $this->workday_plan_model->get_all_per_month()->result_array();

		$this->load->library('pagination');
		$config['base_url'] = base_url().'workday_plan/listdata/';
		$config['total_rows'] = $count;
		$config['per_page'] = $perpage;
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$data['paging'] = $this->pagination->create_links();
		$data['number'] = $start + 1;

		$this->template->display('workday_plan/listdata_view',$data);
	}

	public function add(){
		$this->form_validation->set_rules('hidden_bulan_plan','Bulan','required|numeric');
		$this->form_validation->set_rules('hidden_tahun_plan','Tahun','required|numeric');
		if($this->form_validation->run()==FALSE){
			$this->template->display('workday_plan/add_view');
		}else{
			/*echo '<pre>';
			print_r($this->input->post());*/

			$status = $this->input->post('status');
			$keterangan = $this->input->post('keterangan');
			$bulan = $this->input->post('hidden_bulan_plan');
			$tahun = $this->input->post('hidden_tahun_plan');

			$tgl = 1;
			foreach ($status as $key => $value) {
				$data_plan = array(
								'tanggal' => $tgl,
								'bulan' => $bulan,
								'tahun' => $tahun,
								'status' => $value,
								'keterangan' => $keterangan[$key],
								'created_date' => date('Y-m-d H:i:s'),
								'created_user' => $this->session->userdata('user_id'),
								'active' => '1'
							);
				$this->workday_plan_model->save($data_plan);

				//echo $tgl.'/'.$bulan.'/'.$tahun.' '.$value.' '.$keterangan[$key].'<br/>';
				$tgl++;
			}

			redirect('workday_plan/listdata');
		}
	}

	public function update(){
		if($_POST){
			$id_perencanaan = $_POST['id_perencanaan'];
			$status = $_POST['status'];
			$keterangan = $_POST['keterangan'];

			$data_plan = array(
							'status' => $status,
							'keterangan' => $keterangan,
							'updated_date' => date('Y-m-d H:i:s'),
							'updated_user' => $this->session->userdata('user_id')
						);
			$this->workday_plan_model->update($id_perencanaan,$data_plan);

			echo json_encode(array('success'));
		}
	}

	public function month_view($month,$year){
		if(!$month||!$year){
			redirect('home');
		}else{
			$data['month_view_bulan'] = $month;
			if($month < 10){
				$data['month_view_bulan'] = '0'.$month;
			}
			$data['month_view_tahun'] = $year;
			$this->template->display('workday_plan/month_view',$data);
		}
	}

	public function checking_month_availability(){
		$month = $this->input->post('bulan');
		$year = $this->input->post('tahun');

		$data = array();

		$temp = $this->workday_plan_model->get_by_month($month,$year)->num_rows();

		$data['available'] = true;

		if($temp > 0){
			$data['available'] = false;
		}

		echo json_encode($data);
	}

	public function getting_month_events(){
		$month = $_POST['bulan'];
		$year = $_POST['tahun'];

		$bulan = $month;
		$tahun = $year;

		$data = array();

		$temp = $this->workday_plan_model->get_by_month(intval($month),$year)->result_array();

		foreach ($temp as $row) {
			if($row['status']=='0'){
				$tanggal = $row['tanggal'];
				if($tanggal < 10){
					$tanggal = '0'.$tanggal;
				}
				$event = array('title'=>$row['keterangan'],'start'=>$tahun.'-'.$bulan.'-'.$tanggal);
				array_push($data, $event);
			}
		}

		echo json_encode($data);
	}

	public function detail_date(){
		$date = $_POST['tanggal'];
		$tmp = explode('-', $date);
		$tanggal = $tmp[2];
		$bulan = $tmp[1];
		$tahun = $tmp[0];

		$data = array();

		$temp = $this->workday_plan_model->get_by_date(intval($tanggal),intval($bulan),$tahun)->row_array();

		$data['id_perencanaan'] = $temp['id_perencanaan'];
		$data['tanggal'] = $temp['tanggal'];
		$data['bulan'] = $temp['bulan'];
		$data['tahun'] = $temp['tahun'];
		$data['status'] = $temp['status'];
		$data['keterangan'] = $temp['keterangan'];

		echo json_encode($data);
	}
}