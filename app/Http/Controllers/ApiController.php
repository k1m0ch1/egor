<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Ldap as Users;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('api_auth');
    }
    
    public function getUserAttributes(Request $request, $id, $mode="any") {
        $response = [
            'response' => 'OK',
            'statusCode' => 200,
            'result' => $this->_getUserAttributes($id,$mode),
            'message' => 'Retrieve success'
        ];
        return response()->json($response);
    }
    
    public function _getUserAttributes($id, $mode="any") {
        if (!in_array($mode, ["nip","email","username","any"])) {
            $response = [
                'response' => 'FAILED',
                'statusCode' => 403,
                'message' => 'Unknown mode '.$mode
            ];
            return response()->json($response);
        }
        switch ($mode) {
            case "nip":
                $mode = "uid";
                break;
            case "email":
                $mode = "l";
                break;
            case "username":
                $mode = "o";
                break;
        }
        $users = new Users;
        if ($mode == "any") {
            $user = $users->findByFilter("(|(uid=$id)(l=$id)(o=$id))",true);
        } else {
            $user = $users->findByFilter("$mode=$id",true);
        }
        if (!$user) {
            return [];
        }
        $result = json_decode($user['description'][0],false);
        $result->email = $user['l'][0];
        $result->nip = $user['uid'][0];
        $result->username = $user['o'][0];
        return $result;
    }
    
}
