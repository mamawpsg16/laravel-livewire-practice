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
        <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>PHONE</th>
                <th>ROLES</th>
                <th>PIVOT TIMESTAMP</th>
                <th>PIVOT TEST</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($relationships as $user )
            {{dd($user->roles[0]->pivot->created_at)}}
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->phone->number}}</td>
                    <td>{{$user->roles->pluck('name')->implode(', ')}}</td>
                </tr>
            @empty
                <p>No users</p>
            @endforelse
        </tbody>
    </table>
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
