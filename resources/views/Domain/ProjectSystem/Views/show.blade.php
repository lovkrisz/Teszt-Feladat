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


    <h1 class="text-center text-xl font-bold mb-3">{{$data["project"]->name}}</h1>

    <div class="timer">
        <h1 class="text-xl text-center font-bold">00:00:00</h1>
    </div>

    <div class="memo">
        <textarea name="memo" class="w-full" aria-multiline="true"
                  onkeyup="saveMemo()">{{$data["memo"] ?? ""}}</textarea>
    </div>
    <button onclick="startTimer()" class="bg-blue-700 p-2 text-white rounded cursor-pointer">Start</button>
    <button onclick="stopTimer()" class="bg-red-700 p-2 text-white rounded cursor-pointer">Stop</button>


    <script>
        const memo = document.querySelector('.memo textarea');
        const timer = document.querySelector('.timer h1');
        let time = 0;
        let interval;
        let task_started = false;

        function startTimer() {
            if (!task_started) {
                interval = setInterval(() => {
                    time++;
                    timer.textContent = new Date(time * 1000).toISOString().substr(11, 8);
                }, 1000);
                fetch("/task/create", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        projectId: {{$data["project"]->id}},
                    })
                });
                task_started = true;
                if (memo.value !== '') {
                    saveMemo();
                }

            }

        }

        var typingtimer;

        function saveMemo() {
            if (task_started) {
                clearTimeout(typingtimer);
                typingtimer = setTimeout(() => {
                    fetch("/task/savememo", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            memo: memo.value,
                            projectId: {{$data["project"]->id}},
                        })
                    });
                }, 1500);
            }

        }

        function stopTimer() {
            if (task_started) {
                task_started = false;
                clearInterval(interval);
                fetch("/task/setendtime", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        projectId: {{$data["project"]->id}},
                    })
                });
                location.reload();

            }
        }

        memo.addEventListener('focusout', function () {
            saveMemo();
        });
    </script>
</div>

</body>
</html>
