<div class="min-h-screen flex flex-row sm:justify-center items-center pt-6 sm:pt-0 bg-light-green">

    <div class="flex items-stretch -mx-4">
        <div class="w-full sm:max-w-md mt-6 mx-5 shadow-md overflow-hidden sm:rounded-lg">
            <img class="object-cover h-full align-middle" src="{{ URL::to('/assets/img/Hospital.jpeg') }}">
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>

</div>
