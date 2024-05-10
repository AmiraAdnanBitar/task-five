<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h3 class="text-center mt-3"><b class="text-danger">create new role</b></h3>
        <form action="{{ route('roles.store') }}" method="POST">

            @csrf
            <div class="form-group">
            <label for="exampleInputEmail1"> inter the name of role:</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <p class="mt-3"><b>please choose the permissions of this role</b></p>
            @foreach ($permissions as $permission)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $permission->id }}" id="flexCheckDefault">
            
                    <label class="form-check-label" for="flexCheckDefault">
                    {{$permission->name}}
                    </label>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>


</body>
</html>