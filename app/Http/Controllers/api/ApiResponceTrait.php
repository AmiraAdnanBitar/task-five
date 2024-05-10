<?php
namespace App\Http\Controllers\api;
trait ApiResponceTrait
{
    public function ApiResponse($data=null,$msg=null,$status=null)
    {
        $array=[
            'data'=>$data,
            'meesage'=>$msg,
            'status'=>$status
        ];
        return response($array);
    }
    public function MainCategoryResponse($Books=null,$main=null,$detail=null)
    {
        $array=[
            'Books' =>  $Books ,
            'Main Category'=> $main,
            'Main Category Details'=> $detail,
        ];
        return response($array);
    }
    public function SubCategoryResponse($Books=null,$sub=null,$detail=null)
    {
        $array=[
            'Books' =>  $Books ,
            'Sub Category'=> $sub,
            'Sub Category Details'=> $detail,
        ];
        return response($array);
    }
    public function LoginResponse($user=null,$token=null,$msg=null)
    {
        $array=[
            'user' =>  $user ,
            'token'=> $token,
            'message'=> $msg,
        ];
        return response($array);
    }
}