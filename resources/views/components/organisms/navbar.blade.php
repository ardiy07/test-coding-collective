<nav class="relative shadow-b-xl flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start"
    navbar-main navbar-scroll="true">
    <div class="flex items-center justify-end w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
            <li class="flex items-center">
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-white py-2 px-3 shadow rounded font-semibold bg-gradient-to-tl from-purple-700 to-pink-500">Logout</button>
                </form>
            </li>
        </ul>
    </div>
    </div>
</nav>
