<div class="flex flex-col w-full">
    <div class="inline-block min-w-full align-middle">
        {{-- Este div es el que controla el scroll horizontal local --}}
        <div class="overflow-hidden border border-gray-700 rounded-xl bg-[#111827] custom-scrollbar">
            <div class="overflow-x-auto custom-scrollbar">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-[#1f2937]">
                        <tr>
                            {{ $thead }}
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        {{ $slot }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

