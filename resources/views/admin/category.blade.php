@extends('layouts.app')

@section('content')

<?php

use App\Models\Category;


$categoryList = Category::getRecords();
$categories = json_decode($categoryList, true);
// print_r($categories);
// die;

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Category</title>
</head>

<body>
    <div class="container">
        <div class="row">
            @if(session('success'))
            {{session('success')}}
            @endif
            <h2>Category Details <a class="btn btn-success" href="treeView" style="color: white;float:right">Category Tree view</a>   <a class="btn btn-success mr-2" href="addCategory" style="color: white;float:right">Add Category</a></h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Parent</th>
                        <th scope="col">Added On</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($categories['data']) && !empty($categories['data'])) {
                        $i = 1;
                        foreach ($categories['data'] as $category) {
                    ?>
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$category['name']}}</td>
                                <td>@if($category['parent_id']==0){{'Root'}}
                                    @else
                                    {{$category['parent_id']}}
                                @endif</td>
                                <td>{{$category['created_at']}}</td>
                                <td><a class="btn btn-warning" href="addCategory?id={{$category['id']}}" style="color: white;">Edit</a> <a href="javascript:void(0)" onclick="deleteCategoty({{$category['id']}});" class="btn btn-danger" style="color: white;">Delete</a></td>
                            </tr>
                        <?php
                            $i++;
                        }
                    } else {
                        ?>
                        <tr>No Data Found</tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script>
        function deleteCategoty(id) {
            if (id != '') {
                if (!confirm("Do you want to delete this category ?")) {
                    return false;
                } else {
                    $.ajax({
                        url: 'deleteCategory?id=' + id,
                        type: 'get',
                        success: function(suc) {
                            alert(suc);
                            location.href = 'category';
                        }
                    })
                }
            }
        }
    </script>
</body>

</html>
@endsection