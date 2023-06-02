<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class QrCodeController extends Controller
{
    public function index(Request $request)
    {
      $data = $request->all();
      if(isset($data) && !empty($data)){
        $post = User::find($data['id']);
        $post->firstname = $data['firstname'];
        $post->lastname = $data['lastname'];
        $post->save();
      } 
    }
    public function update(){
		
        print($request);exit;
	}
}