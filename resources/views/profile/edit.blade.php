<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-4">
                            <label for="name" class="block text-gray-700">Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">背景を選択:</label>
                            <div class="flex space-x-2">
                                <button type="submit" name="background" value="bg-white" class="py-2 px-4 rounded border {{ $user->background == 'bg-white' ? 'bg-white text-black border-black' : 'bg-gray-200 text-black' }}">白</button>
                                <button type="submit" name="background" value="bg-gray-500" class="py-2 px-4 rounded border {{ $user->background == 'bg-gray-500' ? 'bg-gray-500 text-white border-black' : 'bg-gray-200 text-black' }}">灰色</button>
                                <button type="submit" name="background" value="bg-yellow-200" class="py-2 px-4 rounded border {{ $user->background == 'bg-yellow-200' ? 'bg-yellow-200 text-black border-black' : 'bg-gray-200 text-black' }}">黄色</button>
                                <button type="submit" name="background" value="bg-violet-400" class="py-2 px-4 rounded border {{ $user->background == 'bg-violet-400' ? 'bg-violet-400 text-white border-black' : 'bg-gray-200 text-black' }}">紫</button>
                                <button type="submit" name="background" value="bg-pink-300" class="py-2 px-4 rounded border {{ $user->background == 'bg-pink-300' ? 'bg-pink-300 text-black border-black' : 'bg-gray-200 text-black' }}">ピンク</button>
                                <button type="submit" name="background" value="bg-lime-100" class="py-2 px-4 rounded border {{ $user->background == 'bg-lime-100' ? 'bg-lime-100 text-black border-black' : 'bg-gray-200 text-black' }}">ライム</button>
                            </div>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
