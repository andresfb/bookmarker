<div class="sticky top-0 z-30 flex h-16 w-full justify-center bg-opacity-90 backdrop-blur transition-all duration-100 bg-base-100 text-base-content">
    <nav class="navbar w-full">

        <!-- Left section -->
        <div class="flex flex-1 md:gap-1 lg:gap-2">

            <!-- Menu Button -->
            <span class="tooltip tooltip-bottom before:text-xs before:content-[attr(data-tip)]" data-tip="Menu">
                <label for="drawer" class="btn btn-square btn-ghost drawer-button lg:hidden">
                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         class="inline-block h-5 w-5 stroke-current md:h-6 md:w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </label>
            </span>

            <!-- Search box -->
            <div class="max-w-sm" x-data="">
                <div class="text-gray-600">
                    <button type="button" @click="$dispatch('toggle-spotlight')"
                        class="inline-block pl-4 pr-5 pt-2 pb-2 flex align-center border border-gray-300 rounded-lg">
                        <svg class="text-gray-600 h-3 w-3 fill-current mt-1" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" id="Capa_1" x="0px" y="0px"
                             viewBox="0 0 56.966 56.966"
                             width="512px" height="512px">
                            <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23
                                s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92
                                c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17
                                s-17-7.626-17-17S14.61,6,23.984,6z" />
                        </svg>
                        <span class="px-4 text-gray-500 text-sm">Search...</span>
                        <span class="border rounded px-1 mr-2 text-gray-600 text-sm">⌘</span>
                        <span class="border rounded px-1 text-gray-600 text-sm">/</span>
                    </button>
                </div>
            </div>

        </div>

        <!-- Center / Right section -->
        <div class="flex-0">

            <div title="{{ Auth::user()->name }}" class="dropdown dropdown-end">
                <div tabindex="0" class="btn btn-ghost gap-1 normal-case">
                    <span class="hidden md:flex">{{ Auth::user()->name }}</span>
                    <div class="avatar placeholder flex md:hidden">
                        <div class="bg-neutral-content text-base rounded-full w-8">
                            <span class="text-xs">{{ Auth::user()->initials }}</span>
                        </div>
                    </div>
                    <svg width="12px" height="12px" class="ml-1 hidden h-3 w-3 fill-current opacity-60 sm:inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2048 2048">
                        <path d="M1799 349l242 241-1017 1017L7 590l242-241 775 775 775-775z"></path>
                    </svg>
                </div>
                <div class="dropdown-content bg-base-200 text-base-content rounded-t-box rounded-b-box top-px mt-16 w-56 overflow-y-auto shadow-2xl">
                    <ul class="menu menu-compact gap-1 p-3" tabindex="0">
                        <li class="disabled">
                            <div class="flex">
                                <span class="flex flex-1 justify-between">
                                    <small class="text-gray-500">Manage Account</small>
                                </span>
                            </div>
                        </li>
                        <li>
                            <a href="{{ route('profile.show') }}" class="flex">
                                <span class="flex flex-1 justify-between">Profile</span>
                            </a>
                        </li>
                        <li></li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf

                                <button type="submit" class="flex">
                                    <span class="flex flex-1 justify-between">Log Out</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

    </nav>
</div>
