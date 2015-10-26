<?php

namespace App\Http\Controllers;

use DB;
use File;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ParentFrontpage;
use App\Models\Permission;

class DashboardController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function showApp(Request $request){
			$result = DB::table('parent_frontpage')->get();
			$access = $request->input('access');
			return view('_layout.select-action-role', compact('result', 'access'));
	}

	public function editSave(Request $request){
			$allowed = array('png', 'jpg', 'gif');
			$hasil = false;
			$image = 'holder.js/180x180';
			
			$results = new \StdClass;
			$validator = \Validator::make($request->all(),
				[
					'nama' => 'required',
					'mode' => 'required',
				]
			);
			$destination = ParentFrontpage::UPLOAD_PATH;

			$result = '';

			if($validator->passes()){
				if($request->has('id') && $request->input('id') != 'xxx'){
					$result = ParentFrontpage::find($request->input('id'));
					$results->info = 'menu frontpage update';
					$results->status = 1;
					$permission = Permission::where('name', $result->nama);
				}else{
					$result = new ParentFrontpage;
					$results->info = 'menu frontpage create';
					$results->status = 1;
					$permission = new Permission;
				}
				$results->message = 'Proses Pengubahan Menu Sukses!';

				$result->nama = $request->input('nama');
				$result->mode = $request->input('mode');
				$result->redirect = $request->input('redirect');
				$result->public_key = $request->input('puKey');
				$result->private_key = $request->input('prKey');
				$result->query = $request->input('query');
				$result->db_host = $request->input('dbhost');
				$result->db_user = $request->input('dbuser');
				$result->db_pass = $request->input('dbpass');

				if($request->hasFile('image')){
					if($request->file('image')->isValid()){

						$filename = date('YmdHis').str_pad(rand(0, 1000), 4, 0, STR_PAD_LEFT).'.'.$request->file('image')->guessExtension();
						$img = \Image::make($request->file('image'))->fit(180, 180)->save($destination.$filename);

						$result->image = $filename;
					}
				}

				$result->save();

                $permission->name = $request->input('nama');
                $permission->display_name = 'Dapat Mengakses '.$request->input('nama');
                $permission->description = 'Dapat Mengakses '.$request->input('nama');
                $permission->access = $result->id;
                $permission->action = 'access';
                $permission->type = 'app';
                $permission->save();
                $results->info = 'permission create';

			}else{
				$results->info = 'menu frontpage';
				$results->status = 0;
				$results->message = 'Proses Pengubahan Menu Gagal!';
			}
			$results->result = $result;

		return response()->json($results);
	}

		public function formDashboard(Request $request){
			$parent_id = 'xxx';
			if($request->input('id')!='x'){
				$result1 = DB::table('parent_frontpage')->where('id', $request->input('id'))->get();
				foreach($result1 as $rS){
					$nama = $rS->nama;
					$redirect = $rS->redirect;
					$image = $rS->image;
					$id = $rS->id;
					$mode = $rS->mode;
					$puKey = $rS->public_key;
					$prKey = $rS->private_key;
					$query = $rS->query;
					$dbhost = $rS->db_host;
					$dbuser = $rS->db_user;
					$dbpass = $rS->db_pass;
					$avatar = $rS->image;

				}
				$files = File::files(public_path() . '/uploads/menu/');
				return view('_layout.form.form-input-dashboard-backend', compact('puKey','prKey','nama', 'redirect', 'image','files','id','mode','parent_id', 'query', 'dbhost', 'dbuser', 'dbpass', 'avatar'));
			}else{
				return view('_layout.form.form-new-input-dashboard-backend', compact('parent_id'));
			}
		}

	public function delete(Request $request){
		$del = ParentFrontpage::find($request->input('id'));
		
		$permission = Permission::where('name', $del->name)->get();
		if(count($permission)>0){
			foreach ($permission as $key => $p) {
				$p->delete();
			}
		}

		$del->delete();
		return $del==true?'success':'fail';
	}
}
