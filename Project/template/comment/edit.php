<?php require(dirname(__DIR__ ).'.../header.html')?>
<form action="/Frame/Project/www/comment/update/<?=$comment->getId();?>" method="post">

  <div class="mb-3">
    <label for="textCom" class="form-label">Text</label>
    <input type="text" class="form-control" name="textCom" value="<?=$comment->getTextCom();?>">
    <input type="hidden" name="articleId" value="<?=$comment->getArticleId();?>">
    <input type="hidden" name="articleId" value="<?=$comment->getCreatedAt();?>">
  </div>

  

  <button type="submit" class="btn btn-primary">Update</button>
</form>
<?php require(dirname(__DIR__ ).'.../footer.html')?>