<div class="min-h-screen flex flex-col md:flex-row sm:justify-center items-center pt-6 sm:pt-0 bg-light-green">

    <div class="md:flex items-stretch">
        <div class="md:w-full sm:max-w-sm mt-6 mx-5 shadow-md overflow-hidden rounded-lg">
            <img class="object-cover h-full align-middle" src="{{ URL::to('/assets/img/Hospital.jpeg') }}">
        </div>

        <div class="md:w-full sm:max-w-sm mt-6 mx-5 md:mx-0 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
            {{ $slot }}
        </div>
    </div>

</div>
