<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teszt Feladat</title>

    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center h-screen">
<div class="bg-gray-300 text-black w-1/2 mx-auto p-4 w-[400px]">
    <h1 class="text-center text-xl font-bold mb-3">Track Time for Project</h1>
    <form method="POST" action="{{route('project.save')}}">
        @csrf
        <input type="text" id="saveEvent" name="project" placeholder="Add new project" class="w-full p-2 text-center bg-transparent border-b border-t border-blue-300">
        <ul>
            @foreach($projects as $project)
                <li class="w-full bg-transparent border-b border-t border-blue-300"><a href="/project/{{$project->id}}" class="block p-2 text-center">{{ $project->name }}</a></li>
            @endforeach
        </ul>
    </form>
</div>

    <script>
        const eventInput = document.getElementById('saveEvent');
        const form = document.querySelector('form');

        eventInput.addEventListener('keyup', function(e) {
            if(e.keyCode === 13) {
                e.preventDefault();
                form.submit();
            }

        });
        </script>

</body>
</html>
