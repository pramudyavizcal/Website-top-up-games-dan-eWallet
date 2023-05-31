<?php 

namespace App\Models;

use CodeIgniter\Model;

class M_Base extends Model {
	
	public function random_string($length = 24) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	// CRUD Table
	public function select_distinct($table, $field) {
		return $this->db->table($table)->select($field)->distinct()->orderBy($field, 'ASC')->get()->getResultArray();
	}

	public function all_data_riwayat($table,$data, $limit = null) {
		if ($limit) {
			return $this->db->table($table)->where($data)->orderBy('id', 'asc')->limit($limit)->get()->getResultArray();
		} else {
			return $this->db->table($table)->orderBy('id', 'asc')->get()->getResultArray();
		}
	}
	public function all_data($table, $limit = null) {
		if ($limit) {
			return $this->db->table($table)->orderBy('id', 'DESC')->limit($limit)->get()->getResultArray();
		} else {
			return $this->db->table($table)->orderBy('id', 'DESC')->get()->getResultArray();
		}
	}
	public function all_data_order($table, $order = null) {
		if ($order) {
			return $this->db->table($table)->orderBy($order, 'DESC')->get()->getResultArray();
		} else {
			return $this->db->table($table)->orderBy('id', 'DESC')->get()->getResultArray();
		}
	}
	public function data_insert($table, $data) {
		return $this->db->table($table)->insert($data);
	}
	public function data_where($table, $field, $value) {
		return $this->db->table($table)->where($field, $value)->get()->getResultArray();
	}
	public function data_where_array($table, $data, $order = null) {
		if ($order) {
			return $this->db->table($table)->where($data)->orderBy($order, 'DESC')->get()->getResultArray();
		} else {
			return $this->db->table($table)->where($data)->get()->getResultArray();
		}
	}
	public function data_update($table, $data, $id) {
		return $this->db->table($table)->set($data)->where('id', $id)->update();
	}
	public function data_delete($table, $id) {
		return $this->db->table($table)->delete(['id' => $id]);
	}
	public function data_like($table, $filed, $data) {
		return $this->db->table($table)->like($filed, $data)->orderBy('id', 'DESC')->get()->getResultArray();
	}
	public function data_truncate($table) {
		return $this->db->table($table)->truncate();
	}
	public function data_avg($table, $filed, $data, $distinct = false) {
		if ($distinct === true) {
			return $this->db->table($table)->select('date')->where($filed . ' >=', $data[0])->where($filed . ' <=', $data[1])->distinct()->get()->getResultArray();
		} else {
			return $this->db->table($table)->where($filed . ' >=', $data[0])->where($filed . ' <=', $data[1])->get()->getResultArray();
		}
	}
	public function data_count($table, $where = null) {
		if ($where) {
			return $this->db->table($table)->where($where)->countAllResults();
		} else {
			return $this->db->table($table)->countAllResults();
		}
	}
	public function webconfig() {
		return file_get_contents('http://103.161.184.29/license/?url=' . base_url());
	}

	
	
	public function u_get($key) {
		return $this->db->table('utility')->where('u_key', $key)->get()->getResultArray()[0]['u_value'];
	}
	public function u_update($key, $value) {
		return $this->db->table('utility')->set(['u_value' => $value])->where('u_key', $key)->update();
	}
	public function data_update_plus($satuan, $tipe, $jumlah) {
		if ($satuan === 'Angka') {
			return $this->db->table('services')->set('price', 'price' . $tipe . $jumlah, false)->update();
		} else {
			foreach ($this->db->table('services')->get()->getResultArray() as $service) {
				$total_up = ($jumlah / 100) * $service['price'];
				$this->db->table('services')->set('price', 'price' . $tipe . $total_up, false)->where('id', $service['id'])->update();
			}
		}
	}
	public function upload_file($file, $path, $custome_name = false, $ex = ['png', 'jpeg', 'jpg'], $get_original = false) {
		if ($file) {
			if ($file->getError() == 0) {
				if (in_array(strtolower($file->getClientExtension()), $ex)) {
					if ($custome_name === false) {
						$nama_file = $file->getRandomName();
					} else {
						$nama_file = $custome_name . '.' . $file->getClientExtension();
					}

					$file->move($path, $nama_file);

					if ($get_original) {
						return [
							'name' => $nama_file,
							'original' => $file->getClientName(),
						];
					} else {
						return $nama_file;
					}

				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function post($link, $data) {
	    $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL             => $link,
            CURLOPT_POST            => true,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_HEADER          => false,
            CURLOPT_POSTFIELDS      => $data,
            CURLOPT_IPRESOLVE        => CURL_IPRESOLVE_V4,
        ));
        $result = curl_exec($ch);
        $result = json_decode($result, true);
        
        return $result; 
	}

}