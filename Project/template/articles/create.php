<?php require(dirname(__DIR__ ).'.../header.html')?>
<form action="/Frame/Project/www/article/store" method="post">
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="title" class="form-control" id="title" name="title">
  </div>
  <div class="mb-3">
    <label for="text" class="form-label">Text</label>
    <input type="text" class="form-control" id="text" name="text">
  </div>
  <div class="form-group">
    <label for="author" >Author</label>
  <select class="form-control" name="author" id="author">
    <?php foreach($users as $user):?>
    <option value="<?=$user->getId();?>"><?=$user->getName();?></option>
    <?php endforeach;?>
  </select>
</div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php require(dirname(__DIR__ ).'.../footer.html')?>

