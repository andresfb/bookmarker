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
                                        onClick="this.select();"
                                        class="input input-bordered block p-2.5 w-full z-20
                                            focus:outline-none focus:ring-primary focus:border-primary"
                                        readonly>
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
                                    class="input input-bordered block p-2.5 w-full z-20
                                        focus:outline-none focus:ring-primary focus:border-primary"
                                    autofocus
                                    required>
                                @error('title') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Section -->
                        <div class="p-2 w-full">
                            <div class="relative">
                                <label for="section" class="leading-7 text-sm text-gray-600">Section</label>
                                <select wire:model.defer="marker.section_id"
                                    name="section"
                                    id="section"
                                    class="input input-bordered block p-2.5 w-full z-20
                                        focus:outline-none focus:ring-primary focus:border-primary">
                                @foreach($sections as $section)
                                    <option value="{{ $section['id'] }}">
                                        {{ $section['title'] }}
                                    </option>
                                @endforeach
                                </select>
                                @error('section') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Tags -->
                        <div class="p-2 mt-2 w-full">
                            <div class="relative">
                                {{ $this->form }}
                            </div>
                        </div>

                        <!-- notes -->
                        <div class="p-2 w-full">
                            <div class="relative">
                                <label for="message" class="leading-7 text-sm text-gray-600">Notes</label>
                                <textarea wire:model.defer="marker.notes"
                                    id="message"
                                    name="message"
                                    class="input input-bordered block p-2.5 w-full z-20
                                        focus:outline-none focus:ring-primary focus:border-primary
                                        h-32 py-1 px-3 resize-none"></textarea>
                            </div>
                        </div>

                        <div class="mt-4 p-2 w-full space-x-3">
                            <button type="submit" class="btn btn-info">Save</button>
                            <button wire:click="$emit('closeModal')" type="button" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>
