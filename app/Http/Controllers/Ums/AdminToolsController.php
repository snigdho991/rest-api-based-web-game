<?php

namespace App\Http\Controllers\Ums;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\FamilyAdmin;
use App\Models\ApiUrl;
use App\Models\Player;

use DataTables;

use Session;
use Image;
use Auth;

class AdminToolsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Administrator']);
    }

    public function fetchUrl(){
        return ApiUrl::findOrFail(1)->url;
    }

    public function dashboard()
    {
        return view('backend.administrator.index');
    }

    public function all_families()
    {
    	$url = $this->fetchUrl();
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Array("User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15") ); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec ($ch);
		curl_close ($ch);
		$info = json_decode($result, true);

		$output = array();

		foreach ($info['users'] as $key => $value) {
			$output[] = $value['f_name'];
		}

		$families = array_unique(array_filter($output));

		return view('backend.administrator.all-families', compact('families'));

    }

    public function users_by_family($family)
    {
    	$url = $this->fetchUrl();
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Array("User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15") ); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec ($ch);
		curl_close ($ch);
		$info = json_decode($result, true);

		$attrs = [];
		
		foreach ($info['users'] as $key => $value) {
		    if($value['f_name'] == $family){
		    	$attrs[] = $value;
		    }
		}

		return view('backend.administrator.users-by-family', compact('attrs','family'));

    }

    public function store_local_admin(Request $request)
    {
    	$this->validate($request, [
        	'name'        => 'required',
            'email'       => 'required|email|unique:users',
            'family_name' => 'required',
            'password'    => 'required',
        ]);

        $user = new User();
       	$user->name     = $request->name;
        $user->email    = $request->email;
        $user->role     = 'Local Administrator';
        $user->password = bcrypt($request->password);

        if($request->hasFile('photo')){
        	$image_tmp = $request->file('photo');
            if ($image_tmp->isValid()) {
                $image_name = $image_tmp->getClientOriginalName();
                $extension = $image_tmp->getClientOriginalExtension();
                $image_new_name = $image_name.'-'.rand(111,99999).'.'.$extension;

                $original_image_path = 'assets/uploads/local-admin/'.$image_new_name;
                
                Image::make($image_tmp)->save($original_image_path);
                
                $user->profile_photo_path = $image_new_name;
            }
        }

        $user->save(); 

        $family_admin = FamilyAdmin::create([
        	'family_name' => $request->family_name,
        	'user_id' => $user->id,
        ]);

        $user->assignRole('Local Administrator');

        Session::flash('success', 'Local Family Administrator Added Successfully !');
        return redirect()->route('dashboard');
    }

    public function destroy_local_admin($id)
    {        
        $familyadmin = FamilyAdmin::findOrFail($id);
        $finduser = User::findOrFail($familyadmin->user_id);
        
        $familyadmin->delete();
        $finduser->delete();

        Session::flash('error', 'Local Family Administrator Deleted Successfully !');
        return redirect()->route('all.families');

    }

    public function api_url()
    {
        $api = $this->fetchUrl();
        return view('backend.administrator.api-url', compact('api'));
    }

    public function update_api_url(Request $request)
    {
        $this->validate($request, [
            'url' => 'required',
        ]);

        $find_api = ApiUrl::findOrFail(1);
        $find_api->url = $request->url;

        $find_api->save();

        Session::flash('success', 'API Url Saved Successfully !');
        return redirect()->back();
    }
}
