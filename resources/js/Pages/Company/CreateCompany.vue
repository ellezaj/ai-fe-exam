<script setup>
    import { useForm } from '@inertiajs/vue3';

    const form = useForm({
        name: null,
        logo: null,
        status: 1
    })

    const change = (e) => {
        form.logo = e.target.files[0];
    }

    const submit = () => {
        form.post(route('company'), {
            onError: () => form.reset()
        });
    }
</script>

<template>
<div class="">
    <form @submit.prevent="submit">
        <div class="space-y-12">
            <div class="">
                <h1 class="title">Create Company</h1>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="col-span-full">
                        <label for="company-name" class="">Company name</label>
                        <div class="mt-2">
                            <input type="text" name="company-name" aria-label="company-name" id="company-name" autocomplete="off" class="" v-model="form.name" :class="{'!ring-red-500' : form.errors.name}">
                            <span class="error" v-if="form.errors.username">{{form.errors.username}}</span>
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label for="company-logo" class="">Company Logo</label>
                        <input id="logo-upload" name="logo-upload" type="file" accept="image/png, image/jpeg, image/jpg" @input="change">
                        <span class="error" v-if="form.errors.logo">{{form.errors.logo}}</span>
                    </div>
                    <div class="col-span-full">
                        <label for="status" class="">Status</label>
                        <div class="mt-2">
                            <select id="status" aria-label="status" name="status" autocomplete="off" class="" v-model="form.status" :class="{'!ring-red-500' : form.errors.status}">
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <Link :href="route('company')" as="button" type="button" class="btn secondary-btn">Cancel</Link>
            <button type="submit" class="btn primary-btn">Save</button>
        </div>
    </form>
</div>
</template>
