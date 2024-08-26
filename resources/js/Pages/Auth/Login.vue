<script setup>
    import { useForm } from '@inertiajs/vue3';

    const form = useForm({
        username: null,
        password: null
    })

    const submit = () => {
        form.post(route('login'), {
            onError: () => form.reset("password")
        });
    }
</script>

<template>
    <Head/>
    <h1 class="title">Archintel Frontend Exam</h1>
    <h2 class="subtitle">Jazelle Mae Toledo-De Guzman</h2>
    <hr class="my-6 mx-4">
    <h1 class="title">Sign In</h1>
    <div class="w-2/4 mx-auto">
        <form @submit.prevent="submit">
            <div class="mb-6">
                <label for="username">Username</label>
                <input type="text" v-model="form.username" :class="{'!ring-red-500' : form.errors.username}"/>
                <span class="error" v-if="form.errors.username">{{form.errors.username}}</span>
            </div>
            <div class="mb-6">
                <label for="password">Password</label>
                <input type="password" v-model="form.password" :class="{'!ring-red-500' : form.errors.password}"/>
                <span class="error" v-if="form.errors.password">{{form.errors.password}}</span>
            </div>
            <div>
                <button class="btn primary-btn w-full" :disabled="form.processing">Sign In</button>
            </div>
        </form>
    </div>
</template>
