<?php
	session_start();
	// セッションの初期化
	unset($_SESSION["ress_msg"]);
	// csrf対策
	require_once 'functions/Security.php';
	$token = Security::makeCsrf();
	$_SESSION['csrf_token'] = $token;
	include_once 'header.php';
	include_once 'sideBar.php';


?>

<div id="main">
	<div>
		<h2>カテゴリ</h2>
	</div>
	<a href="index.php">TOP</a>
	<p style="background: red;color: #fff;"><?php if(!empty($_SESSION["ress_msg"])){	echo $_SESSION["ress_msg"];} ?></p>
	<div>
		<button type="button" class="btn btn-info" id="category_new_regist" data-toggle="modal" data-target="#exampleModal">カテゴリ新規追加</button>
	</div>
	<div>
		登録カテゴリ一覧
			<div>
				編集
			</div>
			<div>
				削除
			</div>
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
			    <input type="text" class="form-control" id="category_name" name="category_name">
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
	
<?php include_once 'footer.php'; ?>