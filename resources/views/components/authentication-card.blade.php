<div class="min-h-screen flex flex-row sm:justify-center items-center pt-6 sm:pt-0 bg-light-green">

    <img class="w-full sm:max-w-md mx-5 shadow-md overflow-hidden sm:rounded-lg" src="{{ URL::to('/assets/img/Hospital.jpeg') }}">

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>

</div>
