<x-org-layout>
    @if($canCreateTopLevel)
    <a
            class="bg-blue-100 px-4 py-4 rounded ml-4 my-4"
                         color="red"
                         href="{{route('org.create')}}">
        add an organization
        </a>
    @endif


    <livewire:org-table />
</x-org-layout>
