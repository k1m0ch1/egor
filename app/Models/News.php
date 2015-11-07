<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //

    const UPLOAD_PATH = 'uploads/news';

    public function getAuthor(){
    	$results = \App\Models\User::find($this->author);
    	if(!is_null($results)){
    		return $results->name;
    	}else{
    		return "Not Found";
    	}
    }

    public function formalTime(){
    	$results = date('l, j F Y', strtotime($this->created_at));

    	return $results;
    }

    public function excerpt(){
        return substr($this->content, 0, 140);
    }
}
