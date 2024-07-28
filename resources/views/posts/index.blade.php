<x-layouts.layout>
    @push('styles')
        @livewireStyles
        <!-- Custom styles can go here -->
     <style>
        body{
            background-color: aqua;
        }
     </style>
    @endpush

    <!-- Main content -->
    <livewire:counter/> 
    <livewire:items />
    <livewire:user-profile :name="'John Doe'" :age="30" />
    @livewireScripts
    <x-forms.input type="text" name="kevin" :is-required="true"></x-forms.input>
    Your main content goes here.

    @push('scripts')
        <script>
            const name = 'ABWF';
            console.log(name,'name');
        </script>
        <!-- Custom scripts can go here -->
        <script src="{{ asset('js/index.js') }}"></script>
    @endpush
</x-layouts.layout>
