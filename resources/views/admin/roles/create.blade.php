@extends('admin.layouts.app')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Create New Role</h2>
                <a href="{{ route('admin.roles.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">Back to Roles</a>
            </div>

            <div class="bg-white rounded-lg shadow-sm">
                <form action="{{ route('admin.roles.store') }}" method="POST" class="p-6">
                    @csrf
                    
                    <!-- Role Information Section -->
                    <div class="mb-8">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Role Name</label>
                                <input type="text" name="name" id="name" class="form-input w-full rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label for="guard_name" class="block text-sm font-medium text-gray-700 mb-2">Guard Name</label>
                                <input type="text" name="guard_name" id="guard_name" class="form-input w-full rounded-md shadow-sm" value="web" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Permissions Section -->
                    <div class="border-t border-gray-200 pt-8">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-medium text-gray-900">Role Permissions</h3>
                            <div class="flex space-x-4">
                                <button type="button" class="text-sm text-blue-600 hover:text-blue-800" onclick="selectAllPermissions()">Select All</button>
                                <button type="button" class="text-sm text-red-600 hover:text-red-800" onclick="deselectAllPermissions()">Deselect All</button>
                                <button type="button" class="text-sm text-gray-600 hover:text-gray-800" onclick="toggleAllGroups()">Expand/Collapse All</button>
                            </div>
                        </div>

                        <div class="space-y-4">
                            @foreach($permissions->groupBy('group') as $group => $groupPermissions)
                                <div class="border border-gray-200 rounded-lg overflow-hidden permission-group">
                                    <!-- Group Header -->
                                    <div class="bg-gray-50 px-4 py-3 flex items-center justify-between cursor-pointer group-header"
                                         onclick="toggleGroup('{{ str_replace(' ', '_', $group) }}')">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-gray-500 transform transition-transform group-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                            <h4 class="font-medium text-gray-900">{{ $group }}</h4>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <button type="button" 
                                                class="text-xs text-blue-600 hover:text-blue-800"
                                                onclick="toggleGroupPermissions('{{ $group }}', true); event.stopPropagation();">
                                                Select All
                                            </button>
                                            <button type="button" 
                                                class="text-xs text-red-600 hover:text-red-800"
                                                onclick="toggleGroupPermissions('{{ $group }}', false); event.stopPropagation();">
                                                Deselect All
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Group Content -->
                                    <div class="hidden group-content" id="{{ str_replace(' ', '_', $group) }}_content">
                                        <div class="p-4 bg-white">
                                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                                @foreach($groupPermissions as $permission)
                                                    <div class="flex items-center space-x-2">
                                                        <input type="checkbox" 
                                                            name="permissions[]" 
                                                            value="{{ $permission->id }}"
                                                            id="permission_{{ $permission->id }}"
                                                            data-group="{{ $group }}"
                                                            class="permission-checkbox h-4 w-4 text-blue-600 rounded border-gray-300">
                                                        <label for="permission_{{ $permission->id }}" 
                                                            class="text-sm text-gray-700 cursor-pointer"
                                                            title="{{ $permission->description }}">
                                                            {{ ucfirst(str_replace(['_', $group], ['', ''], strtolower($permission->name))) }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 border-t border-gray-200 pt-6 flex justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg text-sm font-medium">
                            Create Role
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function selectAllPermissions() {
            document.querySelectorAll('.permission-checkbox').forEach(checkbox => checkbox.checked = true);
        }

        function deselectAllPermissions() {
            document.querySelectorAll('.permission-checkbox').forEach(checkbox => checkbox.checked = false);
        }

        function toggleGroupPermissions(group, state) {
            document.querySelectorAll(`.permission-checkbox[data-group="${group}"]`)
                .forEach(checkbox => checkbox.checked = state);
        }

        function toggleGroup(groupId) {
            const content = document.getElementById(`${groupId}_content`);
            const header = content.previousElementSibling;
            const icon = header.querySelector('.group-icon');
            
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.classList.add('rotate-90');
            } else {
                content.classList.add('hidden');
                icon.classList.remove('rotate-90');
            }
        }

        function toggleAllGroups() {
            const allGroups = document.querySelectorAll('.group-content');
            const allIcons = document.querySelectorAll('.group-icon');
            const isAnyHidden = Array.from(allGroups).some(group => group.classList.contains('hidden'));
            
            allGroups.forEach(group => {
                if (isAnyHidden) {
                    group.classList.remove('hidden');
                } else {
                    group.classList.add('hidden');
                }
            });
            
            allIcons.forEach(icon => {
                if (isAnyHidden) {
                    icon.classList.add('rotate-90');
                } else {
                    icon.classList.remove('rotate-90');
                }
            });
        }

        // Expand first group by default
        document.addEventListener('DOMContentLoaded', function() {
            const firstGroup = document.querySelector('.permission-group');
            if (firstGroup) {
                const groupId = firstGroup.querySelector('.group-content').id.replace('_content', '');
                toggleGroup(groupId);
            }
        });
    </script>
    @endpush
@endsection
