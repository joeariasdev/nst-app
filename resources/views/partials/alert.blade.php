@if(session('message'))
    <div id="alert-component" class="flex justify-between shadow-inner rounded p-3 bg-{{session('message')[0]}} max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="self-center">
            <strong>{{session('message')[1]}}!</strong> {{session('message')[2]}}
        </p>
        <strong class="text-xl align-center cursor-pointer alert-del">&times;</strong>
    </div>
@endif
