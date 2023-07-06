<x-guest-layout>
    <x-slot name="title">
        The Big Bank
    </x-slot>

    <x-slot name="header">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <!-- Bank Logo -->
            <h1 class="text-4xl font-bold text-gray-900">The Big Bank</h1>
        </div>
    </x-slot>

    <!-- Container for demo purpose -->
    <div class="container my-auto mx-auto md:px-6">
        <!-- Section: Design Block -->
        <div class="container mt-20 mx-auto md:px-6">
            <!-- Section: Design Block -->
            <section class="mb-8">

                <div class="flex flex-wrap items-center">
                    <div class="mb-12 w-full shrink-0 grow-0 basis-auto md:px-6 lg:mb-0 lg:w-5/12">
                        <div class="relative overflow-hidden rounded-lg bg-cover bg-[50%] bg-no-repeat
                        shadow-lg dark:shadow-black/20"
                             data-te-ripple-init data-te-ripple-color="light">
                            <img src="https://mdbcdn.b-cdn.net/img/new/textures/full/98.jpg" class="w-full"/>
                            <a href="#!">
                                <div
                                    class="absolute top-0 right-0 bottom-0 left-0 h-full w-full
                                    overflow-hidden bg-[hsl(0,0%,0%,0.4)] bg-fixed">
                                    <div class="flex h-full items-center justify-center">
                                        <div class="px-6 py-12 text-center text-white md:px-12">
                                            <h1 class="mt-2 mb-16 text-5xl font-bold tracking-tight
                                                md:text-6xl xl:text-7xl">
                                                Why our banking is so <br/><span class="text-gray-200">great</span>?
                                            </h1>
                                            <p class="text-[hsl(210,12%,80%)] mb-8">
                                                You can do lot of things in our bank!
                                            </p>
                                            <a class="inline-block rounded bg-gray-100 px-6 py-2 text-sm font-medium
                                            uppercase text-gray-800 transition duration-150 ease-in-out
                                            hover:bg-gray-300 hover:text-black  focus:bg-gray-300 focus:outline-none
                                            focus:ring-0
                                            active:bg-gray-400"
                                               href="{{ route('login') }}" role="button">Login</a>

                                            <a class="inline-block rounded px-6 py-2 text-sm font-medium uppercase
                                            text-white transition duration-150 ease-in-out hover:bg-gray-300
                                            hover:text-gray-900 focus:text-gray-900
                                            focus:outline-none focus:ring-0 active:text-gray-900"
                                               href="{{ route('register') }}" role="button">Register</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="relative overflow-hidden bg-cover bg-no-repeat">
                                    <div
                                        class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden
                                        bg-[hsl(0,0%,98.4%,0.2)] bg-fixed opacity-0 transition duration-300 ease-in-out
                                        hover:opacity-100">
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="w-full shrink-0 grow-0 basis-auto md:px-6 lg:w-7/12">
                        <div class="mb-6 flex">
                            <div class="shrink-0">
                                <div class="rounded-md bg-[hsl(204,30%,20%)] p-4 shadow-lg dark:bg-[hsl(204,23%,30%)]">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2"
                                         stroke="currentColor" class="h-6 w-6 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42
                                              15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655
                                              5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164
                                              1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004
                                              0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071
                                              2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25
                                              3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615
                                              8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 grow">
                                <p class="mb-1 font-bold">Authorization</p>
                                <p class="text-neutral-500 dark:text-neutral-300">
                                    Super-safe 2-factor authorization.
                                </p>
                            </div>
                        </div>

                        <div class="mb-6 flex">
                            <div class="shrink-0">
                                <div class="rounded-md bg-[hsl(204,30%,20%)] p-4 shadow-lg dark:bg-[hsl(204,23%,30%)]">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2"
                                         stroke="currentColor" class="h-6 w-6 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99
                                              11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03
                                              9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196
                                              0-6.1-1.248-8.25-3.285z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 grow">
                                <p class="mb-1 font-bold">Several bank accounts</p>
                                <p class="text-neutral-500 dark:text-neutral-300">
                                    You can create more than one bank account!
                                </p>
                            </div>
                        </div>

                        <div class="mb-6 flex">
                            <div class="shrink-0">
                                <div class="rounded-md bg-[hsl(204,30%,20%)] p-4 shadow-lg dark:bg-[hsl(204,23%,30%)]">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2"
                                         stroke="currentColor" class="h-6 w-6 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0
                                              006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0
                                              01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927
                                              14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09
                                              0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757
                                              4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013
                                              0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 grow">
                                <p class="mb-1 font-bold">Account transfers</p>
                                <p class="text-neutral-500 dark:text-neutral-300">
                                    You can transfer money from one account to another one!
                                </p>
                            </div>
                        </div>

                        <div class="mb-6 flex">
                            <div class="shrink-0">
                                <div class="rounded-md bg-[hsl(204,30%,20%)] p-4 shadow-lg dark:bg-[hsl(204,23%,30%)]">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none" viewBox="0 0 24 24" stroke-width="2"
                                         stroke="currentColor" class="h-6 w-6 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 grow">
                                <p class="mb-1 font-bold">History</p>
                                <p class="text-neutral-500 dark:text-neutral-300">
                                    Transaction history
                                </p>
                            </div>
                        </div>

                        <div class="mb-2 flex">
                            <div class="shrink-0">
                                <div class="rounded-md bg-[hsl(204,30%,20%)] p-4 shadow-lg dark:bg-[hsl(204,23%,30%)]">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2"
                                         stroke="currentColor" class="h-6 w-6 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42
                                              15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655
                                              5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164
                                              1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004
                                              0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071
                                              2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25
                                              3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615
                                              8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 grow">
                                <p class="mb-1 font-bold">Convert currency</p>
                                <p class="text-neutral-500 dark:text-neutral-300">
                                    If bank account is created in other currencies, do currency conversions to
                                    other accounts using official Bank of Latvia currency rate
                                </p>
                            </div>
                        </div>

                        <div class="mb-6 flex">
                            <div class="shrink-0">
                                <div class="rounded-md bg-[hsl(204,30%,20%)] p-4 shadow-lg dark:bg-[hsl(204,23%,30%)]">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" class="h-6 w-6 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 6v6l4 2m-4-8l-4 2m0 0v6M12 18h3l3 3-3-3h-3v-3zM4 6h8m8 0h-8m0
                                              0v12m0-12L8 12"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 grow">
                                <p class="mb-1 font-bold">Deposit account</p>
                                <p class="text-neutral-500 dark:text-neutral-300">
                                    You can make a deposit account
                                </p>
                            </div>
                        </div>

                        <div class="mb-6 flex">
                            <div class="shrink-0">
                                <div class="rounded-md bg-[hsl(204,30%,20%)] p-4 shadow-lg dark:bg-[hsl(204,23%,30%)]">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" class="h-6 w-6 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15.207 9.793l-6.5 6.5a2 2 0 01-2.914-2.672l6.5-6.5a2 2 0 012.914
                                              2.672zM13 12l5 5m0 0l-5-5m5 5H6m15-4h-3v3h3v-3zM6 7H3v3h3V7zm3
                                              0H6v3h3V7zm3 0H9v3h3V7zm3 0h-3v3h3V7zm3 0h-3v3h3V7zm0 3v3h3v-3h-3z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 grow">
                                <p class="mb-1 font-bold">Cryptocurrencies</p>
                                <p class="text-neutral-500 dark:text-neutral-300">
                                    You can buy cryptocurrencies using deposit accounts
                                </p>
                            </div>
                        </div>

                        <div class="mb-6 flex">
                            <div class="shrink-0">
                                <div class="rounded-md bg-[hsl(204,30%,20%)] p-4 shadow-lg dark:bg-[hsl(204,23%,30%)]">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" class="h-6 w-6 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 3l-3 9-3-9M22
                                        10h-6l-3 9L9 10H3"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 grow">
                                <p class="mb-1 font-bold">Flexible Deposit account</p>
                                <p class="text-neutral-500 dark:text-neutral-300">
                                    You can withdraw money or put more in the deposit account
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!-- Section: Design Block -->
        </div>
        <!-- Section: Design Block -->
    </div>
</x-guest-layout>
