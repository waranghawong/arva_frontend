<script setup>
const props = defineProps(['courses_title']);

</script>

<template>
    <div>
    
            <div class="max-w-sm  p-4 mb-5 md:mb-5 xl:mb-2 text-center mx-2 hover:text-white text-[#ff8100] border border-[#ff8100] hover:bg-[#ff8100] text-xs font-semibold rounded">
                <nuxt-link :to="{ path: 'courses', hash: '#'+courses_title.section_id }">
                {{ courses_title.course_offer }}
                </nuxt-link>
            </div>

    </div>

</template>