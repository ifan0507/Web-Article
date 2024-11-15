<x-layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Update article</h2>
            <form action="{{ route('article.update', $post->id) }}" method="post">
                @csrf
                @method('put')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Article
                            Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                            @if ($errors->has('title')) class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 appearance-none dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 peer"
                            @else
                            class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" @endif
                            placeholder="Type article title">
                        @error('title')
                            <span id="nameError" class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="category"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select id="category" name="category"
                            @if ($errors->has('category')) class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 appearance-none dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 peer"
                            @else
                            class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"> @endif
                            <option @disabled(true)
                            value="{{ old('category'), $post->category->id }}">{{ $post->category->name }}
                            </option>
                            @foreach ($category as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span id="nameError" class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="author"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Author</label>
                        <select id="author" name="author"
                            @if ($errors->has('author')) class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 appearance-none dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 peer"
                        @else
                        class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"> @endif
                            <option @disabled(true)
                            value="{{ old('author'), $post->author->id }}">{{ $post->author->name }}
                            </option>
                            @foreach ($author as $aut)
                                <option value="{{ $aut->id }}">{{ $aut->name }}</option>
                            @endforeach
                        </select>
                        @error('author')
                            <span id="nameError" class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="description" rows="4" name="description"
                            @if ($errors->has('description')) class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 appearance-none dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 peer"
                        @else
                        class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" @endif
                            placeholder="Write article description here">{{ old('description', $post->body) }}</textarea>
                        @error('description')
                            <span id="nameError" class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" id="update"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Update Article
                </button>
            </form>
        </div>
    </section>
</x-layout-admin>
