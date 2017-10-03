<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel_import extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->loginstatus->check_login();
		$this->load->library('form_validation');
		$this->load->library('template');
	}
	public function index(){
		$this->template->display('presences/upload_data_view');
	}

	/*public function import_data(){
		$config = array(
			'upload_path'=> .'upload/',
			'allowed_types'=>'xls'
			);

		//print_r($config['upload_path']);die();
		$this->load->library('upload',$config);
		if ($this->upload->do_upload('userfile')){
			$data = $this->upload->data();
			@chmod($data['full_path'],0777);

			$this->load->library('Spreedsheet_Excel_Reader');
			$this->spreedsheet_excel_reader->setOutputEncoding('CP1251');

			$this->spreedsheet_excel_reader->read($data['full_path']);
			$sheets=$this->spreedsheet_excel_reader->$sheets[0];
			error_reporting(E_ALL ^ E_NOTICE);

			$data_excel=array();
			for($i=1;$i<=$sheets['numRows'];$i++){
				if ($sheets['cells'][$i][1]=='') break;

				$data_excel[$i - 1]['FCCARDNO']=$sheets['cells'][$i][i];
			}
			echo '<prev>';
			print_r($data_excel);
			echo '</prev>';
			die();
		}else{
			print_r("expression");
		}
	}*/

	public function do_upload()
    {
    	$actual_path = FCPATH.'upload/';
    	//print_r($actual_path);die();
        $config['upload_path']          = './upload/temp/';
        $config['allowed_types']        = 'gif|jpg|png|xlsx|csv|xls';
        $config['overwrite'] 			= TRUE;
        /*$config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;*/

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
                print_r("expression");
                //$this->load->view('upload_form', $error);
        }
        else
        {
                print_r("sukses upload ---");
               // print_r(FCPATH);

        		//print_r($this->upload->data());die();
        		$uploaded_file = $this->upload->data();

        		$filename = $uploaded_file['file_name'];

        		$file_check = $actual_path.''.$filename;

        		//print_r($file_check);die();

        		if(file_exists($file_check)){
        			print_r("sudah ada --- ");
        			unlink('upload/temp/'.$filename);
        		}else{
        			print_r("Belum ada ---");
        			
        			if(rename('upload/temp/'.$filename, 'upload/'.$filename)){
        				print_r("sukses pindah ---");
        				@chmod($data['full_path'],0777);

        				$data = array();

        				$column_name = array(
        					'A' => 'kode_mesin',
        					'D' => 'tanggal',
        					'E' => 'jam_masuk',
	    					'F' => 'jam_keluar'
        					);

						$this->load->library('Excel');
						

						$file = 'upload/'.$filename;
 	 
						//read file from path
						$objPHPExcel = PHPExcel_IOFactory::load($file);
						 
						//get only the Cell Collection
						$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

						$one_data = array();
						//extract to a PHP readable array format
						foreach ($cell_collection as $cell) {
						    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
						    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
						    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getFormattedValue();
						 	
						 	//print_r($row);echo "<br>";
						 	/*if ($row == 1) {
						        $header[$row][$column] = $data_value;
						    } else {
						        $arr_data[$row][$column] = $data_value;
						    }*/

						   /* if (PHPExcel_Shared_Date::isDateTime($cell)) {
			                    echo $cell->getFormattedValue() , EOL;
			                } else {
			                    echo $cell->getValue() , EOL;
			                }*/

						 	if($row>1){

						 		if(array_key_exists($column, $column_name)){
						 			if($column=='D'){
						 				$parts =  explode('/',$data_value);

						 				$data_value	= $parts[2].'-'.$parts[0].'-'.$parts[1];
						 				print_r($data_value);echo "<br>";
						 			}
						 			$one_data[$column_name[$column]] = $data_value;		

								/*$data_kehadiran = array(
									'hadir' => '1',
									'id_alasan' => '5',
									'created_date' => date('Y-m-d'),
									'created_user' => $this->session->userdata('user_id'),
									'active' => '1'	
											);*/
						 		}

						 	}

						 	if($column=='F' && $row>1){
						    	array_push($data, $one_data);
						    	$one_data = array();
						    }

						 	
						}
						
						echo "<pre>";print_r($data);echo "</pre>";

						$this->load->model('presences_m');

						$this->presences_m->save_all($data);
						$this->presences_m->update($data_kehadiran);



        			}else{
        				print_r("gagal pindah ---");
        			}
        		}
                /*$data = array('upload_data' => $this->upload->data());

                $this->load->view('upload_success', $data);*/
        }
    }
}
