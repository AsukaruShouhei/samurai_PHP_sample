


//		category.php
// $('#category_new_regist').click(function(){
// 	$('category_regist').slideToggle();
// });

/*
	ブラウザの戻るボタンを押下時の処理
*/
window.onpageshow = function(event) {
	if (event.persisted) {
		 window.location.reload();
	}
};