<x-org-layout>
{{--    @if($canCreateTopLevel)--}}
{{--        <div class="mb-4">--}}
{{--    <a--}}
{{--            class="mt-4 bg-blue-100 px-4 py-2 rounded ml-4 my-4 mb-4"--}}
{{--                         color="red"--}}
{{--                         href="{{route('org.create')}}">--}}
{{--        add an organization--}}
{{--        </a>--}}
{{--        </div>--}}
{{--    @endif--}}


    <Link slideover
          class="btn"
          href="/org/create">Create new org</Link>
    <x-splade-table :for="$orgTable" >
        @cell('action', $org)
        <Link slideover href="/org/{{$org->id}}/edit">edit</Link>
        @endcell
    </x-splade-table>


</x-org-layout>
