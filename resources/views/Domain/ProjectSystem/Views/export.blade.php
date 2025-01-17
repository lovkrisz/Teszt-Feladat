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
<body>
@ray($exportedData)
<div class="total_data flex w-full items-center justify-end p-10">

    <table class="ml-auto bg-white border border-gray-200">
        <tr>
            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                Project
            </th>
            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                Total
            </th>
        </tr>
        @foreach($exportedData->totalTimes as $project => $total)
            <tr>
                <td class="py-2 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $project }}</td>
                <td class="py-2 px-4 border-b border-gray-200 text-sm text-gray-700">{{(new \App\Domain\ProjectSystem\HelperClasses\TimeDiffCalculator)->formatSeconds($total)->getResult()}}</td>
            </tr>
        @endforeach
    </table>
</div>
<div class="container mx-auto p-4">
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
        <tr>
            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                Project
            </th>
            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                Start
            </th>
            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                Finish
            </th>
            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                Duration
            </th>
            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                Memo
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($exportedData->tasks as $project => $tasks)
            @ray($tasks)

            @foreach($tasks as $task)
                <tr>
                    <td class="py-2 px-4 border-b border-gray-200 text-sm text-gray-700">{{$project}}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-sm text-gray-700">{{$task["start_time"]}}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-sm text-gray-700">{{$task["end_time"]}}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-sm text-gray-700">{{(new \App\Domain\ProjectSystem\HelperClasses\TimeDiffCalculator)->calculate($task["start_time"],$task["end_time"] )->formatSeconds()->getResult()}}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-sm text-gray-700">{{$task["memo"]}}</td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>
</div>


</body>
</html>
