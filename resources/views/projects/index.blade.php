<!Doctype html>

<html>
<head>

</head>
<body>
      <h1>BirdBoards</h1>

     <ul>
         @forelse($projects as $project)
             <li>
                 <a href="{{$project->path()}}">
                     {{$project->title}}
                 </a>
             </li>
             <li>{{$project->description}}</li>
         @empty
             <li>No projects here</li>
         @endforelse
     </ul>
</body>
</html>
