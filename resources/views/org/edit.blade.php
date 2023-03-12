<x-org-layout>
    <x-splade-modal position="right" max-width="xl">
    <form
        method="put"
        action="{{route('org.update', $org)}}"
    >
        @csrf

        <x-splade-form :for="$form" />
    </form>
    </x-splade-modal>
</x-org-layout>
