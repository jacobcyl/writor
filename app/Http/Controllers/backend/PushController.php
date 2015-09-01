<?php namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Input;
use App\Http\Requests;
use \View;
use Auth;
use App\Push;
use IGeTui;
use IGtBatch;
use IGtSingleMessage;
use IGtTarget;
use IGtLinkTemplate;

define('APPKEY','rnJCsO5CtVAFgJs1rLzjW');
define('APPID','YCVux32lZFAkI8sVuOdsa7');
define('MASTERSECRET','D9NpkQ5AJ16SlfavFsG1u1');
define('HOST','http://sdk.open.api.igexin.com/apiex.htm');
define('CID','407fa1694a2af4bdb63a58e02a184fd8');
define('DEVICETOKEN','');
define('Alias','alias');


class PushController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    public function getBuild(){
        //return redirect('/admin/push/record')->withMessage("创建推送成功");
        return View::make('backend.pages.push-build');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function postCreate()
    {
        $push = new Push;
        $push->user_id = Auth::user()->id;
        $push->title = Input::get('title');
        $push->content = Input::get('content');
        $push->target = "全部用户";
        $push->save();
        self::pushMessageToSingleBatch();

        return redirect('/admin/push/record');
    }

    public function getRecord(){
        $pushs = Push::paginate(15);
        return View::make('backend.pages.push-record')->withPushs($pushs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


    private function pushMessageToSingleBatch(){
        putenv("gexin_pushSingleBatch_needAsync=false");

        $igt = new IGeTui(HOST, APPKEY, MASTERSECRET);
        $batch = new IGtBatch(APPKEY, $igt);
        $batch->setApiUrl(HOST);
        //$igt->connect();
        //消息模版：
        // 1.TransmissionTemplate:透传功能模板
        // 2.LinkTemplate:通知打开链接功能模板
        // 3.NotificationTemplate：通知透传功能模板
        // 4.NotyPopLoadTemplate：通知弹框下载功能模板

    //    $template = IGtNotyPopLoadTemplateDemo();
        $template = self::IGtLinkTemplateDemo();
        //$template = IGtNotificationTemplateDemo();
    //    $template = IGtTransmissionTemplateDemo();

        //个推信息体
        $message = new IGtSingleMessage();
        $message->set_isOffline(true);//是否离线
        $message->set_offlineExpireTime(12 * 1000 * 3600);//离线时间
        $message->set_data($template);//设置推送消息类型
    //    $message->set_PushNetWorkType(1);//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送

        $target = new IGtTarget();
        $target->set_appId(APPID);
        $target->set_clientId(CID);
        $batch->add($message, $target);
        try {

            $rep = $batch->submit();
            // var_dump($rep);
            // echo("<br><br>");
        }catch(Exception $e){
            $rep=$batch->retry();
            // var_dump($rep);
            // echo ("<br><br>");
        }
    }

    private function IGtLinkTemplateDemo(){
        $template =  new IGtLinkTemplate();
        $template ->set_appId(APPID);//应用appid
        $template ->set_appkey(APPKEY);//应用appkey
        $template ->set_title(Input::get('title'));//通知栏标题
        $template ->set_text(Input::get('content'));//通知栏内容
        $template ->set_logo("http://bazhua.igexin.com/file/2015/7/26/10/14405559420990849.txt");//通知栏logo
        $template ->set_isRing(true);//是否响铃
        $template ->set_isVibrate(true);//是否震动
        $template ->set_isClearable(true);//通知栏是否可清除
        $template ->set_url("http://www.igetui.com/");//打开连接地址
        //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
        //iOS推送需要设置的pushInfo字段
        // $apn = new IGtAPNPayload();
        // $apn->alertMsg = "alertMsg";
        // $apn->badge = 11;
        // $apn->actionLocKey = "启动";
        // $apn->category = "ACTIONABLE";
        // $apn->contentAvailable = 1;
        // $apn->locKey = "通知栏内容";
        // $apn->title = "通知栏标题";
        // $apn->titleLocArgs = array("titleLocArgs");
        // $apn->titleLocKey = "通知栏标题";
        // $apn->body = "body";
        // $apn->customMsg = array("payload"=>"payload");
        // $apn->launchImage = "launchImage";
        // $apn->locArgs = array("locArgs");

        // $apn->sound=("test1.wav");;
        // $template->set_apnInfo($apn);
        return $template;
    }

    private function IGtNotificationTemplateDemo(){
        $template =  new IGtNotificationTemplate();
        $template->set_appId(APPID);//应用appid
        $template->set_appkey(APPKEY);//应用appkey
        $template->set_transmissionType(2);//透传消息类型
        $template->set_transmissionContent(Input::get('extraContent'));//透传内容
        $template->set_title(Input::get('title'));//通知栏标题
        $template->set_text(Input::get('content'));//通知栏内容
        $template->set_logo("http://wwww.igetui.com/logo.png");//通知栏logo
        $template->set_isRing(true);//是否响铃
        $template->set_isVibrate(true);//是否震动
        $template->set_isClearable(true);//通知栏是否可清除
        //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
        //iOS推送需要设置的pushInfo字段
        // $apn = new IGtAPNPayload();
        // $apn->alertMsg = "alertMsg";
        // $apn->badge = 11;
        // $apn->actionLocKey = "启动";
        // //        $apn->category = "ACTIONABLE";
        // //        $apn->contentAvailable = 1;
        // $apn->locKey = "通知栏内容";
        // $apn->title = "通知栏标题";
        // $apn->titleLocArgs = array("titleLocArgs");
        // $apn->titleLocKey = "通知栏标题";
        // $apn->body = "body";
        // $apn->customMsg = array("payload"=>"payload");
        // $apn->launchImage = "launchImage";
        // $apn->locArgs = array("locArgs");

        // $apn->sound=("test1.wav");;
        // $template->set_apnInfo($apn);
        return $template;
}

    /**
     * 公用保存用户
     *
     * @param User $user
     *
     * @return void
     */
    protected function makePush($message)
    {
        $user->username    = Input::get('username');
        $user->password     = Input::get('password');
        $user->email    = Input::get('email');
        $user->nickname = Input::get('nickname');
        // $user->user_url      = Input::get('user_url');
        $user->display_name  = Input::get('display_name');

        $user->save();
    }
}
