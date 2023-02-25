<x-org-layout>
    <form
        method="post"
        action="{{route('org.store')}}"
    >
        @csrf

        <x-bladewind::input
            name="name"
            label="Name"
            placeholder="Name"
            type="text"
        />
        @if(count($orgTypes)===1)
            <input type="hidden" name="level_type" value="{{$orgTypes[0]['label']}}"
        @endif
        @if(count($orgTypes)>1)
            <x-bladewind::dropdown
                name="level_type"
                label="Level"
                data="{{json_encode($orgTypes)}}"
            />
        @endif
        <button type="submit">Save</button>
    </form>
</x-org-layout>
