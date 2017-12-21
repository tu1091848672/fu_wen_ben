<?php
namespace app\index\controller;

use think\Controller;
use  think\Db;
class Index extends Controller
{
    public function index()
    {
       return   $this->fetch();

    }
   public  function  index2(){
       $id =input('id');
       $info =DB::name('aa')->where('id',$id)->select();
       var_dump($info);
   }
    public  function  index3(){
        $id=input('get.id');


        $data=DB::name('aa')->where('id',$id)->find();

        return  $this->fetch('',['data'=>$data]);
       // return $this->fetch();
    }
    public  function  add(){



            $data =(input('post.'));
        $info=$data['text'];  //富文本编辑器

         //  $data =1;
            if(is_empty_data($data)){
                return 22;die;
                $info=DB::name('aa')->insert($data);

                if($info==true||$info==1){
                    return $this->success('添加成功',url('index/index'),-1,1);
                }else{
                    return $this->error('添加失败',url('index/index'),-1,1);
                }
            }


    }
}
