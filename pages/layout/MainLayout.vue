<template>
    <div class="m-auto max-w-screen-3xl">
        <header class='flex py-4 px-10 sm:px-10 font-[sans-serif] min-h-[70px] tracking-wide relative z-50 sm:mt-7 mt-0'>
            <div class='flex flex-wrap items-center justify-between gap-5 w-full'>
                <slot name="arva-logo"></slot>

                <div id="collapseMenu"
                class='max-lg:hidden lg:!block max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-50 max-lg:before:inset-0 max-lg:before:z-50'>
                <slot name="nav-menu"></slot>
                </div>

                <div class='flex max-lg:ml-auto space-x-3'>
                    <slot name="header-right"></slot>
                </div>
            </div>
        </header>
        <div
            class="text-black bg-primary mx-auto max-w-screen"
            v-if="$slots['sub-header']"
        >
            <slot name="sub-header"></slot>
        </div>

        <div class="first_content text-gray-600 w-full">
            <slot name="content"></slot>
        </div>
        <div class="text-gray-600 py-4 ">
            <slot name="popular-courses"></slot>
        </div>
        <div class="text-gray-600 py-4 px-10">
            <slot name="courses-category"></slot>
        </div>
        <div class="text-gray-600 py-4 px-10">
            <slot name="benefits"></slot>
        </div>
        <div class="text-gray-600 py-4 px-10">
            <slot name="gift-card"></slot>
        </div>
        <div class="text-gray-600 py-4 px-10">
            <slot name="exclusive-bundles"></slot>
        </div>
        <div class="max-w-screen- bottom-0 left-0 right-0 bg-primary text-black-800">
            <slot name="bottom-section"></slot>
        </div>
    </div>
</template>
<script lang="ts" setup></script>

<style scoped>
.first_content {
  height: 100vh;
}
</style>