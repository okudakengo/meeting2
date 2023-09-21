<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //テーブル名
    protected $table = 'users';

    //可変項目
    protected $fillable = 
    [ 
        'user_name', 
        'user_email1', 
        'user_password', 
        'user_security_level'
    ];


    /*
     * Users テーブルのカラム user_security_level の値に対応するテキストを返すメソッド
     */
    public function getUserSecurityLevelText()
    {

        //dd($this);
        //var_dump($this);

        switch ($this->user_security_level){
        case 0:
          return "開発権限";
          break;
        case 100:
          return "管理者権限";
          break;
        case 1000:
          return "一般権限";
          break;
        case 10000:
          return "外部権限";
          break;
        default:
          return "???(" . $this->user_security_level . ")";
        }


    }

}
