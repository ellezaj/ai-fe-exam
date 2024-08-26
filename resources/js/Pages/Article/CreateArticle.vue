<script setup>
import { reactive, ref,onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';

import Quill from 'quill';
import 'quill/dist/quill.snow.css'; // Import Quill styles
import Datepicker from 'vue3-datepicker/src/datepicker/Datepicker.vue'

defineProps({
    companies: Object,
})

const form = useForm({
    company: null,
    image: null,
    title: null,
    link: null,
    date: new Date(),
    content: null,
})
const change = (e) => {
    form.image = e.target.files[0];
}
const submit = () => {
    getContent();
    form.content = editorContent;
    form.post(route('article'), {
        onError: () => form.reset()
    });
}

const editorContainer = ref(null);
const editorContent = ref('');
onMounted(() => {
    const quill = new Quill(editorContainer.value, {
        theme: 'snow',
        modules: {
        toolbar: [
            [{ header: [1, 2, false] }],
            ['bold', 'italic', 'underline'],
            [{ list: 'ordered' }, { list: 'bullet' }],
            ['link', 'image'],
            ['clean']
        ],
        },
    });
    const getContent = () => {
        editorContent.value = quill.root.innerHTML;
    };

    window.getContent = getContent;
});


const selectedDate = ref(new Date());
</script>

<template>
    <Head/>
    <h1 class="title">Create Article</h1>
    <div class="w-2/4 mx-auto">
        <form @submit.prevent="submit">
            <div class="col-span-full">
                <label for="company" class="">Related Company</label>
                <div class="mt-2">
                    <select id="company" aria-label="company" name="company" autocomplete="off" class="" v-model="form.company" :class="{'!ring-red-500' : form.errors.company}">
                        <option v-for="company in companies" :key="company.id" :value="company.id">{{company.name}}</option>
                    </select>
                </div>
            </div>
            <div class="mb-6">
                <label for="title">Title</label>
                <input type="text" v-model="form.title" :class="{'!ring-red-500' : form.errors.title}"/>
                <span class="error" v-if="form.errors.title">{{form.errors.title}}</span>
            </div>
            <div class="col-span-full">
                <label for="image" class="">Image</label>
                <input id="image-upload" name="image-upload" type="file" class="" accept="image/png, image/jpeg, image/jpg" @input="change">
                <span class="error" v-if="form.errors.image">{{form.errors.image}}</span>
            </div>
            <div class="mb-6">
                <label for="link">Link</label>
                <input type="text" v-model="form.link" :class="{'!ring-red-500' : form.errors.link}"/>
                <span class="error" v-if="form.errors.link">{{form.errors.link}}</span>
            </div>
            <div class="mb-6">
                <label for="date">Date</label>
                <Datepicker v-model="form.date" :locale="locale" />
                <span class="error" v-if="form.errors.date">{{form.errors.date}}</span>
            </div>
            <div class="mb-6">
                <label for="content">Content</label>
                <div ref="editorContainer"></div>
                <span class="error" v-if="form.errors.content">{{form.errors.content}}</span>
            </div>
            <div class="text-right">
                <button class="btn primary-btn" :disabled="form.processing">Create Article</button>
            </div>
        </form>
    </div>
</template>
