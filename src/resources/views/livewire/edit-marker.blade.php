<div>
    <form wire:submit.prevent="save">
        <section class="text-gray-600 body-font relative">
            <div class="container px-2 py-6 mx-auto">
                <div class="flex flex-col text-center w-full border-b border-gray-200 mb-8">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Edit Marker</h1>
                </div>
                <div class="mx-full px-4">
                    <div class="flex flex-wrap -m-2">

                        <!-- URL -->
                        <div class="p-2 w-full">
                            <div class="relative">
                                <label for="url" class="leading-7 text-sm text-gray-600">URL</label>
                                <div class="relative w-full">
                                    <input
                                        id="url"
                                        type="text"
                                        value="{{ $marker->url }}"
                                        class="block p-2.5 w-full z-20
                                            text-sm bg-gray-100 bg-opacity-50 rounded-lg
                                            border border-gray-300 outline-none"
                                        disabled>
                                    <button
                                        type="button"
                                        class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-gray-300 rounded-r-lg border border-gray-300 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-400 dark:hover:bg-gray-300 dark:focus:ring-gray-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="p-2 w-full">
                            <div class="relative">
                                <label for="title" class="leading-7 text-sm text-gray-600">Title</label>
                                <input wire:model.defer="marker.title"
                                    type="text"
                                    id="title"
                                    class="block p-2.5 w-full z-20
                                        text-sm bg-gray-100 bg-opacity-50 rounded-lg
                                        focus:outline-none focus:ring-primary focus:border-primary
                                        border border-gray-300 outline-none"
                                    required>
                                @error('title') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Section -->
                        <div class="p-2 w-full">
                            <div class="relative">
                                <label for="section" class="leading-7 text-sm text-gray-600">Section</label>
                                <select wire:model.defer="marker.section"
                                    name="section"
                                    id="section"
                                    class="block p-2.5 w-full z-20
                                    text-sm bg-gray-100 bg-opacity-50 rounded-lg
                                    focus:outline-none focus:ring-primary focus:border-primary
                                    border border-gray-300 outline-none">
                                @foreach($sections as $section)
                                    <option value="{{ $section['id'] }}">{{ $section['title'] }}</option>
                                @endforeach
                                </select>
                                @error('section') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Tags -->
                        <div class="p-2 w-full">
                            <div class="relative">
                                <h4>Tags</h4>
                            </div>
                        </div>

                        <!-- notes -->
                        <div class="p-2 w-full">
                            <div class="relative">
                                <label for="message" class="leading-7 text-sm text-gray-600">Notes</label>
                                <textarea wire:model.defer="marker.notes"
                                    id="message"
                                    name="message"
                                    class="block p-2.5 w-full z-20
                                        text-sm bg-gray-100 bg-opacity-50 rounded-lg
                                        focus:outline-none focus:ring-primary focus:border-primary
                                        border border-gray-300 outline-none
                                        h-32 py-1 px-3 resize-none"></textarea>
                            </div>
                        </div>

                        <div class="p-2 w-full">
                            <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Button</button>
                        </div>
                        <div class="p-2 w-full pt-8 mt-8 border-t border-gray-200 text-center">
                            <a class="text-indigo-500">example@email.com</a>
                            <p class="leading-normal my-5">49 Smith St.
                                <br>Saint Cloud, MN 56301
                            </p>
                            <span class="inline-flex">
                                <a class="text-gray-500">
                                  <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                  </svg>
                                </a>
                                <a class="ml-4 text-gray-500">
                                  <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                                  </svg>
                                </a>
                                <a class="ml-4 text-gray-500">
                                  <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                                  </svg>
                                </a>
                                <a class="ml-4 text-gray-500">
                                  <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                  </svg>
                                </a>
                              </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>
