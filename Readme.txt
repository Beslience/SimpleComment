https://www.jianshu.com/writer#/notebooks/26933576/notes/30808848/preview

后台
connect.php
	采用mysqli连接数据库
doAction.php  
	首先对表单进行验证
	comment.class.php
		validate方法中使用filter_input对接收的表单数据进行验证
		验证表单中数据成功保存到参数中，并返回true；验证失败，将错误			保存到参数中，并返回false
	对插入语句进行预处理，绑定参数进行提交到数据库，提交成功后将数据通过	
	output方法进行包装返回给前端显示

前端页面
index.php
	每次查询数据库查出所有评论数据。在显示的地方，通过output方法对数据包	装后显示。