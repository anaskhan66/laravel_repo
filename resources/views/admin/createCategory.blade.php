@extends('layouts.app')

@section('content')

<?php
use App\Models\Category;


$categoryArr = Category::getCategoryDropdown();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Add Category</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <h2>Add Category</h2>
            <div class="card">
      <div class="card-body">
        <div class="bs-stepper-content">
          <form id="categoryform" action="" method="post">
     
            <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">

              <div class="row g-3">
              @csrf

                <div class="col-12 col-lg-6">
                  <label for="" class="form-label">Name *</label>
                  <input type="text" required class="form-control" id="Name" value="<?php if(!empty($data) && !empty($data['name'])){ echo $data['name']; } ?>" placeholder="Name" name="name">
                </div>
          
                <div class="col-12 col-lg-6">
                  <label for="" class="form-label">Category</label>
                  <select class="form-control" id="category_id" name="category_id">
                    <option value='0'>Master Category</option>
                    <?php foreach($categoryArr as $category): ?>
                      <option <?php if(!empty($data) && $data['parent_id']==$category->id){ echo 'selected';}?> value='<?= $category->id?>'><?= $category->name?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
                <!-- <div class="col-12 col-lg-6">
                  <label for="" class="form-label">Department *</label>
                  <select required class="form-control" id="department_id" name="department_id">
                    <option value=''>Select</option>
                    <?php //foreach($categoryArr as $department): ?>
                      <option <?php //if(!empty($data) && $data['department_id']==$department->id){ echo 'selected';}?> value='<?php //$department->id?>'><?php //$department->name?></option>
                      <?php //endforeach; ?>
                  </select>
                </div> -->
                
                <div class="col-12 col-lg-12">
                  <button class="btn btn-primary px-4" type="submit">Save
                  </button>
                </div>
              </div>
              <!---end row-->
            </div>
        </div>
      </div>
    </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
@endsection