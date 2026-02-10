<div class="flex flex-col h-[calc(100vh-160px)]"> 
    <div class="overflow-auto border border-gray-700 rounded-xl bg-[#111827] custom-scrollbar">
        <table class="min-w-full divide-y divide-zinc-700 border-separate border-spacing-0">
            <thead class="bg-zinc-200 dark:bg-[#1f1f23] sticky top-0 z-10">
                {{ $thead }}
            </thead>
            
            <tbody class="divide-y divide-gray-700 bg-white dark:bg-zinc-800">
                {{ $slot }}
            </tbody>

            <tfoot class="bg-zinc-200 dark:bg-[#1f1f23] sticky bottom-0 z-10">
                {{ $tfoot }}
            </tfoot>
        </table>
    </div>
</div>


