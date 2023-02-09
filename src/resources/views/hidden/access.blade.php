<x-app-layout>

    <form action="{{ route('hidden.access') }}" method="post">
        @method('PATCH')
        @csrf

        <section class="text-gray-600 body-font relative">
            <div class="container px-5 py-28 mx-auto">
                <div class="flex flex-col text-center w-full mb-12">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Access Hidden Bookmarks</h1>
                    <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Enter your password to view the list</p>
                </div>
                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                    <div class="flex flex-wrap -m-2">

                        <div class="p-2 w-full">
                            <div class="relative ">
                                <label for="password" class="leading-7 text-sm text-gray-600">Password</label>
                                <div class="relative w-full">
                                    <input
                                        id="password"
                                        type="password"
                                        name="password"
                                        onClick="this.select();"
                                        class="input input-bordered block p-2.5 w-full z-20
                                            focus:outline-none focus:ring-primary focus:border-primary"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 p-2 w-full space-x-3">
                            <button type="submit" class="btn btn-info">Access</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </form>

</x-app-layout>
