<?php

namespace xingkong\composertest\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use xingkong\composertest\Http\Models\Admin;

class LoginController extends Controller
{
    /**
     * showdoc
     * @catalog 权限系统/管理员
     * @title 登录
     * @description 管理员登录的接口
     * @method post
     * @url admin/login
     * @param account 必选 string 账号
     * @param password 必选 string 密码
     * @return {"data":{"token":"admin_token","path":[]}}
     * @return_param message  string 请求状态success为成功其他为失败信息
     * @return_param -data object   响应数据
     * @return_param token string 标识
     * @return_param path array 页面路由
     * @remark
     * @number 7
     */
    public function login(Request $req)
    {
        $req->validate([
            'account' => 'required|string|max:100',
            'password' => 'required|string|min:1|max:20',
        ]);
        $data = Admin::where('account', $req->account)->where('password', md5(md5($req->password).env('APP_ATTACH')))->first();
        if (false == $data) {
            return $this->returnJson(1,'账号未注册',[]);
        }
        if (2 == $data->status) {
            return $this->returnJson(1,'账号已冻结',[]);
        }
//        if (1 == $data->is_super) {
//            $rules = Rule::select('id','title','pid','rule', 'type', 'path')->where('status', 1)->get();
//        } else {
//            $group = Group::select('rules')->find($data->group_id);
//            if (false == $group) {
//                return $this->returnJson(1,'无此管理组',[]);
//            }
//            $rules = Rule::select('id','title','pid','rule', 'type', 'path')->whereIn('id', explode(",", $group->rules))->where('status', 1)->get();
//        }
//        $path = []; // 接口返回
//        $rule = []; // 作用域使用
//        $newRule = []; // 引用权限
//        if ($rules->isNotEmpty()) {
//            foreach ($rules->toArray() as $key => $value) {
//                if ($value['type'] >= 2 && $value['rule'] != []) {
//                    array_push($rule, $value['rule']);
//                }
//                $newRule[$value['id']] = $value;
//            }
//            foreach ($newRule as $key => $datum) {
//                if ($datum['pid'] > 0) {
//                    //不是根节点的将自己的地址放到父级的child节点
//                    $newRule[$datum['pid']]['child'][] = &$newRule[$key];
//                } else {
//                    //根节点直接把地址放到新数组中
//                    $path[] = &$newRule[$datum['id']];
//                }
//            }
//        }
////        \DB::table('oauth_access_tokens')
////            ->where(['user_id'=>$data->id,'name'=>'admin_token'])
////            ->delete();
        $token = $data->createToken('admin_token', [])->accessToken;
        return $this->returnJson(0,'成功',['token' => $token,'path' => []]);
    }

    /**
     * showdoc
     * @catalog 权限系统/管理员
     * @title 登出
     * @description 管理员登出的接口
     * @method post
     * @url admin/logout
     * @return {"data":[]}
     * @return_param message  string 请求状态success为成功其他为失败信息
     * @return_param -data object   响应数据
     * @remark
     * @number 8
     */
    public function logout(Request $req)
    {
//        \DB::table('oauth_access_tokens')
//            ->where(['user_id'=>$req->user('admin')->id,'name'=>'admin_token'])
//            ->delete();
        $req->user('admin')->token()->delete();
        return $this->returnJson(0,'成功',[]);
    }
}
