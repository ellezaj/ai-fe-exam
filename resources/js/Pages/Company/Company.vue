<script setup>
    import { useForm } from '@inertiajs/vue3';



    defineProps({
        companies: Object,
    })

    const form = useForm({})


    const deleteCompany = (company) => {
        form.delete(route('company.destroy',company.id))
    }

</script>

<template>
    <Head/>
    <div class="">
        <h1 class="title">Company Management</h1>
        <div>
            <div class="text-right my-2">
                <Link :href="route('company.create')" as="button" type="button" class="btn primary-btn">Create Company</Link>
            </div>
            <table class="">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="company in companies.data" :key="company.id">
                        <td>
                            <img :src="company.logo" alt="Company Logo">
                        </td>
                        <td>{{ company.name }}</td>
                        <td>{{ company.status == 1 ? 'Active' : 'Inactive'}}</td>
                        <td class="text-center">
                            <Link :href="route('company.edit', company)" as="button" type="button" class="btn warning-btn">Update</Link>
                            <button @click="deleteCompany(company)" type="button" class="btn danger-btn">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="my-4 text-right">
                <Link v-for="link in companies.links" :key="link.label" v-html="link.label" :href="link.url" class="p-1 mx-1" :class="{'text-slate-300' : !link.url, 'pagination-active' : link.active}"></Link>
            </div>
        </div>
    </div>

</template>
