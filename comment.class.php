<?php
class Comment{

    private $data=array();

    // 构造函数 初始化数据
    function __construct($data){
        $this->data=$data;
    }
    /**
     * 检测用户输入的数据    验证成功保存到参数中，并返回true；验证失败，将错误保存到参数中，并返回false
     * @param array $arr
     * @return boolean
     */
    public static function validate(&$arr){
        // filter_input — 通过名称获取特定的外部变量，并且可以通过过滤器处理它
        if(!($data['email']=filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL))){
            $errors['email']='请输入合法邮箱';
        }
        if(!($data['url']=filter_input(INPUT_POST,'url',FILTER_VALIDATE_URL))){
            $url='';
        }
        // 检测判断使用回调函数
        if(!($data['content']=filter_input(INPUT_POST,'content',FILTER_CALLBACK,array('options'=>'Comment::validate_str')))){
            $errors['content']='请输入合法内容';
        }
        if(!($data['username']=filter_input(INPUT_POST,'username',FILTER_CALLBACK,array('options'=>'Comment::validate_str')))){
            $errors['username']='请输入合法用户名';
        }

        // 数组范围 options设置成1到5
        $options=array(
            'options'=>array(
                'min_range'=>1,
                'max_range'=>5
            )
        );
        if(!($data['face']=filter_input(INPUT_POST,'face',FILTER_VALIDATE_INT,$options))){
            $errors['face']='请选择合法头像';
        }

        if(!empty($errors)){
            $arr=$errors;
            return false;
        }
        $arr=$data;
        // 邮箱字母转小写
        $arr['email']=strtolower(trim($arr['email']));
        return true;
    }

    /**
     * 过滤用户输入的特殊字符
     * @param string $str
     * @return boolean|string
     */
    public static function validate_str($str){
        // gb2312中，strlen计算字符长度时，一个中文字符算2个长度。 utf8 一个中文字符算3个长度
        if(mb_strlen($str,'UTF8')<1){
            return false;
        }
        $str=nl2br(htmlspecialchars($str,ENT_QUOTES));
        return $str;
    }

    /**
     * 显示评论内容
     * @return string
     */
    public function output(){
        $link_start = '';
        $link_end = '';
        if($this->data['url']){
            $link_start="<a href='".$this->data['url']."' target='_blank'>";

            $link_end="</a>";
        }
        $dateStr=date("Y年m月d日 H:i:s",$this->data['pubTime']);
        $res=<<<EOF
		<div class='comment'>
			<div class='face'>
				{$link_start}
					<img width='50' height='50' src="img/{$this->data['face']}.jpg" alt="" />
				{$link_end}
			</div>
			<div class='username'>
				{$link_start}
				{$this->data['username']}
				{$link_end}		
			</div>
			<div class='date' title='发布于{$dateStr}'>
				{$dateStr}		
			</div>
			<p>{$this->data['content']}</p>		
		</div>
EOF;
        return $res;
    }
}




