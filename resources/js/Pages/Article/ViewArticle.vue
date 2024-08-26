<script setup>
import { reactive, ref,onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';

import Quill from 'quill';
import 'quill/dist/quill.snow.css'; // Import Quill styles
import Datepicker from 'vue3-datepicker/src/datepicker/Datepicker.vue'



const {companies, article} = defineProps({
    companies: Object,
    article: Object,
})
const form = useForm({
    company: article.company,
    image: null,
    title: article.title,
    link: article.link,
    date: new Date(article.date),
    content: article.content,
    status: article.status,
})

</script>

<template>
    <Head/>
    <h1 class="title">{{form.title}}</h1>
    <h1 class="subtitle">{{form.link}}</h1>
    <article v-for="article in articles.data" :key="article.id"  class="m-1">
        <div class="mb-4">
            <img :src="article.image" alt="Article Image">
        </div>

        <div class="pb-2 mx-4 mb-2 article_content">
            <h3 class="article_title">
                <a href="#">
                    {{article.title}}
                </a>
            </h3>
            <a :href="article.link" class="article_link" target="_blank">{{article.link}}</a>
        </div>
        <div class="text-right text-xs px-4 mb-1">
            <span class="article_date text-gray-500">{{formatDate(article.date)}}</span>
        </div>
        <div class="pb-4 grid grid-cols-2">
            <div class="px-4 text-xs">
                <div class="">Edited by:</div>
                <div class="text-gray-500">{{ article.editor.firstname }} {{ article.editor.lastname }}</div>
            </div>
            <div class="px-4 text-xs">
                <div class="">Written by:</div>
                <div class="text-gray-500">{{ article.writer.firstname }} {{ article.writer.lastname }}</div>
            </div>
        </div>
        <template v-html="article.content"></template>
    </article>
</template>
