<div>
    <div class="grid sm:-grid-cols-1  md:grid-cols-2 text-sm font-medium text-center text-body border-b border-default">
        <ul class="flex flex-wrap -mb-px">
            <li class="me-2">
                <x-tabs :href="route('class.materi', ['kode_mk' => $kode_mk])" :active="request()->is('class/' . $kode_mk . '/materi')">Materi</x-tabs>
            </li>
            <li class="me-2">
                <x-tabs :href="route('class.tugas', ['kode_mk' => $kode_mk])" :active="request()->is('class/' . $kode_mk . '/tugas')">Tugas</x-tabs>
            </li>
            <li class="me-2">
                <x-tabs :href="route('class.ujian', ['kode_mk' => $kode_mk])" :active="request()->is('class/' . $kode_mk . '/ujian')">Ujian</x-tabs>
            </li>
        </ul>
        <h2 class="text-2xl font-semibold text-heading dark:text-white md:text-lg text-right">Kelas: {{ $nama }}</h2>
    </div>
</div>