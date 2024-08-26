<script setup>
import { Link, Head } from '@inertiajs/vue3';
</script>

<template>
    <div>
        <header class="sticky top-0 z-10 mb-2 sm:d-none" v-if="$page.props.auth.user">
            <nav class="flex items-center justify-between p-4  mx-auto">

                <div class="flex space-x-6">
                    <Link :href="route('dashboard')" class="nav-link" :class="{'nav-active': $page.component === 'Dashboard'}">Dashboard</Link>
                    <Link :href="route('article')" class="nav-link" :class="{'nav-active': $page.component === 'Article'}">All Media</Link>

                    <!-- for editors only -->
                    <template v-if="$page.props.auth.user.type == 1">
                        <Link :href="route('dashboard')" class="nav-link" :class="{'nav-active': $page.component === 'User'}">User</Link>
                        <Link :href="route('company')" class="nav-link" :class="{'nav-active': $page.component === 'Company'}">Company</Link>
                    </template>
                    <!-- for editors only -->

                    <!-- {{$page.props.auth.user.firstname}} {{$page.props.auth.user.lastname}} -->
                </div>
                <div class="ml-auto">
                    <Link :href="route('logout')" method="post" as="button" type="button" class="nav-link grow-3">Logout</Link>

                </div>
            </nav>
        </header>
        <main class="main_container">
            <div class="w-3/4 mx-auto py-4">
                <slot/>
            </div>
        </main>
    </div>
</template>
