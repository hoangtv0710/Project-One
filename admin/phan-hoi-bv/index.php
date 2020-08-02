<?php 
  session_start();

  $path = "../";
  require_once $path.'../database/db_fashe.php';

  $sql = "select c.*, p.title as postname, p.cate_id as cate from post_comments c join posts p on c.post_id = p.id";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $comment = $stmt->fetchAll();


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bài viết / Phản hồi</title>
  <?php include_once $path.'share/linkAsset.php'; ?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include_once $path.'share/header.php'; ?>
  
  <?php include_once $path.'share/sidebar.php'; ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Phản hồi bài viết
      </h1>

      <ol class="breadcrumb">
        <li><a href="<?= SITELINKADMIN ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Bài viết</li>
        <li class="active">Danh sách phản hồi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Email</th>
                  <th>Nội dung</th>
                  <th>Tiêu đề bài viết</th>
                  <th width="100">Mã bài viết</th>
                </tr>

                <?php foreach ($comment as $item): ?>
                  
                  <tr>
                    
                    <td><?= $item['id'] ?></td>

                    <td><?= $item['email']?></td>

                    <td><?= $item['content']?></td>

                    <td>
                        <a href="<?= SITELINK . 'blog-detail.php?id=' . $item['post_id']. '&categories='.$item['cate'] ?>" target="_blank"><?= $item['postname'] ?></a>
                    </td>

                    <td><?= $item['post_id']?></td>

                    <td>

                      <a 
                        href="javascript:;" 
                        linkurl="remove.php?id=<?= $item['id']?>" 
                        class="btn btn-xs btn-danger btn-remove">
                        <i class="fa fa-trash"></i>  Xoá
                      </a>
                    </td>

                  </tr>
                <?php endforeach ?>
              
              </tbody>
            </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>  
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <?php include_once $path.'share/footer.php'; ?>
</div>
<!-- ./wrapper -->




<script type="text/javascript">

  $('.btn-remove').on('click', function(){
    var url = $(this).attr('linkurl');
    var conf = confirm('Bạn có chắc chắn muốn xoá danh mục này hay không?');

    if(conf){
      window.location.href = url;
    }
  });
</script>

</body>
</html>
