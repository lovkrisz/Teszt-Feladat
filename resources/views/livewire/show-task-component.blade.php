<div class="bg-gray-300 text-black w-1/2 mx-auto p-4 w-[400px]">
    <h1 class="text-center text-xl font-bold mb-3">{{$this->project->name}}</h1>

    <div class="timer">
        <h1 class="text-xl text-center font-bold">00:00:00</h1>
    </div>
    <div class="memo">
        <textarea name="memo" class="w-full" aria-multiline=true wire:model.live.debounce="memo"></textarea>
    </div>
    {{$this->task_id}}
    <button onclick="startTimer()" class="bg-blue-700 p-2 text-white rounded cursor-pointer">Start</button>
    <button onclick="stopTimer()" class="bg-red-700 p-2 text-white rounded cursor-pointer">Stop</button>

    @script
    <script>
        const memo = document.querySelector('.memo textarea');
        const timer = document.querySelector('.timer h1');
        let time = 0;
        let interval;

        function startTimer() {
            Livewire.emit('createTask');
            interval = setInterval(() => {
                time++;
                timer.textContent = new Date(time * 1000).toISOString().substr(11, 8);
            }, 1000);
        }

        function stopTimer() {
            clearInterval(interval);
        }
        memo.addEventListener('focusout', function() {
            Livewire.emit('saveTask');
        });
    </script>
    @endscript
</div>
