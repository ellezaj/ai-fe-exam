<script setup>
    import { useForm } from '@inertiajs/vue3';

    defineProps({
        articles: Object,
        published_articles: Object,
    })
    const formatDate = (date) => {
        let getDate = new Date(date);
        return getDate.toLocaleDateString("en-US", { year: 'numeric', month: 'long', day: 'numeric' })
    }

    const setActiveTab = (id) => {
        let tabpanel = document.getElementsByClassName('panel');
        for (var i = 0; i < tabpanel.length; i++) {
            tabpanel[i].classList.remove('panel-active');
        }

        let tabpanelel = document.getElementById('tabs-'+id);
        tabpanelel.classList.add('panel-active');


        let tabs = document.getElementsByClassName('tabname');
        for (var i = 0; i < tabs.length; i++) {
            tabs[i].classList.remove('active');
        }

        let element = document.getElementById('tabs'+id);
        element.classList.add('active');
    }

</script>

<template>
    <div class="">
       <div class="tab">
            <div class="-mb-px flex space-x-8" aria-orientation="horizontal" role="tablist">
                <button id="tabs1" class="tabname flex-1 whitespace-nowrap active" aria-controls="tabs-1" role="tab" type="button" @click=setActiveTab(1)>For Edit</button>
                <button id="tabs2" class="tabname flex-1 whitespace-nowrap" aria-controls="tabs-2" role="tab" type="button" @click=setActiveTab(2)>Published</button>
            </div>
        </div>
        <div id="tabs-1" class="py-14 px-6 panel panel-active" aria-labelledby="tabs-1-tab-1" role="tabpanel" tabindex="0">
            <div class="">
                <div class="grid grid-cols-3 gap-4 xs:grid-cols-12">
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

                    </article>
                </div>
            </div>
        </div>
        <div id="tabs-2" class="py-14 px-6 panel" aria-labelledby="tabs-1-tab-2" role="tabpanel" tabindex="0">
           <div class="">
                <div class="grid grid-cols-3 gap-4 xs:grid-cols-12">
                    <article v-for="article in published_articles.data" :key="article.id"  class="m-1">
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

                    </article>
                </div>
            </div>
        </div>
    </div>
</template>
