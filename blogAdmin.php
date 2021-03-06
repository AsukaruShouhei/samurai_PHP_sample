<?php
	session_start();

	include_once 'header.php';
	include_once 'sideBar.php';

	// csrf_tokne
	require 'functions/Security.php';
	$sec = new Security();
	$token = $sec->makeCsrf();
	$_SESSION["csrf_token"] = $token;

	//blog の呼び出し
	require_once 'functions/blog.php';
	$blog = new blog();
?>

	<div id="main">
		<h3>記事管理</h3>
		<a href="index.php"><span class="glyphicon glyphicon-home"></span>TOP</a>
		<table class="table">
			<thead>
				<tr>
			      <th scope="col">#</th>
			      <th scope="col">記事タイトル</th>
			      <th scope="col">登録日</th>
			      <th scope="col"></th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php
					$blogs = $blog->getMessageAll();
					foreach ($blogs as $key => $value) {
				?>
			    <tr>
			      <th scope="row"><?php echo $value["id"] ;?></th>
			      <td><?php echo $value["title"] ;?></td>
			      <td><?php echo $value["created_at"] ;?></td>
			      <td>
			      	<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#blogModal" data-id="<?php echo $value['id'] ;?>" data-title="<?php echo $value['title'] ;?>" data-regi=1 data-message="<?php echo $value['message'] ;?>">
			      		<span class="glyphicon glyphicon-refresh"></span>編集
			      	</button>
		      		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#blogModal" data-id="<?php echo $value['id'] ;?>" data-title="<?php echo $value['title'] ;?>" data-regi=2 data-message="<?php echo $value['message'] ;?>">
		      			<span class="glyphicon glyphicon-trash"></span>削除
		      		</button>
			      </td>
			    </tr>
			    <?php
					}
				?>
			  </tbody>
			</table>
	</div><!-- // main -->



<!-- blogModal -->
<div class="modal fade" id="blogModal" tabindex="-1" role="dialog" aria-labelledby="blogModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">記事編集/削除</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <div id="category_regist">
			<form action="insert/change_blog.php" method="post">
				<input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
				<input type="hidden" name="id" value="" id="id">
				<input type="hidden" name="kbn" value="" id="kbn">
			  <div class="form-group">
			    <label for="category_name">タイトル</label>
			    <input type="text" class="form-control" id="m_title" name="title">
			  </div>
			  <div class="form-group">
				<label for="message">記事本文</label>
				<textarea class="form-control" id="m_message" rows="30" name="message"></textarea>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
        <button type="submit" class="btn btn-primary">実行</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$('#changeModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var recipient = button.data('id');
  var title = button.data('title');
  var regi = button.data('regi');
  var message = button.data('message'); 
  var modal = $(this);
  if (regi == 1) {
  	// api
  	$.post({
	        url: 'Api/getUpdateBlog.php',
	        dataType : 'json',
	        data:{
	            'id' : recipient,
	        },
	        success: function(data){
	        	$(window).load(function(){
					console.log(data);
		            modal.find('.modal-title').text('記事を編集します');
					modal.find('#id').val(data.id);
					modal.find('#m_title').val(data.title);
					console.log(modal.find('#m_title'));
					modal.find('#kbn').val(regi);
					modal.find('#m_message').val(data.message);
				});
	        },
	        error: function(data){
	        	// console.log(data); error message 
	            console.log("読み込み失敗");
	        }
    	});
  //  		modal.find('.modal-title').text('記事を編集します');
		// modal.find('#id').val(recipient);
		// modal.find('#m_title').val(title);
		// modal.find('#kbn').val(regi);
		// modal.find('#m_message').val(message);
		$('.modal-header').css('background', '#87cefa');
    }else if(regi == 2){
	　  modal.find('.modal-title').text('記事を削除します');
	    modal.find('#id').val(recipient);
	    modal.find('#title').hide();
	    modal.find('#kbn').val(regi);
	    modal.find('#message').hide();
	    $('.modal-header').css('background', '#f08080');
    }
})
</script>

	
<?php include_once 'footer.php'; ?>