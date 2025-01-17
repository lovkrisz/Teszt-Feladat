<div class="bg-gray-300 text-black w-1/2 mx-auto p-4 w-[400px]">


    <h1 class="text-center text-xl font-bold mb-3">{{$this->project->name}}</h1>

    @persist("timer")
    <div class="timer">
        <h1 class="text-xl text-center font-bold">00:00:00</h1>
    </div>
    @endpersist
    <div class="memo">
        <textarea name="memo" class="w-full" aria-multiline="true" onkeyup="saveMemo()">{{$this->memo}}</textarea>
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

                @this.
                createTask();

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
                    @this.
                    set('memo', memo.value);
                    @this.
                    saveMemo();
                }, 1500);
            }

        }

        function stopTimer() {
            if (task_started) {
                task_started = false;
                clearInterval(interval);
                @this.
                call('setEndTime');
                @this.
                set('memo', "");
                memo.value = "";
                let time = 0;

            }
        }

        memo.addEventListener('focusout', function () {
            saveMemo();
        });
    </script>
</div>
