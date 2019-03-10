<?php
	session_start();
	// csrf対策
	require_once 'functions/Security.php';
	// $token = Security::makeCsrf();
	$sec = new Security();
	$token = $sec->makeCsrf();
	$_SESSION['csrf_token'] = $token;
	require_once 'functions/blog.php';
	include_once 'header.php';
	include_once 'sideBar.php';


?>

<div id="main">
	<div>
		<h2>カテゴリ</h2>
	</div>
	<a href="index.php"><span class="glyphicon glyphicon-home"></span>TOP</a>
	<p style="background: red;color: #fff;"><?php if(!empty($_SESSION["ress_msg"])){	echo $_SESSION["ress_msg"];} ?></p>
	<div>
		<button type="button" class="btn btn-info" id="category_new_regist" data-toggle="modal" data-target="#exampleModal">カテゴリ新規追加</button>
	</div>
	<div>
		登録カテゴリ一覧
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
					// $category = blog::getCategory();
			  		$getCategory = new blog();
			  		$category = $getCategory->getCategory();
					foreach ($category as $key => $value) {
				?>
			    <tr>
			      <th scope="row"><?php echo $value["id"] ;?></th>
			      <td><?php echo $value["category_name"] ;?></td>
			      <td><?php echo $value["created_at"] ;?></td>
			      <td>
			      	<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#changeModal" data-id="<?php echo $value['id'] ;?>" data-name="<?php echo $value['category_name'] ;?>" data-regi=1>
			      		<span class="glyphicon glyphicon-refresh"></span>編集
			      	</button>
		      		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#changeModal" data-id="<?php echo $value['id'] ;?>" data-name="<?php echo $value['category_name'] ;?>" data-regi=2>
		      			<span class="glyphicon glyphicon-trash"></span>削除
		      		</button>
			      </td>
			    </tr>
			    <?php
					}
				?>
			  </tbody>
			</table>
	</div>
</div><!-- // main -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">カテゴリ新規追加</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <div id="category_regist">
			<form action="insert/category_regist.php" method="post">
				<input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
			  <div class="form-group">
			    <label for="category_name">カテゴリ名</label>
			    <input type="text" class="form-control category_name" id="category_name" name="category_name">
			  </div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
        <button type="submit" class="btn btn-primary">登録する</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- changeModal -->
<div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="changeModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">カテゴリ新規追加</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <div id="category_regist">
			<form action="insert/change_category.php" method="post">
				<input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
				<input type="hidden" name="id" value="" id="id" class="id">
				<input type="hidden" name="kbn" value="" id="kbn" class="kbn">
			  <div class="form-group">
			    <label for="category_name">カテゴリ名</label>
			    <input type="text" class="form-control category_name" id="category_name" name="category_name">
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
  var name = button.data('name') 
  var regi = button.data('regi') 
  var modal = $(this)
  if (regi == 1) {
  	  modal.find('.modal-title').text('次のカテゴリを編集します')
	  modal.find('.id').val(recipient)
	  modal.find('.category_name').val(name)
	  modal.find('.kbn').val(regi)
	  $('.modal-header').css('background', '#87cefa');
  }else if(regi == 2){
	　modal.find('.modal-title').text('次のカテゴリを削除します')
	  modal.find('.id').val(recipient)
	  modal.find('.category_name').val(name)
	  modal.find('.kbn').val(regi)
	  $('.modal-header').css('background', '#f08080');
  }else{
  	$('.modal-header').css('background', '#fdf5e6');
  }
})
</script>
	
<?php include_once 'footer.php'; ?>