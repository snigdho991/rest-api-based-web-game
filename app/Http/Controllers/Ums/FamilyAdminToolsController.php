<?php

namespace App\Http\Controllers\Ums;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\FamilyAdmin;
use App\Models\Player;
use App\Models\ApiUrl;

use Session;
use Image;
use Auth;

class FamilyAdminToolsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Local Administrator']);
    }

    public function fetchUrl(){
        return ApiUrl::findOrFail(1)->url;
    }

    public function family_admin_dashboard()
    {
        return view('backend.local-admin.index');
    }

    public function my_family($family)
    {
        $find_family = FamilyAdmin::where('family_name', $family)->first();
        
        if (Auth::user()->id == $find_family->user_id) {
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
                if ($value['f_name'] == $family) {
                    $attrs[] = $value;
                }
            }

            return view('backend.local-admin.my-family', compact('attrs', 'family'));
        } else {
            abort(403);
        }
    }

    public function shooter_one(Request $request)
    {
        $this->validate($request, [
            'shooter_one' => 'required',
        ]);

        $find_player = Player::where('player_name', $request->player_name)->where('family_name', $request->family_name)->where('rank_name', $request->rank_name)->first();
        if($find_player) {
            $find_player->shooter_one = $request->shooter_one;
            $find_player->save();

            Session::flash('success', ' Shooter One Inserted Successfully !');
            return redirect()->back();
        } else {
            $new_player = new Player;
            $new_player->player_name = $request->player_name;
            $new_player->family_name = $request->family_name;
            $new_player->rank_name   = $request->rank_name;
            $new_player->shooter_one = $request->shooter_one;

            $new_player->save();

            Session::flash('success', ' Shooter One Inserted Successfully !');
            return redirect()->back();
        }
    }

    public function delete_shooter_one($shooter_one)
    {        
        $player = Player::where('player_name', $shooter_one)->first();
        
        $player->shooter_one = null;
        $player->save();

        Session::flash('error', 'Shooter One Removed Successfully !');
        return redirect()->back();

    }


    public function shooter_two(Request $request)
    {
        $this->validate($request, [
            'shooter_two' => 'required',
        ]);

        $find_player = Player::where('player_name', $request->player_name)->where('family_name', $request->family_name)->where('rank_name', $request->rank_name)->first();
        if($find_player) {
            $find_player->shooter_two = $request->shooter_two;
            $find_player->save();

            Session::flash('success', ' Shooter Two Inserted Successfully !');
            return redirect()->back();
        } else {
            $new_player = new Player;
            $new_player->player_name = $request->player_name;
            $new_player->family_name = $request->family_name;
            $new_player->rank_name   = $request->rank_name;
            $new_player->shooter_two = $request->shooter_two;

            $new_player->save();

            Session::flash('success', ' Shooter Two Inserted Successfully !');
            return redirect()->back();
        }
    }

    public function delete_shooter_two($shooter_two)
    {        
        $player = Player::where('player_name', $shooter_two)->first();
        
        $player->shooter_two = null;
        $player->save();

        Session::flash('error', 'Shooter Two Removed Successfully !');
        return redirect()->back();

    }


    public function shooter_three(Request $request)
    {
        $this->validate($request, [
            'shooter_three' => 'required',
        ]);

        $find_player = Player::where('player_name', $request->player_name)->where('family_name', $request->family_name)->where('rank_name', $request->rank_name)->first();
        if($find_player) {
            $find_player->shooter_three = $request->shooter_three;
            $find_player->save();

            Session::flash('success', ' Shooter Three Inserted Successfully !');
            return redirect()->back();
        } else {
            $new_player = new Player;
            $new_player->player_name = $request->player_name;
            $new_player->family_name = $request->family_name;
            $new_player->rank_name   = $request->rank_name;
            $new_player->shooter_three = $request->shooter_three;

            $new_player->save();

            Session::flash('success', ' Shooter Three Inserted Successfully !');
            return redirect()->back();
        }
    }

    public function delete_shooter_three($shooter_three)
    {        
        $player = Player::where('player_name', $shooter_three)->first();
        
        $player->shooter_three = null;
        $player->save();

        Session::flash('error', 'Shooter Three Removed Successfully !');
        return redirect()->back();

    }

    public function store_user(Request $request)
    {

        $this->validate($request, [
            'player_name' => 'required',
            'email'       => 'required|email|unique:users',
            'password'    => 'required',
        ]);

        $find_player = Player::where('player_name', $request->player_name)->where('family_name', $request->family_name)->where('rank_name', $request->rank_name)->first();
        if($find_player){
            $user = new User();
            $user->name     = $request->player_name;
            $user->email    = $request->email;
            $user->role     = 'User';
            $user->password = bcrypt($request->password);

            if($request->hasFile('photo')){
                $image_tmp = $request->file('photo');
                if ($image_tmp->isValid()) {
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    $image_new_name = $image_name.'-'.rand(111,99999).'.'.$extension;

                    $original_image_path = 'assets/uploads/user/'.$image_new_name;
                    
                    Image::make($image_tmp)->save($original_image_path);
                    
                    $user->profile_photo_path = $image_new_name;
                }
            }

            $user->save(); 

            $find_player->user_id = $user->id;

            $find_player->save();

            $user->assignRole('User');

            Session::flash('success', 'User Added Successfully !');
            return redirect()->back();

        } else {

            $user = new User();
            $user->name     = $request->player_name;
            $user->email    = $request->email;
            $user->role     = 'User';
            $user->password = bcrypt($request->password);

            if($request->hasFile('photo')){
                $image_tmp = $request->file('photo');
                if ($image_tmp->isValid()) {
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    $image_new_name = $image_name.'-'.rand(111,99999).'.'.$extension;

                    $original_image_path = 'assets/uploads/user/'.$image_new_name;
                    
                    Image::make($image_tmp)->save($original_image_path);
                    
                    $user->profile_photo_path = $image_new_name;
                }
            }

            $user->save(); 

            $player = Player::create([
                'family_name' => $request->family_name,
                'rank_name'   => $request->rank_name,
                'player_name' => $request->player_name,
                'user_id'     => $user->id,
            ]);

            $user->assignRole('User');

            Session::flash('success', 'User Added Successfully !');
            return redirect()->back();
        }
    }

    public function delete_player($id)
    {
        $find_player = Player::where('user_id', $id)->first();
        
        $find_player->user_id = null;
        $find_player->save();

        $user = User::find($id);
        $user->delete();

        Session::flash('error', 'User Deleted Successfully !');
        return redirect()->back();
    }
}