<!Doctype html>

<html>
<head>

</head>
<body>
      <h1>BirdBoards</h1>

     <ul>
         @foreach($projects as $project)
             <li>{{$project->title}}</li>
             <li>{{$project->description}}</li>
         @endforeach
     </ul>
</body>
</html>
