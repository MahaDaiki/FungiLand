<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close change"  data-dismiss="alert" aria-label="Close">
            <span class="fs-4 text-danger" aria-hidden="true">X</span>
        </button>
        <strong>Validation Error!</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible mt-4">
        <button type="button" class="close change" data-dismiss="alert" aria-label="Close">
            <span class="fs-4 text-danger" aria-hidden="true">X</span>
        </button>
        {{ session()->get('success') }}
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible mt-4">
        <button type="button" class="close change" data-dismiss="alert" aria-label="Close">
            <span class="fs-4 text-danger" aria-hidden="true">X</span>
        </button>
        {{ session()->get('error') }}
    </div>
@endif

</body>
</html>