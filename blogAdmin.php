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
		<a href="index.php">TOP</a>
		<table class="table">
			<thead>
				<tr>
			      <th scope="col">#</th>
			      <th scope="col">カテゴリ名</th>
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
			      	<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#changeModal" data-id="<?php echo $value['id'] ;?>" data-title="<?php echo $value['title'] ;?>" data-regi=1 data-message="<?php echo $value['message'] ;?>">
			      		<span class="glyphicon glyphicon-refresh"></span>編集
			      	</button>
		      		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#changeModal" data-id="<?php echo $value['id'] ;?>" data-title="<?php echo $value['title'] ;?>" data-regi=2 data-message="<?php echo $value['message'] ;?>">
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



<!-- changeModal -->
<div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="changeModal" aria-hidden="true">
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
			    <input type="text" class="form-control" id="title" name="title">
			  </div>
			  <div class="form-group">
				<label for="message">記事本文</label>
				<textarea class="form-control" id="message" rows="30" name="message"></textarea>
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
  var button = $(event.relatedTarget)
  var recipient = button.data('id') 
  var name = button.data('title') 
  var regi = button.data('regi') 
  var regi = button.data('message') 
  var modal = $(this)
  if (regi == 1) {
  	  modal.find('.modal-title').text('記事を編集します')
	  modal.find('#id').val(recipient)
	  modal.find('#title').val(name)
	  modal.find('#kbn').val(regi)
	  modal.find('#message').val(message)
	  $('.modal-header').css('background', '#87cefa');
  }else if(regi == 2){
	　modal.find('.modal-title').text('記事を削除します')
	  modal.find('#id').val(recipient)
	  modal.find('#title').val(name)
	  modal.find('#kbn').val(regi)
	  modal.find('#message').val(message)
	  $('.modal-header').css('background', '#f08080');
  }
})
</script>
	
<?php include_once 'footer.php'; ?>