<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
	
	use SoftDeletes;
	
    //テーブル名
    protected $table = "meetings";
    
    //可変項目
    protected $fillable = 
    [
		    'meeting_date', 
		    'meeting_name', 
		    'meeting_description'
    ];
    
    public function getMeetingPriorityText(){
    	
    	switch ($this->meeting_priority){
    	case 0:
    		return "A";
    		break;
    	case 1:
    		return "B";
    		break;
    	case 2:
    		return "C";
    		break;
    	default:
    		return "???(" . $this->meeting_priority . ")";
    	}
    }
}
