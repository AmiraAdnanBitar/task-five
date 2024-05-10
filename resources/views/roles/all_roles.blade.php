<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3 style="margin-bottom: 25px;text-align: center;">roles table</h3>
    <a href="{{ route('roles.create') }}" class="btn btn-primary">add new role</a>
    <div class="row" style="margin-top:10px;">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">edit</th> 
                    <th scope="col">Delete role</th> 
                    <th scope="col">Update role</th> 
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $index => $role)
                    <tr>
                        <th scope="row">{{ $loop->index }}</th>
                        <td>{{ $role->name }}</td>
                        @if($index!=0)
                        <td>
                        
                                <form action="{{ route('roles.destroy', ['id' => $role->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            
                        
                        </td>
                        <td>
                            <form action="{{ route('roles.update', ['id' => $role->id]) }}" method="get">
                                @csrf
                                
                                <button type="submit" class="btn btn-danger">Update</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>

        