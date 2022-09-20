<?php

namespace App\Http\Controllers\Cms;

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

class IndexController extends Controller
{
    public function fetchUrl(){
        return ApiUrl::findOrFail(1)->url;
    }

    public function dashboard_index_api(Request $request)
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
            $attrs[$key] = $value;
        }

        usort($attrs, function($a, $b) {
            return $a['status'] <=> $b['status'];
        });

        
        return DataTables::of($attrs)
                    ->addIndexColumn()
                    ->editColumn('uname', function ($attr) {
                        $player = Player::where('player_name', $attr['uname'])->where('family_name', $attr['f_name'])->where('rank_name', $attr['rank_name'])->first();

                        if($player && $player->user_id != null){
                            return '<span style="float: left;">
                                        <span style="font-weight: 500;">'. $attr['uname'] .'</span>
                                    </span>
                                    <span class="CellWithComment">
                                        <i class="mdi mdi-arrow-up-bold-circle-outline ms-1 text-success" style="position: relative; top: -4px; cursor: pointer; font-size: 18px; float: right;"></i>
                                        <span class="CellComment" style="background-color:#34c38f !important;">Activated</span>
                                    </span>';
                        } else {
                            return '<span style="float: left;">
                                        <span style="font-weight: 500;">'. $attr['uname'] .'</span>
                                    </span>
                                    <span class="CellWithComment">
                                        <i class="mdi mdi-arrow-down-bold-circle-outline ms-1 text-danger" style="position: relative; top: -4px; cursor: pointer; font-size: 18px; float: right;"></i>
                                        <span class="CellComment" style="background-color:#f46a6a !important;">De-activated</span>
                                    </span>';
                        }
                    })
                    ->editColumn('status', function ($attr) {
                        if ($attr['status'] == 2) {return '<span class="badge bg-success">Alive</span>';}
                        else if($attr['status'] == 3) {return '<span class="badge bg-danger">Dead</span>';}
                    })
                    ->editColumn('f_name', function ($attr) {
                    	if($attr['f_name'] != null) {
                        	return '<span id="tooltip-container"><span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="'.$attr['f_name'].'">'.$attr['f_name'].'</span></span>';
                        } else {
                        	return '<span class="badge rounded-pill badge-soft-danger">N/A</span>';
                        }
                    })
                    ->editColumn('shooter_one', function ($attr) {
                        $player = Player::where('player_name', $attr['uname'])->where('family_name', $attr['f_name'])->where('rank_name', $attr['rank_name'])->first();

                        if($player && $player->shooter_one) {
                            return ''.$player->shooter_one;
                        } else {
                            return '<span class="badge rounded-pill badge-soft-danger">N/A</span>';
                        }
                    })
                    ->editColumn('shooter_two', function ($attr) {
                        $player = Player::where('player_name', $attr['uname'])->where('family_name', $attr['f_name'])->where('rank_name', $attr['rank_name'])->first();
                        
                        if($player && $player->shooter_two) {
                            return ''.$player->shooter_two;
                        } else {
                            return '<span class="badge rounded-pill badge-soft-danger">N/A</span>';
                        }
                    })
                    ->editColumn('shooter_three', function ($attr) {
                        $player = Player::where('player_name', $attr['uname'])->where('family_name', $attr['f_name'])->where('rank_name', $attr['rank_name'])->first();
                        
                        if($player && $player->shooter_three) {
                            return ''.$player->shooter_three;
                        } else {
                            return '<span class="badge rounded-pill badge-soft-danger">N/A</span>';
                        }
                    })
                    ->editColumn('found', function ($attr) {
                        $player = Player::where('player_name', $attr['uname'])->where('family_name', $attr['f_name'])->where('rank_name', $attr['rank_name'])->first();
                        
                        if($player && $player->found) {
                            return ''.$player->found;
                        } else {
                            return '<span class="badge rounded-pill badge-soft-danger">N/A</span>';
                        }
                    })
                    ->editColumn('comment', function ($attr) {
                        $player = Player::where('player_name', $attr['uname'])->where('family_name', $attr['f_name'])->where('rank_name', $attr['rank_name'])->first();
                        
                        if($player && $player->comment) {
                            return ''.$player->comment;
                        } else {
                            return '<span class="badge rounded-pill badge-soft-danger">N/A</span>';
                        }
                    })
                    ->rawColumns(['status', 'f_name', 'uname', 'shooter_one', 'shooter_two', 'shooter_three', 'found', 'comment'])
                    ->make(true);
    }
}
