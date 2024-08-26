<script setup>
    import { useForm } from '@inertiajs/vue3';

    defineProps({
        articles: Object,
    })
    const form = useForm({})
    const deleteArticle = (article) => {
        form.delete(route('article.destroy',article.id))
    }
</script>

<template>
    <div>
        <h1 class="title">All Media</h1>
        <div class="text-right my-2">
            <Link :href="route('article.create')" as="button" type="button" class="btn primary-btn">Create Article</Link>
        </div>
        <table class="table-fixed">
            <thead>
                <tr>
                    <th>Company</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Link</th>
                    <th>Writer</th>
                    <th>Editor</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="article in articles.data" :key="article.id">
                    <td>{{ article.company.name }} </td>
                    <td>
                        <img :src="article.image" alt="Article Image">
                    </td>
                    <td>{{ article.title }}</td>
                    <td>{{ article.link }}</td>
                    <td>{{ article.writer.firstname }} {{ article.writer.lastname }}</td>
                    <td>{{ article.editor.firstname }} {{ article.editor.lastname }}</td>
                    <td>{{ article.status == 1 ? 'Published' : 'For Edit'}}</td>
                    <td class="text-center">
                        <Link :href="route('article.show', article)" as="button" type="button" class="btn primary-btn">Preview</Link>
                        <Link :href="route('article.edit', article)" as="button" type="button" class="btn warning-btn">Update</Link>
                        <button @click="deleteArticle(article)" type="button" class="btn danger-btn">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Pagination -->
       <div class="my-4 text-right">
            <Link v-for="link in articles.links" :key="link.label" v-html="link.label" :href="link.url" class="p-1 mx-1" :class="{'text-slate-300' : !link.url, 'pagination-active' : link.active}"></Link>
        </div>
    </div>
</template>
