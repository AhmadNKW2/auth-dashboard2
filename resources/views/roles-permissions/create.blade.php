<x-guest-layout>
    <form method="POST" action="{{ route('roles-permissions.store') }}">
        @csrf

        <!-- Role Name -->
        <div>
            <x-input-label for="role_name" :value="__('Role Name')" />
            <x-text-input id="role_name" class="block mt-1 w-full" type="text" name="role_name" :value="old('role_name')" required autofocus autocomplete="role_name" />
            <x-input-error :messages="$errors->get('role_name')" class="mt-2" />
        </div>

        <!-- Permissions Checkboxes -->
        <div class="mt-4">
            <x-input-label for="permissions" :value="__('Permissions')" />
            @foreach(Spatie\Permission\Models\Permission::all() as $permission)
                <div class="block mt-1">
                    <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="permissions[]" value="{{ $permission->name }}">
                    <label for="permissions[]" class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $permission->name }}</label>
                </div>
            @endforeach
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Create Role and Permissions') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
