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

class UserToolsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:User']);
    }

    public function fetchUrl(){
        return ApiUrl::findOrFail(1)->url;
    }

    public function user_dashboard()
    {
        return view('backend.user.index');
    	/*$url = $this->fetchUrl();
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
            $attrs[] = $value;
        }

        usort($attrs, function($a, $b) {
            return $a['status'] <=> $b['status'];
        });

        return view('backend.user.index', compact('attrs'));*/
    }

    public function user_details($family, $player)
    {
    	$find_player = Player::where('family_name', $family)->where('player_name', $player)->first();
        
        if (Auth::user()->id == $find_player->user_id) {
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
                if ($value['uname'] == $player) {
                    $attrs[] = $value;
                }
            }

            return view('backend.user.user-details', compact('attrs', 'player', 'family', 'find_player'));
        } else {
            abort(403);
        }
    }

    public function save_found(Request $request)
    {
        $this->validate($request, [
            'found' => 'required',
        ]);

        $find_player = Player::where('user_id', $request->user_id)->first();
        if($find_player) {
            $find_player->found = $request->found;
            $find_player->save();

            Session::flash('success', ' Found Inserted Successfully !');
            return redirect()->back();
        } else {
            $new_player = new Player;
            $new_player->player_name = $request->player_name;
            $new_player->user_id = $request->user_id;
            $new_player->family_name = $request->family_name;
            $new_player->rank_name   = $request->rank_name;
            $new_player->found = $request->found;

            $new_player->save();

            Session::flash('success', ' Found Inserted Successfully !');
            return redirect()->back();
        }
    }

    public function delete_found($player)
    {
        $player = Player::where('player_name', $player)->first();
        
        $player->found = null;
        $player->save();

        Session::flash('error', 'Found Removed Successfully !');
        return redirect()->back();
    }

    public function save_comment(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required',
        ]);

        $find_player = Player::where('user_id', $request->user_id)->first();
        if($find_player) {
            $find_player->comment = $request->comment;
            $find_player->save();

            Session::flash('success', 'Comment Inserted Successfully !');
            return redirect()->back();
        } else {
            $new_player = new Player;
            $new_player->player_name = $request->player_name;
            $new_player->user_id = $request->user_id;
            $new_player->family_name = $request->family_name;
            $new_player->rank_name   = $request->rank_name;
            $new_player->comment = $request->comment;

            $new_player->save();

            Session::flash('success', 'Comment Inserted Successfully !');
            return redirect()->back();
        }
    }

    public function delete_comment($player)
    {        
        $player = Player::where('player_name', $player)->first();
        
        $player->comment = null;
        $player->save();

        Session::flash('error', 'Comment Removed Successfully !');
        return redirect()->back();

    }
}
