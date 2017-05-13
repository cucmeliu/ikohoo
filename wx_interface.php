<?php
//装载模板文件
include_once("wx_tpl.php");

//获取微信发送数据
$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];


define("HELLOMSG", "感谢您关注科狐工作室！[愉快]正在建设中");
       
define("MENUMSG", "    1. 关于科狐工作室 \n      About ikohoo
    2. 云计算 \n      Cloud Computing
    3. 大数据 \n      Big Data
    4. 移动互联网 \n      Mobile Internet
    5. 关于呆瓜 \n      About Me
    6. 各种查询 \n      Convinent Query
    请输入编号查阅相应内容[玫瑰]
    ");
       
$MainMenu=array(
    array(),
    array("Title"=>"科狐工作室", 
          "Description" =>"", 
          "PicUrl" =>"http://ikohoo-ikohoo.stor.sinaapp.com/pic/logo.jpg", 
          "Url" =>"http://ikohoo.sinaapp.com/index.php"),
    array("Title"=>"云计算", 
          "Description" =>"栏目正在建设中...", 
          "PicUrl" =>"http://ikohoo-ikohoo.stor.sinaapp.com/pic/cloud.jpg", 
          "Url" =>"http://ikohoo.sinaapp.com/showAPage.php?mainpage=cloud"),
    array("Title"=>"大数据", 
          "Description" =>"栏目正在建设中...", 
          "PicUrl" =>"http://ikohoo-ikohoo.stor.sinaapp.com/pic/bigdata.jpg", 
          "Url" =>"http://ikohoo.sinaapp.com/showAPage.php?mainpage=bigdata"),
    array("Title"=>"移动互联网", 
          "Description" =>"", 
          "PicUrl" =>"http://ikohoo-ikohoo.stor.sinaapp.com/pic/mobileinet.png", 
          "Url" =>"http://ikohoo.sinaapp.com/showAPage.php?mainpage=mobileInet"),
    array("Title"=>"呆瓜", 
          "Description" =>"关于呆瓜", 
          "PicUrl" =>"http://ikohoo-ikohoo.stor.sinaapp.com/pic/myworkcard.jpg", 
          "Url" =>"http://ikohoo.sinaapp.com/showAPage.php?mainpage=aboutme"),
    array("Title"=>"【11】新闻 天气 空气 股票 彩票 星座\n".
    "【12】快递 人品 算命 解梦 附近 苹果\n".
    "【13】公交 火车 汽车 航班 路况 违章\n".
    "【14】翻译 百科 双语 听力 成语 历史\n".
    "【15】团购 充值 菜谱 贺卡 景点 冬吴\n".
    "【16】情侣相 夫妻相 亲子相 女人味\n".
    "【17】相册 游戏 笑话 答题 点歌 树洞\n".
    "【18】微社区 四六级 华强北 世界杯\n\n".
    "更多精彩，即将亮相，敬请期待", 
          "Description" =>"", 
          "PicUrl" =>"", 
          "Url" =>"")

    );
       
$QueryMenu= array("Title" =>"【1】新闻 天气 空气 股票 彩票 星座\n".
    "【2】快递 人品 算命 解梦 附近 苹果\n".
    "【3】公交 火车 汽车 航班 路况 违章\n".
    "【4】翻译 百科 双语 听力 成语 历史\n".
    "【5】团购 充值 菜谱 贺卡 景点 冬吴\n".
    "【6】情侣相 夫妻相 亲子相 女人味\n".
    "【7】相册 游戏 笑话 答题 点歌 树洞\n".
    "【8】微社区 四六级 华强北 世界杯\n\n".
    "更多精彩，即将亮相，敬请期待！", "Description" =>"", "PicUrl" =>"", "Url" =>"");
       
       
/*
private function transmitNews($object, $newsArray)
    {
        if(!is_array($newsArray)){
            return "";
        }
        $itemTpl = "    <item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
   	 	</item>
		";
        $item_str = "";
        foreach ($newsArray as $item){
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $newsTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<Content><![CDATA[]]></Content>
<ArticleCount>%s</ArticleCount>
<Articles>
$item_str</Articles>
</xml>";

        $result = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray));
        return $result;
    }

*/
  //返回回复数据
if (!empty($postStr)){

        //解析数据
          $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        //发送消息方ID
          $fromUsername = $postObj->FromUserName;
        //接收消息方ID
          $toUsername = $postObj->ToUserName;
         //消息类型
          $form_MsgType = $postObj->MsgType;

    // 文字消息
    	if($form_MsgType=="text")
        {
            $form_Content = trim($postObj->Content);
            if(!empty($form_Content))
            {
                switch ($form_Content)
                {
                    case "1":
                    case "2":
                    case "3":
                    case "4":
                    case "5":
                    $msgType = "news";
                	$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, time(), $msgType, 1, 
                                     $MainMenu[$form_Content]['Title'],
                                         $MainMenu[$form_Content]['Description'],
                                         $MainMenu[$form_Content]['PicUrl'],
                                         $MainMenu[$form_Content]['Url']);
                    break;
                    
                    // 其他查询
                    case "6":
 					$msgType = "text";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, $MainMenu[6]['Title']);
                    break;
                    
                    // 非菜单输入
                    default:
                    $msgType = "text";
                    $ret_Content = "不可识别的输入\n" . MENUMSG;
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, $ret_Content);
                }
                
                //$resultStr = $ret_Content;
                echo $resultStr;
                
                exit;
            }
            else
            {
                $ret_Content  = MENUMSG;
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, $ret_Content);
                echo $resultStr;
                exit;
            }
        }
        else
        //事件消息
          if($form_MsgType=="event")
          {
            //获取事件类型
            $form_Event = $postObj->Event;
            //订阅事件
            if($form_Event=="subscribe")
            {
              //回复欢迎文字消息     
                $msgType = "text";
                $contentStr = HELLOMSG . MENUMSG;
                
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, $contentStr);
                
                echo $resultStr;
              exit;
            }

          }

  }
  else
  {
          echo "";
          exit;
  }

?>