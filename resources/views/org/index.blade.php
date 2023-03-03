<x-org-layout>
    @if($canCreateTopLevel)
        <div class="mb-4">
    <a
            class="mt-4 bg-blue-100 px-4 py-2 rounded ml-4 my-4 mb-4"
                         color="red"
                         href="{{route('org.create')}}">
        add an organization
        </a>
        </div>
    @endif


    <livewire:org-table />
</x-org-layout>
