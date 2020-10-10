<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BirdBoard</title>
</head>
<body>
<h1>Create a project</h1>

<form method="post" action="/projects">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" aria-describedby="title" placeholder="Enter Title">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description" placeholder="Enter Description"></textarea>
     </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>
