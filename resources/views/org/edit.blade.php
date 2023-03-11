<x-org-layout>
    <form
        method="put"
        action="{{route('org.update', $org)}}"
    >
        @csrf

        <x-bladewind::input
            name="name"
            label="Name"
            placeholder="Name"
            type="text"
            value="{{$org->name}}"
        />
        <input type="hidden" name="id" value="{{$org->id}}"
        @if(count($orgTypes)===1)
            <input type="hidden" name="level_type" value="{{$orgTypes[0]['label']}}"
        @endif
        @if(count($orgTypes)>1)
            <x-bladewind::dropdown
                class="level_type"
                name="level_type"
                label="Level"
                placeholder="SDfsdfds"
                data="{{json_encode($orgTypes)}}"
            />
        @endif
        <x-bladewind::button can_submit="true" type="submit">Save</x-bladewind::button>
    </form>
</x-org-layout>
